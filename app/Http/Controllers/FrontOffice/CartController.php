<?php

namespace App\Http\Controllers\FrontOffice;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $cartItems = $request->input('cartItems'); // Get the array of cart items
        $products = Product::whereIn('id', $cartItems)->get(); // Retrieve products
        return response()->json($products); // Return products as JSON
    }

}
