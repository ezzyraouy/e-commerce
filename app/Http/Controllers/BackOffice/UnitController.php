<?php
namespace App\Http\Controllers\BackOffice;

use App\Models\unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class UnitController extends Controller
{
    // Get all units
    public function index()
    {
        return view('back-office.units.index',['units'=>Unit::OrderBy('created_at','desc')->get()]);
    }

    // Get a single unit
    public function show($id)
    {
        $unit = Unit::findOrFail($id);
         return view('back-office.units.edit',['units'=>Unit::get(),'unit' => $unit]);
    }
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
         return view('back-office.units.edit',['units'=>Unit::get(),'unit' => $unit]);
    }

    public function create()
    {
        return view('back-office.units.create',['units' => Unit::all()]);
    }

    // Create a new unit
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = $request->all();
     
        Unit::create($input);

        return back()->with('success', 'The content has been successfully saved');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $input = $request->all();
        
        $unit->update($input);

        return back()->with('success', 'The content has been successfully saved');
    }

    // Delete a unit
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return back()->with('success' ,'The content deleted successfully');
    }
}