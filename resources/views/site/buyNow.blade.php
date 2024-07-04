@extends('template.template')
@section('content')

<?php
// dd($product);

$addToCartUrl = route('postAddToCart', $product->slug);
$buyNowUrl = route('postAddToCartAndDirectProceedToCheckOut', $product->slug);

$rrtProduct = $rrtProdut ?? null;

if ($rrtProduct) {
    $addToCartUrl = route('postAddToCart', $rrtProduct->slug);
    $buyNowUrl = route('postAddToCartAndDirectProceedToCheckOut', $rrtProduct->slug);
}


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
            <div class="col-md-3">
                <div class="productImage">
                    <img src="{{ asset('uploads/product/' . $product->product_image) }}" alt="Image is not Available!">
                </div>
                <div class="productDescription">
                    <p>
                        {{ $product->product_description }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 prodDet">
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

                        @if ($product->total === null)
                        @else
                        <div class="col-md-6">
                            <h4>Price per qty</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>Rs.{{ $product->total }}@if ($product->discount_price)
                                <span style="text-decoration: line-through; font-size: 1.1rem;">Rs.
                                    {{ $product->original_price }}</span>
                                @else
                                {{-- Handle discount_price not set --}}
                                @endif
                            </h5>
                        </div>
                        @endif


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

                        <form action="" method="POST" id="myCartAndCheckOut" class="form" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="col-md-12 radios">
                                <input type="radio" name="price2" value="nrml_price" id="nrml_price" checked>
                                <span class="prices" onclick="selectRadio('nrml_price')">Normal Price</span>
                        
                                <input type="radio" name="price2" value="urgent_price" id="urgent_price">
                                <span class="prices" onclick="selectRadio('urgent_price')">Urgent Price</span>
                            </div>
                        
                            <div class="designer">
                                <label for="upload_design" class="custom-file-upload"></label>
                                <input type="file" class="form-control @error('upload_design') is-invalid @enderror" value="{{ old('upload_design') }}" id="upload_design" name="upload_design" required />
                        
                                <label for="hire_designer" class="hire-designer"></label>
                                <input name="hire_designer" id="hire_designer" class="hire_designer" onclick="openWhatsAppChat()" />
                            </div>
                        
                            <input type="number" name="quantity" id="quantity" min="1" max="10000" value="1" placeholder="quantity" style="height: 45px; width: 170px; text-align: center;">
                        
                            <button class="btn add-to-cart btn-buy-page" type="button" onclick="validateAddToCart()">
                                <i class="fa-solid fa-cart-shopping"></i><span>Add To Cart</span>
                            </button>
                            <button class="btn buy-now-button btn-buy-page" type="button" onclick="validateBuyNow()"> 
                                <span class="buyNow">Buy Now</span>
                            </button>
                        </form>


                    </div>
                </div>

            </div>
            @if ($product->qty_range1)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Price List</h3>
                    </div>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Quantity Range</th>
                                    <th>Normal Price (/unit)</th>
                                    <th>Urgent Price (/unit)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($product->qty_range1)
                                <tr>
                                    <td>{{ $product->qty_range1 }} - {{ $product->qty_range2 }}</td>
                                    <td>Rs. {{ $product->nrml_price1 }}</td>
                                    <td>Rs. {{ $product->urgent_price1 }}</td>
                                    @else

                                </tr>
                                @endif
                                @if ($product->qty_range3)
                                <tr>
                                    <td>{{ $product->qty_range3 }} - {{ $product->qty_range4 }}</td>
                                    <td>Rs. {{ $product->nrml_price2 }}</td>
                                    <td>Rs. {{ $product->urgent_price2 }}</td>
                                    @else

                                </tr>
                                @endif
                                @if ($product->qty_range5)
                                <tr>
                                    <td>{{ $product->qty_range5 }} - {{ $product->qty_range6 }}</td>
                                    <td>Rs. {{ $product->nrml_price3 }}</td>
                                    <td>Rs. {{ $product->urgent_price3 }}</td>
                                    @else

                                </tr>
                                @endif
                                @if ($product->qty_range6)
                                <tr>
                                    <td>{{ $product->qty_range7 }} - {{ $product->qty_range8 }}</td>
                                    <td>Rs. {{ $product->nrml_price4 }}</td>
                                    <td>Rs. {{ $product->urgent_price4 }}</td>
                                    @else

                                </tr>
                                @endif
                                @if ($product->qty_range3)
                                <tr>
                                    <td>{{ $product->qty_range9 }} - {{ $product->qty_range10 }}</td>
                                    <td>Rs. {{ $product->nrml_price5 }}</td>
                                    <td>Rs. {{ $product->urgent_price5 }}</td>
                                    @else

                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else

            @endif
        </div>
    </div>
</section>


{{-- Rating And Review --}}
<section id="ratingAndReview">
  <div class="container-fluid div-center">
    <div class="wholeBox">
      <div class="upper-box">
        <div class="header">
          <div class="row bs-guuter-x-0 jhsgvbe">
            <div
              class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-blue white center"
            >
              <button onclick="addAReview()">
                <h3>Add A Review</h3>
              </button>
            </div>
            <div
              class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-green white center"
            >
              <button onclick="viewReview()">
                <h3>View Review</h3>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="Cntbox bg-d9">
        <div class="col-md-12">
          <div class="addAndViewReview">
            <div class="addAReview" id="addAReview">
              <div class="header">
                <h3 class="blue my-2 center">Review this Product</h3>
              </div>

              <div class="textArea">
                <textarea
                  name=""
                  id=""
                  class="w-90p h-9rem m-5 p-1"
                  placeholder="Add a Review"
                ></textarea>
              </div>
              <div class="reviewStars center my-3">
                <svg
                  height="800px"
                  width="800px"
                  class="star"
                  data-value="1"
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 47.94 47.94"
                  xml:space="preserve"
                >
                  <path
                    d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                    C22.602,0.567,25.338,0.567,26.285,2.486z"
                  />
                </svg>
                <svg
                  height="800px"
                  width="800px"
                  class="star"
                  data-value="2"
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 47.94 47.94"
                  xml:space="preserve"
                >
                  <path
                    d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                    C22.602,0.567,25.338,0.567,26.285,2.486z"
                  />
                </svg>
                <svg
                  height="800px"
                  width="800px"
                  class="star"
                  data-value="3"
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 47.94 47.94"
                  xml:space="preserve"
                >
                  <path
                    d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                    C22.602,0.567,25.338,0.567,26.285,2.486z"
                  />
                </svg>
                <svg
                  height="800px"
                  width="800px"
                  class="star"
                  data-value="4"
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 47.94 47.94"
                  xml:space="preserve"
                >
                  <path
                    d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                    C22.602,0.567,25.338,0.567,26.285,2.486z"
                  />
                </svg>
                <svg
                  height="800px"
                  width="800px"
                  class="star"
                  data-value="5"
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 47.94 47.94"
                  xml:space="preserve"
                >
                  <path
                    d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                    c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                    c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                    c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                    c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                    C22.602,0.567,25.338,0.567,26.285,2.486z"
                  />
                </svg>
              </div>
              <div class="bottom center">
                <a href="#"> 
                    <button onclick="logRating()">Add</button>
                </a>
              </div>
            </div>
            <div class="viewReview ds-none" id="viewReview">
              <div class="header">
                <h3 class="green my-2 center">View Review</h3>
              </div>
              <div class="mainReview">
                <div class="review m-2">
                  <div class="gagae">
                    <div class="row bs-guuter-x-0">
                      <div class="col-md-12 my-3">
                        <div class="user">
                          <div class="row bs-guuter-x-0">
                            <!-- User Image -->
                            <div class="col-md-1">
                              <div class="image">
                                <img src="{{ asset('site/images/user.jpg') }}" alt="" />
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="row bs-guuter-x-0">
                                <!-- User Name -->
                                <div class="col-md-6">
                                  <div class="name">
                                    <h4>Ghanshyam Gautam (Customer)</h4>
                                  </div>
                                </div>
                                <!-- Date -->
                                <div class="col-md-6">
                                  <div class="date green">
                                    <h4>[February 22, 2024]</h4>
                                  </div>
                                </div>

                                <!-- Main User Review (Stars) -->
                                <div class="col-md-12">
                                  <div class="row bs-guuter-x-0">
                                    <div class="col-md-4">
                                      <div class="starReview">
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: white"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                    <div class="col-md-7 my-1">
                                      <div class="starReviewLine">
                                        <h5>Perfecto!!</h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 my-3">
                        <div class="user">
                          <div class="row bs-guuter-x-0">
                            <!-- User Image -->
                            <div class="col-md-1">
                              <div class="image">
                                <img src="{{ asset('site/images/user.jpg') }}" alt="" />
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="row bs-guuter-x-0">
                                <!-- User Name -->
                                <div class="col-md-6">
                                  <div class="name">
                                    <h4>Ghanshyam Gautam (Customer)</h4>
                                  </div>
                                </div>
                                <!-- Date -->
                                <div class="col-md-6">
                                  <div class="date green">
                                    <h4>[February 22, 2024]</h4>
                                  </div>
                                </div>

                                <!-- Main User Review (Stars) -->
                                <div class="col-md-12">
                                  <div class="row bs-guuter-x-0">
                                    <div class="col-md-4">
                                      <div class="starReview">
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: white"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                    <div class="col-md-7 my-1">
                                      <div class="starReviewLine">
                                        <h5>Perfecto!!</h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 my-3">
                        <div class="user">
                          <div class="row bs-guuter-x-0">
                            <!-- User Image -->
                            <div class="col-md-1">
                              <div class="image">
                                <img src="{{ asset('site/images/user.jpg') }}" alt="" />
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="row bs-guuter-x-0">
                                <!-- User Name -->
                                <div class="col-md-6">
                                  <div class="name">
                                    <h4>Ghanshyam Gautam (Customer)</h4>
                                  </div>
                                </div>
                                <!-- Date -->
                                <div class="col-md-6">
                                  <div class="date green">
                                    <h4>[February 22, 2024]</h4>
                                  </div>
                                </div>

                                <!-- Main User Review (Stars) -->
                                <div class="col-md-12">
                                  <div class="row bs-guuter-x-0">
                                    <div class="col-md-4">
                                      <div class="starReview">
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: white"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                    <div class="col-md-7 my-1">
                                      <div class="starReviewLine">
                                        <h5>Perfecto!!</h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 my-3">
                        <div class="user">
                          <div class="row bs-guuter-x-0">
                            <!-- User Image -->
                            <div class="col-md-1">
                              <div class="image">
                                <img src="{{ asset('site/images/user.jpg') }}" alt="" />
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="row bs-guuter-x-0">
                                <!-- User Name -->
                                <div class="col-md-6">
                                  <div class="name">
                                    <h4>Ghanshyam Gautam (Customer)</h4>
                                  </div>
                                </div>
                                <!-- Date -->
                                <div class="col-md-6">
                                  <div class="date green">
                                    <h4>[February 22, 2024]</h4>
                                  </div>
                                </div>

                                <!-- Main User Review (Stars) -->
                                <div class="col-md-12">
                                  <div class="row bs-guuter-x-0">
                                    <div class="col-md-4">
                                      <div class="starReview">
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: white"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                    <div class="col-md-7 my-1">
                                      <div class="starReviewLine">
                                        <h5>Perfecto!!</h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 my-3">
                        <div class="user">
                          <div class="row bs-guuter-x-0">
                            <!-- User Image -->
                            <div class="col-md-1">
                              <div class="image">
                                <img src="{{ asset('site/images/user.jpg') }}" alt="" />
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="row bs-guuter-x-0">
                                <!-- User Name -->
                                <div class="col-md-6">
                                  <div class="name">
                                    <h4>Ghanshyam Gautam (Customer)</h4>
                                  </div>
                                </div>
                                <!-- Date -->
                                <div class="col-md-6">
                                  <div class="date green">
                                    <h4>[February 22, 2024]</h4>
                                  </div>
                                </div>

                                <!-- Main User Review (Stars) -->
                                <div class="col-md-12">
                                  <div class="row bs-guuter-x-0">
                                    <div class="col-md-4">
                                      <div class="starReview">
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: #ed8a19"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                        <svg
                                          height="800px"
                                          width="800px"
                                          version="1.1"
                                          id="Capa_1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          viewBox="0 0 47.94 47.94"
                                          xml:space="preserve"
                                        >
                                          <path
                                            style="fill: white"
                                            d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757
                                                   c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042
                                                   c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685
                                                   c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528
                                                   c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956
                                                   C22.602,0.567,25.338,0.567,26.285,2.486z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                    <div class="col-md-7 my-1">
                                      <div class="starReviewLine">
                                        <h5>Perfecto!!</h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="view-more-btn">
                    <a href="">
                      <button class="viewMoreBtn">View More</button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
$related_products = App\Models\Product::where('category_id', $product->category_id)
->where('deleted_at', null)
->where('status', 'active')
->where('id', '!=', $product->id)
->get(); 
// dd($related_products);

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
        @foreach ($related_products as $rrtProduct)
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
                                                    <img src="{{ asset('uploads/product/' . $rrtProduct->product_image) }}"
                                                        alt="">
                                                </div>
                                                <div class="contentBx">
                                                    <h2>{{ $rrtProduct->product_title }}</h2>

                                                    <div class="description">
                                                        <h3>{{ Str::limit($rrtProduct->product_description ?? 'No Description', 15)}}..
                                                        </h3>
                                                    </div>

                                                    @if ($rrtProduct->discount_price > 0)
                                                    <div class="original_price">
                                                        <h3 style="text-decoration: line-through;">
                                                            Rs.{{ $rrtProduct->original_price }}
                                                        </h3>
                                                    </div>
                                                    @else

                                                    @endif
                                                    <!-- 
                                                    <div class="price">
                                                        <h3>Rs.{{ $rrtProduct->total }}</h3>
                                                    </div> -->
                                                    <a href="{{ route('getProductDetails', $rrtProduct->slug) }}">Buy
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
<script>
    function selectRadio(radioId) {
        document.getElementById(radioId).checked = true;
    }
    
    function validateForm() {
        var uploadDesignInput = document.getElementById("upload_design");
    
        if (uploadDesignInput.files.length === 0) {
            toastr.error("You need to upload a design");
            return false;
        }
    }
    
    function validateAddToCart() {
        var uploadDesignInput = document.getElementById("upload_design");
    
        if (uploadDesignInput.files.length === 0) {
            toastr.error("You need to upload a design");
            return false;
        }
    
        document.getElementById("myCartAndCheckOut").action = "{{ $addToCartUrl }}";
        document.getElementById("myCartAndCheckOut").submit();
    }
    
    function validateBuyNow() {
        var uploadDesignInput = document.getElementById("upload_design");
    
        if (uploadDesignInput.files.length === 0) {
            toastr.error("You need to upload a design");
            return false;
        }
    
        document.getElementById("myCartAndCheckOut").action = "{{ $buyNowUrl }}";
        document.getElementById("myCartAndCheckOut").submit();
    }
    
    function openWhatsAppChat() {
        var designerNumber = '9703516489';
        var whatsappUrl = 'https://wa.me/' + designerNumber;
        window.open(whatsappUrl, '_blank');
    }
    </script>