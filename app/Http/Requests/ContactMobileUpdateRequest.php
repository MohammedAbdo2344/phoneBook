<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMobileUpdateRequest extends FormRequest
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
            'id'=>['required','exists:contact_mobiles,id'],
            'number' => ['required', 'digits:11','unique:contact_mobiles,number'],
        ];
    }

    public  function messages(): array
    {
        return [
            'id.required'=>"The id field is Required",
            'id.exists'=>"Cannot Update this contact mobile",
            'number.required' => "The :attribute field is Required",
            'number.digits'   => "The Number must be 11 digits.",
            'number.unique'   => "This number has already been recorded."
        ];
    }
}
