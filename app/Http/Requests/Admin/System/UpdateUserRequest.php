<?php

namespace App\Http\Requests\Admin\System;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        $rules = [
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Only allow changing name, username, email if role is admin
        if ($user && $user->role === 'admin') {
            $rules['name'] = 'required|string|max:255';
            $rules['username'] = ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)];
            $rules['email'] = ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)];
        }

        return $rules;
    }
}
