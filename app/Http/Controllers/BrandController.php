<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function search(Request $request)
    {
        $searchTerm = $request->get('name'); // Get the search term from the request

        // Query to filter brands based on the 'name' field
        $query = Brand::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply pagination to the filtered results
        $brands = $query->orderBy('id', 'DESC')->paginate(5);

        // Pass the search term for query persistence in pagination links
        $brands->appends(['name' => $searchTerm]);

        return view('brands.index', compact('brands', 'searchTerm'));
    }



    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(5);
        return view('brands.index', compact('brands'));
    }



    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:brands,name",
        ]);

        $request = Brand::create([
            "name" => $request->name,
        ]);

        session()->flash('success', 'Brand created successfully');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $brands = Brand::findOrFail($id);

        return view('brands.edit', compact('brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|unique:brands,name,$id,id",
        ]);

        $brands = Brand::findOrFail($id);

        $brands->name = $request->name;
        $brands->save();

        session()->flash('success', 'Brand updated successfully');
        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        $brands = Brand::findOrFail($id);

        $brands->delete();

        session()->flash('success', 'Brand deleted successfully');
        return redirect()->route('brands.index');
    }
}
