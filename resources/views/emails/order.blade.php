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

    <!-- HTML Table for Order Details -->
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
            $price = $item->UnitProduct->price;
            $discount = $item->discount ?? 0;
            $tax =  (($price - $discount) * $item->quantity) * 0.15;
            $subtotal = ($price - $discount) * $item->quantity;
            $total += $subtotal + $tax;
            @endphp
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $order->id }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->product->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->UnitProduct->unit->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->quantity }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($price, 2) }} SAR</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($discount, 2) }} SAR</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($tax, 2) }} SAR</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($subtotal, 2) }} SAR</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($subtotal + $tax, 2) }} SAR</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold;">
                <td colspan="8" style="border: 1px solid #ddd; padding: 8px; text-align: right;">Grand Total:</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($total, 2) }} SAR</td>
            </tr>
        </tbody>
    </table>

    <p>Thank you,</p>
    <p>Your Store Team</p>

    <!-- Optional: Add instructions for the CSV file attachment -->
    <p>Additionally, you can download the order details as an Excel-compatible CSV file attached to this email.</p>
</body>

</html>
