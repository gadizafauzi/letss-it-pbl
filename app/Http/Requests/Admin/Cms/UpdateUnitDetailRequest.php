<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitDetailRequest extends FormRequest
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
            'description_title' => 'nullable|string|max:255',
            'description_body' => 'nullable|string',
            'target_age' => 'nullable|string|max:100',
            'quota' => 'nullable|string|max:100',
            'description_logo' => 'nullable|image|max:2048',
        ];
    }
}
