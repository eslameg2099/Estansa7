<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;
use App\Http\Requests\Concerns\HasPrefix;

class RegisterRequest extends FormRequest
{
    use WithHashedPassword;

    /**
     * Determine if the supervisor is authorized to make this request.
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
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => [
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),
            ],
           

            'cv' => [
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),
            ],

            'category_id' => [
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),'exists:category_providers,id',

            ],

           
            'skills' => [
                
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),'max:500',
            ],
            'unit_price' => [
                
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),'numeric','min:1',
            ],
            'experience' => [
                
                Rule::requiredIf(function () {
                    return $this->type == User::Provider_TYPE;
                }),'numeric','between:0,4',
            ],
            'type' => [
                'nullable',
                Rule::in([
                    User::CUSTOMER_TYPE,
                    User::Provider_TYPE,

                ]),
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('customers.attributes');
    }
}
