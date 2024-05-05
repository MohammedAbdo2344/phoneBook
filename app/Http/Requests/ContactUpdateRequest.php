<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'=>['required','exists:contacts,id'],
            'name' => ['required','regex:/^[\p{L}\p{M}\s.\-]+$/u', 'min:3', 'max:100'],
            'image' => ['nullable'],
        ];
    }
    public function  messages(): array
    {
        return [
            'id.required'=>"The id field is Required",
            'id.exists'=>"Cannot Update this contact",
            'name.required' => "The :attribute field is Required",
            'name.min' => "The name must be at least :min characters.",
            'name.max' => "The name may not be greater than :max characters.",
            'name.regex'=>"The name must be a string."
        ];
    }
}
