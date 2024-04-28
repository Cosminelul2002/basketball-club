<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            'height' => 'numeric',
            'weight' => 'numeric',
            'skill_level' => 'in:Începător', 'Intermediar', 'Avansat',
            'parent_name' => 'regex:/^[A-Za-z\s]+$/|max:255',
            'parent_phone' => 'numeric|digits_between:10,15',
            'player_group_id' => 'exists:player_groups,id',
        ];
    }
}
