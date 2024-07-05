@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($categories);
?>

<section id="manageCategory">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Manage Category -- {{ $categories->count() }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Category Title</th>
                                    <th>Category Image</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->category_title }}</td>
                                    <td>
                                        @if ($category->category_image != null)
                                        <img height="60.5rem" width="60.5rem"
                                            src="{{ asset('uploads/category/' . $category->category_image) }}"
                                            class="img-responsive img-fluid" />
                                        @else
                                        <span class="text-danger">Image not available</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->status == 'active')
                                        <span class="text-success"
                                            style="padding-left: 8px; font-weight: 600;">Active</span>
                                        @else
                                        <span class="text-danger"
                                            style="padding-left: 8px; font-weight: 600;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="{{ route('getEditCategory', $category->slug) }}"><button
                                                class="btn btn-success btn-sm">Edit</button></a>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteCategoryModal-{{ $category->slug }}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryModalLabel"><b>Add Category</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postAddCategory') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="title">Category Title*</label>
                        <input type="text" class="form-control @error('category_title') is-invalid @enderror"
                            value="{{ old('category_title') }}" id="title" name="category_title"
                            placeholder="Enter Category Title" required />

                        @error('category_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="image">Category Image*</label>

                        <input type="file" class="form-control @error('category_image') is-invalid @enderror" id="image"
                            name="category_image" placeholder="Enter Category Title" value="{{ old('category_image') }}"
                            required />

                        @error('category_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="status">Status*</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                            required>
                            <option value="active">Active</option>
                            <option value="inactive">Hidden</option>
                        </select>

                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add Category">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Category Modal --}}
@foreach ($categories as $category)
<div class="modal fade" id="deleteCategoryModal-{{ $category->slug }}" tabindex="-1" aria-labelledby="deleteCategoryModal-{{ $category->slug }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg afaeaetgarsg">
        <div class="modal-content afaeaetgarsg">
            <section id="confirmation">
                <div class="container">
                    <div class="allCenter">
                    <div class="box">
                        <div class="cross end">
                        <button class="fa-solid fa-xmark closeCross" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="upper center">
                        <div class="mainCross">X</div>
                        <h2>Are You Sure?</h2>
                        </div>
                        <div class="text center">
                        <h6>
                            Do you really want to delete <b>{{ $category->category_title }}</b>? This process cannot
                            be undone.
                        </h6>
                        </div>
                        <div class="buttons center">
                        <button class="btn cancel" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a href="{{ route('getDeleteCategory', $category->slug) }}">
                            <button class="btn delete">Delete</button>
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
    
@endforeach



@endsection