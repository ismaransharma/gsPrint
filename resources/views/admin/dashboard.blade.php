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
    <link rel="stylesheet" href="{{ asset('site/css/utility.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/adminMedia.css') }}">
</head>

<body>

    <div id="admin-navbar" class="adminDashboardBg">
        <div class="row w-100p">
            <div class="col-lg-2 col-md-3 col-sm-2 col-xs-1 navBg">
                <nav>
                    <ul class="nav flex-column">
                        <li class="nav-item h-6">
                            <a href="{{ route('Dashboard') }}" class="flex jc-center center ">
                                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                class="h-auto-w-50p hide iconsSvgs" viewBox="0 0 495.398 495.398"
                                xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391
                                                        v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158
                                                        c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747
                                                        c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"/>
                                                    <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401
                                                        c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79
                                                        c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                            </a>
                            <a class="nav-link home td-none white itemsTexts" href="{{ route('getDashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item h-6">
                            <a href="{{ route('getManageAboutUs') }}" class="flex jc-center center">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-20-2-auto hide iconsSvgs">
                                    <path d="M4 21C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a class="nav-link about-us td-none white w-70p itemsTexts" href="{{ route('getManageAboutUs') }}">About Us</a>
                        </li>
                        <li class="nav-item h-6">
                            <a href="{{ route('getManageContactUs') }}" class="flex jc-center center">
                                <svg viewBox="0 -2.5 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-20 w-auto hide iconsSvgs">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="white" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -922.000000)" fill="white">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path d="M262,764.291 L254,771.318 L246,764.281 L246,764 L262,764 L262,764.291 Z M246,775 L246,766.945 L254,773.98 L262,766.953 L262,775 L246,775 Z M244,777 L264,777 L264,762 L244,762 L244,777 Z" id="email-[#1573]" fill="white">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>       
                            </a>
                            <a class="nav-link contact-us td-none white w-70p itemsTexts" href="{{ route('getManageContactUs') }}">Contact Us</a>
                        </li>
                        <li class="nav-item h-6">
                            <a href="{{ route('getManageCategory') }}" class="flex jc-center center">
                                <svg fill="#000000"  viewBox="-7.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" class="h-auto-w-50p hide iconsSvgs">
                                    <title>category</title>
                                    <path d="M2.594 4.781l-1.719 1.75h15.5l-1.719-1.75h-12.063zM17.219 13.406h-17.219v-6.031h17.219v6.031zM12.063 11.688v-1.719h-6.875v1.719h0.844v-0.875h5.156v0.875h0.875zM17.219 20.313h-17.219v-6.031h17.219v6.031zM12.063 18.594v-1.75h-6.875v1.75h0.844v-0.875h5.156v0.875h0.875zM17.219 27.188h-17.219v-6h17.219v6zM12.063 25.469v-1.719h-6.875v1.719h0.844v-0.875h5.156v0.875h0.875z"></path>
                                </svg>
                            </a>
                            <a class="nav-link category td-none white w-70p itemsTexts" href="{{ route('getManageCategory') }}">Category</a>
                        </li>
                        <li class="nav-item h-6">
                            <a href="{{ route('getManageProducts') }}" class="flex jc-center center">
                                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 979.124 979.124" xml:space="preserve" class="h-auto-w-50p hide iconsSvgs">
                                    <g>
                                        <g>
                                            <path d="M129.629,845.555h719.866V405.491l129.629-241.146l-57.252-30.776l-124.305,231.24H181.556L57.252,133.569L0,164.345
                                                l129.629,241.146V845.555z M194.629,780.555V429.809h589.866v350.747H194.629L194.629,780.555z"/>
                                            <rect x="599.863" y="672.049" width="125.119" height="65.955"/>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <a class="nav-link product td-none white w-70p itemsTexts" href="{{ route('getManageProducts') }}">Product</a>
                        </li>
                        <li class="nav-item h-6">
                            <a href="{{ route('getManageOrders') }}" class="flex jc-center center">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-auto-w-50p hide iconsSvgs">
                                    <path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M2 1C1.44772 1 1 1.44772 1 2C1 2.55228 1.44772 3 2 3H3.21922L6.78345 17.2569C5.73276 17.7236 5 18.7762 5 20C5 21.6569 6.34315 23 8 23C9.65685 23 11 21.6569 11 20C11 19.6494 10.9398 19.3128 10.8293 19H15.1707C15.0602 19.3128 15 19.6494 15 20C15 21.6569 16.3431 23 18 23C19.6569 23 21 21.6569 21 20C21 18.3431 19.6569 17 18 17H8.78078L8.28078 15H18C20.0642 15 21.3019 13.6959 21.9887 12.2559C22.6599 10.8487 22.8935 9.16692 22.975 7.94368C23.0884 6.24014 21.6803 5 20.1211 5H5.78078L5.15951 2.51493C4.93692 1.62459 4.13696 1 3.21922 1H2ZM18 13H7.78078L6.28078 7H20.1211C20.6742 7 21.0063 7.40675 20.9794 7.81078C20.9034 8.9522 20.6906 10.3318 20.1836 11.3949C19.6922 12.4251 19.0201 13 18 13ZM18 20.9938C17.4511 20.9938 17.0062 20.5489 17.0062 20C17.0062 19.4511 17.4511 19.0062 18 19.0062C18.5489 19.0062 18.9938 19.4511 18.9938 20C18.9938 20.5489 18.5489 20.9938 18 20.9938ZM7.00617 20C7.00617 20.5489 7.45112 20.9938 8 20.9938C8.54888 20.9938 8.99383 20.5489 8.99383 20C8.99383 19.4511 8.54888 19.0062 8 19.0062C7.45112 19.0062 7.00617 19.4511 7.00617 20Z" fill="#0F0F0F"/>
                                </svg>
                            </a>
                            <a class="nav-link orders td-none white w-70p itemsTexts" href="{{ route('getManageOrders') }}">Orders</a>
                        </li>
            
            
                    </ul>
                </nav>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-10 p-0 mainCtc">
                @yield('adminTemplate')
            </div>
        </div>
    </div>


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