<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
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
        // the route parameter is named 'siswa' inside the resource route
        $siswaId = $this->route('siswa')->id ?? null;
        
        return [
            'unit_id'          => 'nullable|exists:units,id',
            'class_id'         => 'nullable|exists:classes,id',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'nis'              => 'required|unique:students,nis,' . $siswaId,
            'nisn'             => 'required|unique:students,nisn,' . $siswaId,
            'nik'              => 'nullable|digits:16|unique:students,nik,' . $siswaId,
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Nama lengkap wajib diisi',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique'   => 'NIS sudah digunakan',
            'nisn.required' => 'NISN wajib diisi',
            'nisn.unique'   => 'NISN sudah digunakan',
            'nik.digits'   => 'NIK harus 16 digit',
            'nik.unique'   => 'NIK sudah digunakan',
            'photo.image'  => 'Foto harus berformat jpg, jpeg, atau png',
            'photo.mimes'  => 'Foto harus berformat jpg, jpeg, atau png',
            'photo.max'    => 'Ukuran foto maksimal 2MB',
            'status.required' => 'Status siswa wajib dipilih',
            'unit_id.exists' => 'Unit pendidikan tidak valid',
            'class_id.exists' => 'Kelas tidak valid',
            'academic_year_id.exists' => 'Tahun ajaran tidak valid',
            'gender.in' => 'Jenis kelamin tidak valid',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
        ];
    }
}
