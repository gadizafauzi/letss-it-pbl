<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// Models
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $login = $this->input('login');
        $password = $this->input('password');

        $user = $this->findUser($login);

        // ❌ login gagal
        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'Login atau password salah',
            ]);
        }

        // ❌ akun tidak aktif
        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'login' => 'Akun tidak aktif',
            ]);
        }

        // ✅ login sukses
        Auth::login($user);
        $this->session()->regenerate();
    }

    private function findUser(string $login)
    {
        // admin (username)
        $user = User::where('username', $login)->first();
        if ($user) return $user;

        // teacher (NIP)
        $teacher = Teacher::where('nip', $login)->first();
        if ($teacher) return $teacher->user;

        // student (NIS / NISN)
        $student = Student::where('nis', $login)
            ->orWhere('nisn', $login)
            ->first();

        if ($student) return $student->user;

        return null;
    }
}
