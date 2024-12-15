<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function search(Request $request)
    {
        $searchTerm = $request->get('name'); // Get the search term from the request

        // Query to filter categories based on the 'name' field
        $query = Supplier::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply pagination to the filtered results
        $suppliers = $query->orderBy('id', 'DESC')->paginate(5);

        // Pass the search term for query persistence in pagination links
        $suppliers->appends(['name' => $searchTerm]);

        return view('suppliers.index', compact('suppliers', 'searchTerm'));
    }

    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'DESC')->paginate(5);

        return view('suppliers.index', compact( 'suppliers'));
    }

    public function create(){
        return view('suppliers.create');
    }

    public function store(Request $request){
        $request -> validate([
            "name" => "required|unique:suppliers,name",
            "email" => "required|unique:suppliers,email",
            "address" => "required",
            "phonenumber" => "required|string|max:10|min:9",
        ]);

        Supplier::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "address"=>$request->address,
            "phonenumber"=>$request->phonenumber,
        ]);

        session()->flash('success' , 'Supplier created successfully');
        return redirect()->route('suppliers.index');
    }

    public function edit($id){
        $suppliers = Supplier::findOrFail($id);

        return view('suppliers.edit',compact('suppliers'));
    }

    public function update(Request $request,$id){
        $request -> validate([
            "name" => "required|unique:suppliers,name,$id,id",
            "email" => "required|unique:suppliers,email,$id,id",
            "address" => "required",
            "phonenumber" => "required|string|max:10|min:9",
        ]);

        $suppliers = Supplier::findOrFail($id);

        $suppliers->name = $request->name;
        $suppliers->email = $request->email;
        $suppliers->address = $request->address;
        $suppliers->phonenumber = $request->phonenumber;
        $suppliers->save();

        session()->flash('success' , 'Supplier updated successfully');
        return redirect()->route('suppliers.index');
    }

    public function destroy($id){
        $suppliers = Supplier::findOrFail($id);

        $suppliers->delete();
        session()->flash('success' , 'Supplier deleted successfully');
        return redirect()->route('suppliers.index');
    }
}
