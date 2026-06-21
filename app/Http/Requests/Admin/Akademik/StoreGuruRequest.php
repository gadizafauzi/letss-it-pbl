<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
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
            'unit_id'           => 'required|exists:units,id',
            'position_id'       => 'nullable|exists:positions,id',
            'nip'               => 'required|string|max:50|unique:teachers,nip|unique:users,username',
            'full_name'         => 'required|string|max:255',
            'gender'            => 'nullable|in:male,female',
            'birth_place'       => 'nullable|string|max:100',
            'birth_date'        => 'nullable|date',
            'last_education'    => 'nullable|string|max:100',
            'phone'             => 'nullable|string|max:20',
            'address'           => 'nullable|string',
            'employment_status' => 'nullable|in:pegawai_tetap,pegawai_tidak_tetap',
            'status'            => 'required|in:active,inactive',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
