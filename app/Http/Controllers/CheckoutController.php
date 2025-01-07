<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your orders.');
        }
        $orders = Order::where('user_id', $user->id)
            ->where('status', 'InProgress')
            ->with(['orderItems','orderItems.product'])
            ->latest() 
            ->first();
            // dd($orders);
        return view('front-office.checkout', compact('orders'));
    }
}
