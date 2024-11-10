<x-admin-auth-layout title="Verify Email">
    <x-slot name="main">
        <h1 class="auth-title">Verification.</h1>


        @if (session('status') == 'verification-link-sent')
        <p class="text-sm text-success">A new verification link has been sent to your registered email address.</p>
        @endif


        <p class="auth-subtitle mb-3 fs-6">
            Email Verification is required for further access. Could you verify your email
            address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send
            you another.
        </p>


        <form method="POST" action="/admin/email/verification-send">
            @csrf
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                Resend Verification Email
            </button>
        </form>




        <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Want to try with a different email?
            <form method="POST" action="/admin/logout">
                @csrf
                <a href="javascript:void(0)" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="font-bold">Logout</a>
            </form>
            </p>

        </div>
    </x-slot>
</x-admin-auth-layout>