<x-admin-auth-layout title="Login">
    <x-slot name="main">
        <h1 class="auth-title">Log in.</h1>
        <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

        @if (session('status'))
        <p class="text-sm text-success">{{ session('status') }}</p>
        @endif

        <form method="POST" action="/admin/login">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" placeholder="Email" name="email"
                    value="{{ old('email') }}" required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>

                @error('email')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror

            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Password" name="password"
                    required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>

                @error('password')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror

                @error('errorMessage')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" type="submit">Log in</button>
        </form>

    </x-slot>
</x-admin-auth-layout>