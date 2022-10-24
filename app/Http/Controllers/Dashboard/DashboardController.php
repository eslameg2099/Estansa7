<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use App\Models\Reservation;
use App\Models\Admin;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Reservations = Reservation::with('customer','category','provider')
        ->whereDate('day_at', today())
        ->filter()
        ->paginate(10);
       
        return view('dashboard.home', compact('Reservations'));
    }
}
