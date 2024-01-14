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
    }

?>


<section id="login">
    <div class="container">
        <div class="main">
            <div class="box">
                <div class="row">
                    <div class="col-md-12 right">
                        <div class="login">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="signinHeader">
                                    <h3>Sign Up</h3>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input id="name" type="text" class=" @error('name') is-invalid @enderror loginp"
                                            name="name" value="{{ old('name') }}" required autocomplete="email"
                                            placeholder="   Enter Your Name" autofocus required>
                                        @error('name ')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class=" @error('email') is-invalid @enderror loginp" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="   Enter Your Email" autofocus required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input id="password" type="password"
                                                    class="@error('password') is-invalid @enderror loginp"
                                                    name="password" placeholder="   Enter your Password" required
                                                    autocomplete="current-password">
                                            </div>

                                            <div class="col-md-2 togglePassUp">
                                                <span class="togglePass" onclick="togglePassword()">
                                                    <i id="eyeIcon" class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input id="password_confirmation" type="password"
                                                    class="@error('password_confirmation') is-invalid @enderror loginp"
                                                    name="password_confirmation" placeholder="   Confirm your Password"
                                                    required autocomplete="current-password">
                                            </div>

                                            <div class="col-md-2 togglePassUp">
                                                <span class="togglePass" onclick="togglePasswordConfirm()">
                                                    <i id="eyeIconConfirm" class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>

                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 reg">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12 aldyacc">
                                <a href="{{ route('login') }}">Already have an account?</a>
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