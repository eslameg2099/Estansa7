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

            $phone='201091447746';
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://graph.facebook.com/v16.0/116077974838171/messages',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "to": '. $phone.',
                "type": "template",
                "template": {
                    "name": "hello_world",
                    "language": {
                        "code": "en_US"
                    }
                }
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAAH2w2WZAssUBAJvi31ykJL5RGRXJYiav5hswPzzXFDIjCBKc7FYE9Nk5oXd7UjT2YsnrUrQKkU4WFY7aIh0BDneeZCQi6midwxweUaKRHQZAmPZBtXytta5UNZAWFyZAXro1YlINxuSqzv8XOf3ZC2ONw07BbbhUDjtx8SOxnARUtGrGJDmajU',
                'Content-Type: application/json'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);

        }
        return 0;
      
    }
}
