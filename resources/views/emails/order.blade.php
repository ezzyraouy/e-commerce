{{--Hello,

You have received a new order with the following details:

<table style="width: 100%; border-collapse: collapse; margin: 20px 0; border: 1px solid #ddd;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f8f9fa;">Field</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f8f9fa;">Details</th>
        </tr>
    </thead>
    <tbody>
        <!-- Order Details -->
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Order ID</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->id }}</td>
</tr>

<!-- Order Products -->
<tr>
    <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Order Products</td>
    <td style="border: 1px solid #ddd; padding: 8px;">
        <ul style="padding-left: 20px; margin: 0;">
            @foreach($order->OrderItems as $item)
            <li><strong>{{ $item->product->name }}</strong>
            <li><strong>{{ $item->UnitProduct->unit->name }}</strong> (Quantity: {{ $item->quantity }})</li>
            @endforeach
        </ul>
    </td>
</tr>

<!-- Customer Details -->
<tr>
    <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Customer Name</td>
    <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->user->name }}</td>
</tr>
<tr>
    <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Phone</td>
    <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->user->phone }}</td>
</tr>
<tr>
    <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Email</td>
    <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->user->email }}</td>
</tr>
</tbody>
</table>

--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>

<body>
    <p>Hello,</p>
    <p>You have received a new order with the following details:</p>
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; border: 1px solid #ddd; direction: ltr; text-align: center; font-family: Arial, sans-serif; font-size: 14px;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product Name</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Unit</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Discount</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tax</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Subtotal</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            @endphp
            @foreach($order->OrderItems as $item)
            @php
            $price = $item->product->price;
            $discount = $item->discount ?? 0;
            $tax = $item->tax ?? 0;
            $subtotal = ($price - $discount) * $item->quantity;
            $total += $subtotal + $tax;
            @endphp
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->id }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->product->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->UnitProduct->unit->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->quantity }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($price, 2) }} USD</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($discount, 2) }} USD</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($tax, 2) }} USD</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($subtotal, 2) }} USD</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($subtotal + $tax, 2) }} USD</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold;">
                <td colspan="8" style="border: 1px solid #ddd; padding: 8px; text-align: right;">Grand Total:</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($total, 2) }} USD</td>
            </tr>
        </tbody>
    </table>
    <p>Thank you,</p>
    <p>Your Store Team</p>
</body>

</html>