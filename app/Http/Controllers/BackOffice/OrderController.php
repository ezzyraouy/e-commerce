<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('back-office.orders.index', ['orders' => Order::whereNotIn('status', ['cancel', 'pending'])->with(['OrderItems.product', 'user'])->OrderBy('created_at','desc')->get()]);
    }
    public function OrderItems(Request $request)
    {
        $orderItems = OrderItems::where('order_id', $request->id)->with(['product'])->get();

        if ($orderItems->isEmpty()) {
            return response()->json(['message' => 'No order items found.'], 404);
        }

        return response()->json($orderItems);
    }
    public function OrderUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json($user);
    }
}
