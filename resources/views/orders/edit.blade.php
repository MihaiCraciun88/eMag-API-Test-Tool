@extends('layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h1 class="h2 mb-3"> Show Order</h1>
            </div>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">{{ $message }}</div>
    @endif

    <div class="row">

        <form action="{{ route('orders.update', $order) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="col-12 mb-3">
                <div class="mb-3"><strong>Customer name:</strong> {{ $order->customer->name }}</div>
                <div class="mb-3"><strong>Customer email:</strong> {{ $order->customer->email }}</div>
                <div class="mb-3"><strong>Customer phone:</strong> {{ $order->customer->billing_phone }}</div>
                <div class="mb-3">
                    <strong>Status:</strong>
                    <select name="status" class="form-select form-select-sm">
                        <option value="{{ App\Models\Order::STATUS_CANCELLED }}"{{ $order->status == App\Models\Order::STATUS_CANCELLED ? ' selected' : '' }}>CANCELLED</option>
                        <option value="{{ App\Models\Order::STATUS_NEW }}"{{ $order->status == App\Models\Order::STATUS_NEW ? ' selected' : '' }}>NEW</option>
                        <option value="{{ App\Models\Order::STATUS_IN_PROGRESS }}"{{ $order->status == App\Models\Order::STATUS_IN_PROGRESS ? ' selected' : '' }}>IN_PROGRESS</option>
                        <option value="{{ App\Models\Order::STATUS_PREPARED }}"{{ $order->status == App\Models\Order::STATUS_PREPARED ? ' selected' : '' }}>PREPARED</option>
                        <option value="{{ App\Models\Order::STATUS_FINALIZED }}"{{ $order->status == App\Models\Order::STATUS_FINALIZED ? ' selected' : '' }}>FINALIZED</option>
                        <option value="{{ App\Models\Order::STATUS_RETURNED }}"{{ $order->status == App\Models\Order::STATUS_RETURNED ? ' selected' : '' }}>RETURNED</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <div class="col-12 mb-3">
            <h2>Produse</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col" style="width:115px;">Pret normal</th>
                        <th scope="col" style="width:115px;">Pret redus</th>
                        <th scope="col" style="width:115px;">TVA unitar</th>
                        <th scope="col" style="width:115px;">Cantitate</th>
                        <th scope="col" style="width:115px;">Total</th>
                        <th scope="col" style="width:20px;">Actiuni</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ round($product->original_price * ($product->vat + 1), 2) }}</td>
                        <td>{{ round($product->sale_price * ($product->vat + 1), 2) }}</td>
                        <td>{{ round($product->sale_price * $product->vat, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ round($product->sale_price * ($product->vat + 1), 2) * $product->quantity }}</td>
                        <td>
                            <form action="{{ route('orders.products.destroy', [$order->id, $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 mb-3">
            <h2>Atasamente</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Url</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->attachments as $attachment)
                    <tr>
                        <th scope="row">{{ $attachment->id }}</th>
                        <td>{{ $attachment->name }}</td>
                        <td>{{ $attachment->url }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection