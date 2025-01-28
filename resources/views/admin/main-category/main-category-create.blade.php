<x-admin-layout title="Main Category">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="category" activePage="main-category">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Main Category" subtitle="Create Main Category">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/main-category">Main Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Category</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-body">
                <form class="form" method="POST" action="/admin/main-category-create">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('category_name')])
                                type="text" name="category_name" id="category_name"
                                placeholder="Category Name" value="{{ old('category_name') }}">

                                @error('category_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_logo" class="form-label">Category Logo</label>
                                <input @class(['form-control', 'is-invalid'=> $errors->has('category_logo')])
                                type="text"
                                name="category_logo" id="category_logo"
                                placeholder="Category Logo" value="{{old('category_logo') }}">
                                @error('category_logo')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea @class(['form-control', 'is-invalid'=> $errors->has('category_description')]) name="category_description" id="category_description" rows="4"
                                    placeholder="Category Description">{{ old('category_description') }}</textarea>
                                @error('category_description')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3 mb-1">
                                Submit
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