<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;
use App\Http\Requests\Concerns\HasPrefix;

class ExcuseRequest extends FormRequest
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
            'reservation_id' => ['required', 'exists:reservations,id'],
            'reason' => ['required', 'string', 'max:500'],
            'type' => ['required', 'numeric','between:1,2'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('excuse.attributes');
    }
}
