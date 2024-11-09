<x-admin.auth.auth-layout title="Forgot Password">
    <x-slot name="main">
        <h1 class="auth-title">Forgot Password.</h1>
        <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>

        @if (session('status'))
        <p class="text-sm text-success">{{ session('status') }}</p>
        @endif

        <form action="/admin/forgot-password" method="POST">
            @csrf

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

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Send</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>
                Remember your account? <a href="/admin/login" class="font-bold">Log in</a>.
            </p>
        </div>
    </x-slot>
</x-admin.auth.auth-layout>