<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactsMobileRequest extends FormRequest
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
            'number' => ['required', 'digits:11','unique:contact_mobiles,number'],
        ];
    }

    public  function messages(): array
    {
        return [
            'number.required' => "The :attribute field is Required",
            'number.digits'   => "The Number must be 11 digits.",
            'number.unique'   => "This number has already been recorded."
        ];
    }
}
