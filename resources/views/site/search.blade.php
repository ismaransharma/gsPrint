@extends('template.template')
@section('content')

<?php
    // dd($mergedProducts);
?>

<section id="pageHead">
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col-md-6">
                    <h5>
                        <a href="{{ route('getHome') }}">
                            <i class="fa-solid fa-house"></i> <span>HOME</span>
                        </a> <span>/</span> <span><a href="{{ route('getShop') }}">Shop</a></span> <span>/</span>
                        <span>Search</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="featuresProducts">
    <div class="container">
        <div class="featProd">
            <div class="ProBody">
                <div class="row">
                    @foreach ($mergedProducts as $product)
                    <div class="col-md-3">
                        <div class="Prodcard">
                            <div class="containerji">
                                <div class="card">
                                    <div class="imgBx">
                                        <img src="{{ asset('uploads/product/' . $product->product_image) }}" alt="">
                                    </div>
                                    <div class="contentBx">
                                        <h2>{{ $product->product_title }}</h2>

                                        <div class="description">
                                            <h3>{{ Str::limit($product->product_description ?? 'No Description', 15)}}
                                            </h3>
                                        </div>

                                        @if ($product->discount_price > 0)
                                        <div class="original_price">
                                            <h3 style="text-decoration: line-through;">Rs.{{ $product->original_price }}
                                            </h3>
                                        </div>
                                        @else

                                        @endif

                                        <a href="{{ route('getProductDetails', $product->slug) }}">Buy Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

@endsection