<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;  // Ensure Category model is imported
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Function to list products and categories
    public function index()
    {
        $products = Product::all();
        $categories = Category::all(); // Fetch all categories
        return view('admin.products.index')->with(['products' => $products, 'categories' => $categories]);
    }

    // Store a new product
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;
        $product->category_id = $request->category_id; // Ensure category_id is set

        // Upload image
        if ($request->hasFile('photo')) {
            $newname = uniqid();
            $image = $request->file('photo');
            $newname .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newname);
            $product->photo = $newname;
        }

        // Save the product
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product added successfully!');
        } else {
            return redirect()->back()->withErrors(['Error adding product']);
        }
    }

    // Destroy a product
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            // Delete product photo
            $file_path = public_path() . '/uploads/' . $product->photo;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            // Delete product from database
            if ($product->delete()) {
                return redirect()->back()->with('success', 'Product deleted successfully!');
            } else {
                return redirect()->back()->withErrors(['Error deleting product']);
            }
        } else {
            return redirect()->back()->withErrors(['Product not found']);
        }
    }

    // Update an existing product
    public function update(Request $request)
    {
        // Find the product by ID
        $product = Product::find($request->idproduct);

        if (!$product) {
            return redirect()->back()->withErrors(['Product not found']);
        }

        // Update product details
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte = $request->qte;
        $product->category_id = $request->category_id; // Ensure category is updated

        // Handle photo upload (optional)
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            $file_path = public_path('uploads/' . $product->photo);
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Upload new photo
            $newname = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $request->file('photo')->move($destinationPath, $newname);
            $product->photo = $newname;
        }

        // Save the updated product
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product updated successfully!');
        } else {
            return redirect()->back()->withErrors(['Error updating product']);
        }
    }
}

