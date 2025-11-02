<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Inventory') }}</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  {{-- Theme CSS --}}
  <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #6366f1;
      --primary-dark: #4f46e5;
      --sidebar-bg: #1e293b;
      --navbar-bg: #0f172a;
      --sidebar-hover: #334155;
      --text-light: #e2e8f0;
      --text-muted: #94a3b8;
      --border-color: #334155;
    }

    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background-color: #f1f5f9;
    }

    /* Top Navigation */
    .app-navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: var(--navbar-bg);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      z-index: 1000;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }

    .app-navbar .navbar-brand {
      display: flex;
      align-items: center;
      gap: 14px;
      text-decoration: none;
      color: var(--text-light);
      font-size: 24px;
      font-weight: 700;
      transition: margin-left 0.3s ease;
      letter-spacing: -0.5px;
    }

    .app-navbar .navbar-brand i {
      font-size: 32px;
      color: var(--primary-color);
      filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.4));
    }

    #sidebarToggle {
      display: none;
      background: rgba(99, 102, 241, 0.1);
      border: 1px solid rgba(99, 102, 241, 0.2);
      border-radius: 8px;
      font-size: 24px;
      color: var(--text-light);
      cursor: pointer;
      padding: 8px 12px;
      margin-right: 16px;
      transition: all 0.2s;
    }

    #sidebarToggle:hover {
      background: rgba(99, 102, 241, 0.2);
      border-color: var(--primary-color);
    }

    .app-navbar .d-flex.align-items-center:first-child {
      display: flex;
      align-items: center;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .user-info {
      color: var(--text-muted);
      font-size: 14px;
      font-weight: 500;
      padding: 10px 18px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-logout {
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 10px 24px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
      box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
    }

    .btn-logout:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
    }

    /* Sidebar */
    .app-sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 280px;
      height: calc(100vh - 70px);
      background: var(--sidebar-bg);
      overflow-y: auto;
      z-index: 999;
      transition: transform 0.3s ease;
      padding: 28px 0;
      border-right: 1px solid var(--border-color);
    }

    .app-sidebar::-webkit-scrollbar {
      width: 8px;
    }

    .app-sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .app-sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 4px;
    }

    .app-sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    .section-title {
      color: var(--text-muted);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 20px 24px 10px 24px;
      margin-top: 12px;
    }

    .section-title:first-child {
      margin-top: 0;
      padding-top: 0;
    }

    .app-sidebar .nav {
      padding: 0;
    }

    .app-sidebar .nav-link {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 24px;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      transition: all 0.2s;
      border-left: 4px solid transparent;
      position: relative;
    }

    .app-sidebar .nav-link:hover {
      background: var(--sidebar-hover);
      color: var(--text-light);
      padding-left: 28px;
    }

    .app-sidebar .nav-link.active {
      background: rgba(99, 102, 241, 0.15);
      color: var(--primary-color);
      border-left-color: var(--primary-color);
      font-weight: 600;
    }

    .app-sidebar .nav-link.active i {
      color: var(--primary-color);
    }

    .app-sidebar .nav-link i {
      font-size: 20px;
      width: 24px;
      text-align: center;
      flex-shrink: 0;
    }

    /* Main Content */
    .app-shell {
      margin-top: 70px;
    }

    .app-main {
      margin-left: 280px;
      padding: 32px;
      min-height: calc(100vh - 70px);
      transition: margin-left 0.3s ease;
    }

    /* Sidebar Backdrop */
    .sidebar-backdrop {
      display: none;
      position: fixed;
      top: 70px;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 998;
      opacity: 0;
      transition: opacity 0.3s ease;
      backdrop-filter: blur(2px);
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
      #sidebarToggle {
        display: block;
      }

      .app-sidebar {
        transform: translateX(-100%);
      }

      .app-main {
        margin-left: 0;
      }

      html.sidebar-open .app-sidebar {
        transform: translateX(0);
      }

      html.sidebar-open .sidebar-backdrop {
        display: block;
        opacity: 1;
      }

      .user-info {
        display: none;
      }

      .app-navbar {
        padding: 0 20px;
      }
    }

    @media (max-width: 576px) {
      .app-navbar {
        padding: 0 16px;
        height: 64px;
      }

      .app-shell {
        margin-top: 64px;
      }

      .app-sidebar {
        top: 64px;
        height: calc(100vh - 64px);
      }

      .sidebar-backdrop {
        top: 64px;
      }

      .app-navbar .navbar-brand {
        font-size: 20px;
      }

      .app-navbar .navbar-brand i {
        font-size: 28px;
      }

      .btn-logout {
        padding: 8px 18px;
        font-size: 13px;
      }

      .app-main {
        padding: 20px;
      }
    }

    /* Guest Layout */
    @guest
      .app-main {
        margin-left: 0;
        padding-top: 0;
        margin-top: 0;
      }
    @endguest
  </style>
</head>

<body>

