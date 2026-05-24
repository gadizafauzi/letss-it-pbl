<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Unit;
use App\Models\Position;

class GuruController extends Controller
{
    /**
     * LIST DATA GURU
     */
    public function index(Request $request)
    {
        $query = Teacher::with([
            'unit',
            'position',
            'user',
        ]);

        /**
         * SEARCH
         */
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        /**
         * FILTER UNIT
         */
        if ($request->unit) {

            $query->where('unit_id', $request->unit);
        }

        /**
         * FILTER POSITION
         */
        if ($request->position) {

            $query->where('position_id', $request->position);
        }

        $teachers = $query
            ->latest()
            ->get();

        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.index', compact(
            'teachers',
            'units',
            'positions'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.create', compact(
            'units',
            'positions'
        ));
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'position_id' => 'nullable|exists:positions,id',

            'nip' => 'required|string|max:50|unique:teachers,nip|unique:users,username',

            'full_name' => 'required|string|max:255',

            'gender' => 'nullable|in:male,female',

            'birth_place' => 'nullable|string|max:100',

            'birth_date' => 'nullable|date',

            'last_education' => 'nullable|string|max:100',

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'employment_status' => 'nullable|in:pegawai_tetap,pegawai_tidak_tetap',

            'status' => 'required|in:active,inactive',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /**
         * UPLOAD FOTO
         */
        if ($request->hasFile('photo')) {

            $validated['photo'] = $request
                ->file('photo')
                ->store('teachers', 'public');
        }

        /**
         * CREATE USER LOGIN
         */
        $user = User::create([

            'name' => $validated['full_name'],

            'username' => $validated['nip'],

            'password' => Hash::make('12345678'),

            'role' => 'teacher',

            'status' => $validated['status'],
        ]);

        /**
         * CREATE TEACHER
         */
        Teacher::create([

            'user_id' => $user->id,

            'unit_id' => $validated['unit_id'],

            'position_id' => $validated['position_id'] ?? null,

            'nip' => $validated['nip'],

            'full_name' => $validated['full_name'],

            'gender' => $validated['gender'] ?? null,

            'birth_place' => $validated['birth_place'] ?? null,

            'birth_date' => $validated['birth_date'] ?? null,

            'last_education' => $validated['last_education'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'address' => $validated['address'] ?? null,

            'employment_status' => $validated['employment_status'] ?? null,

            'status' => $validated['status'],

            'photo' => $validated['photo'] ?? null,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    /**
     * DETAIL GURU
     */
    public function show(Teacher $guru)
    {
        $guru->load([
            'unit',
            'position',
            'teachingAssignments',
            'user',
        ]);

        return view('admin.guru.show', [
            'teacher' => $guru
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Teacher $guru)
    {
        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.edit', [
            'teacher' => $guru,
            'units' => $units,
            'positions' => $positions,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Teacher $guru)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'position_id' => 'nullable|exists:positions,id',

            'nip' => 'required|string|max:50|unique:teachers,nip,' . $guru->id,

            'full_name' => 'required|string|max:255',

            'gender' => 'nullable|in:male,female',

            'birth_place' => 'nullable|string|max:100',

            'birth_date' => 'nullable|date',

            'last_education' => 'nullable|string|max:100',

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'employment_status' => 'nullable|in:pegawai_tetap,pegawai_tidak_tetap',

            'status' => 'required|in:active,inactive',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /**
         * VALIDASI USERNAME USER
         */
        if (
            User::where('username', $validated['nip'])
            ->where('id', '!=', $guru->user_id)
            ->exists()
        ) {

            return back()
                ->withErrors([
                    'nip' => 'NIP sudah digunakan sebagai username login.'
                ])
                ->withInput();
        }

        /**
         * UPLOAD FOTO BARU
         */
        if ($request->hasFile('photo')) {

            /**
             * HAPUS FOTO LAMA
             */
            if ($guru->photo) {

                Storage::disk('public')->delete($guru->photo);
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store('teachers', 'public');
        }

        /**
         * UPDATE USER LOGIN
         */
        if ($guru->user) {

            $guru->user->update([

                'name' => $validated['full_name'],

                'username' => $validated['nip'],

                'status' => $validated['status'],
            ]);
        }

        /**
         * UPDATE DATA GURU
         */
        $guru->update([

            'unit_id' => $validated['unit_id'],

            'position_id' => $validated['position_id'] ?? null,

            'nip' => $validated['nip'],

            'full_name' => $validated['full_name'],

            'gender' => $validated['gender'] ?? null,

            'birth_place' => $validated['birth_place'] ?? null,

            'birth_date' => $validated['birth_date'] ?? null,

            'last_education' => $validated['last_education'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'address' => $validated['address'] ?? null,

            'employment_status' => $validated['employment_status'] ?? null,

            'status' => $validated['status'],

            'photo' => $validated['photo'] ?? $guru->photo,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diupdate');
    }

    /**
     * DELETE DATA
     */
    public function destroy(Teacher $guru)
    {
        /**
         * HAPUS FOTO
         */
        if ($guru->photo) {

            Storage::disk('public')->delete($guru->photo);
        }

        /**
         * HAPUS USER LOGIN
         */
        if ($guru->user) {

            $guru->user->delete();
        }

        /**
         * HAPUS DATA GURU
         */
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
