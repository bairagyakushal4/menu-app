<x-admin.auth.auth-layout title="Login">
    <x-slot name="main">
        <h1 class="auth-title">Log in.</h1>
        <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

        <form method="POST" action="/admin/login">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Email" name="email"
                    value="{{ old('email') }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>

            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end mb-3">
                <input class="form-check-input me-2" type="checkbox" id="remember_me">
                <label class="form-check-label text-gray-600" for="remember_me">
                    Keep me logged in
                </label>
            </div>


            @foreach ((array) $errors->get('email') as $message)
            <p class="invalid-feedback d-block">{{ $message }}</p>
            @endforeach
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Don't have an account? <a href="admin/register" class="font-bold">Sign up</a>.</p>

            @if (Route::has('admin.forgot-password'))
            <p><a class="font-bold" href="/admin/forgot-password">Forgot password?</a>.</p>
            @endif
        </div>
    </x-slot>
</x-admin.auth.auth-layout>