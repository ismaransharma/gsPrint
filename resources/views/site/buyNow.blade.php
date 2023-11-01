@extends('template.template')
@section('content')

<?php
// dd($product)
?>

<section id="pageHead">
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <a href="{{ route('getHome') }}">
                            <i class="fa-solid fa-house"></i> <span>HOME</span>
                        </a> <span>/</span> <span>{{ $product->product_title }}</span> <span>/</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="buyNowContainer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="productImage">
                    <img src="{{ asset('uploads/product/' . $product->product_image) }}" alt="Image is not Available!">
                </div>
                <div class="productDescription">
                    <p>
                        {{ $product->product_description }}
                    </p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="productTitle">
                    <h3 class="fw-bold">{{ $product->product_title }}</h3>
                </div>
                <!-- <div class="productDescription">
                    <p>
                        {{ $product->product_description }}
                    </p>
                </div> -->
                <div class="products-details">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>G SM/Gaje</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>String</h5>
                        </div>
                        <div class="col-md-6">
                            <h4>Weight</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $product->weight }} Gram(s)</h5>
                        </div>
                        <div class="col-md-6">
                            <h4>Price per qty</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>Rs.{{ $product->total }}@if ($product->discount_price)
                                <span
                                    style="text-decoration: line-through; font-size: 1.1rem;">Rs.{{ $product->original_price }}</span>
                                @else

                                @endif
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <h4>Stock</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $product->stock }}</h5>
                        </div>
                        @if ($product->colour == "Null" && "NULL" )

                        @else
                        <div class="col-md-6">
                            <h4>Colour</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $product->colour }}</h5>
                        </div>
                        @endif

                        @if ($product->size === "Null" || $product->size === "NULL" || $product->size === null)
                        @else
                        <div class="col-md-6">
                            <h4>Size</h4>
                        </div>
                        <div class="col-md-6">
                            @if ($product->size === "ALL")
                            <h5>XS, S, M, L, XL, XXL</h5>
                            @else
                            <h5>{{ $product->size }}</h5>
                            @endif
                        </div>
                        @endif
                        @if ($product->sizeinc === "Null" || $product->sizeinc === "NULL" || $product->sizeinc === null)
                        @else
                        <div class="col-md-6">
                            <h4>Size</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>
                                <span>{{ $product->sizeincnum1 }}</span>
                                <span>x</span>
                                <span>{{ $product->sizeincnum2 }}</span>
                                <span>{{ $product->sizeinc }}</span>
                            </h5>
                        </div>
                        @endif
                        @if ($product->paper_weight === "Null" || $product->paper_weight === "NULL" ||
                        $product->paper_weight === null)
                        @else
                        <div class="col-md-6">
                            <h4>Paper Weight</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>
                                <span>{{ $product->paper_weight }} GM</span>
                            </h5>
                        </div>
                        @endif
                        @if ($product->paper_type === "Null" || $product->paper_type === "NULL" ||
                        $product->paper_type === null)
                        @else
                        <div class="col-md-6">
                            <h4>Paper Type</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>
                                <span>{{ $product->paper_type }}</span>
                            </h5>
                        </div>
                        @endif
                        @if ($product->print_type === "Null" || $product->print_type === "NULL" || $product->print_type
                        === null)
                        @else
                        <div class="col-md-6">
                            <h4>Print Type</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>
                                <span class="text-uppercase">
                                    @if ($product->print_type == "multi_colour_print")
                                    Multi Colour Print
                                    @else
                                    Black And White Print
                                    @endif
                                </span>
                            </h5>
                        </div>
                        @endif
                        @if ($product->thickness === "Null" || $product->thickness === "NULL" ||
                        $product->thickness === null)
                        @else
                        <div class="col-md-6">
                            <h4>Thickness</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>
                                <span>{{ $product->thickness }} MM</span>
                            </h5>
                        </div>
                        @endif


                    </div>
                </div>

                <form action="{{ route('postAddToCart', $product->slug) }}" method="POST" class="form">
                    @csrf
                    <input type="number" name="quantity" id="quantity" min="1" max="30" value="1" placeholder="quantity"
                        style="height: 45px; width: 170px; text-align: center;">
                    <button class="btn add-to-cart btn-buy-page">
                        <i class="fa-solid fa-cart-shopping"></i><span>Add To Cart</span>
                    </button>
                    <button class="btn buy-now-button btn-buy-page">
                        <span>Buy Now</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>


<?php $related_products = App\Models\Product::where('category_id', $product->category_id)
        ->where('deleted_at', null)
        ->where('status', 'active')
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get(); 
?>

@if (count($related_products) > 0)
<section id="relatedProducts">
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h3>RELATED PRODUCTS</h3>
                    <h4 class="text-muted">__x__</h4>
                </div>
            </div>
        </div>
        @foreach ($related_products as $item)
        <div class="body">
            <section id="featuresProducts">
                <div class="container">
                    <div class="featProd">
                        <div class="ProBody">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="Prodcard">
                                        <div class="containerji">
                                            <div class="card">
                                                <div class="imgBx">
                                                    <img src="{{ asset('uploads/product/' . $product->product_image) }}"
                                                        alt="">
                                                </div>
                                                <div class="contentBx">
                                                    <h2>{{ $product->product_title }}</h2>

                                                    <div class="description">
                                                        <h3>{{ Str::limit($product->product_description ?? 'No Description', 15)}}..
                                                        </h3>
                                                    </div>

                                                    @if ($product->discount_price > 0)
                                                    <div class="original_price">
                                                        <h3 style="text-decoration: line-through;">
                                                            Rs.{{ $product->original_price }}
                                                        </h3>
                                                    </div>
                                                    @else

                                                    @endif

                                                    <div class="price">
                                                        <h3>Rs.{{ $product->total }}</h3>
                                                    </div>
                                                    <a href="{{ route('getProductDetails', $product->slug) }}">Buy
                                                        Now</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </section>
        </div>
        @endforeach
    </div>
</section>
@else

@endif

@endsection