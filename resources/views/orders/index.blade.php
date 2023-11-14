@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h1 class="h2 mb-3">Orders</h1>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Vendor name</th>
            <th>Customer</th>
            <th>Total</th>
            <th width="150px">Action</th>
        </tr>
        @foreach ($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->vendor_name }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->total() }}</td>
            <td>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('orders.edit', $order->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $orders->links() !!}
      
@endsection