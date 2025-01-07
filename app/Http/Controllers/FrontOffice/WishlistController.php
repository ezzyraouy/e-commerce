<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
class WishlistController extends Controller
{
    public function getWishlist(Request $request)
    {
        $wishlistItems = $request->input('wishlistItems'); // Get the array of cart items
        $products = Product::whereIn('id', $wishlistItems)->get(); // Retrieve products
        return response()->json($products); // Return products as JSON
    }
    // Add item to wishlist (session-based)
    // public function toggleWishlist($id)
    // {
    //     $wishlist = session()->get('wishlist', []);

    //     // Check if the product is already in the wishlist
    //     if (isset($wishlist[$id])) {
    //         // Remove the product from the wishlist
    //         unset($wishlist[$id]);
    //         session()->put('wishlist', $wishlist);

    //         return response()->json(['action' => 'removed']);
    //     } else {
    //         // Add the product to the wishlist
    //         $product = Product::find($id);
    //         if (!$product) {
    //             return response()->json(['error' => 'Product not found'], 404);
    //         }

    //         $wishlist[$id] = $product;
    //         session()->put('wishlist', $wishlist);

    //         return response()->json(['action' => 'added']);
    //     }
    // }

    // public function addToWishlist($id)
    // {
    //     $product = Product::find($id);
    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }

    //     // Add to session or user's wishlist
    //     $wishlist = session()->get('wishlist', []);
    //     $wishlist[$id] = $product;
    //     session()->put('wishlist', $wishlist);

    //     return response()->json(['message' => 'Product added to wishlist']);
    // }


    // // Display the wishlist
    // public function viewWishlist()
    // {
    //     $wishlist = session()->get('wishlist', []);
    //     return view('wishlist.index', compact('wishlist'));
    // }

    // // Remove item from wishlist
    // public function removeFromWishlist($productId)
    // {
    //     $wishlist = session()->get('wishlist');

    //     if (isset($wishlist[$productId])) {
    //         unset($wishlist[$productId]);
    //         session()->put('wishlist', $wishlist);
    //     }

    //     return redirect()->back()->with('success', 'Product removed from wishlist');
    // }
}

