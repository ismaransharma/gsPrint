@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($products);
?>

<section id="dashboard">
    <div class="container">
        <div class="top">
            <div class="row">
                <div class="col-md-3 first main-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9 first">
                                    <h6>Welcome Admin!</h6>
                                </div>
                                <div class="col-md-3">
                                    <div class="profile-image">
                                        <img src="{{ asset('site/images/test.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="profile-name">
                                <h6>Ghanshyam Gautam</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 second middle">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h6>Total Earning!</h6>
                            </div>
                            <div class="earning">
                                <h5>Rs. 208000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="profile-name">
                        <h5>Ghanshyam Gautam</h5>
                    </div>
                </div>
                <div class="col-md-3 third middle">
                    <div class="card">
                        <div class="card-body">
                            <h6>Completed Orders!</h6>
                            <div class="col-md-6 text-center">
                                <div class="completedOrders">
                                    <h5>20</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($products->where('stock', '<', 15)->count() > 0)
                <div class="row middle">
                    <div class="col-md-12 main-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Low Stock Product</h3>
                                    </div>
                                </div>
                                <div class="lists">
                                    <h4>
                                        <ul>
                                            @foreach ($products as $product)
                                            @if ($product->stock < 10) @if ($product->stock <= 5) <li
                                                    style="color: red;">
                                                    {{ $product->product_title }} -> {{ $product->stock }}
                                                    </li>
                                                    @else
                                                    <li>{{ $product->product_title }} -> {{ $product->stock }}</li>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                        </ul>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

        </div>
    </div>
</section>

@endsection