<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    //
    public function index()
    {
        // Eager load the supplier relationship
        $purchases = Purchase::with('suppliers')->orderBy('id', 'DESC')->paginate(5);
        return view('purchases.index', compact('purchases'));
    }


    public function create(){
        $products = Product::all();
        $specs = ProductSpecification::all();
        $suppliers = Supplier::all();
        return view('purchases.create',compact('suppliers','products','specs'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'suppliers_id' => 'required|exists:suppliers,id',
            'shipping_company' => 'required|string|max:255',
            'shipping_price' => 'required|numeric',
            'shipping_status' => 'required|in:ordered,recieved,waiting',
            'paid_price' => 'required|numeric',
            'notpaid_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'products' => 'required|array', // Validate that we get an array of products
            'products.*.product_id' => 'nullable|exists:products,id', // Validate product IDs if available
            'products.*.product_name' => 'required|string',
            'products.*.product_specifications_id' => 'nullable|exists:product_specifications,id',
            'products.*.specs_value' => 'required|string',
            'products.*.qty' => 'required|integer',
            'products.*.purchase_price' => 'required|numeric',
            'products.*.sale_price' => 'required|numeric',
            'products.*.status' => 'required|in:new,second-hand,99',
        ]);

        DB::beginTransaction(); // Start a transaction

        try {
            // Create a new purchase record
            $purchase = Purchase::create([
                'suppliers_id' => $request->suppliers_id,
                'shipping_company' => $request->shipping_company,
                'shipping_price' => $request->shipping_price,
                'shipping_status' => $request->shipping_status,
                'paid_price' => $request->paid_price,
                'notpaid_price' => $request->notpaid_price,
                'total_price' => $request->total_price,
            ]);

            // Loop through the products and store them in purchase_products
            foreach ($request->products as $productData) {
                PurchaseProduct::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productData['product_id'], // Can be null
                    'product_name' => $productData['product_name'],
                    'product_specifications_id' => $productData['product_specifications_id'], // Can be null
                    'specs_value' => $productData['specs_value'],
                    'qty' => $productData['qty'],
                    'purchase_price' => $productData['purchase_price'],
                    'sale_price' => $productData['sale_price'],
                    'status' => $productData['status'],
                ]);
            }

            DB::commit(); // Commit the transaction

            session()->flash('success' , 'Purchase created successfully');
            return redirect()->route('purchases.index');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback in case of an error
            return response()->json(['error' => 'Failed to store purchase and products.'], 500);
        }
    }

}
