<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function search(Request $request)
    {
        $searchTerm = $request->get('name'); // Get the search term from the request

        // Query to filter categories based on the 'name' field
        $query = Product::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply pagination to the filtered results
        $products = $query->orderBy('id', 'DESC')->paginate(5);

        // Pass the search term for query persistence in pagination links
        $products->appends(['name' => $searchTerm]);

        return view('products.index', compact('products', 'searchTerm'));
    }



    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications.*.product_code' => 'required|string|max:255|unique:product_specifications,product_code',
            'specifications.*.specs_value' => 'required|string|max:255',
            'specifications.*.status' => 'required|string|in:new,second-hand,99',
            'specifications.*.purchase_price' => 'required|numeric|min:0',
            'specifications.*.sale_price' => 'required|numeric|min:0',
            'specifications.*.qty' => 'required|integer|min:0',
        ]);

        try {
            // Save basic product data
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'image' => $this->handleImageUpload($request), // Handle the image upload
            ]);

            // Check if specifications are provided
            if ($request->has('specifications') && is_array($request->specifications)) {
                foreach ($request->specifications as $spec) {
                    // Create each specification for the product
                    $product->specifications()->create([
                        'product_code' => $spec['product_code'],
                        'specs_value' => $spec['specs_value'],
                        'status' => $spec['status'],
                        'purchase_price' => $spec['purchase_price'],
                        'sale_price' => $spec['sale_price'],
                        'qty' => $spec['qty'],
                    ]);
                }
            }

            session()->flash('success', 'Product created successfully');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving product: ' . $e->getMessage());
        }
    }


    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Store the image in the 'public/assets/img' directory
            $imagePath = $image->store('assets/img', 'public');
            return $imagePath;
        }

        return null; // Return null if no image is uploaded
    }

    public function edit($id){
        $products = Product::with('specifications')->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.edit' , compact('products','categories','brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'specifications' => 'array',
            'specifications.*.product_code' => 'required|string',
            'specifications.*.specs_value' => 'required|string',
            'specifications.*.qty' => 'required|integer',
            'specifications.*.purchase_price' => 'required|numeric',
            'specifications.*.sale_price' => 'required|numeric',
            'specifications.*.status' => 'required|string|in:new,second-hand,99',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'brand_id', 'category_id'));

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $filePath]);
        }

        $product->specifications()->delete(); // Delete old specifications

        foreach ($request->specifications as $spec) {
            $product->specifications()->create($spec);
        }

        session()->flash('success', 'Product updated successfully');
        return redirect()->route('products.index');
    }
}
