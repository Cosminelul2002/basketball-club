<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRoleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Numele rolului este obligatoriu.',
            'name.string' => 'Numele rolului trebuie sa fie un text.',
            'name.max' => 'Numele rolului nu poate avea mai mult de 255 de caractere.',
            'description.required' => 'Descrierea rolului este obligatorie.',
            'description.string' => 'Descrierea rolului trebuie sa fie un text.',
            'description.max' => 'Descrierea rolului nu poate avea mai mult de 255 de caractere.',
        ];
    }
}
