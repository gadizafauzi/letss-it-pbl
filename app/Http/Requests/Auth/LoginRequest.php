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
            'role' => ['required', 'in:admin,teacher,student'],
        ];
    }

    public function authenticate(): void
    {
        $login = $this->input('login');
        $password = $this->input('password');
        $role = $this->input('role');

        $user = $this->findUser($login);

        // ❌ gagal login (dibuat general biar aman)
        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'Login gagal, periksa kembali data anda',
            ]);
        }

        // ❌ akun tidak aktif
        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'login' => 'Akun tidak aktif',
            ]);
        }

        // ❌ role tidak sesuai tab
        if ($user->role !== $role) {
            throw ValidationException::withMessages([
                'login' => 'Role tidak sesuai dengan pilihan login',
            ]);
        }

        // ✅ login sukses
        Auth::login($user);
        $this->session()->regenerate();
    }

    private function findUser(string $login)
    {
        // admin
        if ($user = User::where('username', $login)->first()) {
            return $user;
        }

        // guru
        if ($teacher = Teacher::where('nip', $login)->first()) {
            return $teacher->user;
        }

        // siswa
        if ($student = Student::where('nis', $login)
            ->orWhere('nisn', $login)
            ->first()) {
            return $student->user;
        }

        return null;
    }
}
