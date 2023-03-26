<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Excuse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Reservation;
use App\Http\Requests\Api\ExcuseRequest;
use Illuminate\Support\Facades\Http;

class ExcuseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ExcuseRequest $request)
    {
      $Excuse = Excuse::create([
        'provider_id'=>$request->user()->id,
        'type'=>$request->type,
        'reservation_id'=>$request->reservation_id,
        'reason'=>$request->reason,
      ]);
      $Reservation = Reservation::findorfail($request->reservation_id);
      $Reservation->update(['stauts'=> '4']); 

      $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
        'user' => $Reservation->customer->name,
        'code'=> $Reservation->id,
        'email'=>$Reservation->customer->email,
        'type'=>'cancel',
        'title'=>'مقدم الخدمة يعتذر عن الجلسة',
        'date'=> $Reservation->day_at,
        

    ]); 

      return response()->json([
        'message' => "تم بنجاح سوف نتواصل معك قريبا",
    ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
