@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($product->category_id);
?>

<section id="editCategory">
    <div class="container">
        <div class="row">
            <div class="col-md-12 card-col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Edit Product - {{ $product->product_title }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('postEditProduct', $product->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Product Title</label>
                                        <input type="text" name="product_title"
                                            class="form-control @error('product_title') is-invalid @enderror"
                                            value="{{ $product->product_title }}" id="product_title"
                                            placeholder="Enter Product Title" />
                                        @error('product_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">-----------Choose Category-----------</option>
                                            @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}"
                                                <?php if($product->category_id == $cate->id){ echo 'selected'; } ?>>
                                                {{ $cate->category_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="image">Product Image<span class="text-danger"></span></label>

                                        <input type="file"
                                            class="form-control  @error('product_image') is-invalid @enderror"
                                            id="image" name="product_image" placeholder="Enter Product iImage"
                                            value="{{ $product->product_image }}" />
                                        @if ($product->product_image != null)
                                        <img src="{{ asset('uploads/product/' . $product->product_image) }}"
                                            class="img-responsive img-fluid" width="150" height="150" />
                                        @else
                                        <span class="text-danger">Image not available</span>
                                        @endif
                                        @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="active"
                                                <?php if($product->status == 'active') {echo('selected');}?>>
                                                Active</option>
                                            <option value="inactive"
                                                <?php if($product->status == 'inactive') { echo('selected'); } ?>>
                                                Hidden</option>
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
                                        <label for="">Colour (Null if not necessary)</label>
                                        <input type="text" class="form-control @error('colour') is-invalid @enderror"
                                            value="{{ $product->colour }}" id="discount_price" name="colour" />
                                        @error('colour')
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
                                                class="form-control @error('qty_range1') is-invalid @enderror qty_range1"
                                                style="width: 7rem;" value="{{ $product->qty_range1 }}" id="qty_range1"
                                                name="qty_range1" /> <span class="m-2">-</span> <input type="number"
                                                step="0.01"
                                                class="form-control @error('qty_range2') is-invalid @enderror sizeinc"
                                                value="{{ $product->qty_range2 }}" id="qty_range2" name="qty_range2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="nrml_price1">Normal Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('nrml_price1') is-invalid @enderror"
                                            value="{{ $product->nrml_price1 }}" id="nrml_price1" name="nrml_price1" />
                                        @error('nrml_price1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="urgent_price1">Urgent Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('urgent_price1') is-invalid @enderror"
                                            value="{{ $product->urgent_price1 }}" id="urgent_price1"
                                            name="urgent_price1" />
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
                                                style="width: 7rem;" value="{{ $product->qty_range3 }}" id="qty_range3"
                                                name="qty_range3" /> <span class="m-2">-</span> <input type="number"
                                                step="0.01"
                                                class="form-control @error('qty_range4') is-invalid @enderror sizeinc"
                                                value="{{ $product->qty_range4 }}" id="qty_range4" name="qty_range4" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="nrml_price2">Normal Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('nrml_price2') is-invalid @enderror"
                                            value="{{ $product->nrml_price2 }}" id="nrml_price2" name="nrml_price2" />
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
                                            value="{{ $product->urgent_price2 }}" id="urgent_price2"
                                            name="urgent_price2" />
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
                                                style="width: 7rem;" value="{{ $product->qty_range5 }}" id="qty_range5"
                                                name="qty_range5" /> <span class="m-2">-</span> <input type="number"
                                                step="0.01"
                                                class="form-control @error('qty_range6') is-invalid @enderror sizeinc"
                                                value="{{ $product->qty_range6 }}" id="qty_range6" name="qty_range6" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="nrml_price3">Normal Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('nrml_price3') is-invalid @enderror"
                                            value="{{ $product->nrml_price3 }}" id="nrml_price3" name="nrml_price3" />
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
                                            value="{{ $product->urgent_price3 }}" id="urgent_price3"
                                            name="urgent_price3" />
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
                                                style="width: 7rem;" value="{{ $product->qty_range7 }}" id="qty_range7"
                                                name="qty_range7" /> <span class="m-2">-</span> <input type="number"
                                                step="0.01"
                                                class="form-control @error('qty_range8') is-invalid @enderror sizeinc"
                                                value="{{ $product->qty_range8 }}" id="qty_range8" name="qty_range8" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="nrml_price4">Normal Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('nrml_price4') is-invalid @enderror"
                                            value="{{ $product->nrml_price4 }}" id="nrml_price4" name="nrml_price4" />
                                        @error('nrml_price4')
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
                                            value="{{ $product->urgent_price4 }}" id="urgent_price4"
                                            name="urgent_price4" />
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
                                                style="width: 7rem;" value="{{ $product->qty_range9 }}" id="qty_range9"
                                                name="qty_range9" /> <span class="m-2">-</span> <input type="number"
                                                step="0.01"
                                                class="form-control @error('qty_range10') is-invalid @enderror sizeinc"
                                                value="{{ $product->qty_range10 }}" id="qty_range10"
                                                name="qty_range10" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="nrml_price5">Normal Price in (Rs.)</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('nrml_price5') is-invalid @enderror"
                                            value="{{ $product->nrml_price5 }}" id="nrml_price5" name="nrml_price5" />
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
                                            value="{{ $product->urgent_price5 }}" id="urgent_price5"
                                            name="urgent_price5" />
                                        @error('urgent_price5')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label for="">Weight in gm (pcs/sqr)*</label>
                                        <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                            value="{{ $product->weight }}" id="weight" name="weight" required />
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">Product Description</label>
                                        <textarea name="product_description"
                                            class="form-control @error('product_description') is-invalid @enderror"
                                            id="product_description" cols="10" rows="5" placeholder="Write in 15 Word "
                                            required>{{ $product->product_description }}</textarea>
                                        @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="size">Size</label>
                                        <select name="size" id="size"
                                            class="form-control @error('size') is-invalid @enderror">
                                            <option value="">None</option>
                                            <option value="XS"
                                                <?php if($product->size == 'XS') { echo('selected'); } ?>>
                                                Extra Small (XS)
                                            </option>
                                            <option value="S" <?php if($product->size == 'S') { echo('selected'); } ?>>
                                                Small (S)
                                            </option>
                                            <option value="M" <?php if($product->size == 'M') { echo('selected'); } ?>>
                                                Medium (M)
                                            </option>
                                            <option value="L" <?php if($product->size == 'L') { echo('selected'); } ?>>
                                                Large (L)
                                            </option>
                                            <option value="XL"
                                                <?php if($product->size == 'XL') { echo('selected'); } ?>>
                                                Extra Large (XL)
                                            </option>
                                            <option value="XXL"
                                                <?php if($product->size == 'XXL') { echo('selected'); } ?>>
                                                Ultra Large (XXL)
                                            </option>
                                            <option value="ALL"
                                                <?php if($product->size == 'ALL') { echo('selected'); } ?>>
                                                XS, S, M, L, XL, XXL
                                            </option>
                                        </select>

                                        @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="sizeinc">Size (inch,m,cm,etc)</label>
                                        <div class="d-flex">
                                            <input type="number" step="0.01"
                                                class="form-control @error('sizeincnum1') is-invalid @enderror sizeincnum1"
                                                value="{{ $product->sizeincnum1 }}" id="sizeincnum1"
                                                name="sizeincnum1" />
                                            <span class="m-2">x</span> <input type="number" step="0.01"
                                                class="form-control @error('sizeincnum2') is-invalid @enderror sizeincnum2"
                                                value="{{ $product->sizeincnum2 }}" id="sizeincnum2"
                                                name="sizeincnum2" />
                                            <select name="sizeinc" id="sizeinc" class="form-control mx-2">
                                                <option value="">None</option>
                                                <option value="sqft"
                                                    <?php if($product->sizeinc == 'sqft') { echo('selected'); } ?>>
                                                    Sq.ft
                                                </option>
                                                <option value="sqm"
                                                    <?php if($product->sizeinc == 'sqm') { echo('selected'); } ?>>
                                                    Sq.m</option>
                                                <option value="cuft"
                                                    <?php if($product->sizeinc == 'cuft') { echo('selected'); } ?>>
                                                    cu.ft
                                                </option>
                                                <option value="inch"
                                                    <?php if($product->sizeinc == 'in') { echo('selected'); } ?>>in
                                                </option>
                                                <option value="cm"
                                                    <?php if($product->sizeinc == 'cm') { echo('selected'); } ?>>cm
                                                </option>
                                                <option value="mm"
                                                    <?php if($product->sizeinc == 'mm') { echo('selected'); } ?>>
                                                    mm</option>
                                                <option value="m"
                                                    <?php if($product->sizeinc == 'm') { echo('selected'); } ?>>
                                                    m</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Paper Weight in GM</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('paper_weight') is-invalid @enderror"
                                            value="{{ $product->paper_weight }}" id="paper_weight" name="paper_weight"
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
                                            <option value="A1"
                                                <?php if($product->paper_type == 'A1') { echo('selected'); } ?>>A1
                                            </option>
                                            <option value="A2"
                                                <?php if($product->paper_type == 'A2') { echo('selected'); } ?>>A2
                                            </option>
                                            <option value="A3"
                                                <?php if($product->paper_type == 'A3') { echo('selected'); } ?>>A3
                                            </option>
                                            <option value="A4"
                                                <?php if($product->paper_type == 'A4') { echo('selected'); } ?>>A4
                                            </option>
                                            <option value="A5"
                                                <?php if($product->paper_type == 'A5') { echo('selected'); } ?>>A5
                                            </option>
                                            <option value="A6"
                                                <?php if($product->paper_type == 'A6') { echo('selected'); } ?>>A6
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="print_type">Print Type</label>
                                        <select name="print_type" id="print_type" class="form-control">
                                            <option value="">None</option>
                                            <option value="multi_colour_print"
                                                <?php if($product->print_type == 'multi_colour_print') { echo('selected'); } ?>>
                                                Multi Colour Print
                                            </option>
                                            <option value="black_and_white_print"
                                                <?php if($product->print_type == 'black_and_white_print') { echo('selected'); } ?>>
                                                Black and White Print
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Thickness in mm</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('thickness') is-invalid @enderror"
                                            value="{{ $product->thickness }}" id="thickness" name="thickness"
                                            placeholder="Enter Thickness in mm" />
                                        @error('thickness')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="Save changes">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection