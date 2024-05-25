@extends('admin.dashboard')
@section('adminTemplate')


<?php
use Carbon\Carbon;
?>

<section id="manageCategory">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>All Orders -- {{ $orders->count() }}</h4>
                            </div>
                            <div class="col-md-6 d-flex">
                                <h4 class="mx-4">Order Status</h4>
                                <select name="" id="orderSelect" class="fs-4 outline-none" onchange="handleOrderChange()">
                                    <option value="allOrders" class="allOrders">All</option>
                                    <option value="pendingOrders" class="pendingOrders">Pending</option>
                                    <option value="shippedOrders" class="shippedOrders">Shipped</option>
                                    <option value="deliveredOrders" class="deliveredOrders">Delivered</option>
                                    <option value="cancelOrders" class="cancelOrders">Cancel</option>
                                    <option value="refundOrders" class="refundOrders">Refund</option>
                                </select>
                            </div>
                            <div class="col-md-3 text-end">
                                <form action="/admin/orders/searchOrder">
                                    <input type="search" placeholder="Search Order" name="searchOrder" id="searchOrder"
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
                        <div id="allOrdersSection" class="order-section">
                            @include('admin.orders.allOrders', ['orders' => $allOrders])
                        </div>
                        <div id="shippedOrdersSection" class="order-section">
                            @include('admin.orders.shippedOrders', ['orders' => $shippedOrders])
                        </div>
                        <div id="deliveredOrdersSection" class="order-section" style="display: none;">
                            @include('admin.orders.deliveredOrders', ['orders' => $deliveredOrders])
                        </div>
                        <div id="pendingOrdersSection" class="order-section" style="display: none;">
                            @include('admin.orders.pendingOrders', ['orders' => $pendingOrders])
                        </div>
                        <div id="cancelOrdersSection" class="order-section" style="display: none;">
                            @include('admin.orders.cancelOrders', ['orders' => $cancelledOrders])
                        </div>
                        <div id="refundOrdersSection" class="order-section" style="display: none;">
                            @include('admin.orders.refundOrders', ['orders' => $refundedOrders])
                        </div>
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
    $orderTime = $order1->created_at;
    $carbonTimestamp = Carbon::parse($orderTime)->setTimezone('Asia/Kathmandu');
    $formattedDate = $carbonTimestamp->format('d-F'); 
    $formattedTime = $carbonTimestamp->format('g:i A'); 

    $humanReadableTime = $carbonTimestamp->diffForHumans();

    $actualOrderTime = $formattedDate . ' at ' . $formattedTime . ' (' . $humanReadableTime . ')';


    // dd($order1->additional_information)
?>

<!-- Modal for view Order-->
<div class="modal fade manageOrder" id="view-{{ $order1->cart_code }}" tabindex="-1"
    aria-labelledby="#view-{{ $order1->cart_code }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('updateOrder', $order1->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">View Items - {{ $order1->cart_code }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h3>Product Name:</h3>
                                <h4>{{ $order1->product_name }}</h4>
                            </div>
                            <div class="col-md-4 mb-2">
                                <h3>Quantity:</h3>
                                <h4>{{ $order1->quantity }}</h4>
                            </div>
                            <div class="col-md-4 mb-2">
                                <h3>Per Quantity:</h3>
                                <h4>{{ $order1->price }}</h4>
                            </div>
                            <div class="col-md-4 mb-2">
                                <h3>Sub Total:</h3>
                                <h4>{{ $order1->total }}</h4>
                            </div>
                            <div class="col-md-12 mb-2">
                                <h3>Price Type:</h3>
                                @if ($order1->price2 == "nrml_price")
                                    <h4>Normal Price</h4>
                                @else
                                    <h4>Urgent Price</h4>
                                @endif
                            </div>
                            <div class="col-md-6 mb-5">
                                <h3>Shipping Charge (All over Nepal):</h3>
                                <h4>150</h4>
                            </div>
                            <div class="col-md-6 mb-5">
                                <h3>Total:</h3>
                                <h4>{{ $order1->payment_amount }}</h4>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h3>Order Status:</h3>
                                <select name="order_status" id="orderSelect" class="form-select fs-4">
                                    <option value="Pending" {{ $order1->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped" {{ $order1->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order1->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order1->order_status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                                    <option value="Refunded" {{ $order1->order_status == 'Refunded' ? 'selected' : '' }}>Refund</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <h3>Design:</h3>
                                @if ($order1->upload_design)
                                    <img src="{{ asset('uploads/uploadADesign/'. $order1->upload_design) }}" alt="Uploaded Design" class="yourOrderImg">
                                    <h4>(Customer Own design)</h4>
                                @else
                                    <h4>Hired a designer</h4>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h3>Created At:</h3>
                                <h4>{{ $actualOrderTime }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary fs-4">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endforeach

@endsection