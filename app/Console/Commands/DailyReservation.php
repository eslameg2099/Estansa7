<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
class DailyReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::with('customer','category','provider')
        ->whereDate('day_at', today())
        ->where('stauts','2')
        ->get();
        foreach ($reservations as $reservation){

            $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
                'user' => $reservation->customer->name,
                'code'=> $reservation->id,
                'email'=>$reservation->provider->email,
                'type'=>'done',
                'title'=>'تم تاكيد حجز الجلسة بنجاح',
                'date'=> $reservation->day_at,
               ]); 

        }
      
      
    }
}