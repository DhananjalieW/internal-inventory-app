<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Innovior Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

  <title>{{ config('app.name', 'Inventory') }}</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- Alpine.js --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    /* ===== CSS Variables ===== */
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --secondary: #8b5cf6;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --info: #06b6d4;

      --gray-50: #f8fafc;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-300: #cbd5e1;
      --gray-400: #94a3b8;
      --gray-500: #64748b;
      --gray-600: #475569;
      --gray-700: #334155;
      --gray-800: #1e293b;
      --gray-900: #0f172a;

      --sidebar-width: 280px;
      --topbar-height: 72px;
      --sidebar-bg: #0f172a;
      --sidebar-hover: rgba(255, 255, 255, 0.05);
      --sidebar-active: rgba(99, 102, 241, 0.15);
      --sidebar-text: #94a3b8;
      --sidebar-text-active: #ffffff;
      --sidebar-section: #475569;
    }

    /* ===== Reset & Base ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--gray-100);
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* ===== Top Navigation Bar ===== */
    .topbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: var(--topbar-height);
      background: var(--sidebar-bg);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      z-index: 1001;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .topbar-inner {
      height: 100%;
      padding: 0 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
    }

    /* Left Section */
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .sidebar-toggle {
      display: none;
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      color: var(--sidebar-text);
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      align-items: center;
      justify-content: center;
    }

    .sidebar-toggle:hover {
      background: rgba(255, 255, 255, 0.12);
      color: white;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .brand:hover .brand-icon {
      transform: rotate(-5deg) scale(1.05);
    }

    .brand-icon {
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
      transition: all 0.3s ease;
    }

    .brand-icon i {
      font-size: 22px;
      color: white;
    }

    .brand-text {
      display: flex;
      flex-direction: column;
    }

    .brand-name {
      font-size: 18px;
      font-weight: 800;
      color: white;
      letter-spacing: -0.5px;
      line-height: 1.2;
    }

    .brand-tagline {
      font-size: 11px;
      font-weight: 500;
      color: var(--sidebar-text);
      letter-spacing: 0.3px;
    }

    /* Right Section */
    .topbar-right {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    /* User Dropdown */
    .user-dropdown {
      position: relative;
    }

    .user-trigger {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 14px 8px 8px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .user-trigger:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.15);
    }

    .topbar-avatar {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      font-weight: 700;
      color: white;
      box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
      flex-shrink: 0;
    }

    .topbar-user-info {
      display: flex;
      flex-direction: column;
      text-align: left;
      min-width: 0;
    }

    .topbar-user-name {
      font-size: 14px;
      font-weight: 700;
      color: white;
      line-height: 1.2;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 150px;
    }

    .topbar-user-role {
      font-size: 12px;
      font-weight: 500;
      color: var(--sidebar-text);
      white-space: nowrap;
    }

    .topbar-chevron {
      color: var(--sidebar-text);
      font-size: 14px;
      transition: transform 0.3s ease;
      flex-shrink: 0;
    }

    /* Dropdown Menu */
    .topbar-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      width: 240px;
      background: white;
      border: 1px solid var(--gray-200);
      border-radius: 14px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      z-index: 9999;
      overflow: hidden;
    }

    .topbar-dropdown-header {
      padding: 16px;
      background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
      border-bottom: 1px solid var(--gray-200);
    }

    .topbar-dropdown-name {
      font-size: 15px;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .topbar-dropdown-email {
      font-size: 13px;
      color: var(--gray-500);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .topbar-dropdown-body {
      padding: 8px;
    }

    .topbar-dropdown-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px;
      color: var(--gray-700);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      border-radius: 8px;
      transition: all 0.2s ease;
      width: 100%;
      background: none;
      border: none;
      cursor: pointer;
      text-align: left;
    }

    .topbar-dropdown-item:hover {
      background: var(--gray-50);
      color: var(--gray-900);
    }

    .topbar-dropdown-item i {
      font-size: 18px;
      color: var(--gray-400);
      transition: color 0.2s ease;
      flex-shrink: 0;
    }

    .topbar-dropdown-item:hover i {
      color: var(--primary);
    }

    .topbar-dropdown-divider {
      height: 1px;
      background: var(--gray-200);
      margin: 4px 0;
    }

    .topbar-dropdown-item.logout {
      color: var(--danger);
    }

    .topbar-dropdown-item.logout:hover {
      background: #fef2f2;
      color: var(--danger);
    }

    .topbar-dropdown-item.logout i {
      color: var(--danger);
    }

    /* ===== Sidebar ===== */
    .sidebar {
      position: fixed;
      top: var(--topbar-height);
      left: 0;
      width: var(--sidebar-width);
      height: calc(100vh - var(--topbar-height));
      background: var(--sidebar-bg);
      border-right: 1px solid rgba(255, 255, 255, 0.06);
      overflow-y: auto;
      z-index: 999;
      transition: transform 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .sidebar-content {
      padding: 20px 16px;
    }

    /* Sidebar Section */
    .sidebar-section {
      margin-bottom: 24px;
    }

    .sidebar-section:last-child {
      margin-bottom: 0;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 0 12px 12px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--sidebar-section);
    }

    .section-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(255, 255, 255, 0.06);
    }

    /* Nav Links */
    .nav-links {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 12px;
      color: var(--sidebar-text);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      border-radius: 10px;
      transition: all 0.2s ease;
      position: relative;
    }

    .nav-link:hover {
      background: var(--sidebar-hover);
      color: white;
    }

    .nav-link:hover .nav-icon {
      background: rgba(255, 255, 255, 0.1);
      color: white;
    }

    .nav-link.active {
      background: var(--sidebar-active);
      color: white;
      font-weight: 600;
    }

    .nav-link.active .nav-icon {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    .nav-link.active::after {
      content: '';
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 60%;
      background: linear-gradient(180deg, var(--primary), var(--secondary));
      border-radius: 3px 0 0 3px;
    }

    .nav-icon {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
      transition: all 0.2s ease;
      color: var(--sidebar-text);
    }

    .nav-text {
      flex: 1;
    }

    .nav-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 20px;
      height: 20px;
      padding: 0 6px;
      background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
      color: white;
      font-size: 11px;
      font-weight: 700;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
    }

    /* ===== Main Content ===== */
    .app-container {
      margin-top: var(--topbar-height);
      margin-left: var(--sidebar-width);
      min-height: calc(100vh - var(--topbar-height));
      padding: 32px;
      transition: margin-left 0.3s ease;
    }

    /* Sidebar Backdrop */
    .sidebar-backdrop {
      display: none;
      position: fixed;
      top: var(--topbar-height);
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(4px);
      z-index: 998;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
      :root {
        --sidebar-width: 260px;
      }
    }

    @media (max-width: 991px) {
      .sidebar-toggle {
        display: flex;
      }

      .sidebar {
        transform: translateX(-100%);
        box-shadow: none;
      }

      .app-container {
        margin-left: 0;
      }

      body.sidebar-open .sidebar {
        transform: translateX(0);
        box-shadow: 10px 0 40px rgba(0, 0, 0, 0.3);
      }

      body.sidebar-open .sidebar-backdrop {
        display: block;
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      :root {
        --topbar-height: 64px;
      }

      .topbar-inner {
        padding: 0 16px;
      }

      .brand-text {
        display: none;
      }

      .brand-icon {
        width: 40px;
        height: 40px;
      }

      .brand-icon i {
        font-size: 20px;
      }

      .topbar-user-info {
        display: none;
      }

      .user-trigger {
        padding: 8px;
      }

      .topbar-chevron {
        display: none;
      }

      .sidebar {
        width: 280px;
      }

      .app-container {
        padding: 20px;
      }

      .topbar-dropdown {
        width: 220px;
      }
    }

    @media (max-width: 576px) {
      :root {
        --topbar-height: 60px;
      }

      .brand-icon {
        width: 36px;
        height: 36px;
      }

      .brand-icon i {
        font-size: 18px;
      }

      .topbar-avatar {
        width: 36px;
        height: 36px;
        font-size: 14px;
      }

      .sidebar {
        width: 100%;
      }

      .app-container {
        padding: 16px;
      }
    }

    /* ===== Animations ===== */
    @keyframes slideInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .app-container > * {
      animation: slideInUp 0.4s ease;
    }
  </style>
</head>

<body>
@auth
  {{-- ===== Top Navigation Bar ===== --}}
  <header class="topbar">
    <div class="topbar-inner">
      {{-- Left --}}
      <div class="topbar-left">
        <button type="button" class="sidebar-toggle" onclick="toggleSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="brand">
          <div class="brand-icon"><i class="bi bi-boxes"></i></div>
          <div class="brand-text">
            <span class="brand-name">{{ config('app.name', 'Inventory') }}</span>
            <span class="brand-tagline">Management System</span>
          </div>
        </a>
      </div>

      {{-- Right --}}
      <div class="topbar-right">
        <div class="user-dropdown" x-data="{ open: false }" @click.away="open = false">
          <div class="user-trigger" @click="open = !open">
            <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="topbar-user-info">
              <div class="topbar-user-name">{{ auth()->user()->name }}</div>
              <div class="topbar-user-role">{{ auth()->user()->role }}</div>
            </div>
            <i class="bi bi-chevron-down topbar-chevron" :style="open ? 'transform:rotate(180deg)' : ''"></i>
          </div>

          <div class="topbar-dropdown" x-show="open"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
               x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 transform scale-100"
               x-transition:leave-end="opacity-0 transform scale-95"
               style="display: none;">
            <div class="topbar-dropdown-header">
              <div class="topbar-dropdown-name">{{ auth()->user()->name }}</div>
              <div class="topbar-dropdown-email">{{ auth()->user()->email }}</div>
            </div>
            <div class="topbar-dropdown-body">
              
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="topbar-dropdown-item logout">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Logout</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- ===== Sidebar Backdrop ===== --}}
  <div class="sidebar-backdrop" onclick="toggleSidebar()"></div>

  {{-- ===== Sidebar ===== --}}
  @php $role = auth()->user()->role ?? null; @endphp
  <aside class="sidebar">
    <div class="sidebar-content">
      {{-- MAIN --}}
      <div class="sidebar-section">
        <div class="section-title">MAIN</div>
        <div class="nav-links">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <div class="nav-icon"><i class="bi bi-speedometer2"></i></div>
            <span class="nav-text">Dashboard</span>
          </a>

          @if($role === 'Viewer')
            <a href="{{ route('viewer.products.index') }}" class="nav-link {{ request()->routeIs('viewer.products.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-box-seam"></i></div>
              <span class="nav-text">Products</span>
            </a>
            <a href="{{ route('viewer.warehouses.index') }}" class="nav-link {{ request()->routeIs('viewer.warehouses.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-building"></i></div>
              <span class="nav-text">Warehouses</span>
            </a>
            <a href="{{ route('viewer.movements.index') }}" class="nav-link {{ request()->routeIs('viewer.movements.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-arrow-left-right"></i></div>
              <span class="nav-text">Movements</span>
            </a>
          @endif

          @if(in_array($role, ['Admin', 'Inventory Manager']))
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-box-seam"></i></div>
              <span class="nav-text">Products</span>
            </a>
            <a href="{{ route('warehouses.index') }}" class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-building"></i></div>
              <span class="nav-text">Warehouses</span>
            </a>
            <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-truck"></i></div>
              <span class="nav-text">Suppliers</span>
            </a>
          @endif

          @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
            <a href="{{ route('movements.index') }}" class="nav-link {{ request()->routeIs('movements.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-arrow-left-right"></i></div>
              <span class="nav-text">Stock Movements</span>
            </a>
            <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-receipt"></i></div>
              <span class="nav-text">Purchase Orders</span>
            </a>
          @endif
        </div>
      </div>

      {{-- TRANSFERS --}}
      @if(in_array($role, ['Admin', 'Inventory Manager', 'Clerk']))
        <div class="sidebar-section">
          <div class="section-title">TRANSFERS</div>
          <div class="nav-links">
            <a href="{{ route('transfers.create') }}" class="nav-link {{ request()->routeIs('transfers.create') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-plus-circle"></i></div>
              <span class="nav-text">Request Transfer</span>
            </a>
            <a href="{{ route('transfers.my') }}" class="nav-link {{ request()->routeIs('transfers.my') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-inbox"></i></div>
              <span class="nav-text">My Requests</span>
            </a>
            @if(in_array($role, ['Admin', 'Inventory Manager']))
              <a href="{{ route('admin.transfers.index') }}" class="nav-link {{ request()->routeIs('admin.transfers.*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="bi bi-hourglass-split"></i></div>
                <span class="nav-text">Pending Transfers</span>
                @php
                  $pendingCount = 0;
                  try {
                    if (class_exists(\App\Models\WarehouseTransfer::class) && \Illuminate\Support\Facades\Schema::hasTable('warehouse_transfers')) {
                      $pendingCount = \App\Models\WarehouseTransfer::where('status', 'pending')->count();
                    }
                  } catch (\Throwable $e) {}
                @endphp
                @if($pendingCount > 0)
                  <span class="nav-badge">{{ $pendingCount }}</span>
                @endif
              </a>
            @endif
          </div>
        </div>
      @endif

      {{-- APPROVALS --}}
      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <div class="sidebar-section">
          <div class="section-title">APPROVALS</div>
          <div class="nav-links">
            <a href="{{ route('admin.approvals.index') }}" class="nav-link {{ request()->routeIs('admin.approvals.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-clipboard-check"></i></div>
              <span class="nav-text">Approvals</span>
            </a>
          </div>
        </div>
      @endif

      {{-- REPORTS --}}
      @if(in_array($role, ['Admin', 'Inventory Manager']))
        <div class="sidebar-section">
          <div class="section-title">REPORTS</div>
          <div class="nav-links">
            <a href="{{ route('reorder.index') }}" class="nav-link {{ request()->routeIs('reorder.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-exclamation-triangle"></i></div>
              <span class="nav-text">Reorder</span>
            </a>
            <a href="{{ route('reports.stock') }}" class="nav-link {{ request()->routeIs('reports.stock') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-grid-3x3-gap"></i></div>
              <span class="nav-text">Stock Report</span>
            </a>
            <a href="{{ route('reports.movements') }}" class="nav-link {{ request()->routeIs('reports.movements') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-activity"></i></div>
              <span class="nav-text">Movements</span>
            </a>
          </div>
        </div>
      @endif

      {{-- ADMIN --}}
      @if($role === 'Admin')
        <div class="sidebar-section">
          <div class="section-title">ADMIN</div>
          <div class="nav-links">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
              <div class="nav-icon"><i class="bi bi-people"></i></div>
              <span class="nav-text">Users</span>
            </a>
          </div>
        </div>
      @endif
    </div>
  </aside>

  {{-- ===== Main Content ===== --}}
  <main class="app-container">
    {{ $slot }}
  </main>
@endauth

@guest
  <main style="min-height: 100vh;">
    {{ $slot }}
  </main>
@endguest

<script>
function toggleSidebar() {
  document.body.classList.toggle('sidebar-open');
}
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && document.body.classList.contains('sidebar-open')) {
    toggleSidebar();
  }
});
window.addEventListener('resize', () => {
  if (window.innerWidth > 991) {
    document.body.classList.remove('sidebar-open');
  }
});
</script>
</body>
</html>