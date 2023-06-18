<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                'user' => $reservation->provider->name,
                'code'=> $reservation->id,
                'email'=>$reservation->provider->email,
                'type'=>'remberprovider',
                'title'=>'نذكرك بمعاد جلسة اليوم',
                'date'=> $reservation->day_at->toDateString(),
                'from'=>$reservation->from,
               ]); 

               $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
                'user' => $reservation->customer->name,
                'code'=> $reservation->id,
                'email'=>$reservation->customer->email,
                'type'=>'remberprovider',
                'title'=>'نذكرك بمعاد جلسة اليوم',
                'date'=> $reservation->day_at->toDateString(),
                'from'=>$reservation->from,

               ]); 

        }
        return 0;
      
    }
}
