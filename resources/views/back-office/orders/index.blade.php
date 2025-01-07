@extends('back-office.layouts.master')
<!-- main-content-wrap -->
@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>All Orders</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="#">
                        <div class="text-tiny">Product</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Orders</div>
                </li>
            </ul>
        </div>
        <!-- product-list -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="wg-box">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            @foreach($order->orderItems as $item)
                            <span class="order-item" data-id="{{ $item->order_id }}">
                                {{ $item->product->name }} * {{ $item->quantity }}
                            </span><br>
                            @endforeach
                        </td>
                        <td><span class="user" data-id="{{ $order->user->id }}">{{ $order->user->name }}</span></td>
                        <td>{{ $order->total_amount }} USD</td>
                        <td><span class="{{ $order->status }}">{{ $order->status }}</span></td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
       
        
<!-- /product-list -->
</div>
<!-- /main-content-wrap -->
</div>
<div class="modal modalCentered fade form-sign-in modal-part-content" id="order-item">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div id="alert-placeholder"></div>
                <div class="demo-title">Order Items</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-order-form">
                <!-- Order details will be inserted here dynamically -->
                <div id="order-details" class="order-details"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal modalCentered fade form-sign-in modal-part-content" id="user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div id="alert-placeholder"></div>
                <div class="demo-title">User Items</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-user-form">
                <!-- User details will be inserted here dynamically -->
                <div id="user-details" class="user-details"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-part-content {
        border-radius: 8px;
    }

    .modal-content {
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .demo-title {
        font-size: 24px;
        font-weight: bold;
    }

    .icon-close {
        cursor: pointer;
        font-size: 20px;
    }

    .order-details,
    .user-details {
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .order-details p,
    .user-details p {
        font-size: 16px;
        margin: 10px 0;
    }

    .order-details p span,
    .user-details p span {
        font-weight: bold;
    }

    .order-item-table,
    .user-item-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .order-item-table th,
    .order-item-table td,
    .user-item-table th,
    .user-item-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .order-item-table th,
    .user-item-table th {
        background-color: #f2f2f2;
    }

    .alert {
        margin-bottom: 20px;
    }

    .custom-size-details {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }

    .custom-size-details h3 {
        text-align: center;
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
    }

    .custom-size-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #ddd;
    }

    .custom-size-item:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: bold;
        color: #555;
    }

    .value {
        font-size: 16px;
        color: #333;
    }

    .custom-size-item span {
        display: inline-block;
    }

    .custom-size-item .value {
        text-align: right;
        color: #007bff;
        /* Optional: add a color for the values */
    }
</style>

@endsection
@section('scripts')
<script>
    $(document).on('click', '.order-item', function() {
        const orderId = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route("orders.OrderItems") }}',
            data: {
                id: orderId
            },
            success: function(response) {
                const order = response[0]; // Assuming response is an array and the first element is the order item

                // Create order details HTML
                let orderDetailsHtml = `
                    <div>
                        <p><span>Order ID:</span> ${order.id}</p>
                        <p><span>Product ID:</span> ${order.product_id}</p>
                        <p><span>Quantity:</span> ${order.quantity}</p>
                        <p><span>Date:</span> ${new Date(order.created_at).toLocaleString()}</p>
                    </div>
                    <table class="order-item-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${order.product.name}</td> <!-- Update this dynamically based on product details -->
                                <td>${order.quantity}</td>
                            </tr>
                        </tbody>
                    </table>
                `;

                // Inject the order details HTML into the modal
                $('#order-details').html(orderDetailsHtml);

                // Show the modal
                $('#order-item').modal('show');
            },
            error: function(xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    errorMessages += '<ul>';
                    $.each(errors, function(key, value) {
                        errorMessages += '<li>' + value[0] + '</li>';
                    });
                    errorMessages += '</ul>';
                    errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    errorMessages += '</div>';

                    $('#alert-placeholder').html(errorMessages);
                } else {
                    let genericError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    genericError += 'An error occurred, please try again.';
                    genericError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    genericError += '</div>';

                    $('#alert-placeholder').html(genericError);
                }
            }
        });
    });

    $(document).on('click', '.user', function() {
        const userId = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route("orders.user") }}',
            data: {
                id: userId
            },
            success: function(response) {
                const user = response; // Assuming response is an array and the first element is the user item

                // Create user details HTML
                let userDetailsHtml = `
                <div>
                    <p><span>User ID:</span> ${user.id}</p>
                    <p><span>Name:</span> ${user.name}</p>
                    <p><span>Email:</span> ${user.email}</p>
                    <p><span>Phone:</span> ${user.phone}</p>
                    <p><span>Address:</span> ${user.address}</p>
                </div>
                <table class="user-item-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${user.name}</td>
                        </tr>
                    </tbody>
                </table>
            `;

                // Inject the user details HTML into the modal
                $('#user-details').html(userDetailsHtml);

                // Show the modal
                $('#user').modal('show');
            },
            error: function(xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessages = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    errorMessages += '<ul>';
                    $.each(errors, function(key, value) {
                        errorMessages += '<li>' + value[0] + '</li>';
                    });
                    errorMessages += '</ul>';
                    errorMessages += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    errorMessages += '</div>';

                    $('#alert-placeholder').html(errorMessages);
                } else {
                    let genericError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    genericError += 'An error occurred, please try again.';
                    genericError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    genericError += '</div>';

                    $('#alert-placeholder').html(genericError);
                }
            }
        });
    });
</script>

@endsection
<!-- /main-content-wrap -->