<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapelRequest extends FormRequest
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
            'unit_id' => 'required|exists:units,id',
            'subject_code' => 'required|string|max:20|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:100|unique:subjects,subject_name',
        ];
    }
}
