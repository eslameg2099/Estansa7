<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;

class ProviderRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' =>['nullable', 'string', 'max:900'],
            'category_id' => ['required', 
            'exists:category_providers,id'],
            'skills' => ['nullable', 'string','max:5000'],
            'unit_price' => ['required','numeric','min:1'],
            'experience' => ['required','numeric','between:0,4'],
            
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->route('provider')->id],
            'phone' => ['required', 'unique:users,phone,' . $this->route('provider')->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('users.types')))],
             'category_id' => ['required', 
            'exists:category_providers,id'],
            'unit_price' => ['required','numeric','min:1'],
            'experience' => ['required','numeric','between:0,4'],
            'skills' => ['nullable', 'string','max:5000'],
            'bio' =>['nullable', 'string', 'max:900'],
            'address' => ['nullable', 'string', 'max:255'],



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
