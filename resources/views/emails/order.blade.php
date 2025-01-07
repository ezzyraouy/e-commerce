
Hello,

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
                        <li><strong>{{ $item->product->name }}</strong> (Quantity: {{ $item->quantity }})</li>
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

