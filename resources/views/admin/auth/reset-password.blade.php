<x-admin-auth-layout title="Reset Password">
    <x-slot name="main">
        <h1 class="auth-title">Reset Password.</h1>
        <p class="auth-subtitle mb-5">Enter the new password to update the records.</p>

        <form action="/admin/reset-password" method="POST">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- hidden --}}
            <div class="form-group position-relative has-icon-left mb-4 d-none">
                <input type="text" class="form-control form-control-xl" placeholder="Email" name="email" required
                    value="{{ old('email', $request->email) }}">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                @error('email')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>
            {{-- hidden --}}


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

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Reset Password</button>
        </form>

    </x-slot>
</x-admin-auth-layout>