<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePpdbTimelineRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'card_title'  => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date_range'  => 'required|string|max:255',
            'status'      => 'required|in:Dibuka,Segera,Menunggu,Selesai',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ];
    }
}
