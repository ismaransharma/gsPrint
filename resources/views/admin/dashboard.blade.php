<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/fontawesome/all.css') }}" />


    <link rel="stylesheet" href="{{ asset('site/css/admin/media.css') }}">
    <link rel="stylesheet" href="{{ asset('site/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin/utility.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin/media.css') }}">
</head>

<body>

    <section id="adminTemplate">
        <div class="container-fluid">
            <div class="upperMain">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-dark egrgrs">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="bi bi-house-door" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12 2a1 1 0 0 1 .832.445l8 11a1 1 0 0 1 .168.555V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7.5a1 1 0 0 1 .168-.555l8-11A1 1 0 0 1 12 2zm0 2.621L5.356 14.5h13.288L12 4.621zM6 16v3h2v-2h4v2h2v-3H6z"/>
                                    <path fill-rule="evenodd" d="M11 14h2v6h-2v-6z"/>
                                  </svg>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item {{ request()->is('admin') || request()->is('admin/dashboard') ? 'active' : '' }}">
                                        <a class="nav-link" aria-current="page" href="{{ route('getDashboard') }}">Home</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/aboutUs/manageAboutUs') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('getManageAboutUs') }}">About Us</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/category/manageCategory') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('getManageCategory') }}">Category</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/product/manageProducts') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('getManageProducts') }}">Product</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/orders/manageOrders') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('getManageOrders') }}">Orders</a>
                                    </li>
                                </ul>                              
                            </div>
                        </div>
                    </nav>
                    <div class="col-lg-12 col-md-10 right w-85p">
                        @yield('adminTemplate')                 
                    </div>
                </div>
            </div>

            
        </div>
    </section>


    <script src="{{ asset('site/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('site/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('site/jquery/jquery.js') }}"></script>
    <script src="{{ asset('site/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('site/fontawesome/all.js') }}"></script>
    <script src="{{ asset('site/js/orderMngt.js') }}"></script>
    <script src="{{ asset('site/js/adminNav.js') }}"></script>
    
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


</body>

</html>