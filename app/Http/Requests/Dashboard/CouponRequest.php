<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }

      
    }


    public function createRules()
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:coupons,code'],
            'percentage_value' => ['required', 'numeric'],
            'usage_count' => ['required', 'numeric'],
            'expired_at' => ['required', 'date'],
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    public function updateRules()
    {
        return [
            'code' => ['required', 'string', 'max:255'. $this->route('coupon')->id],
            'percentage_value' => ['required', 'numeric'],
            'usage_count' => ['required', 'numeric'],
            'expired_at' => ['sometimes', 'date'],
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('coupons.attributes');
    }
}
