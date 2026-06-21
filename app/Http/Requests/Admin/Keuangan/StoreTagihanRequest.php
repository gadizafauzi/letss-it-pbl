<?php

namespace App\Http\Requests\Admin\Keuangan;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagihanRequest extends FormRequest
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
            'payment_type_id' => 'required|exists:payment_types,id',
            'period' => 'required|string|max:255',
            'due_date' => 'required|date',
            'target' => 'required|in:all,class,student',
            'class_id' => 'required_if:target,class|nullable|exists:classes,id',
        ];
    }
}
