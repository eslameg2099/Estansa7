<?php


namespace App\Traits;


use App\Models\Coupon;

trait CouponTrait
{
    protected $coupon;

    protected function set_coupon($value){
        $this->coupon = Coupon::where('id',$value)->orWhere('title',$value)->first();
        return $this->coupon;
    }
    /**
     * Check if user can withdrew.
     *
     * @param object $this
     *
     * @return bool
     */
    public function is_valid_coupon($value)
    {
        return true;
    }

    /**
     * Check if user can withdrew.
     *
     * @param object $record
     *
     * @return array
     */
    public function get_discount()
    {
        if(! $this->is_valid_coupon($this->coupon)) return [];
        return [
            "type" => is_null($this->discount) ? Coupon::PERCENTAGE_DISCOUNT : Coupon::NUMERIC_DISCOUNT,
            "value" => is_null($this->discount) ? $this->discount_percentage : $this->discount,
        ];
    }
    /**
     * Check if user can withdrew.
     *
     * @param object $record
     *
     * @return float
     */
    public function apply_coupon($coupon , $price)
    {
        if(is_null($this->set_coupon($coupon))) return null;
        if(! $this->is_valid_coupon($coupon)) return null;
        $price = is_null($this->coupon->discount) ? $this->discount_percentage($price,$this->coupon->discount_percentage) : $this->$this->discount_value($price,$this->coupon->discount);
        return $price;
    }
    /**
     * Check if user can withdrew.
     *
     * @param object $record
     *
     * @return float
     */
    protected function discount_value($price , $value)
    {
        return $price - $value;
    }
    /**
     * Check if user can withdrew.
     *
     * @param object $record
     *
     * @return float
     */
    protected function discount_percentage($price , $value)
    {
        $percentage = (100 - $value) / 100;
        return $price * $percentage;
    }
}
