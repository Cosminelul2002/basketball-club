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
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'date_of_birth' => 'date',
            'height' => 'numeric',
            'weight' => 'numeric',
            'skill_level' => 'string|max:255',
            'parent_name' => 'string|max:255',
            'parent_phone' => 'string|max:255',
            'player_group_id' => 'exists:player_groups,id',
        ];
    }
}
