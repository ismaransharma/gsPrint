@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($searchOrder);
?>



<section id="manageCategory">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Manage Order -- {{ $orders->count() }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <form action="/admin/orders/searchOrder">
                                    <input type="search" placeholder="Search Order" name=" searchOrder" id="searchOrder"
                                        class="@error('searchOrder') is-invalid @enderror round-left search"
                                        value="{{ $searchOrder }}">
                                    <button class="round-right searchBtn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Cart Code</th>
                                    <th>Address</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->mobile_number }}</td>
                                    <td>{{ Str::limit($order->email ?? 'No Email', 10)}}..</td>
                                    <td>{{ $order->cart_code }}</td>
                                    <td>{{ Str::limit($order->address ?? 'No Address', 10)}}..</td>
                                    <td>
                                        @if ($order->payment_method == 'cod')
                                        @if ($order->payment_status == 'Y')
                                        <h5 class="green">Cash on Delivery</h5>
                                        @else
                                        <h5 class="red">Cash on Delivery</h5>
                                        @endif
                                        @else
                                        <h5>Online Payment</h5>
                                        @endif
                                    </td>
                                    <td style="width: 121px;">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $order->cart_code }}">View</button>
                                        @if ($order->payment_method == 'cod')
                                        <br>
                                        <div class="toggle-payment-padding" style="padding-top: 5px;">
                                            <a href="{{ route('makePaymentComplete', $order->id) }}"
                                                onclick="return confirm('Are you sure you want to change payment status?');">
                                                Toggle Payment
                                            </a>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@foreach ($orders as $order1)
<?php
    $carts = App\Models\Cart::where('cart_code', $order1->cart_code)->get();
    if ($carts) {
        $total_amount = App\Models\Cart::where('cart_code', $order1->cart_code)->sum('total_price');
    }
?>


<!-- Modal for view Order-->
<div class="modal fade manageOrder" id="view-{{ $order1->cart_code }}" tabindex="-1"
    aria-labelledby="#view-{{ $order1->cart_code }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Items - {{ $order1->cart_code }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h3>Product Name:-</h3>
                            <h4>{{ $order1->product_name }}</h4>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h3>Quantity:-</h3>
                            <h4>{{ $order1->quantity }}</h4>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h3>Per Quanitity:-</h3>
                            <h4>{{ $order1->price }}</h4>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h3>Sub Total:-</h3>
                            <h4>{{ $order1->total }}</h4>
                        </div>
                        <div class="col-md-12 mb-2">
                            <h3>Price Type:-</h3>
                            @if ($order1->price2 == "nrml_price")
                            <h4>Normal Price</h4>
                            @else
                            <h4>Urgent Price</h4>
                            @endif
                        </div>
                        <div class="col-md-6 mb-5">
                            <h3>Shipping Charge (All over Nepal):-</h3>
                            <h4>150</h4>
                        </div>
                        <div class="col-md-6 mb-5">
                            <h3>Total:-</h3>
                            <h4>{{ $order1->payment_amount }}</h4>
                        </div>
                        <div class="col-md-12 mb-2">
                            <h3>Design:-</h3>
                            @if ($order1->upload_design)
                            <img src="{{ asset('uploads/uploadADesign/'. $order1->upload_design) }}"
                                alt="Uploaded Design" class="yourOrderImg">
                            <h4>(Customer Own design)</h4>
                            @else
                            <h4>Hired a designer</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection