<?php

namespace App\Http\Controllers\FrontOffice;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\UnitProduct;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        // Get the array of cart items from the request
        $cartItems = $request->input('cartItems');

        // If there are no cart items, return an empty response
        if (!$cartItems) {
            return response()->json([]);
        }

        // Extract product IDs and unit IDs from the cart items
        $productIds = array_map(fn($item) => $item['productId'], $cartItems);
        $unitIds = array_map(fn($item) => $item['unitId'], $cartItems);

        // Retrieve products and their related unitProducts
        $products = Product::with(['unitProducts'])->whereIn('id', $productIds)->get();

        // Retrieve units based on unitIds
        $units = UnitProduct::with(['unit'])->whereIn('id', $unitIds)->get();

        // Return both products and units as a JSON response
        return response()->json([
            'products' => $products,
            'units' => $units
        ]);
    }
}
