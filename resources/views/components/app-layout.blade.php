<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventory') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Breeze/Alpine/Vite --}}
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

@auth
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-3 shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Inventory</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="topnav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @php $role = auth()->check() ? (auth()->user()->role ?? null) : null; @endphp

        {{-- Dashboard (all) --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
             href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        {{-- Admin + Inventory Manager --}}
        @if(in_array($role, ['Admin','Inventory Manager']))
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
               href="{{ route('products.index') }}">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}"
               href="{{ route('warehouses.index') }}">Warehouses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"
               href="{{ route('suppliers.index') }}">Suppliers</a>
          </li>
        @endif

        {{-- Admin + Manager + Clerk --}}
        @if(in_array($role, ['Admin','Inventory Manager','Clerk']))
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('movements.*') ? 'active' : '' }}"
               href="{{ route('movements.index') }}">Stock Movements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}"
               href="{{ route('pos.index') }}">Purchase Orders</a>
          </li>

          {{-- Transfers --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('transfers.*') || request()->routeIs('admin.transfers.*') ? 'active' : '' }}"
               href="#" role="button" data-bs-toggle="dropdown">Transfers</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ request()->routeIs('transfers.create') ? 'active' : '' }}" href="{{ route('transfers.create') }}">Request Transfer</a></li>
              <li><a class="dropdown-item {{ request()->routeIs('transfers.my') ? 'active' : '' }}" href="{{ route('transfers.my') }}">My Requests</a></li>
              @if(in_array($role, ['Admin','Inventory Manager']))
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item {{ request()->routeIs('admin.transfers.*') ? 'active' : '' }}" href="{{ route('admin.transfers.index') }}">Pending Transfers</a></li>
              @endif
            </ul>
          </li>
        @endif

        {{-- Reports + Users (Admin only) --}}
        @if($role === 'Admin')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('reorder.*') || request()->routeIs('reports.*') ? 'active' : '' }}"
               href="#" role="button" data-bs-toggle="dropdown">Reports</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('reorder.index') }}">Reorder</a></li>
              <li><a class="dropdown-item" href="{{ route('reports.stock') }}">Stock by Warehouse</a></li>
              <li><a class="dropdown-item" href="{{ route('reports.movements') }}">Movements</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
               href="{{ route('admin.users.index') }}">Users & Roles</a>
          </li>
        @endif
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-flex align-items-center me-2">
          <span class="text-muted small">Hi, {{ auth()->user()->name }} ({{ $role }})</span>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-secondary">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
@endauth

<main class="py-3">
  {{ $slot }}
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
