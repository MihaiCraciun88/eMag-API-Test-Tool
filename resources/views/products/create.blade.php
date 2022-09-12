@extends('layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
            <h2>Add New product</h2>
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
   
<form action="{{ route('products.store') }}" method="POST">
    @csrf
  
    <div class="mb-3">
        <label class="form-label">Nume</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Cod produs:</label>
        <input type="text" name="ext_part_number" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Cod bare:</label>
        <input type="text" name="part_number_key" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Cod intern:</label>
        <input type="text" name="part_number" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Moneda:</label>
        <input type="text" name="currency" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Pret vanzare:</label>
        <input type="text" name="sale_price" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Pret intreg:</label>
        <input type="text" name="original_price" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Cota TVA:</label>
        <input type="text" name="vat" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Status:</label>
        <input type="text" name="status" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">User:</label>
        <input type="text" name="mkt_id" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
   
</form>
@endsection