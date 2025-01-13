<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 20px auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 20px;
            margin: 5px 0;
        }

        .header p {
            margin: 2px;
            font-size: 14px;
        }

        .details {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            padding: 5px;
        }

        .qr {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
        }

        .totals {
            text-align: left;
            font-weight: bold;
            margin-top: 20px;
            font-size: 14px;
        }

        .totals p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Jabal Tareeq Company</h1>
            <h2>Tax Invoice</h2>
            <p>Tax No. (TIN): 31172212500003</p>
            <p>Order ID: {{ $order->id }}</p>
            <p><img src="{{asset('assets/images/QR-Facture.png')}}" alt="QR Code"></p>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td>Date: {{ $order->created_at }}</td>
                    <td colspan="2">Invoice Type: Credit</td>
                </tr>
                <tr>
                    <td>Currency: SAR</td>
                    <td colspan="2">Invoice Center: Main Center - Jabal Tareeq Ltd.</td>
                </tr>
                <tr>
                    <td colspan="3">Customer Name: {{ $order->user->name }} - Phone Number: {{ $order->user->phone }}</td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du produit</th>
                    <th>Unité</th>
                    <th>Quantité</th>
                    <th>Prix (SAR)</th>
                    <th>Remise (SAR)</th>
                    <th>Taxe (15%)</th>
                    <th>Total (SAR)</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalBeforeDiscount = 0;
                $totalDiscount = 0;
                $totalTax = 0;
                $grandTotal = 0;
                @endphp
                @foreach($order->OrderItems as $index => $item)
                @php
                $price = $item->UnitProduct->price;
                $discount = $item->discount ?? 0;
                $subtotal = ($price - $discount) * $item->quantity;
                $tax = $subtotal * 0.15;
                $total = $subtotal + $tax;

                $totalBeforeDiscount += $price * $item->quantity;
                $totalDiscount += $discount * $item->quantity;
                $totalTax += $tax;
                $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->UnitProduct->unit->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($price, 2) }}</td>
                    <td>{{ number_format($discount, 2) }}</td>
                    <td>{{ number_format($tax, 2) }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <p>Total Before Discount: {{ number_format($totalBeforeDiscount, 2) }} SAR</p>
            <p>Total Discount: {{ number_format($totalDiscount, 2) }} SAR</p>
            <p>Total (Excluding VAT): {{ number_format($totalBeforeDiscount - $totalDiscount, 2) }} SAR</p>
            <p>VAT (15%): {{ number_format($totalTax, 2) }} SAR</p>
            <p>Total (Including VAT): {{ number_format($grandTotal, 2) }} SAR</p>
        </div>

        <div class="footer">
            <p>Merci pour votre confiance !</p>
        </div>
    </div>
</body>

</html>
