<x-admin-auth-layout title="Register">
    <x-slot name="main">
        <h1 class="auth-title">Sign Up.</h1>
        <p class="auth-subtitle mb-5">Input your data to register to Menu App.</p>

        <form action="/admin/register" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Name" name="name"
                    value="{{ old('name') }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>

                @error('name')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Email" name="email"
                    value="{{ old('email') }}">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                @error('email')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>

                @error('password')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                    name="password_confirmation">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>

                @error('password_confirmation')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Sign Up</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>
                Already have an account? <a href="/admin/login" class="font-bold">Log in</a>.
            </p>
        </div>
    </x-slot>
</x-admin-auth-layout>