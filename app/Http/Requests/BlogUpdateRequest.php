<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:blogs,id',
            'title' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string|max:50',
            'summary' => 'required|string|max:50',
            'content' => 'required|string|max:50',
            'tag' => 'required|string|max:50',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
