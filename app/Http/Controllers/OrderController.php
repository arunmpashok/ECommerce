<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('product')->orderByDesc('created_at')->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required',
            'phone'            => 'required',
            'quantity'         => 'required',
            'product_id'       => 'required',
        ]);
        $Order                  = new Order();
        $Order->customer_name   = $request->customer_name;
        $Order->phone           = $request->phone;
        $Order->product_id      = $request->product_id;
        $Order->quantity        = $request->quantity;
        $Order->order_id        = rand ( 10000 , 99999 );
        $Order->save();
        return redirect()->route('order.index')
        ->with('success','Order has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order    = Order::with('product')->find($id);
        return view('order.invoice', compact('order'));
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order    = Order::find($id);
        $products  = Product::orderByDesc('created_at')->get();

        return view('order.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone'         => 'required',
            'product_id'    => 'required',
            'quantity'      => 'required',
        ]);
        
        $Order                  = Order::find($id);
        $Order->customer_name   = $request->customer_name;
        $Order->phone           = $request->phone;
        $Order->product_id      = $request->product_id;
        $Order->quantity        = $request->quantity;
        $Order->save();
    
        return redirect()->route('order.index')
                        ->with('success','Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully');
    }
}
