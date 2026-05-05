<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password baru">
    <input type="password" name="password_confirmation" placeholder="Konfirmasi password">

    <button>Reset Password</button>
</form>
