<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Hash;

//model
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

// class LoginRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, ValidationRule|array<mixed>|string>
//      */
//     // public function rules(): array
//     // {
//     //     return [
//     //         'email' => ['required', 'string', 'email'],
//     //         'password' => ['required', 'string'],
//     //     ];
//     // }

//     public function rules(): array
//     {
//         return [
//             'login' => ['required', 'string'],
//             'password' => ['required', 'string'],
//         ];
//     }



//     /**
//      * Attempt to authenticate the request's credentials.
//      *
//      * @throws ValidationException
//      */

//     // public function authenticate(): void
//     // {
//     //     $this->ensureIsNotRateLimited();

//     //     if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
//     //         RateLimiter::hit($this->throttleKey());

//     //         throw ValidationException::withMessages([
//     //             'email' => trans('auth.failed'),
//     //         ]);
//     //     }

//     //     RateLimiter::clear($this->throttleKey());
//     // }

//     public function authenticate(): void
//     {
//         $this->ensureIsNotRateLimited();

//         $login = $this->input('login');
//         $password = $this->input('password');

//         // cari user berdasarkan username
//         $user = User::where('username', $login)->first();

//         // kalau tidak ketemu → cek teacher (NIP)
//         if (!$user) {
//             $teacher = Teacher::where('nip', $login)->first();
//             if ($teacher) {
//                 $user = $teacher->user;
//             }
//         }

//         // kalau tidak ketemu → cek student (NIS / NISN)
//         if (!$user) {
//             $student = Student::where('nis', $login)
//                 ->orWhere('nisn', $login)
//                 ->first();

//             if ($student) {
//                 $user = $student->user;
//             }
//         }

//         // kalau tetap tidak ada
//         if (!$user || !Hash::check($password, $user->password)) {
//             throw ValidationException::withMessages([
//                 'login' => 'Login atau password salah.',
//             ]);
//         }

//         // cek status
//         if ($user->status !== 'active') {
//             throw ValidationException::withMessages([
//                 'login' => 'Akun tidak aktif.',
//             ]);
//         }

//         Auth::login($user, $this->boolean('remember'));

//         $this->session()->regenerate();
//     }

//     /**
//      * Ensure the login request is not rate limited.
//      *
//      * @throws ValidationException
//      */
//     public function ensureIsNotRateLimited(): void
//     {
//         if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
//             return;
//         }

//         event(new Lockout($this));

//         $seconds = RateLimiter::availableIn($this->throttleKey());

//         // throw ValidationException::withMessages([
//         //     'email' => trans('auth.throttle', [
//         //         'seconds' => $seconds,
//         //         'minutes' => ceil($seconds / 60),
//         //     ]),
//         // ]);
//         throw ValidationException::withMessages([
//             'login' => trans('auth.throttle', [
//                 'seconds' => $seconds,
//                 'minutes' => ceil($seconds / 60),
//             ]),
//         ]);
//     }

//     /**
//      * Get the rate limiting throttle key for the request.
//      */
//     public function throttleKey(): string
//     {
//         // return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
//         return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
//     }
// }



namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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
        $this->ensureIsNotRateLimited();

        $login = $this->input('login');
        $password = $this->input('password');

        $user = User::where('username', $login)->first();

        if (!$user) {
            $teacher = Teacher::where('nip', $login)->first();
            if ($teacher) {
                $user = $teacher->user;
            }
        }

        if (!$user) {
            $student = Student::where('nis', $login)
                ->orWhere('nisn', $login)
                ->first();

            if ($student) {
                $user = $student->user;
            }
        }

        // ❌ login gagal
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => 'Login atau password salah.',
            ]);
        }

        // ❌ akun tidak aktif
        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'login' => 'Akun tidak aktif.',
            ]);
        }

        // ✅ login sukses
        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());

        $this->session()->regenerate();
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('login')) . '|' . $this->ip()
        );
    }
}
