<x-admin-layout title="Product">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="product" activePage="product">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Product" subtitle="Update Product">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/product">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-body">
                <form class="form" method="POST" action="/admin/product-update" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('product_name')]) type="text"
                                name="product_name" id="product_name" placeholder="Product Name"
                                value="{{$product->product_name}}">
                                @error('product_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('product_price')])
                                type="number" step="0.01" name="product_price" id="product_price"
                                placeholder="Product Price"
                                value="{{$product->product_price}}">
                                @error('product_price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Product Veg / Non Veg</label>
                                <br>
                                <div class="form-check form-check-inline form-check-success">
                                    <input class="form-check-input" type="radio" name="product_veg_non_veg"
                                        id="product_veg_non_veg__veg" value="veg"
                                        @checked($product->product_veg_non_veg=='veg')>
                                    <label class="form-check-label" for="product_veg_non_veg__veg">Veg</label>
                                </div>

                                <div class="form-check form-check-inline form-check-danger">
                                    <input class="form-check-input" type="radio" name="product_veg_non_veg"
                                        id="product_veg_non_veg__non_veg" value="non_veg"
                                        @checked($product->product_veg_non_veg=='non_veg')>
                                    <label class="form-check-label" for="product_veg_non_veg__non_veg">Non Veg</label>
                                </div>

                                <div class="form-check form-check-inline form-check-secondary">
                                    <input class="form-check-input" type="radio" name="product_veg_non_veg"
                                        id="product_veg_non_veg__na" value="na"
                                        @checked($product->product_veg_non_veg=='na')>
                                    <label class="form-check-label" for="product_veg_non_veg__na">N/A</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select @class(['form-select', 'is-invalid'=> $errors->has('category_id')])
                                    id="category_id" name="category_id">
                                    <option value="" disabled>Select Category</option>
                                    @foreach($subCategories as $row)
                                    <option @selected($product->category_id==$row->category_id)
                                        value="{{$row->category_id }}">
                                        {{ $row->category_name }} - ({{ $row->main_category_name }})
                                    </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="product_description" class="form-label">Product Description</label>
                                <textarea @class(['form-control', 'is-invalid'=> $errors->has('product_description')]) name="product_description" id="product_description" rows="4" 
                                    placeholder="Product Description">{{$product->product_description}}</textarea>
                                @error('product_description')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input type="file" name="product_image" id="product_image" class="form-control mb-2"
                                    onchange="product_image_preview(event)">

                                <img id="image_preview" class="thumb-img" src="{{ $product->product_image }}"
                                    alt="{{ $product->product_name }}" {{ $product->product_image == '' ?
                                'style="display: none;"' : '' }} />

                                <div id="image_error_message" class="invalid-feedback d-block"></div>
                            </div>
                        </div>


                    </div>


                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3 mb-1">
                                Update
                            </button>
                            <button type="reset" class="btn btn-light-secondary mb-1">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>


</x-admin-layout>