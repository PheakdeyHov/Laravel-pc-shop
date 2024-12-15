<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function search(Request $request)
    {
        $searchTerm = $request->get('name'); // Get the search term from the request

        // Query to filter categories based on the 'name' field
        $query = Category::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply pagination to the filtered results
        $categories = $query->orderBy('id', 'DESC')->paginate(5);

        // Pass the search term for query persistence in pagination links
        $categories->appends(['name' => $searchTerm]);

        return view('categories.index', compact('categories', 'searchTerm'));
    }



    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(5);
        return view('categories.index', compact('categories'));
    }



    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:categories,name",
        ]);

        $request = Category::create([
            "name" => $request->name,
        ]);

        session()->flash('success', 'Category created successfully');
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);

        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|unique:categories,name,$id,id",
        ]);

        $categories = Category::findOrFail($id);

        $categories->name = $request->name;
        $categories->save();

        session()->flash('success', 'Category updated successfully');
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);

        $categories->delete();

        session()->flash('success', 'Category deleted successfully');
        return redirect()->route('categories.index');
    }
}
