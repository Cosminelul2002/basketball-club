<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'role' => 'required|string|exists:roles,key', // 'player' or 'admin
            'confirmedPassword' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Numele este obligatoriu.',
            'last_name.required' => 'Prenumele este obligatoriu.',
            'email.required' => 'Email-ul este obligatoriu.',
            'email.email' => 'Email-ul trebuie sa fie valid.',
            'email.unique' => 'Email-ul este deja folosit.',
            'password.required' => 'Parola este obligatorie.',
            'role.required' => 'Rolul este obligatoriu.',
            'role.exists' => 'Rolul nu exista.',
            'confirmedPassword.required' => 'Confirmarea parolei este obligatorie.',
            'confirmedPassword.same' => 'Parolele nu coincid.',
        ];
    }
}
