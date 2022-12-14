<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;
use App\Http\Requests\Concerns\HasPrefix;

class PostRequest extends FormRequest
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
            'titele' => ['required', 'string', 'max:255' ],
            'slug'=>['required', 'string', 'max:120', 'unique:posts,slug'],
            'description' => ['required', 'string', 'max:5000'],
            'category_id' => ['required', 'exists:category_posts,id'],
           // 'image' => ['required', 'image'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('posts.attributes');
    }
}
