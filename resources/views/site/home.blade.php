@extends('template.template')
@section('content')


<div id="cateAndSlider">
    <div class="row">
        <div class="col-md-2">
            @foreach ($cateproducts as $category)
            <div class="col-md-12">
                <div class="btn-group dropend" id="hoverDropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="row">
                            <div class="col-md-7 text-left">
                                <span class="cateName">{{ $category->category_title }}</span>
                            </div>
                            <div class="col-md-1">
                                <span class="right"><i class="fa-solid fa-angle-right name-right"></i></span>
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($category->products->whereNull('deleted_at') as $product)
                        <a href="{{ route('getProductDetails', $product->slug) }}">
                            <li>{{ $product->product_title }}</li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-10">
            <div id="slider">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('site/images/BannerFlex-01.jpg') }}" alt="" class="img-fluid sliders">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('site/images/IDCards-01.jpg') }}" alt="" class="img-fluid sliders">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('site/images/BannerTshirt-01.jpg') }}" alt="" class="img-fluid sliders">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="" aria-hidden="true">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="" aria-hidden="true">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



@if (count($categories) > 0)
<section id="featuresCategories">
    <div class="container">
        <div class="featCate">
            <div class="cateHeader">
                <h6 class="first">Made The Hard Way</h6>
                <h5 class="second">Featured Categories</h5>
                <div class="decoration">
                    <span>__X__</span>
                </div>
            </div>
            <div class="cateBody">
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-3">
                        <div class="cateimg">
                            <img class="eyhuaga" src="{{ asset('uploads/category/'. $category->category_image) }}"
                                alt="{{ $category->category_image }}">
                        </div>
                        <div class="name">
                            <span>{{ $category->category_title }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@else
@endif

@if (count($products) > 0)
<section id="featuresProducts">
    <div class="container">
        <div class="featProd">
            <div class="ProdHeader">
                <h6 class="first">Made The Hard Way</h6>
                <h5 class="second">Featured Products</h5>
                <div class="decoration">
                    <span>__X__</span>
                </div>
            </div>
            <div class="ProBody">
                <div class="row">
                    @foreach ($products as $product)
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

                                        <div class="ratingStars d-flex jc-center">
                                            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                    C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                            </svg>
                                            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                    C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                            </svg>
                                            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                    C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                            </svg>
                                            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                    C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                            </svg>
                                            <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                viewBox="0 0 47.94 47.94" xml:space="preserve">
                                                <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                    C22.602,0.567,25.338,0.567,26.285,2.486z"/>
                                            </svg>
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

@else

@endif


<!-- 
<section id="specialEvent">
    <div class="container">
        <div class="eveHeader">
            <h6 class="first">Offers</h6>
            <h5 class="second">Special Offers</h5>
            <div class="decoration">
                <span>__X__</span>
            </div>
        </div>
        <div class="eveBody">
            <div class="row">
                <div class="col-md-3">
                    <div class="Prodcard">
                        <div class="containerji">
                            <div class="card">
                                <div class="imgBx">
                                    <img src="{{ asset('site/images/card1.png') }}" alt="">
                                </div>
                                <div class="contentBx">
                                    <h2>Business Card</h2>

                                    <div class="size">
                                        <h3>Single Side</h3>
                                    </div>

                                    <div class="price originalPrice">
                                        <h3>Rs.200</h3>
                                    </div>

                                    <div class="price">
                                        <h3>Rs.140</h3>
                                    </div>
                                    <a href="#">Buy Now</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="Prodcard">
                        <div class="containerji">
                            <div class="card">
                                <div class="imgBx">
                                    <img src="{{ asset('site/images/stamp.png') }}" alt="">
                                </div>
                                <div class="contentBx">
                                    <h2>Stamp</h2>

                                    <div class="size">
                                        <h3>Stamp blue</h3>
                                    </div>

                                    <div class="price originalPrice">
                                        <h3>Rs.100</h3>
                                    </div>

                                    <div class="price">
                                        <h3>Rs.70</h3>
                                    </div>
                                    <a href="#">Buy Now</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


@endsection