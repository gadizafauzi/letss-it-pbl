@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Pengaturan Sistem – Token Fonnte</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.system.settings.update') }}">
        @csrf
        <div class="mb-4">
            <label for="fonnte_api_token" class="block text-sm font-medium text-gray-700">
                Token API Fonnte
            </label>
            <input type="text" name="fonnte_api_token" id="fonnte_api_token"
                value="{{ old('fonnte_api_token', $token) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            @error('fonnte_api_token')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
            Simpan Token
        </button>
    </form>
</div>
@endsection
