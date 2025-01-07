<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front-office.product.shop',['products'=>Product::latest()->paginate(9)]);
    }
    public function indexCategorie($categorySlug)
    {
        $category = Category::whereSlug($categorySlug)->firstOrFail();
    
        $products = Product::where('category_id', $category->id)
            ->latest()
            ->paginate(9);
        return view('front-office.product.shop',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::whereSlug($slug)->with('images','category')->first();
        $categories = Category::all();
        return view('front-office.product.product-detail',['product'=>$product,'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $query = $request->input('query'); // Retrieve the search term
        
        // Search products by name or description
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(9);

        // Return a view with the search results
        return view('front-office.product.shop', compact('products', 'query'));
    }
}
