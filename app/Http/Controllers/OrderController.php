<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(30);
    
        return view('orders.index', compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $product
     * @return \Illuminate\Http\Order
     */
    public function destroy(Order $order)
    {
        $order->delete();
    
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
