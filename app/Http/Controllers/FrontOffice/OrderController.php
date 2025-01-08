<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'CartItem' => 'required|array',
            'CartItem.*.product_id' => 'required|integer|exists:products,id',
            'CartItem.*.quantity' => 'required|integer|min:1',
        ]);
        $input = $request->all();
        $order = Order::create($input);
        foreach ($request->CartItem as $item) {
            $order->OrderItems()->create([
                'user_id' => $input['user_id'],
                'unit_product_id' => $item['unit_product_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                // 'size' => $item['size'],
            ]);
        }
        session()->put('success', 'Your order has been successfully created!');
        try {
            $order = Order::with(['user', 'OrderItems.product','OrderItems.UnitProduct.unit'])->findOrFail($order->id);
        
            Mail::to(env('ADMIN_EMAIL'))->send(new OrderMail($order));
            // Mail::to('a.ezzyraouy@directinvest.ma')->send(new OrderMail($order));
            return response()->json(['success' => true, 'order' => $order], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Order saved, but email failed to send.',
                'error' => $e->getMessage()
            ], 500);
        }
        
       
    }
}
