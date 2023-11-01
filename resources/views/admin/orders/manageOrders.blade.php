@extends('admin.dashboard')
@section('adminTemplate')

<?php
// dd($orders);
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
                                        <h5>Cash on Delivery</h5>
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

    // dd($order1->additional_information)
?>

<!-- Modal for view Order-->
<div class="modal fade" id="view-{{ $order1->cart_code }}" tabindex="-1"
    aria-labelledby="#view-{{ $order1->cart_code }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Items - {{ $order1->cart_code }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table">
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/product/' . $cart->getProductFromCart->product_image) }}"
                                        alt="{{ $cart->getProductFromCart->product_title }}" class="img-fluid"
                                        style="height: 100px; width: 100px;">
                                </td>
                                <td>
                                    <p>{{ $cart->getProductFromCart->product_title }} <br>
                                        {{ $cart->getProductFromCart->category->category_title }} <br>
                                        Rs.
                                        {{ $cart->getProductFromCart->orginal_cost - $cart->getProductFromCart->discounted_cost }}
                                    </p>
                                    <div class="additional_information">
                                        @if ($order1->additional_information)
                                        <b>Additional Information:- {{ $order1->additional_information }}</b>

                                        @else
                                        <b>Additional Information: Null</b>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row top-bottom-border p-2">
                        <div class="col-md-6">Quantity:</div>
                        <div class="col-md-6 text-right cost">{{ $cart->quantity }}
                        </div>
                    </div>
                    <div class="row top-bottom-border p-2">
                        <div class="col-md-6">Sub Total:</div>
                        <div class="col-md-6 text-right cost">{{ $total_amount }}
                        </div>
                    </div>
                    <div class="row top-bottom-border p-2">
                        <div class="col-md-6">Shipping Charge:</div>
                        <div class="col-md-6 text-right cost">
                            Rs. 100 | All Over Nepal
                            <!-- {{ $order1->address }} -->
                        </div>
                    </div>
                    <div class="row top-bottom-border p-2">
                        <div class="col-md-6">Grand Total:</div>
                        <div class="col-md-6 text-right cost">Rs. {{ $total_amount + 100}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection