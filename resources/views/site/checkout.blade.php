@extends('template.template')
@section('content')

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
                        <span>/</span> <span>Checkout</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="proceed-to-checkout" class="mt-5 mb-5">
    <div class="container">
        <form action="{{ route('postCheckout') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Billing Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name*</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="" value="{{ old('name') }}" required>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="mobile_number">Mobile Number*</label>
                                            <input type="number"
                                                class="form-control @error('mobile_number') is-invalid @enderror"
                                                name="mobile_number" id="mobile_number" placeholder=""
                                                value="{{ old('mobile_number') }}" required>

                                            @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="email">Email*</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="" value="{{ old('email') }}"
                                                required>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="full_address">Full Address*</label>
                                            <input type="text"
                                                class="form-control @error('full_address') is-invalid @enderror"
                                                name="address" id="full_address" placeholder=""
                                                value="{{ old('full_address') }}" required>

                                            @error('full_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="additional_information">Additon Informations*</label>
                                            <textarea
                                                class="form-control @error('additional_information') is-invalid @enderror"
                                                name="additional_information" id="additional_information"
                                                placeholder="Additional Information"
                                                rows="10">{{ old('additional_information') }}</textarea>

                                            @error('additional_information')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="right">
                        <div class="card">
                            <div class="card-body">
                                <div class="header">
                                    <h2>Your Orders</h2>
                                </div>
                                <div class="body">
                                    <div class="main-body">
                                        <div class="bdy">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($cart_items as $cart)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('uploads/product/' . $cart->getProductFromCart->product_image) }}"
                                                                alt="{{ $cart->getProductFromCart->product_title }}"
                                                                class="img-fluid">
                                                        </td>
                                                        <td>
                                                            <p>Product:- {{ $cart->getProductFromCart->product_title }}
                                                                <br>
                                                                Quantity:- {{ $cart->quantity }}<br>
                                                                Cost:- Rs.
                                                                {{ $cart->getProductFromCart->total }} per<br>
                                                                Total:- Rs.
                                                                {{ $cart->quantity * $cart->getProductFromCart->total}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="payment_method"
                                                        id="" value="cod" required>

                                                    <img src="{{ asset('site/images/cod.png') }}" alt=""
                                                        class="img-fluid">
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="payment_method"
                                                        id="" value="cod" required>

                                                    <img src="{{ asset('site/images/esewa.png') }}" alt=""
                                                        class="img-fluid">
                                                </label>
                                            </div>
                                        </div>

                                        @error('payment_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="body-footer">
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
                                            <button class="btn btn-sm">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection