<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactsRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'image' => ['nullable'],
        ];
    }

    public function  messages(): array
    {
        return [
            'name.required' => "The name field Required",
            'name.min' => "The name must be at least :min characters.",
            'name.max' => "The name may not be greater than :max characters.",
        ];
    }
}
