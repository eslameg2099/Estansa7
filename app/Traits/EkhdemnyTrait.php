<?php

namespace App\Traits;

use App\Models\Address;
use App\Models\Helpers\priceHelper;
use App\Models\Kitchen;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Object_;

trait EkhdemnyTrait
{
    private array $record = [];
    public array $statuses = [
        '00' => 'Order created successfully',
        '01' => 'Error: Order Reference already exist!',
        '02' => 'Error: Order Reference is empty or null!',
        '03' => 'Error Creating customer infirmation',
        '04' => 'Error while creating order, check entered details!',
        '05' => 'Failed creating the Kitchen profile!',
        '06' => 'You are not allowed to create orders!',
        '07' => 'Credentials are not correct!',
        '08' => 'System Error! unable to get order!',
    ];

    public string $successCode = '00';
    public array $OrderReference = [];

    public function setOrderRefrence()
    {
        $this->OrderReference = [
          'OrderReference'  => $this->id
        ];
    }
    public function setRecord()
    {
        $this->record =  [
            'OrderReference'=>'HOMEZ00'.$this->id,
            'Kitchen'=> "Kitchen ".$this->kitchen->id,
            'Phone'=> $this->chef->phone,
            'KitchenGeoLocation'=> $this->kitchen->longitude.",". $this->kitchen->latitude ,
            'Pickup_DateTime'=>$this->cooked_at->toDateTimeString(),
            'FirstName'=>$this->customer->name,
            'LastName'=>$this->customer->name,
            'Mobile'=>$this->chef->phone,
            'ClientGeoLocation'=> $this->address->longitude ."," .$this->address->latitude,
            'Comment'=>$this->notes
        ];
        return $this;
    }
    public function choosePrice(): float
    {
        $address = Address::findOrFail($this->address_id);
        $kitchen = Kitchen::findOrFail($this->kitchen_id);
        $distance = priceHelper::deliveryDistance($kitchen->longitude,$kitchen->latitude,$address->longitude,$address->latitude);
        switch ($distance)
        {
            case $distance > 0 && $distance <= 20:
                return 20;
            case $distance > 20 && $distance <= 30:
                return 30;
            case $distance > 30 && $distance <= 40:
                return 45;
            default:
                return 45;
        }
    }
    public function requestDelivery()
    {
        $config = config('services.ekhdemny');
        return Http::withBasicAuth($config['user'], $config['pass'])->post("http://driverapi.wenetlb.net/api/homezCreateOrder",$this->record);
    }
    public function requestCancelDelivery()
    {
        $config = config('services.ekhdemny');
        return Http::withBasicAuth($config['user'], $config['pass'])->post("http://driverapi.wenetlb.net/api/HomezOrderCancelation",$this->OrderReference);
    }


    public function deliveryStatus(string $orderReference)
    {
        $config = config('services.ekhdemny');
        $response = Http::withBasicAuth($config['user'], $config['pass'])->post("http://driverapi.wenetlb.net/api/getHomezOrderStatus",[
            "OrderReference" => $orderReference
        ]);
        dd($response->json());
    }
}