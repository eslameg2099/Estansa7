<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\AvailableTime;
use App\Http\Requests\Api\AvailableTimeRequest;
use App\Http\Resources\AvailableTimeResource;

class AvailableTimeController extends Controller
{

    
    use AuthorizesRequests, ValidatesRequests;

    /**
     * EstateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->availabletimes->groupBy('day_id');
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
    public function store(AvailableTimeRequest $request)
    {
      $this->check($request->day_id,$request->from,$request->to);  
      $AvailableTime =  $request->user()->availabletimes()->create($request->all());
      return new AvailableTimeResource($AvailableTime);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AvailableTime $availabletime)
    {
        return new AvailableTimeResource($availabletime);
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
    public function update(AvailableTimeRequest $request, $id)
    {
        $availabletime =  $request->user()->availabletimes()->findorfail($id);
        $availabletime->update($request->all());
        return new AvailableTimeResource($availabletime);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $availabletime =  $request->user()->availabletimes()->findorfail($id);
        $availabletime->delete();
        return response()->json([
            'message' => "تم الحذف بنجاح",
        ]);

    }


    public function toggleLock(Request $request,$id)
    {

        $availabletime =  $request->user()->availabletimes()->findorfail($id);
        if ($availabletime->active == '0') {

            $availabletime->update(['active' => '1']);


            return new AvailableTimeResource($availabletime);
        }

        $availabletime->update(['active' => '0']);


        return new AvailableTimeResource($availabletime);
    }


    public function daylock(Request $request,$id)
    {
        $availabletimes =  $request->user()->availabletimes()->where('day_id',$id)->update(['active' => '0']);
        return response()->json([
            'message' => "تم تعطيل اليوم بنجاح",
        ]);

    }

    public function dayunlock(Request $request,$id)
    {
        $availabletimes =  $request->user()->availabletimes()->where('day_id',$id)->update(['active' => '1']);
        return response()->json([
            'message' => "تم تفعيل اليوم بنجاح",
        ]);

    }

    public  function check(Request $request,$day_id,$from,$to)
    {
        $AvailableTime =  $request->user()->availabletimes()->where('day_id',$day_id)->where('from',$from)->where('to',$to)->first();
        if($AvailableTime != null)
        {
            return response()->json([
                'message' => "هذا المعاد محدد من قبل",
            ]);
        }

        
    }


}
