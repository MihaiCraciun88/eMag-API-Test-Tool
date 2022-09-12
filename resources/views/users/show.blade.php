@extends('layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2> Show User</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="mb-3">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="mb-3">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>
    </div>
    
    <form action="{{ route('users.seed', $user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="mb-3">
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <strong>Generare comenzi automat pentru user:</strong>
                    <button type="submit" class="btn btn-success">Generare</button>
                </div>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">IP</th>
                <th scope="col" style="width:20px;">Actiuni</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userIps as $ip)
            <tr>
                <th scope="row">{{ $ip->id }}</th>
                <td>{{ long2ip($ip->ip) }}</td>
                <td>
                    <form action="{{ route('users.ips.destroy', [$user->id, $ip->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="{{ route('users.ips.store', $user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="mb-3">
                    <strong>Adauga IP:</strong>
                    <input type="text" name="ip" class="form-control" placeholder="IP">
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ $user->id }}" />
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection