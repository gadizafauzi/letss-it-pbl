<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
            'unit_id'          => 'nullable|exists:units,id',
            'class_id'         => 'nullable|exists:classes,id',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'nis'              => 'required|unique:students,nis',
            'nisn'             => 'required|unique:students,nisn',
            'nik'              => 'nullable|digits:16|unique:students,nik',
            'full_name'        => 'required',
            'gender'           => 'nullable|in:L,P',
            'birth_place'      => 'nullable',
            'birth_date'       => 'nullable|date',
            'hobby'            => 'nullable',
            'phone'            => 'nullable',
            'address'          => 'nullable',
            'father_name'      => 'nullable',
            'mother_name'      => 'nullable',
            'parent_phone'     => 'nullable',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'           => 'required',
        ];
    }
}
