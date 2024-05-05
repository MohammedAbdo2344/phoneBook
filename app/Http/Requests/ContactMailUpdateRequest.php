<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMailUpdateRequest extends FormRequest
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
            'id'=>['required','exists:contact_mails,id'],
            'mail' => ['required', 'unique:contact_mails,mail', 'email'],
        ];
    }

    public  function messages(): array
    {
        return [
            'id.required'=>"The id field is Required",
            'id.exists'=>"Cannot Update this contact mail",
            'mail.required' => "The :attribute field is Required",
            'mail.unique'   => "This email has already been used.",
            'mail.email'    => "Please enter a valid email address."
        ];
    }
}
