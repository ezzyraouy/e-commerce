<?php
namespace App\Http\Controllers\BackOffice;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    // Get all categories
    public function index()
    {
        return view('back-office.categories.index',['categories'=>Category::with(['CategoryParent'])->OrderBy('created_at','desc')->get()]);
    }

    // Get a single category
    public function show($id)
    {
        $category = Category::with('category', 'CategoryParent')->findOrFail($id);
         return view('back-office.categories.edit',['categories'=>Category::with(['CategoryParent'])->get(),'category' => $category]);
    }
    public function edit($id)
    {
        $category = Category::with('category', 'CategoryParent')->findOrFail($id);
         return view('back-office.categories.edit',['categories'=>Category::with(['CategoryParent'])->get(),'category' => $category]);
    }

    public function create()
    {
        return view('back-office.categories.create',['categories' => Category::all()]);
    }

    // Create a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $input = $request->all();
        if($request->hasFile('image')){
            $input['image'] = $request->image->store('images/categories', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        Category::create($input);

        return back()->with('success', 'The content has been successfully saved');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $input = $request->all();
        if($request->hasFile('image')){
            $input['image'] = $request->image->store('images/categories', 'public');
        }
        $input['slug'] = Str::slug($input['name']);
        $category->update($input);

        return back()->with('success', 'The content has been successfully saved');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success' ,'The content deleted successfully');
    }
}