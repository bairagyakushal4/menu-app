<x-admin-layout title="Main Category">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="category" activePage="main-category">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Main Category" subtitle="View Main Categories">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Main Category</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">

            <div class="card-body">
                <div class="mb-3 text-end">
                    <a href="/admin/main-category-create" class="btn btn-primary">Create Category</a>
                </div>

                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category Logo</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Category Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mainCategories as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->category_logo }}</td>
                                <td>{{ $row->category_name }}</td>
                                <td>{{ $row->category_description }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input @if($row->category_status == 'active') checked @endif
                                        class="form-check-input" type="checkbox" id="category_status"
                                        name="category_status" onchange="changeCategoryStatus(this)" data-id="{{
                                        $row->category_id }}">
                                        {{-- <label class="form-check-label" for="category_status">Active</label> --}}
                                    </div>
                                </td>
                                <td>@if($row->created_at) {{ $row->created_at->format('M d, Y h:i A')}} @endif</td>
                                <td>@if($row->updated_at) {{$row->updated_at->format('M d, Y h:i A') }}@endif</td>
                                <td>
                                    <a href="/admin/main-category-update/{{ $row->category_id }}"
                                        class="btn icon btn-primary mb-2 me-2"><i class="bi bi-pencil"></i></a>
                                    <a href="/admin/main-category-delete/{{ $row->category_id }}"
                                        class="btn icon btn-danger mb-2 me-2" onclick="deleteConfirm(this, event)"><i
                                            class="bi bi-trash"></i></a>

                                    <a href="/admin/sub-category/{{ $row->category_id }}"
                                        class="btn icon btn-secondary mb-2 me-2"><i class="bi bi-search"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </x-slot>

    <x-slot name="script">
        @if (session('create_msg'))
        <script>
            successAlert("{{ session('create_msg') }}")
        </script>
        @endif

        @if (session('update_msg'))
        <script>
            successAlert("{{ session('update_msg') }}")
        </script>
        @endif

        @if (session('delete_msg'))
        <script>
            successAlert("{{ session('delete_msg') }}")
        </script>
        @endif


        <script>
            function changeCategoryStatus(el) {
                const category_status = el.checked ? 'active' : 'disabled';
                const category_id = el.getAttribute('data-id');

                $.ajax({
                    url: '/admin/change-category-status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: category_id,
                        category_status: category_status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data>0) {
                            successAlert('Status updated successfully');
                        }else{
                            errorAlert('Some error occured');
                        }
                    }, error: function (xhr) {
                        // if error occurred
                        alert("Error occurred.please try again");
                        //   $(placeholder).append(xhr.statusText + xhr.responseText);
                    },
                });
            }
        </script>
    </x-slot>

</x-admin-layout>