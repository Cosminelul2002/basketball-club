<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'salary_id' => 'required|integer',
            'staff_role_id' => 'required|integer',
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
            'first_name.required' => 'Prenumele este obligatoriu.',
            'last_name.required' => 'Numele este obligatoriu.',
            'email.required' => 'Emailul este obligatoriu.',
            'phone.required' => 'Numarul de telefon este obligatoriu.',
            'date_of_birth.required' => 'Data nasterii este obligatorie.',
            'salary_id.required' => 'Salariul este obligatoriu.',
            'staff_role_id.required' => 'Rolul este obligatoriu.',
        ];
    }
}
