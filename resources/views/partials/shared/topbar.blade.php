{{-- lagi maintenance --}}

<header class="bg-white border-b px-6 py-3 flex justify-between items-center">

    <!-- LEFT -->
    <h2 class="font-semibold text-gray-700">
        Dashboard
    </h2>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <span class="text-sm text-gray-600">
            {{ auth()->user()->username }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                Logout
            </button>
        </form>

    </div>

</header>
