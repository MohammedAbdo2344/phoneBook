<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactsMailRequest extends FormRequest
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
            'mail' => ['required', 'unique:contact_mails,mail', 'email'],
        ];
    }

    public  function messages(): array
    {
        return [
            'mail.required' => "The mail field Required",
            'mail.unique'   => "This email has already been used.",
            'mail.email'    => "Please enter a valid email address."
        ];
    }
}
