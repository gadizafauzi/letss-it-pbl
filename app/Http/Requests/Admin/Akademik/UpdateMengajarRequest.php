<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMengajarRequest extends FormRequest
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
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
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
            'teacher_id.required' => 'Guru wajib dipilih',
            'teacher_id.exists' => 'Guru tidak valid',
            'subject_id.required' => 'Mata pelajaran wajib dipilih',
            'subject_id.exists' => 'Mata pelajaran tidak valid',
            'class_id.required' => 'Kelas wajib dipilih',
            'class_id.exists' => 'Kelas tidak valid',
            'academic_year_id.required' => 'Tahun ajaran wajib dipilih',
            'academic_year_id.exists' => 'Tahun ajaran tidak valid',
        ];
    }
}
