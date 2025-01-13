<?php

namespace App\Http\Controllers;

use App\Models\c;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('guest.home')->with('products', $products)->with('categories', $categories);
    }
public function productDetails($id){
    $product = Product::find($id);
    $products = Product::where('id', '!=', $id)->get();
    $categories = Category::all();
    return view('guest.product-details')->with('categories', $categories)->with('product', $product)->with('products', $products);
}

public function shop($idcategory){
    $category=category::find($idcategory);
    $products = $category->products;
    $categories = Category::all();
    return view('guest.shop')->with('categories', $categories)->with('products', $products);

}

public function search(request $request){
    
    $products = Product::where('name', 'LIKE', '%'. $request->keywords.'%')->get();
    $categories = Category::all();
    return view('guest.shop')->with('categories', $categories)->with('products', $products);


    

}
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}
