<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCmsKontakRequest extends FormRequest
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
            'address'            => 'nullable|string',
            'phone'              => 'nullable|string|max:30',
            'whatsapp_number'    => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:100',
            'operational_hours'  => 'nullable|string',
            'maps_embed'         => 'nullable|string',
            'facebook'           => 'nullable|url|max:255',
            'instagram'          => 'nullable|url|max:255',
            'youtube'            => 'nullable|url|max:255',
        ];
    }
}
