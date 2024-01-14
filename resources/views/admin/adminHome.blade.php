@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($Orders);
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
                                <h6>{{ $user }}</h6>
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
                                <h5>Rs. {{ $totalEarnings }}</h5>
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
                                    <h5>{{ $Orders}}</h5>
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