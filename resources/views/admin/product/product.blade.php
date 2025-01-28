<x-admin-layout title="Product">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="product" activePage="product">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Product" subtitle="View Products">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">

            <div class="card-body">
                <div class="mb-3 text-end">
                    <a href="/admin/product-sample-download" class="mb-2">Sample CSV</a>
                    <a href="/admin/product-import" class="btn btn-primary ms-2 mb-2">Import Product with CSV</a>
                    <a href="/admin/product-imgs-bulk-upload" class="btn btn-primary ms-2 mb-2">Bulk Product Images
                        Upload</a>
                    <a href="/admin/product-create" class="btn btn-primary ms-2 mb-2">Create Product</a>
                </div>

                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Product SKU</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Veg / Non Veg</th>
                                <th>Product Status</th>
                                <th>Product Category</th>
                                <th>Product Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->product_sku }}</td>
                                <td>
                                    @if($row->product_image)
                                    <img src="{{ $row->product_image }}" alt="{{$row->product_name}}" class="thumb-img">
                                    @endif
                                </td>
                                <td>{{ $row->product_name }}</td>
                                <td>{{ $row->product_price }}</td>
                                <td>{{ $row->product_veg_non_veg }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input @if($row->product_status == 'active') checked @endif
                                        class="form-check-input" type="checkbox" id="product_status"
                                        name="product_status" onchange="changeProductStatus(this)" data-id="{{
                                        $row->product_id }}">
                                    </div>
                                </td>
                                <td>{{ $row->category_id }}</td>
                                <td>{{ $row->product_description }}</td>
                                <td>@if($row->created_at) {{ $row->created_at->format('M d, Y h:i A')}} @endif</td>
                                <td>@if($row->updated_at) {{ $row->updated_at->format('M d, Y h:i A')}} @endif</td>
                                <td>
                                    <a href="/admin/product-update/{{ $row->product_id }}"
                                        class="btn icon btn-primary mb-2 me-2"><i class="bi bi-pencil"></i></a>
                                    <a href="/admin/product-delete/{{ $row->product_id }}"
                                        class="btn icon btn-danger mb-2 me-2" onclick="deleteConfirm(this, event)"><i
                                            class="bi bi-trash"></i></a>

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
            function changeProductStatus(el) {
                const product_status = el.checked ? 'active' : 'disabled';
                const product_id = el.getAttribute('data-id');

                $.ajax({
                    url: '/admin/change-product-status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        product_status: product_status
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