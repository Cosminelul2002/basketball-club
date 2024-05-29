<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest
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
            'amount' => 'required',
            'currency' => 'required|string',
            'salary_type' => 'required|string',
            'duration' => 'required',
            'duration_type' => 'required|string',
            'description' => 'required|string',
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
            'amount.required' => 'Câmpul suma este obligatoriu.',
            // 'amount.regex' => 'Câmpul suma trebuie să fie un număr valid.',
            'currency.required' => 'Câmpul valută este obligatoriu.',
            'currency.string' => 'Câmpul valută trebuie să fie text.',
            'type.required' => 'Câmpul tip este obligatoriu.',
            'type.string' => 'Câmpul tip trebuie să fie text.',
            'start_date.required' => 'Câmpul data de început este obligatoriu.',
            'start_date.date' => 'Câmpul data de început trebuie să fie o dată.',
            'end_date.required' => 'Câmpul data de sfârșit este obligatoriu.',
            'end_date.date' => 'Câmpul data de sfârșit trebuie să fie o dată.',
            'description.required' => 'Câmpul descriere este obligatoriu.',
            'description.string' => 'Câmpul descriere trebuie să fie text.',
        ];
    }
}
