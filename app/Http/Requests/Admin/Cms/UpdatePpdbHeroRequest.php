<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePpdbHeroRequest extends FormRequest
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
            'title'                 => 'required|string|max:255',
            'subtitle'              => 'nullable|string',
            'badge_text'            => 'nullable|string|max:255',
            'button_text'           => 'nullable|string|max:100',
            'button_link'           => 'nullable|string|max:255',
            'button_secondary_text' => 'nullable|string|max:100',
            'button_secondary_link' => 'nullable|string|max:255',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'             => 'boolean',
        ];
    }
}
