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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'unit_id.required' => 'Unit wajib dipilih',
            'unit_id.exists' => 'Unit tidak valid',
            'subject_code.required' => 'Kode mapel wajib diisi',
            'subject_code.max' => 'Kode mapel maksimal 20 karakter',
            'subject_code.unique' => 'Kode mapel sudah digunakan',
            'subject_name.required' => 'Nama mata pelajaran wajib diisi',
            'subject_name.max' => 'Nama mata pelajaran maksimal 100 karakter',
            'subject_name.unique' => 'Nama mata pelajaran sudah digunakan',
        ];
    }
}
