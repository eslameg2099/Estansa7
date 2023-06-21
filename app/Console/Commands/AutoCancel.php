<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
class AutoCancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:cancel';

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
        $reservations = Reservation::whereDate('day_at', today())
        ->where('stauts','2')
        ->whereTime('from','<',Carbon::now()->toTimeString())
        ->get();
        foreach ($reservations as $reservation){
            $reservation->update(['stauts'=> '3']); 
        }
        return 0;
    }
}
