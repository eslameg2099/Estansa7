<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\Api\ReservationRequest;
use App\Models\AvailableTime;
use Illuminate\Support\Facades\Http;
use App\Events\updateavailable_times;
use App\Models\Coupon;
use App\Models\Userused;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;
use App\Http\Resources\ReservationResource;
use Illuminate\Validation\ValidationException;
use App\Models\Helpers\PaymobHelpers;
use App\Traits\mail;

use function PHPUnit\Framework\returnCallback;

class ReservationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests,mail;

    /**
     * EstateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('paymob_payment_verify');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Reservations = Reservation::auth()->where('stauts','2')->filter()->OrderByDESC('id')->simplePaginate();
        return ReservationResource::collection($Reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
      
       $availabletime =  AvailableTime::where('id',$request->availableday_id)->firstOrFail();

       $this->check($availabletime);
       $userused = null ;

       if($request->free == true)
       {
        $userused = $this->checkused($request->user()->id);
       }

       $coupon_id = null ;

       if ($value = $request->input('coupon')) {
        $this->applyCoupon($availabletime, $value);
        $coupon_id = Coupon::where('code',$request->input('coupon'))->first()->id;
       }

       $Reservation =  Reservation::create([
        'user_id'  => $request->user()->id,
        'provider_id'   => $availabletime->user_id,
        'from'   => $availabletime->from,
        'to'   => $availabletime->to,
        'comment'   => $request->comment,
        'category_id'   => $availabletime->provider->category_id,
        'day_at'   => $request->day_at,
        'cost'   => $this->cost_reservation($availabletime),
        'availabletime_id'=>$availabletime->id,
        'coupon_id'=> $coupon_id,
       ]);

       ///free

      


     if($userused == 0 && $request->free == true)
     {
        event(new updateavailable_times($Reservation->availabletime));
        $Reservation->update(['stauts'=> '2','free'=>'1']); 
        $this->sendmail($Reservation->customer->name,$Reservation->id,$Reservation->provider->email,'done','تم  حجز استشارة لديكم ',Carbon::parse($Reservation->day_at)->format('Y/m/d'),Carbon::parse($Reservation->from)->format('h:i A'));
        $this->sendmail($Reservation->customer->name,$Reservation->id,$Reservation->customer->email,'done','تم تاكيد حجز الاستشارة بنجاح ',Carbon::parse($Reservation->day_at)->format('Y/m/d'),Carbon::parse($Reservation->from)->format('h:i A'));
        return ('https://estansa7.com/book-consult?expert_id='.$Reservation->provider_id.'&book_step=3');
     }

     return   PaymobHelpers::payment(677122,$request->user(),$Reservation);

    }


    protected function applyCoupon(AvailableTime $availabletime, $coupon)
    {
        /** @var \App\Models\Coupon $coupon */
        
        if (! $coupon = Coupon::where('code', $coupon)->first()) {
            throw ValidationException::withMessages([
                'coupon' => [__('The coupon you entered is invalid.')],
            ]);
        }

        if ($coupon->isExpired()) {
            throw ValidationException::withMessages([
                'coupon' => [__('The coupon you entered is expired.')],
            ]);
        }

        if ($coupon->usage >= $coupon->usage_count) {
            throw ValidationException::withMessages([
                'coupon' => [__('The coupon you entered is used.')],
            ]);
        }

     
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $reservation = $request->user()->Reservations()->where('id',$id)->firstorfail(); 
        $reservation->delete();
        return response()->json([
            'message' => "تم الحذف بنجاح",
        ]);
    }

    public function checkused($id)
    { 
        $userused = Userused::where('user_id',$id)->first();
        if($userused != null)
        {
            throw ValidationException::withMessages([
                'message' => 'لقد استخدمت التجربة المجانية من قبل',
            ]);
        }
        else
        $userused = Userused::create(['user_id'=>$id]);
        return 0;
    }

    public function check($availabletime)
    {
        if($availabletime->booked_up != '0')
        {
            throw ValidationException::withMessages([
                'message' => 'محجوز من قبل',
            ]);
        }
    }
   

    public function paymob_payment_verify(Request $request)
    {
        $string = $request['amount_cents'] . $request['created_at'] . $request['currency'] . $request['error_occured'] . $request['has_parent_transaction'] . $request['id'] . $request['integration_id'] . $request['is_3d_secure'] . $request['is_auth'] . $request['is_capture'] . $request['is_refunded'] . $request['is_standalone_payment'] . $request['is_voided'] . $request['order'] . $request['owner'] . $request['pending'] . $request['source_data_pan'] . $request['source_data_sub_type'] . $request['source_data_type'] . $request['success'];
        if ($request['success'] == "true")
        {
            $reservation  =  Reservation::where('payment_id',$request['order'])->firstorfail();  
            $reservation->update(['stauts'=> '2']); 
            if($reservation->coupon_id != null )
            {
                $reservation->update(['discount'=> ($reservation->coupon->percentage_value * $reservation->cost /100)]);
                $coupon = $reservation->coupon;
                $coupon->usage = $coupon->usage + 1;
                $coupon->save(); 

            }
			event(new updateavailable_times($reservation->availabletime));
            $message = "تم الدفع والحجز بنجاح";
            PaymobHelpers::transactions_reservation($reservation);

            $this->sendmail($reservation->customer->name,$reservation->id,$reservation->provider->email,'done','تم  حجز استشارة لديكم ',Carbon::parse($reservation->day_at)->format('Y/m/d'),Carbon::parse($reservation->from)->format('h:i A'));
            $this->sendmail($reservation->customer->name,$reservation->id,$reservation->customer->email,'done','تم تاكيد حجز الاستشارة بنجاح ',Carbon::parse($reservation->day_at)->format('Y/m/d'),Carbon::parse($reservation->from)->format('h:i A'));
         

            return redirect('https://estansa7.com/book-consult?expert_id='.$reservation->provider_id.'&book_step=3');

		   // return (new ReservationResource($reservation))->additional(compact('message'));
        }
        else
        {
                return response()->json([
                'message' => "لم يتم الحجز يرجي مراجعة بيانات الكارت الخاص بيكم",
                ]);
            
        }
    }


    public function finish_reservation(Request $request,$id)
    {   
        $reservation = $request->user()->Reservations()->where('id',$id)->firstorfail(); 
        $reservation->update(['stauts'=> '3']); 
        $reservation->availabletime->update(['booked_up'=> '0']);
        return response()->json([
            'message' => "تم انهاء الجلسة بنجاح",
            ]);
    }


    public function cost_reservation($availabletime)
    {
        if($availabletime->provider->free_session == '1' ){return 0;}else return $availabletime->provider->unit_price ;
    }

}
