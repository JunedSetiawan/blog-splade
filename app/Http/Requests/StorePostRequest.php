<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:150',
            'category_id' => 'exists:categories,id',
            'body' => 'required|min:10',
            'user_id' => 'exists:users,id',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            'tag_id.*' => 'exists:tags,id'
        ];
    }
}
