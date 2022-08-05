<?php

namespace App\Support;

use JsonSerializable;
use Laraeast\LaravelSettings\Facades\Settings;

class Price implements JsonSerializable
{
    /**
     * @var string|float
     */
    protected $price;

    /**
     * @var mixed|null
     */
    protected $currency;

    /**
     * Create Price Instance.
     *
     * @param $price
     */
    public function __construct($price)
    {
        $this->price = $price;

        $this->currency = 'ج.م';
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'amount' => (float) $this->price,
            'formatted' => (float) $this->price.' '.$this->currency,
            'string_amount' => (string) $this->price,
            'currency' => (string) $this->currency,
        ];
    }

    /**
     * Convert price to string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) data_get($this->jsonSerialize(), 'formatted');
    }
}
