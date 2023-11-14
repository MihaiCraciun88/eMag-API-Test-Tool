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
        $orders = Order::query()->orderBy('id', 'DESC')->paginate(30);
    
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
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
