@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h1 class="h2 mb-3">Products</h1>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nume</th>
            <th>Cod produs</th>
            <th>Stoc</th>
            <th width="150px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>#{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->part_number }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection