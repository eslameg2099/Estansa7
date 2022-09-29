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
}
