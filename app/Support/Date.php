<?php

namespace App\Support;

use JsonSerializable;
use Illuminate\Support\Carbon;

class Date implements JsonSerializable
{
    /**
     * @var string|float
     */
    protected $date;

    /**
     * Create Price Instance.
     *
     * @param $date
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'datetime' => Carbon::parse($this->date)->toDateTimeString(),
            'date' => Carbon::parse($this->date)->toDateString(),
            'for_humans' => Carbon::parse($this->date)->diffForHumans(),
            'formatted' => Carbon::parse($this->date)->toDayDateTimeString(),
        ];
    }

    /**
     * Convert date to string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) data_get($this->jsonSerialize(), 'date');
    }
}
