<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Masukkan Email">
    <button>Kirim Link Reset</button>
</form>
