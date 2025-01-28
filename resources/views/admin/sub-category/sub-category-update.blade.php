<x-admin-layout title="Sub Category">
    <x-slot name="sidebar">
        <x-admin-sidebar activeModule="category" activePage="sub-category">
        </x-admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin-page-title title="Sub Category" subtitle="Update Sub Category">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/sub-category">Sub Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Category</li>
        </x-admin-page-title>
    </x-slot>

    <x-slot name="main">
        <div class="card">
            <div class="card-body">
                <form class="form" method="POST" action="/admin/sub-category-update">
                    @csrf

                    @method('PUT')

                    <input type="hidden" name="category_id" value="{{ $subCategory->category_id }}">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div @class(['form-group', 'is-invalid'=> $errors->has('main_category_name')])>
                                <label for="main_category_name" class="form-label">Main Category</label>
                                <select class="form-select" id="main_category_name" name="main_category_name">
                                    @foreach ($mainCategories as $row)
                                    <option @if ($subCategory->parent_category_id==$row->category_id) selected @endif
                                        value="{{$row->category_id}}">
                                        {{ $row->category_name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('main_category_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div @class(['form-group', 'is-invalid'=> $errors->has('category_name')])>
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                    placeholder="Category Name" value="{{ $subCategory->category_name }}">

                                @error('category_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div @class(['form-group', 'is-invalid'=> $errors->has('category_description')])>
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control"
                                    rows="4"
                                    placeholder="Category Description">{{ $subCategory->category_description }}</textarea>
                                @error('category_description')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
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