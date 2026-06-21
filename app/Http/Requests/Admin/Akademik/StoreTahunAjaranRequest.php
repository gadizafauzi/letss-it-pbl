<?php

namespace App\Http\Requests\Admin\Akademik;

use Illuminate\Foundation\Http\FormRequest;

class StoreTahunAjaranRequest extends FormRequest
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
            'year' => 'required|string|unique:academic_years,year',
            'active_semester' => 'required|in:odd,even',
            'start_odd' => 'required|date',
            'end_odd' => 'required|date|after:start_odd',
            'start_even' => 'required|date',
            'end_even' => 'required|date|after:start_even',
        ];
    }
}
