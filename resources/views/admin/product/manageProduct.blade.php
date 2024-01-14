@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($products);
?>

<section id="manageCategory">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Manage Products -- {{ $products->count() }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addProductModal">Add Product</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Product Description</th>
                                    <th>Original Price</th>
                                    <th>Discount Price</th>
                                    <th>Total</th>
                                    <th>Weight</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->product_title }}</td>
                                    <td>
                                        @if ($product->product_image != null)
                                        <img height="60.5rem" width="60.5rem"
                                            src="{{ asset('uploads/product/' . $product->product_image) }}"
                                            class="img-responsive img-fluid" />
                                        @else
                                        <span class="text-danger">Image not available</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($product->product_description ?? 'No Description', 10)}}..</td>
                                    <td>{{ $product->original_price }}</td>
                                    <td>{{ $product->discount_price }}</td>
                                    <td>{{ $product->total }}</td>
                                    <td>{{ $product->weight }}gm</td>
                                    <td>
                                        @if ($product->status == 'active')
                                        <span class="text-success"
                                            style="padding-left: 8px; font-weight: 600;">Active</span>
                                        @else
                                        <span class="text-danger"
                                            style="padding-left: 8px; font-weight: 600;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('getEditProduct', $product->slug) }}"><button
                                                class="btn btn-success btn-sm">Edit</button></a>
                                        <a href="{{ route('getDeleteProduct', $product->slug) }}"><button
                                                class="btn btn-danger btn-sm">Delete</button></a>
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
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductModalLabel"><b>Add Product</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postAddProduct') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Product Title*</label>
                                <input type="text" name="product_title"
                                    class="form-control @error('product_title') is-invalid @enderror"
                                    value="{{ old('product_title') }}" id="product_title"
                                    placeholder="Enter Product Title" required />
                                @error('product_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="category_id">Category*</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-----------Choose Category-----------</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Product Image*</label>
                                <input type="file" class="form-control @error('product_image') is-invalid @enderror"
                                    value="{{ old('product_image') }}" id="product_image" name="product_image"
                                    required />
                                @error('product_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="status">Status*</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror"
                                    value="{{ old('status') }}" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Hidden</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Colour</label>
                                <input type="text" class="form-control @error('colour') is-invalid @enderror"
                                    value="Null" id="colour" name="colour" />
                                @error('colour')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Quantity Range*</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('qty_range1') is-invalid @enderror qty_range1"
                                        style="width: 7rem;" value="{{ old('qty_range1') }}" id="qty_range1"
                                        name="qty_range1" required /> <span class="m-2">-</span> <input type="number"
                                        step="0.01"
                                        class="form-control @error('qty_range2') is-invalid @enderror sizeinc"
                                        value="{{ old('qty_range2') }}" id="qty_range2" name="qty_range2" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="nrml_price1">Normal Price in (Rs.)*</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('nrml_price1') is-invalid @enderror"
                                    value="{{ old('nrml_price1') }}" id="nrml_price1" name="nrml_price1" required />
                                @error('nrml_price1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="urgent_price1">Urgent Price in (Rs.)*</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('urgent_price1') is-invalid @enderror"
                                    value="{{ old('urgent_price1') }}" id="urgent_price1" name="urgent_price1"
                                    required />
                                @error('urgent_price1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Quantity Range</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('qty_range3') is-invalid @enderror qty_range3"
                                        style="width: 7rem;" value="{{ old('qty_range3') }}" id="qty_range3"
                                        name="qty_range3" /> <span class="m-2">-</span> <input type="number" step="0.01"
                                        class="form-control @error('qty_range4') is-invalid @enderror sizeinc"
                                        value="{{ old('qty_range4') }}" id="qty_range4" name="qty_range4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="nrml_price2">Normal Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('nrml_price2') is-invalid @enderror"
                                    value="{{ old('nrml_price2') }}" id="nrml_price2" name="nrml_price2" />
                                @error('nrml_price2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="urgent_price2">Urgent Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('urgent_price2') is-invalid @enderror"
                                    value="{{ old('urgent_price2') }}" id="urgent_price2" name="urgent_price2" />
                                @error('urgent_price2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Quantity Range</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('qty_range5') is-invalid @enderror qty_range5"
                                        style="width: 7rem;" value="{{ old('qty_range5') }}" id="qty_range5"
                                        name="qty_range5" /> <span class="m-2">-</span> <input type="number" step="0.01"
                                        class="form-control @error('qty_range6') is-invalid @enderror sizeinc"
                                        value="{{ old('qty_range6') }}" id="qty_range6" name="qty_range6" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="nrml_price3">Normal Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('nrml_price3') is-invalid @enderror"
                                    value="{{ old('nrml_price3') }}" id="nrml_price3" name="nrml_price3" />
                                @error('nrml_price3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="urgent_price3">Urgent Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('urgent_price3') is-invalid @enderror"
                                    value="{{ old('urgent_price3') }}" id="urgent_price3" name="urgent_price3" />
                                @error('urgent_price3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Quantity Range</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('qty_range7') is-invalid @enderror qty_range7"
                                        style="width: 7rem;" value="{{ old('qty_range7') }}" id="qty_range7"
                                        name="qty_range7" /> <span class="m-2">-</span> <input type="number" step="0.01"
                                        class="form-control @error('qty_range8') is-invalid @enderror sizeinc"
                                        value="{{ old('qty_range8') }}" id="qty_range8" name="qty_range8" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="nrml_price4">Normal Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('nrml_price4') is-invalid @enderror"
                                    value="{{ old('nrml_price4') }}" id="nrml_price4" name="nrml_price4" />
                                @error('urgent_price4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="urgent_price4">Urgent Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('urgent_price4') is-invalid @enderror"
                                    value="{{ old('urgent_price4') }}" id="urgent_price4" name="urgent_price4" />
                                @error('urgent_price4')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Quantity Range</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('qty_range9') is-invalid @enderror qty_range9"
                                        style="width: 7rem;" value="{{ old('qty_range9') }}" id="qty_range9"
                                        name="qty_range9" /> <span class="m-2">-</span> <input type="number" step="0.01"
                                        class="form-control @error('qty_range10') is-invalid @enderror sizeinc"
                                        value="{{ old('qty_range10') }}" id="qty_range10" name="qty_range10" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="nrml_price5">Normal Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('nrml_price5') is-invalid @enderror"
                                    value="{{ old('nrml_price5') }}" id="nrml_price5" name="nrml_price5" />
                                @error('nrml_price5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="urgent_price5">Urgent Price in (Rs.)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('urgent_price5') is-invalid @enderror"
                                    value="{{ old('urgent_price5') }}" id="urgent_price5" name="urgent_price5" />
                                @error('urgent_price5')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Weight in gm (pcs/sqr)*</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    value="{{ old('weight') }}" id="weight" name="weight"
                                    placeholder="Enter Weight in Gram(s)" required />
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Product Description*</label>
                                <textarea name="product_description"
                                    class="form-control @error('product_description') is-invalid @enderror"
                                    id="product_description" cols="30" rows="10" placeholder="Enter Product Description"
                                    required>{{ old('product_description') }}</textarea>
                                @error('discounted_cost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-2">
                                <label for="sizeinc">Size (inch,m,cm,etc)</label>
                                <div class="d-flex">
                                    <input type="number" step="0.01"
                                        class="form-control @error('sizeincnum1') is-invalid @enderror sizeincnum1"
                                        style="width: 7rem;" value="{{ old('sizeincnum1') }}" id="sizeincnum1"
                                        name="sizeincnum1" /> <span class="m-2">x</span> <input type="number"
                                        step="0.01"
                                        class="form-control @error('sizeincnum2') is-invalid @enderror sizeinc"
                                        value="{{ old('sizeincnum2') }}" id="sizeincnum2" name="sizeincnum2" />
                                    <select name="sizeinc" id="sizeinc" class="form-control mx-2">
                                        <option value="">None</option>
                                        <option value=" sqft">Sq.ft</option>
                                        <option value="sqm">Sq.m</option>
                                        <option value="cuft">cu.ft</option>
                                        <option value="inch">in</option>
                                        <option value="cm">cm</option>
                                        <option value="mm">mm</option>
                                        <option value="m">m</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="size">Size</label>
                                <select name="size" id="size" class="form-control">
                                    <option value="">None</option>
                                    <option value=" XS">Extra Small (XS)</option>
                                    <option value="S">Small (S)</option>
                                    <option value="M">Medium (M)</option>
                                    <option value="L">Large (L)</option>
                                    <option value="XL">Extra Large (XL)</option>
                                    <option value="XXL">Ultra Large (XXL)</option>
                                    <option value="ALL">XS, S, M, L, XL, XXL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="">Paper Weight in GM</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('paper_weight') is-invalid @enderror"
                                    value="{{ old('paper_weight') }}" id="paper_weight" name="paper_weight"
                                    placeholder="Enter Paper Weight in Gram(s)" />
                                @error('paper_weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="paper_type">Paper</label>
                                <select name="paper_type" id="paper_type" class="form-control">
                                    <option value="">None</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
                                    <option value="A6">A6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="print_type">Print Type</label>
                                <select name="print_type" id="print_type" class="form-control">
                                    <option value="">None</option>
                                    <option value="multi_colour_print">Multi Colour Print</option>
                                    <option value="black_and_white_print">Black and White Print</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="">Thickness in mm</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('thickness') is-invalid @enderror"
                                    value="{{ old('thickness') }}" id="thickness" name="thickness"
                                    placeholder="Enter Thickness in mm" />
                                @error('thickness')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>






                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn" id="save_product" onclick="product_added()">
                                <input type="submit" class="btn btn-primary" value="Add Product" />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection