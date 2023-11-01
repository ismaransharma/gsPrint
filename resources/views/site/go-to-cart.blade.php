@extends('template.template') @section('content')


<?php
    if (Auth::check()) {
        $user = Auth::user(); // Get the currently authenticated user
        $cart_code = $user->cart_code;
        
        // Retrieve the cart items associated with the user
        $cart_items = \App\models\Cart::where('cart_code', $cart_code)->get();

        // Calculate the total amount and quantity from the cart items
        $total_amount = $cart_items->sum('total_price');
        $quantity = $cart_items->sum('quantity');
        
        // dd($total_amount);
    }
     else {
        // Handle non-authenticated users
    }

    // dd($cart_code);

?>

<section id="pageHead" class="cart">
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <a href="{{ route('getHome') }}">
                            <i class="fa-solid fa-house"></i> <span>HOME</span>
                        </a>
                        <span>/</span> <span>Cart</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cart-content">
    <div class="container">
        <div class="cartHeader">
            <h2>
                Your Cart is Total Rs. {{ $total_amount }} with
                {{ $quantity }} Product(s)
            </h2>
        </div>
        <div class="myCart">
            <h2>My Cart</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="left">
                    @foreach ($cart_items as $cart)
                    <div class="cartBody">
                        <div class="myCartProducts">
                            <div class="row">
                                <div class="col-md-3 pdimg">
                                    <div class="productImage">
                                        <img src="{{ asset('uploads/product/' . $cart->getProductFromCart->product_image) }}"
                                            alt="" />
                                    </div>
                                </div>
                                <div class="col-md-3 pdttl">
                                    <span>{{ $cart->getProductFromCart->product_title }}</span>
                                    <h4>Rs. {{ $cart->getProductFromCart->total }}/Qty</h4>
                                </div>
                                <div class="col-md-3 pdqt">
                                    <form action="{{ route('getUpdateCart', $cart->id) }}" method="POST"
                                        class="form-inline">
                                        @csrf
                                        <div class="form-group" style="padding-left: 20px;">
                                            <input type="number" class="form-control" name="quantity" id="quantiy"
                                                style="width:12.5rem; text-align: center; height: 3rem; font-size: 1.6rem;"
                                                value="{{ $cart->quantity }}" max="30" min="1">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2 pdtot">
                                    <h4>Rs. {{ $cart->total_price }}</h4>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('getDeleteCart', $cart->id) }}">
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="right">
                    <div class="card">
                        <div class="card-body">
                            <div class="header">
                                <h2>Order Summary</h4>
                            </div>
                            <div class="body">
                                <div class="subTotal">
                                    <h3>Sub Total:- Rs. {{ $total_amount }}</h3>
                                </div>
                                <div class="shipping">
                                    <h3>Shipping:- Rs. 150</h3>
                                </div>
                                <div class="total">
                                    <h3>Total:- Rs. {{ $total_amount + 150 }}</h3>
                                </div>
                                <div class="proceedToCheckout">
                                    <a href="{{ route('getProceedToCheckout') }}">
                                        <button class="btn btn-sm">Proceed To Checkout</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection