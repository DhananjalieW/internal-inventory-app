<?php>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  {{-- Innovior Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  
  <title>{{ config('app.name', 'Inventory') }}</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
      --primary-light: #818cf8;
      --secondary-color: #8b5cf6;
      --sidebar-bg: #0f172a;
      --sidebar-bg-dark: #020617;
      --navbar-bg: #1e293b;
      --text-light: #f1f5f9;
      --text-muted: #94a3b8;
      --text-dark: #0f172a;
      --border-color: #334155;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      min-height: 100vh;
    }

    /* ===== Top Navigation ===== */
    .app-navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      z-index: 1000;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border-bottom: 1px solid rgba(99, 102, 241, 0.2);
    }

    .app-navbar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), #06b6d4);
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    #sidebarToggle {
      display: none;
      background: rgba(99, 102, 241, 0.15);
      border: 1px solid rgba(99, 102, 241, 0.3);
      border-radius: 10px;
      font-size: 22px;
      color: var(--text-light);
      cursor: pointer;
      padding: 8px 12px;
      transition: all 0.3s ease;
    }

    #sidebarToggle:hover {
      background: rgba(99, 102, 241, 0.25);
      border-color: var(--primary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 14px;
      text-decoration: none;
      color: var(--text-light);
      font-size: 22px;
      font-weight: 700;
      letter-spacing: -0.5px;
      transition: all 0.3s ease;
    }

    .navbar-brand:hover {
      color: white;
    }

    .brand-icon {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
      transition: all 0.3s ease;
    }

    .navbar-brand:hover .brand-icon {
      transform: rotate(5deg) scale(1.05);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
    }

    .brand-icon i {
      font-size: 20px;
      color: white;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 16px;
      background: rgba(99, 102, 241, 0.1);
      border: 1px solid rgba(99, 102, 241, 0.2);
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .user-info:hover {
      background: rgba(99, 102, 241, 0.15);
      border-color: rgba(99, 102, 241, 0.3);
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 14px;
    }

    .user-details {
      text-align: left;
    }

    .user-name {
      color: var(--text-light);
      font-size: 14px;
      font-weight: 600;
      line-height: 1.2;
    }

    .user-role {
      color: var(--text-muted);
      font-size: 12px;
      font-weight: 500;
    }

    .btn-logout {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-logout:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
    }

    /* ===== Sidebar ===== */
    .app-sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 280px;
      height: calc(100vh - 70px);
      background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-dark) 100%);
      overflow-y: auto;
      z-index: 999;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      padding: 24px 0;
      border-right: 1px solid rgba(99, 102, 241, 0.1);
    }

    .app-sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .app-sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .app-sidebar::-webkit-scrollbar-thumb {
      background: rgba(99, 102, 241, 0.3);
      border-radius: 3px;
    }

    .app-sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(99, 102, 241, 0.5);
    }

    /* Section Titles */
    .section-title {
      color: var(--text-muted);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      padding: 20px 24px 12px 24px;
      margin-top: 8px;
      position: relative;
    }

    .section-title::before {
      content: '';
      position: absolute;
      left: 24px;
      right: 24px;
      top: 10px;
      height: 1px;
      background: linear-gradient(90deg, rgba(99, 102, 241, 0.3) 0%, transparent 100%);
    }

    .section-title:first-child {
      margin-top: 0;
      padding-top: 0;
    }

    .section-title:first-child::before {
      display: none;
    }

    /* Nav Links */
    .sidebar-nav {
      padding: 0 12px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 16px;
      margin: 3px 0;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      border-radius: 10px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .nav-link:hover {
      color: var(--text-light);
      background: rgba(99, 102, 241, 0.1);
      padding-left: 20px;
    }

    .nav-link:hover .nav-icon {
      transform: scale(1.1);
      background: rgba(99, 102, 241, 0.2);
    }

    .nav-link.active {
      color: white;
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
    }

    .nav-link.active::after {
      content: '';
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 24px;
      background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
      border-radius: 4px 0 0 4px;
    }

    .nav-icon {
      width: 36px;
      height: 36px;
      background: rgba(99, 102, 241, 0.1);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    .nav-link.active .nav-icon {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    .nav-text {
      flex: 1;
    }

    /* ===== Main Content ===== */
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
      backdrop-filter: blur(4px);
    }

    /* ===== Mobile Responsive ===== */
    @media (max-width: 991px) {
      #sidebarToggle {
        display: flex;
      }

      .app-sidebar {
        transform: translateX(-100%);
        box-shadow: none;
      }

      .app-main {
        margin-left: 0;
      }

      html.sidebar-open .app-sidebar {
        transform: translateX(0);
        box-shadow: 10px 0 40px rgba(0, 0, 0, 0.3);
      }

      html.sidebar-open .sidebar-backdrop {
        display: block;
        opacity: 1;
      }

      .user-details {
        display: none;
      }

      .user-info {
        padding: 8px;
      }
    }

    @media (max-width: 768px) {
      .app-navbar {
        padding: 0 20px;
        height: 64px;
      }

      .app-navbar::before {
        height: 2px;
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

      .navbar-brand {
        font-size: 18px;
      }

      .brand-icon {
        width: 38px;
        height: 38px;
      }

      .brand-icon i {
        font-size: 18px;
      }

      .app-main {
        padding: 20px;
      }

      .btn-logout span {
        display: none;
      }

      .btn-logout {
        padding: 10px 12px;
      }
    }

    @media (max-width: 576px) {
      .app-navbar {
        padding: 0 16px;
        height: 60px;
      }

      .app-shell {
        margin-top: 60px;
      }

      .app-sidebar {
        top: 60px;
        height: calc(100vh - 60px);
        width: 100%;
      }

      .sidebar-backdrop {
        top: 60px;
      }

      .user-info {
        display: none;
      }

      .app-main {
        padding: 16px;
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

    /* ===== Animations ===== */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .app-main > * {
      animation: fadeIn 0.3s ease;
    }
  </style>
</head>

<body>

@auth
{{-- Top Navigation --}}
<nav class="app-navbar">
  <div class="navbar-left">
    {{-- Mobile Toggle --}}
    <button type="button" id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>
    
    {{-- Brand --}}
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <div class="brand-icon">
        <i class="bi bi-boxes"></i>
      </div>
      <span>{{ config('app.name') }}</span>
    </a>
  </div>

  <div class="navbar-right">
    {{-- User Info --}}
    <div class="user-info">
      <div class="user-avatar">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
      </div>
      <div class="user-details">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-role">{{ auth()->user()->role }}</div>
      </div>
    </div>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="mb-0">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
      </button>
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
    <nav class="sidebar-nav">
      <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <div class="nav-icon">
          <i class="bi bi-speedometer2"></i>
        </div>
        <span class="nav-text">Dashboard</span>
      </a>

      {{-- Viewer: Read-only Products and Warehouses --}}
      @if($role === 'Viewer')
        <a href="{{ route('viewer.products.index') }}" class="nav-link {{ request()->routeIs('viewer.products.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-box-seam"></i>
          </div>
          <span class="nav-text">Products</span>
        </a>
        
        <a href="{{ route('viewer.warehouses.index') }}" class="nav-link {{ request()->routeIs('viewer.warehouses.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-building"></i>
          </div>
          <span class="nav-text">Warehouses</span>
        </a>
        
        <a href="{{ route('viewer.movements.index') }}" class="nav-link {{ request()->routeIs('viewer.movements.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <span class="nav-text">Stock Movements</span>
        </a>
      @endif

      {{-- Admin + Manager: Full access --}}
      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-box-seam"></i>
          </div>
          <span class="nav-text">Products</span>
        </a>
        
        <a href="{{ route('warehouses.index') }}" class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-building"></i>
          </div>
          <span class="nav-text">Warehouses</span>
        </a>

        <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-truck"></i>
          </div>
          <span class="nav-text">Suppliers</span>
        </a>
      @endif

      @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
        <a href="{{ route('movements.index') }}" class="nav-link {{ request()->routeIs('movements.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <span class="nav-text">Stock Movements</span>
        </a>
        
        <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-receipt"></i>
          </div>
          <span class="nav-text">Purchase Orders</span>
        </a>
      @endif
    </nav>

    @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
      <div class="section-title">TRANSFERS</div>
      <nav class="sidebar-nav">
        <a href="{{ route('transfers.create') }}" class="nav-link {{ request()->routeIs('transfers.create') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-arrow-right-circle"></i>
          </div>
          <span class="nav-text">Request Transfer</span>
        </a>
        
        <a href="{{ route('transfers.my') }}" class="nav-link {{ request()->routeIs('transfers.my') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-inbox"></i>
          </div>
          <span class="nav-text">My Requests</span>
        </a>
        
        @if(in_array($role, ['Admin', 'Inventory Manager']))
          <a href="{{ route('admin.transfers.index') }}" class="nav-link {{ request()->routeIs('admin.transfers.*') ? 'active' : '' }}">
            <div class="nav-icon">
              <i class="bi bi-clipboard-check"></i>
            </div>
            <span class="nav-text">Pending Transfers</span>
          </a>
        @endif
      </nav>
    @endif

    @if(in_array($role, ['Admin', 'Inventory Manager']))
      <div class="section-title">APPROVALS</div>
      <nav class="sidebar-nav">
        <a href="{{ route('admin.approvals.index') }}" class="nav-link {{ request()->routeIs('admin.approvals.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-check-circle"></i>
          </div>
          <span class="nav-text">Approvals</span>
        </a>
      </nav>
    @endif

    {{-- REPORTS --}}
    @if(in_array($role, ['Admin', 'Inventory Manager']))
      <div class="section-title">REPORTS</div>
      <nav class="sidebar-nav">
        <a href="{{ route('reorder.index') }}" class="nav-link {{ request()->routeIs('reorder.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-exclamation-triangle"></i>
          </div>
          <span class="nav-text">Reorder</span>
        </a>
        
        <a href="{{ route('reports.stock') }}" class="nav-link {{ request()->routeIs('reports.stock') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-grid-3x3-gap"></i>
          </div>
          <span class="nav-text">Stock Report</span>
        </a>
        
        <a href="{{ route('reports.movements') }}" class="nav-link {{ request()->routeIs('reports.movements') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-bar-chart-line"></i>
          </div>
          <span class="nav-text">Movements</span>
        </a>
      </nav>
    @endif

    {{-- ADMIN --}}
    @if($role === 'Admin')
      <div class="section-title">ADMIN</div>
      <nav class="sidebar-nav">
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          <div class="nav-icon">
            <i class="bi bi-people"></i>
          </div>
          <span class="nav-text">Users</span>
        </a>
      </nav>
    @endif
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

  function closeSidebar() {
    htmlEl.classList.remove('sidebar-open');
  }

  toggleBtn?.addEventListener('click', toggleSidebar);
  backdrop?.addEventListener('click', closeSidebar);

  // Close sidebar on ESC key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSidebar();
  });
})();
</script>
</body>
</html>