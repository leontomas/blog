<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string|max:250',
            'summary' => 'required|string|max:250',
            'content' => 'required|string|max:250',
            'tag' => 'required|string|max:50',
            'user_id' => 'required|integer|users,id'
        ];
    }
}
