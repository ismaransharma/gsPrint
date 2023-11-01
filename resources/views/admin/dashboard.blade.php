<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/fontawesome/all.css') }}" />


    <link rel="stylesheet" href="{{ asset('site/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('site/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin.css') }}">
</head>

<body>

    <div id="admin-navbar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getDashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getManageAboutUs') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getManageContactUs') }}">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getManageCategory') }}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getManageProducts') }}">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getManageOrders') }}">Orders</a>
            </li>


        </ul>
    </div>

    @yield('adminTemplate')

    <script src="{{ asset('site/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('site/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('site/jquery/jquery.js') }}"></script>
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


</body>

</html>