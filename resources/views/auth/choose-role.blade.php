<div class="container">
    <h2>Select your role</h2>
    <form action="{{ route('auth.role-login') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="password" value="{{ $password }}">
        @foreach ($roles as $role)
            <button type="submit" name="role" value="{{ $role }}" class="btn btn-primary m-2">
                Login as {{ ucfirst($role) }}
            </button>
        @endforeach
    </form>
</div>