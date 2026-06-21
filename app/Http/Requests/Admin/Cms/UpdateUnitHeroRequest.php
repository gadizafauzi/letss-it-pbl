<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitHeroRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
