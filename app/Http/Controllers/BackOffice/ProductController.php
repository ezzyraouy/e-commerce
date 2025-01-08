<?php

namespace App\Http\Controllers\BackOffice;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('back-office.products.index', ['products' => Product::with(['images', 'category', 'unit'])->OrderBy('created_at', 'desc')->get()]);
    }

    public function show($id)
    {
        $product = Product::with('images', 'category')->findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        return view('back-office.products.edit', ['product' => $product, 'categories' => $categories, 'units' => $units]);
    }
    public function edit($id)
    {
        $product = Product::with('images', 'category')->findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        return view('back-office.products.edit', ['product' => $product, 'categories' => $categories, 'units' => $units]);
    }
    public function create()
    {
        return view('back-office.products.create', ['categories' => Category::all(), 'units' => Unit::all()]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);
    //     $input = $request->all();
    //     if($request->hasFile('image')){
    //         $input['image'] = $request->image->store('images/products', 'public');
    //     }
    //     $input['slug'] = Str::slug($input['name']);
    //     $product = Product::create($input);
    //     if ($images = $request->file('images')) {
    //         foreach ($images as  $item) {
    //             $path = $item->store('images/products', 'public');
    //             $product->images()->create([
    //                 'path' => $path,
    //             ]);
    //         }
    //     }
    //     return back()->with('success', 'The content has been successfully saved');

    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'units' => 'required|array', // Validate units array
            'units.*.unit_id' => 'required|exists:units,id', // Each unit ID must exist in the units table
            'units.*.quantity' => 'required|integer|min:1',
            'units.*.price' => 'required|numeric|min:0',
        ]);

        $input = $request->all();

        // Save the main product
        if ($request->hasFile('image')) {
            $input['image'] = $request->image->store('images/products', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        $product = Product::create($input);

        // Save related units (UnitProduct)
        foreach ($request->input('units') as $unit) {
            $product->unitProducts()->create($unit);
        }

        // Save additional images
        if ($images = $request->file('images')) {
            foreach ($images as $item) {
                $path = $item->store('images/products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return back()->with('success', 'The product and its units have been successfully saved.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'units' => 'required|array', // Validate units array
            'units.*.unit_id' => 'required|exists:units,id', // Each unit ID must exist in the units table
            'units.*.quantity' => 'required|integer|min:1',
            'units.*.price' => 'required|numeric|min:0',
        ]);

        $input = $request->all();

        // Find the product
        $product = Product::findOrFail($id);

        // Update the main product
        if ($request->hasFile('image')) {
            $input['image'] = $request->image->store('images/products', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        $product->update($input);

        // Get current unit product IDs for this product
        $existingUnitProducts = $product->unitProducts()->pluck('id')->toArray();

        // IDs of the submitted units
        $submittedUnitProductIds = array_column($request->input('units'), 'id');

        // Delete units not in the request
        $unitsToDelete = array_diff($existingUnitProducts, $submittedUnitProductIds);
        $product->unitProducts()->whereIn('id', $unitsToDelete)->delete();

        // Process submitted units
        foreach ($request->input('units') as $unit) {
            if (isset($unit['id']) && in_array($unit['id'], $existingUnitProducts)) {
                // Update existing unit product
                $product->unitProducts()->find($unit['id'])->update($unit);
            } else {
                // Add new unit product
                $product->unitProducts()->create($unit);
            }
        }

        // Save additional images
        if ($images = $request->file('images')) {
            foreach ($images as $item) {
                $path = $item->store('images/products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return back()->with('success', 'The content has been successfully updated.');
    }



    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);
        foreach ($product->images as $image) {
            $image->delete();
        }
        $product->delete();
        return back()->with('success', 'The content deleted successfully');
    }
}
