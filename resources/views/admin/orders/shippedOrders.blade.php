<table class="table">
    <thead>
        <tr>
            <th>S.N</th>
            <th>User Id</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Order Status</th>
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
            <td>
                <h5 class="greenyellow">Shipped</h5>    
            </td>
            <td>{{ $order->cart_code }}</td>
            <td>{{ Str::limit($order->address ?? 'No Address', 10) }}..</td>
            <td>
                @if ($order->payment_method == 'cod')
                @if ($order->payment_status == 'Y')
                <h5 class="green">Cash on Delivery</h5>
                @else
                <h5 class="red">Cash on Delivery</h5>
                @endif
                @else
                <h5 class="green">Online Payment</h5>
                @endif
            </td>
            <td style="width: 121px;">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#view-{{ $order->cart_code }}">View</button>
                @if ($order->payment_method == 'cod')
                <br>
                <div class="toggle-payment-padding" style="padding-top: 5px;">
                    <a href="{{ route('makePaymentComplete', $order->id) }}" onclick="return confirm('Are you sure you want to change payment status?');">
                        Toggle Payment
                    </a>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
