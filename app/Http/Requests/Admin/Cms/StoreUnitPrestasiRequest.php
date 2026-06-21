<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitPrestasiRequest extends FormRequest
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
            'type' => 'required|in:school,teacher,student',
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:100',
            'side' => 'required|in:left,right',
            'order' => 'nullable|integer',
        ];
    }
}
