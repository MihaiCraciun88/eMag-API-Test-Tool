@extends('layout')
  
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
    <a href="{{ url('/run-seed') }}" class="btn btn-danger">Refresh DB and Seed</a>
    <a href="{{ url('/doc/eMAG-Marketplace-API-documentation-v4.3.5.docx') }}" class="btn btn-success" target="_blank">Documentation</a>
    <hr>
    POST: {{ url('/api/order/count') }}<br>
    POST: {{ url('/api/order/read') }}<br>
    POST: {{ url('/api/order/attachments/save') }}<br>
    POST: {{ url('/api/product_offer/count') }}<br>
    POST: {{ url('/api/product_offer/read') }}<br>

    <form class="g-3 my-3" id="request-form">
        <div class="row g-3">
            <div class="col-auto">
                <label class="form-label">User</label>
                <select name="user" class="form-select">
                @foreach ($users as $user)
                    <option data-email="{{ $user->email }}">{{ $user->email }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label">Parola</label>
                <input name="password" class="form-control">
            </div>
            <div class="col-auto">
                <label class="form-label">Endpoint</label>
                <select name="action" class="form-select">
                    <option>{{ url('/api/order/count') }}</option>
                    <option>{{ url('/api/order/read') }}</option>
                    <option>{{ url('/api/order/attachments/save') }}</option>
                    <option>{{ url('/api/product_offer/count') }}</option>
                    <option>{{ url('/api/product_offer/read') }}</option>
                </select>
            </div>
            <div class="col-auto">
                <div class="mb-2">&nbsp;</div>
                <button class="btn btn-primary" name="send">Trimite</button>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div class="card" id="card-result">
                    <pre id="request-result"></pre>
                </div>
            </div>
        </div>
    </form>

    <script>
        var form = document.getElementById('request-form');
        form.onsubmit = function() {
            return false;
        };
        form.send.onclick = function() {
            var request = fetch(form.action.value, {
                method: 'POST',
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Basic ' + btoa(form.user.value + ':' + form.password.value)
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify({
                    data: {
                        itemsPerPage: 10
                    }
                }) // body data type must match "Content-Type" header
            });
            request
                .then(response => response.json())
                .then(data => {
                    document.getElementById('request-result').innerHTML = JSON.stringify(data, null, 4);
                });
        };
    </script>
@endsection