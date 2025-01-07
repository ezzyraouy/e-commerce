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
        return view('back-office.products.index',['products'=>Product::with(['images','category','unit'])->OrderBy('created_at','desc')->get()]);
    }

    public function show($id)
    {
        $product = Product::with('images','category' )->findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        return view('back-office.products.edit',['product'=>$product,'categories' => $categories,'units' => $units]);
    }
    public function edit($id)
    {
        $product = Product::with('images','category' )->findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        return view('back-office.products.edit',['product'=>$product,'categories' => $categories,'units' => $units]);
    }
    public function create()
    {
        return view('back-office.products.create',['categories' => Category::all(),'units' => Unit::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $input = $request->all();
        if($request->hasFile('image')){
            $input['image'] = $request->image->store('images/products', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        $product = Product::create($input);
        if ($images = $request->file('images')) {
            foreach ($images as  $item) {
                $path = $item->store('images/products', 'public');
                $product->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return back()->with('success', 'The content has been successfully saved');
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $input = $request->all();
        if($request->hasFile('image')){
            $input['image'] = $request->image->store('images/products', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        $product = Product::findOrFail($id);
        $product->update($input);
        if ($images = $request->file('images')) {
            foreach ($images as  $item) {
                $path = $item->store('images/products', 'public');
                $product->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return back()->with('success', 'The content has been successfully saved');
    }

    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);
        foreach ($product->images as $image) {
            $image->delete();
        }
        $product->delete();
        return back()->with('success' ,'The content deleted successfully');
    }
}
