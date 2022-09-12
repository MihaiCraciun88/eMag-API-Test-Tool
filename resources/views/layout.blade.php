<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
    <link href="{{ url('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('css/main.css') }}" rel="stylesheet">
</head>
<body>
  
<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="{{ url('') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="{{ url('') }}" class="nav-link {{ Route::is('home') ? 'active' : 'text-white' }}">Home</a></li>
            <li class="nav-item"><a href="{{ url('/users') }}" class="nav-link {{ Route::is('users.*') ? 'active' : 'text-white' }}">Users</a></li>
            <li class="nav-item"><a href="{{ url('/orders') }}" class="nav-link {{ Route::is('orders.*') ? 'active' : 'text-white' }}">Orders</a></li>
            <li class="nav-item"><a href="{{ url('/products') }}" class="nav-link {{ Route::is('products.*') ? 'active' : 'text-white' }}">Products</a></li>
            <li class="nav-item"><a href="{{ url('/customers') }}" class="nav-link {{ Route::is('customers.*') ? 'active' : 'text-white' }}">Customers</a></li>
        </ul>
        <!--<hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" class="rounded-circle me-2" width="32" height="32">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>-->
    </div>
    <div class="d-flex flex-column align-items-stretch flex-grow-1 flex-shrink-0 bg-white">
        <div class="p-3 scrollarea" id="content">
            @yield('content')
        </div>
    </div>
</main>
   
</body>
</html>