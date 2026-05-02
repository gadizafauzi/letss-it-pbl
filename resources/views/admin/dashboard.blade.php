{{-- lagi maintenance --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Dashboard Student</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>


{{-- @extends('layouts.admin')

@section('content')

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-sm text-gray-500">Total Siswa</p>
        <h1 class="text-2xl font-bold mt-2">120</h1>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-sm text-gray-500">Total Guru</p>
        <h1 class="text-2xl font-bold mt-2">25</h1>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <p class="text-sm text-gray-500">Kelas</p>
        <h1 class="text-2xl font-bold mt-2">10</h1>
    </div>

</div>

@endsection --}}
