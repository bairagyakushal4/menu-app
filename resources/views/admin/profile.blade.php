<x-admin-layout title="Profile">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="profile" activePage="profile">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Profile" subtitle="View Profile">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Information</h4>
                <p class="small">Update your account's profile information and email address.</p>
            </div>
            <div class="card-body">

                {{-- for verifing the email --}}
                <form method="POST" action="/admin/email/verification-send" id="send-verification">
                    @csrf
                </form>

                <form method="post" action="/admin/profile">
                    @csrf
                    @method('patch')

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('name')])
                                type="text" name="name" id="name"
                                placeholder="Name" value="{{old('name', $user->name)}}" required>

                                @error('name')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('email')])
                                type="email" name="email" id="email"
                                placeholder="Email" value="{{old('email', $user->email)}}" required>

                                @error('email')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>



                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <p>
                        Your email address is unverified.
                        <a href="javascript:void(0);" class="font-bold text-decoration-underline"
                            onclick="event.preventDefault(); document.getElementById('send-verification').submit();">
                            Click here to re-send the verification email
                        </a>
                        .
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="text-sm text-success">
                        A new verification link has been sent to your email address.
                    </p>
                    @endif
                    @endif


                    @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success">Profile Information Updated.</p>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3 mb-1">
                                Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Password</h4>
                <p class="small">Ensure your account is using a long, random password to stay secure.</p>
            </div>
            <div class="card-body">

                <form method="post" action="/admin/password-update">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input @class(['form-control', 'is-invalid'=>
                                $errors->updatePassword->has('current_password')])
                                type="password" name="current_password" id="current_password"
                                placeholder="Current Password" autocomplete="current-password" required>

                                @error('current_password', 'updatePassword')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password" class="form-label">New Password</label>
                                <input @class(['form-control', 'is-invalid'=>
                                $errors->updatePassword->has('password')])
                                type="password" name="password" id="password"
                                placeholder="New Password" autocomplete="new-password" required>

                                @error('password', 'updatePassword')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input @class(['form-control', 'is-invalid'=>
                                $errors->updatePassword->has('password_confirmation')])
                                type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm Password" required>

                                @error('password_confirmation', 'updatePassword')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>


                    @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success">Password Updated.</p>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3 mb-1">
                                Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Delete Account</h4>
                <p class="small">Once your account is deleted, all of its resources and data will be permanently
                    deleted. Before deleting your account, please download any data or information that you wish to
                    retain.
                </p>
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#delete_account_modal">
                    DELETE ACCOUNT
                </button>







                <div class="modal fade" id="delete_account_modal" tabindex="-1" role="dialog"
                    aria-labelledby="delete_account_modal_label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <form method="POST" action="/admin/profile" onsubmit="deleteAccount(event)">
                                @csrf
                                @method('delete')

                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title white" id="delete_account_modal_label">
                                        Are you sure you want to delete your account?
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Once your account is deleted, all of its resources and data will be permanently
                                    deleted.
                                    Please enter your password to confirm you would like to permanently delete your
                                    account.

                                    <div class="form-group mt-3">
                                        <input id="delete_account_password" type="password" placeholder="Password"
                                            name="password" class="form-control">
                                    </div>

                                    <p class="invalid-feedback d-block" id="delete_account_password_error"></p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-danger ms-1">
                                        Delete Account
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </x-slot>

    <x-slot name="script">
        <script>
            function deleteAccount(ev) {
                ev.preventDefault();
                const el = ev.target;
                const formData = new FormData(el);
        
                // Debugging: Log FormData to ensure password field is present
                // for (let pair of formData.entries()) {
                //     console.log(pair[0] + ': ' + pair[1]); // This will log each field in the FormData
                // }
        
                $.ajax({
                    type: "POST", // Use POST for delete routes if Laravel needs _method for DELETE
                    url: el.action,
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        // $(`#delete_account_password_error`).html(``);
                    },
                    success: function (data) {
                        console.log(data);
                        if (data=='deleted') {
                            location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        const errorData = JSON.parse(xhr.responseText);
                        // console.log("Error Data:", errorData);
                        // console.log("status:", status);
                        if (status == 'error') {
                            $(`#delete_account_password_error`).html(errorData.message);
                        }
                    }
                });
            }
        </script>


    </x-slot>

</x-admin-layout>