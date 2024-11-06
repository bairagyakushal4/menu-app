<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} {{$title}}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/my-style.css') }}">

    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
</head>

<body>
    <div id="app">
        {{$sidebar}}

        <div id="main" class="layout-navbar">
            <x-admin.admin-header></x-admin.admin-header>

            <div id="main-content">
                <div class="page-heading">
                    {{$pageTitle}}

                    <section class="section">
                        {{$main}}
                    </section>
                </div>
            </div>

            <x-admin.admin-footer></x-admin.admin-footer>
        </div>
    </div>


    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>

    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script> --}}


    <script src="{{ asset('assets/js/my-script.js') }}"></script>

    @isset($script)
    {{$script}}
    @endisset


</body>

</html>