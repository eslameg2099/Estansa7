<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;

class PostRequest extends FormRequest
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
            'titele' => ['required', 'string', 'max:255' ],
            'slug'=>['required', 'string', 'max:120', 'unique:posts,slug'],
            'description' => ['required', 'string', 'max:8000'],
            'category_id' => ['required', 'exists:category_posts,id'],
           // 'image' => ['required', 'image'],
            'user_id' => ['required', 'exists:users,id'],

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
            'titele' => ['required', 'string', 'max:255' ],
          //  'slug'=>['required', 'string', 'max:120', 'unique:posts,slug'. $this->post->id],
            'description' => ['required', 'string', 'max:8000'],
            'category_id' => ['required', 'exists:category_posts,id'],
           // 'image' => ['required', 'image'],
            'user_id' => ['required', 'exists:users,id'],

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
