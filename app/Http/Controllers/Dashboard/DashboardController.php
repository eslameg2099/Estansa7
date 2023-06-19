<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use App\Models\Reservation;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $reservations = Reservation::with('customer','category','provider')
        ->whereDate('day_at', today())
        ->where('stauts','2')
        //->where('from',Carbon::now()->toTimeString())
        ->first();
        return $reservations;
        $Reservations = Reservation::with('customer','category','provider')
        ->whereDate('day_at', today())
        ->where('stauts','2')
        ->filter()
        ->paginate(10);
       
        return view('dashboard.home', compact('Reservations'));
    }
}
