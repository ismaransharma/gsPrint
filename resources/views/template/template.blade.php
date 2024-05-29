<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>

    <link rel="stylesheet" href="{{ asset('site/fontawesome/all.css') }}">

    <link rel="stylesheet" href="{{ asset('site/bootstrap/bootstrap.css') }}" />

    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/utility.css') }}">
    <link rel="stylesheet" href="{{ asset('site/toastr/toastr.css') }}">




</head>


<body>

    <div id="top-header">
        <div class="row">
            <div class="col-md-5 col-lg-6 col-sm-7 pl-1">
                <div class="phoneNumber">
                    <span><i class="fa-solid fa-phone"></i></span>
                    <span>Customer Service: </span>
                    <span>+977 (061) 525561, 9856047078 </span>
                </div>
            </div>
            <div class="col-md-7 col-lg-6 col-sm-5 center">
                <div class="row p-0 jc-end">
                    <div class="col-md-3 bdr jijo">
                        <div class="myAccount">
                            <a href="{{ route('getAccDashboard') }}">
                                <span><i class="fa-solid fa-user"></i></span>
                                <span>MY ACCOUNT</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 bdr uiui">
                        <div class="home">
                            <span><a href="{{ route('getHome') }}">HOME</a></span>
                        </div>
                    </div>
                    <div class="col-md-2 ccio">
                        <div class="cart">
                            <span class="temCart" data-bs-toggle="modal" data-bs-target="#checkCartModal">CART</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (Auth::check()) {
        $user = Auth::user();
        // dd($user);
        $cart_code = $user->cart_code;
        
        
        $cart_items = \App\models\Cart::where('cart_code', $cart_code)->get();

        $total_amount = $cart_items->sum('total_price');
        $quantity = $cart_items->sum('quantity');
        
        // dd($total_amount);
    }
     else {
    }
    ?>


    <section id="navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 wd-10p">
                    <div class="logo">
                        <a href="{{ route('getHome') }}" class="d-inline-block">
                            <img src="{{ asset('site/images/logo.PNG') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-10 wd-90p div-end">
                    <nav class="navbar navbar-expand-lg col-lg-12 col-md-12 col-sm-6 col-xs-2 jc-end w-100p">
                        <div class="toggler-btn div-end">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="row w-100p mt-sm-04 newio">
                                <div class="col-lg-9 col-md-8 .col-sm-12 .col-xs-6 jc-center">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <div class="search w-100p">
                                            <form action="/search">
                                                <input type="search" placeholder="Search Product...." name="search" id="search"
                                                    class="@error('search') is-invalid @enderror round-left"
                                                    value="{{ $search }}">
                                                <button class="round-right">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    
                                @if (Auth::check())
                                    <div class="col-lg-3 col-md-4 col-sm-12 .col-xs-6 jc-center ai-center flex chg-10 wd-10p mt-sm-1 newio">
                                        <div class="cart-total">
                                            <a class="minCarTtl" data-bs-toggle="modal" data-bs-target="#checkCartModal">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                            @if ($total_amount)
                                            <a class="minCarTtl" data-bs-toggle="modal" data-bs-target="#checkCartModal">
                                                <span>Rs. {{ $total_amount }}</span>
                                            </a>
                                            @else
                                            <span>Rs. 0</span>
                                            @endif
                                        </div>
                                    </div>
    
                                @else
                                    <div class="col-lg-3 col-md-4 col-sm-12 .col-xs-6 jc-center ai-center flex chg-10 wd-10p mt-sm-1 newio">
                                        <div class="row">
                                            <div class="col-md-6 w-auto jc-center">
                                                <div class="login">
                                                    <a href="{{ route('login') }}">
                                                        <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Login</span>
                                                    </a>
                
                                                </div>
                                            </div>
                                            <div class="col-md-6 w-auto jc-center">
                                                <div class="login">
                                                    <a href="{{ route('register') }}">
                                                        <i class="fa-solid fa-user-plus"></i> <span>Register</span>
                                                    </a>
                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>


            </div>
        </div>
    </section>

    @yield('content')


    <section id="footer">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner">
                            <img src="{{ asset('site/images/banner.PNG') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                <div class="row">
                    <div class="col-md-4">
                        <div class="header">
                            <span class="first">AUT</span><span>HORIZED Dealer</span>
                        </div>
                        <div class="dealers">
                            <img height="66px" class="mb-2" src="{{ asset('site/images/dealer1.PNG') }}" alt="">
                            <img height="75px" src="{{ asset('site/images/dealer2.PNG') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header">
                            <span class="first">USE</span><span>FUL LINKS</span>
                        </div>
                        <div class="links">
                            <a href="{{ route('getHome') }}">
                                <h5>HOME</h5>
                            </a>
                            <a href="{{ route('getAboutUs') }}">
                                <h5>ABOUT US</h5>
                            </a>
                            <a href="{{ route('getShop') }}">
                                <h5>SHOP</h5>
                            </a>
                            <a href="{{ route('getContactUs') }}">
                                <h5>CONTACT US</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="header">
                            <span class="first">GET</span> <span>CONNECTED</span>
                        </div>
                        <div class="addnumlink">
                            <h5>
                                <span><i class="fa-solid fa-paper-plane"></i></span> <span>Sangam Marg, Newroad,
                                    Pokhara</span>
                            </h5>
                            <h5>
                                <span><i class="fa-solid fa-phone"></i></span> <span>Phone: (061)525561</span>
                            </h5>
                            <h5>
                                <span><i class="fa-solid fa-mobile-screen"></i></span> <span>Mobile: 9856047078</span>
                            </h5>
                            <h5 class="fbinsta">
                                <span><i class="fa-brands fa-facebook-f fb"></i></span> <span><i
                                        class="fa-brands fa-instagram"></i></span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Shopping Cart Modal -->
    <div class="modal fade" id="checkCartModal" tabindex="-1" aria-labelledby="checkCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="checkCartModalLabel"><b>Shopping Cart</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (Auth::check())
                    @if ($cartCount > 0)
                    <div class="container-fluid">
                        <div class="cart-model-ko-main-content">
                            <div class="cart-system">
                                <div class="row">
                                    <div class="col-md-6 text-dark">
                                        <table class="table table-stripped cart-table">
                                            <thead>
                                                <tr>
                                                    <th>Product Title</th>
                                                    <th>Product Image</th>
                                                    <th>Product Quantity</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @foreach ($carts as $cart)
                                            <tbody>
                                                <tr>
                                                    <td class="product_title_cart">
                                                        {{ $cart->getProductFromCart->product_title }}
                                                    </td>
                                                    <td>
                                                        <img height="50px" width="70px"
                                                            src="{{ asset('uploads/product/' . $cart->getProductFromCart->product_image) }}"
                                                            alt="{{ $cart->getProductFromCart->product_title }}">
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('getUpdateCart', $cart->id) }}"
                                                            method="POST" class="form-inline">
                                                            @csrf
                                                            <div class="form-group" style="padding-left: 20px;">
                                                                <input type="number" class="form-control"
                                                                    name="quantity" id="quantity"
                                                                    style="width:70px; text-align: center;"
                                                                    value="{{ $cart->quantity }}" max="10000" min="1">
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>Rs. {{ $cart->total_price }}</td>
                                                    <td>
                                                        <a href="{{ route('getDeleteCart', $cart->id) }}">
                                                            <button class="btn btn-danger" type="submit" title="Remove {{ $cart->getProductFromCart->product_title }}">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total Amount:</td>
                                                    <td>Rs. {{ $total_amount }}</td>
                                                    <td>
                                                        <a href="{{ route('getDeleteAllCart') }}">
                                                            <button class="btn btn-danger" type="submit" title="Remove All Products From Cart">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-buttons mt-2">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <a href="{{ route('getCart') }}">
                                            <button class="go-to-cart-btn cart-buttons">
                                                <h5>Go To Cart</h5>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-md-12 ">
                                        <a href="{{ route('getProceedToCheckout') }}">
                                            <button class="proceed-to-checkout-btn cart-buttons">
                                                <h5>Proceed To Checkout</h5>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="modal-body">
                        <div class="alert alert-danger">No data found!</div>
                    </div>
                    @endif
                    @else
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            Please Login!
                            <a href="{{ route('login') }}">
                                <button class="btn btn-sm btn-primary">Login</button>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('site/jquery/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('site/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('site/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('site/fontawesome/all.js') }}"></script>

    <script>
    @if(Session::has('success'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }
    toastr.success("{{ Session('success') }}");
    @elseif(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }
    toastr.error("{{ Session('error') }}");
    @endif
    </script>


    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>

    <script>
    function togglePasswordConfirm() {
        var passwordInput = document.getElementById("password_confirmation");
        var eyeIcon = document.getElementById("eyeIconConfirm");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>

    <script>
        $(document).ready(function() {
            // Hover functionality for dropdown
            $("#hoverDropdown").hover(function() {
                $(this).find(".dropdown-menu").addClass("show");
            }, function() {
                $(this).find(".dropdown-menu").removeClass("show");
            });
        });
    </script>


</body>

</html>