<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
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
            'first_name' => 'alpha|max:255',
            'last_name' => 'alpha|max:255',
            'date_of_birth' => 'date',
            'email' => 'email|max:255',
            'phone' => 'numeric|digits_between:10,15',
            'description' => 'string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.alpha' => 'Numele poate conține doar litere.',
            'first_name.max' => 'Numele nu poate avea mai mult de :max caractere.',
            'last_name.alpha' => 'Prenumele poate conține doar litere.',
            'last_name.max' => 'Prenumele nu poate avea mai mult de :max caractere.',
            'date_of_birth.date' => 'Data de naștere trebuie să fie o dată validă.',
            'email.email' => 'Adresa de email trebuie să fie o adresă de email validă.',
            'email.max' => 'Adresa de email nu poate avea mai mult de :max caractere.',
            'phone.numeric' => 'Numărul de telefon trebuie să fie un număr valid.',
            'phone.digits_between' => 'Numărul de telefon trebuie să aibă între :min și :max cifre.',
            'description.max' => 'Descrierea nu poate avea mai mult de :max caractere.',
        ];
    }
}
