<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderByDesc('created_at')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = ProductCategory::orderByDesc('created_at')->get();
        return view('product.create', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price'         => 'required',
            'category_id'   => 'required',
        ]);
        $path                   = $request->file('image')->store('public/images');
        $Product                = new Product();
        $Product->name          = $request->name;
        $Product->category_id   = $request->category_id;
        $Product->price         = $request->price;
        $Product->image         = $path;
        $Product->save();
     
        return redirect()->route('product.index')
                        ->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categorys = ProductCategory::orderByDesc('created_at')->get();

        return view('product.edit', compact('product', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
        
        $Product = Product::find($id);
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $Product->image = $path;
        }
        $Product->name = $request->name;
        $Product->category_id = $request->category_id;
        $Product->price = $request->price;
        $Product->save();
    
        return redirect()->route('product.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Product = Product::find($id);
        $Product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
