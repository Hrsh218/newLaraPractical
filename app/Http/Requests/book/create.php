<?php

namespace App\Http\Requests\book;

use Illuminate\Foundation\Http\FormRequest;

class create extends FormRequest
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
            'name' => 'required',
            'category' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:4096',
            'author_name' => 'required',
            'published_date' => 'required',
        ];
    }
}
