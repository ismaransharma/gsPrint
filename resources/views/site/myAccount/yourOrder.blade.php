@extends('site.myAccount.myAccTemplate')
@section('content')

<?php
// dd($orders);
?>
@if ($orders->isEmpty())
<section id="yourOrder">
    <div class="container">
        <h2>You Haven't Purchased Anything.</h2>
    </div>
</section>
@else

<section id="orderSection">
    <div class="container">
        <h2>Your Orders</h2>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->payment_amount }}</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#view-{{ $order->cart_code }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


@foreach ($orders as $order1)
<?php
    $carts = App\Models\Cart::where('cart_code', $order1->cart_code)->get();
    if ($carts) {
        $total_amount = App\Models\Cart::where('cart_code', $order1->cart_code)->sum('total_price');
    }

    // dd($order1->product_name);
?>



<!-- Order Modal -->
<div class="modal fade yourOrder" id="view-{{ $order1->cart_code }}"" tabindex=" -1"
    aria-labelledby="#view-{{ $order1->cart_code }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="checkOrderModalLabel"><b>Order - (Cart Code -
                        {{ $order1->cart_code }})</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                        <img src="{{ asset('uploads/uploadADesign/'. $order1->upload_design) }}" alt="Uploaded Design"
                            class="yourOrderImg">
                        <h4>(Your Own design)</h4>
                        @else
                        <h4>Hired a designer</h4>
                        @endif
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endforeach


@endif



@endsection