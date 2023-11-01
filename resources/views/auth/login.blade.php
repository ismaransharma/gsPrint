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
                    <div class="col-md-6 left">
                        <a href="{{ URL::to('googleLogin') }}">
                            <button class="btn">
                                <div class="google">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa-brands fa-google googleIcon"></i> <span>Google</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6 right">
                        <div class="login">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="signinHeader">
                                    <h3>Sign In</h3>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="@error('password') is-invalid @enderror loginp" name="password"
                                            placeholder="   Enter Your Password" required
                                            autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection