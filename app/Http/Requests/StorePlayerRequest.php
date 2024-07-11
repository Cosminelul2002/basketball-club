<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
            'first_name' => 'max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'skill_level' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:255',
            'group_id' => 'nullable|exists:groups,id',
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
            'date_of_birth.required' => 'Data nașterii este obligatorie.',
            'height.numeric' => 'Înălțimea trebuie să fie un număr.',
            'weight.numeric' => 'Greutatea trebuie să fie un număr.',
            'skill_level.required' => 'Nivelul de abilitate este obligatoriu.',
            'parent_name.required' => 'Numele părintelui este obligatoriu.',
            'parent_phone.required' => 'Numărul de telefon al părintelui este obligatoriu.',
            'group_id.exists' => 'Grupa selectată nu există.',
        ];
    }
}
