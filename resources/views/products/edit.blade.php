@extends('layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h1 class="h2 mb-3">Edit product</h1>
            </div>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="mb-3">
            <label class="form-label">Nume</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Cod produs:</label>
            <input type="text" name="ext_part_number" class="form-control" value="{{ $product->ext_part_number }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Cod bare:</label>
            <input type="text" name="part_number_key" class="form-control" value="{{ $product->part_number_key }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Cod intern:</label>
            <input type="text" name="part_number" class="form-control" value="{{ $product->part_number }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Moneda:</label>
            <input type="text" name="currency" class="form-control" value="{{ $product->currency }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Pret vanzare:</label>
            <input type="text" name="sale_price" class="form-control" value="{{ $product->sale_price }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Pret intreg:</label>
            <input type="text" name="original_price" class="form-control" value="{{ $product->original_price }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Cota TVA:</label>
            <input type="text" name="vat" class="form-control" value="{{ $product->vat }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <input type="text" name="status" class="form-control" value="{{ $product->status }}">
        </div>
        <div class="mb-3">
            <label class="form-label">User:</label>
            <input type="text" name="mkt_id" class="form-control" value="{{ $product->mkt_id }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
   
    </form>
@endsection