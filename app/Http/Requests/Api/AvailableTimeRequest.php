<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;
use App\Http\Requests\Concerns\HasPrefix;

class AvailableTimeRequest extends FormRequest
{

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
            'day_id' => ['required', 'numeric','between:0,6'],
            'from' => ['required', 'date_format:H:i'],
            'to' => ['required', 'date_format:H:i'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('AvailableTime.attributes');
    }
}