@auth
{{-- Top Navigation --}}
<nav class="app-navbar">
  <div class="d-flex align-items-center">
    {{-- Mobile Toggle --}}
    <button type="button" id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>
    
    {{-- Brand --}}
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <i class="bi bi-grid-3x3-gap"></i>
      <span>Inventory</span>
    </a>
  </div>

  {{-- Right Side --}}
  <div class="navbar-right">
    <span class="user-info">Hi, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
    <form method="POST" action="{{ route('logout') }}" class="mb-0">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<div class="app-shell">
  {{-- Sidebar Backdrop (Mobile) --}}
  <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

  {{-- Sidebar --}}
  @php $role = auth()->user()->role ?? null; @endphp
  <aside class="app-sidebar">
    {{-- MAIN Section --}}
    <div class="section-title">MAIN</div>
    <nav class="nav flex-column">
      <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>

      {{-- Viewer: Read-only Products and Warehouses --}}
      @if($role === 'Viewer')
        <a href="{{ route('viewer.products.index') }}" class="nav-link {{ request()->routeIs('viewer.products.*') ? 'active' : '' }}">
          <i class="bi bi-box-seam"></i>
          <span>Products</span>
        </a>
        
        <a href="{{ route('viewer.warehouses.index') }}" class="nav-link {{ request()->routeIs('viewer.warehouses.*') ? 'active' : '' }}">
          <i class="bi bi-building"></i>
          <span>Warehouses</span>
        </a>
        
        <a href="{{ route('viewer.movements.index') }}" class="nav-link {{ request()->routeIs('viewer.movements.*') ? 'active' : '' }}">
          <i class="bi bi-arrow-left-right"></i>
          <span>Stock Movements</span>
        </a>
      @endif

      {{-- Admin + Manager: Full access --}}
      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
          <i class="bi bi-box-seam"></i>
          <span>Products</span>
        </a>
        
        <a href="{{ route('warehouses.index') }}" class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}">
          <i class="bi bi-building"></i>
          <span>Warehouses</span>
        </a>

        <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
          <i class="bi bi-truck"></i>
          <span>Suppliers</span>
        </a>
      @endif

      @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
        <a href="{{ route('movements.index') }}" class="nav-link {{ request()->routeIs('movements.*') ? 'active' : '' }}">
          <i class="bi bi-arrow-left-right"></i>
          <span>Stock Movements</span>
        </a>
        
        <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
          <i class="bi bi-receipt"></i>
          <span>Purchase Orders</span>
        </a>
      @endif

      @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
        <div class="section-title">TRANSFERS</div>
        <a href="{{ route('transfers.create') }}" class="nav-link {{ request()->routeIs('transfers.create') ? 'active' : '' }}">
          <i class="bi bi-arrow-right-circle"></i>
          <span>Request Transfer</span>
        </a>
        
        <a href="{{ route('transfers.my') }}" class="nav-link {{ request()->routeIs('transfers.my') ? 'active' : '' }}">
          <i class="bi bi-inbox"></i>
          <span>My Requests</span>
        </a>
        
        @if(in_array($role, ['Admin', 'Inventory Manager']))
          <a href="{{ route('admin.transfers.index') }}" class="nav-link {{ request()->routeIs('admin.transfers.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            <span>Pending Transfers</span>
          </a>
        @endif
      @endif

      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <div class="section-title">APPROVALS</div>
        <a href="{{ route('admin.approvals.index') }}" class="nav-link {{ request()->routeIs('admin.approvals.*') ? 'active' : '' }}">
          <i class="bi bi-check-circle"></i>
          <span>Approvals</span>
        </a>
      @endif

      {{-- REPORTS - Show for both Admin and Inventory Manager --}}
      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <div class="section-title">REPORTS</div>
        <a href="{{ route('reorder.index') }}" class="nav-link {{ request()->routeIs('reorder.*') ? 'active' : '' }}">
          <i class="bi bi-exclamation-triangle"></i>
          <span>Reorder</span>
        </a>
        
        <a href="{{ route('reports.stock') }}" class="nav-link {{ request()->routeIs('reports.stock') ? 'active' : '' }}">
          <i class="bi bi-grid-3x3-gap"></i>
          <span>Stock Report</span>
        </a>
        
        <a href="{{ route('reports.movements') }}" class="nav-link {{ request()->routeIs('reports.movements') ? 'active' : '' }}">
          <i class="bi bi-arrow-left-right"></i>
          <span>Movements</span>
        </a>
      @endif

      {{-- USERS - Admin only --}}
      @if($role === 'Admin')
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          <i class="bi bi-people"></i>
          <span>Users</span>
        </a>
      @endif
    </nav>
  </aside>

  {{-- Main Content --}}
  <main class="app-main">
    {{ $slot }}
  </main>
</div>
@endauth

@guest
  <main class="app-main" style="margin-left: 0; padding-top: 0;">
    {{ $slot }}
  </main>
@endguest

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Sidebar Toggle
(function() {
  const toggleBtn = document.getElementById('sidebarToggle');
  const backdrop = document.getElementById('sidebarBackdrop');
  const htmlEl = document.documentElement;

  function toggleSidebar() {
    htmlEl.classList.toggle('sidebar-open');
  }

  toggleBtn?.addEventListener('click', toggleSidebar);
  backdrop?.addEventListener('click', () => htmlEl.classList.remove('sidebar-open'));
})();
</script>
</body>
</html>