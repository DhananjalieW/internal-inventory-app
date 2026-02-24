<?php>
<x-app-layout>
  <style>
    /* ===== Suppliers Page Styles ===== */
    .suppliers-page {
      padding: 0;
    }

    /* ===== Page Header ===== */
    .page-header {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
      border-radius: 20px;
      padding: 32px 40px;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: 10%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header-content {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .page-title {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      margin: 0 0 8px 0;
      letter-spacing: -0.5px;
    }

    .page-subtitle {
      color: #94a3b8;
      font-size: 1rem;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-new {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border: none;
      border-radius: 14px;
      color: white;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-new:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
      color: white;
    }

    .btn-new i {
      font-size: 18px;
    }

    /* ===== Alert Success ===== */
    .alert-success-custom {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border: 1px solid #6ee7b7;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
    }

    .alert-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .alert-icon.success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .alert-icon i {
      color: white;
      font-size: 22px;
    }

    .alert-content {
      flex: 1;
      font-size: 15px;
      font-weight: 500;
      color: #065f46;
    }

    .alert-close {
      background: rgba(6, 95, 70, 0.1);
      border: none;
      border-radius: 10px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #065f46;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .alert-close:hover {
      background: rgba(6, 95, 70, 0.2);
    }

    /* ===== Search Card ===== */
    .search-card {
      background: white;
      border-radius: 16px;
      padding: 24px 28px;
      margin-bottom: 28px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .search-form {
      display: flex;
      gap: 16px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .search-input-wrapper {
      flex: 1;
      min-width: 280px;
    }

    .search-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
      margin-bottom: 10px;
    }

    .search-input-group {
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input-group i {
      position: absolute;
      left: 16px;
      color: #94a3b8;
      font-size: 18px;
      z-index: 1;
    }

    .search-input {
      width: 100%;
      padding: 14px 16px 14px 50px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
    }

    .search-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .search-input:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .search-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-search {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #475569;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      border-color: #6366f1;
      color: #6366f1;
      background: white;
    }

    .btn-clear {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 48px;
      height: 48px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #64748b;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-clear:hover {
      border-color: #ef4444;
      color: #ef4444;
      background: #fef2f2;
    }

    /* ===== Data Card ===== */
    .data-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
    }

    .data-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    /* ===== Table ===== */
    .data-table {
      width: 100%;
      border-collapse: collapse;
    }

    .data-table thead {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .data-table thead th {
      padding: 16px 24px;
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      text-align: left;
    }

    .data-table thead th.text-center {
      text-align: center;
    }

    .data-table thead th.text-end {
      text-align: right;
    }

    .data-table tbody tr {
      transition: all 0.2s ease;
      border-bottom: 1px solid #f1f5f9;
    }

    .data-table tbody tr:hover {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
    }

    .data-table tbody tr:last-child {
      border-bottom: none;
    }

    .data-table tbody td {
      padding: 18px 24px;
      font-size: 14px;
      color: #334155;
    }

    .data-table tbody td.text-center {
      text-align: center;
    }

    .data-table tbody td.text-end {
      text-align: right;
    }

    /* ===== Supplier Badge ===== */
    .supplier-badge {
      display: inline-flex;
      align-items: center;
      gap: 12px;
    }

    .supplier-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    .supplier-icon i {
      color: white;
      font-size: 18px;
    }

    .supplier-name {
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
    }

    /* ===== Email Link ===== */
    .email-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #6366f1;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .email-link:hover {
      color: #4f46e5;
      text-decoration: underline;
    }

    .email-link i {
      font-size: 16px;
    }

    /* ===== Phone ===== */
    .phone-text {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      font-size: 14px;
    }

    .phone-text i {
      color: #94a3b8;
    }

    /* ===== Status Badges ===== */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
    }

    .status-badge.active {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .status-badge.inactive {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #64748b;
    }

    /* ===== Action Buttons ===== */
    .action-group {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }

    .btn-edit {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 18px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-edit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .btn-delete {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 18px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #64748b;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-delete:hover {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #dc2626;
      transform: translateY(-2px);
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 80px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .empty-state-icon i {
      font-size: 44px;
      color: #94a3b8;
    }

    .empty-state-title {
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 15px;
      margin-bottom: 28px;
    }

    .btn-empty-action {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 14px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-empty-action:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
      color: white;
    }

    /* ===== Pagination ===== */
    .pagination-wrapper {
      padding: 20px 24px;
      border-top: 1px solid #f1f5f9;
      display: flex;
      justify-content: flex-end;
    }

    /* Override Laravel Pagination Styles */
    .pagination {
      display: flex;
      gap: 6px;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .pagination .page-item .page-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 40px;
      padding: 0 14px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      color: #64748b;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .pagination .page-item .page-link:hover {
      background: #f8fafc;
      border-color: #6366f1;
      color: #6366f1;
    }

    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-color: transparent;
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .pagination .page-item.disabled .page-link {
      background: #f8fafc;
      border-color: #e2e8f0;
      color: #cbd5e1;
      cursor: not-allowed;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .page-header {
        padding: 24px;
      }

      .page-title {
        font-size: 1.5rem;
      }

      .page-header-content {
        flex-direction: column;
        align-items: flex-start;
      }

      .btn-new {
        width: 100%;
        justify-content: center;
      }

      .search-form {
        flex-direction: column;
      }

      .search-input-wrapper {
        width: 100%;
        min-width: unset;
      }

      .btn-search {
        width: 100%;
        justify-content: center;
      }

      .data-table {
        display: block;
        overflow-x: auto;
      }

      .action-group {
        flex-direction: column;
      }

      .btn-edit, .btn-delete {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  <div class="suppliers-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Suppliers</h1>
          <p class="page-subtitle">
            <i class="bi bi-truck"></i>
            Manage supplier contacts and status
          </p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn-new">
          <i class="bi bi-plus-circle"></i>
          New Supplier
        </a>
      </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
      <div class="alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-lg"></i>
        </div>
        <div class="alert-content">{{ session('success') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Search Card --}}
    <div class="search-card">
      <form method="GET" class="search-form">
        <div class="search-input-wrapper">
          <label class="search-label">Search Suppliers</label>
          <div class="search-input-group">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="search-input" 
              value="{{ $q ?? '' }}" 
              placeholder="Search by name, email or phone..."
            >
          </div>
        </div>
        <button type="submit" class="btn-search">
          <i class="bi bi-funnel"></i>
          Search
        </button>
        @if($q ?? '')
          <a href="{{ route('suppliers.index') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
          </a>
        @endif
      </form>
    </div>

    {{-- Suppliers Table --}}
    <div class="data-card">
      <table class="data-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th class="text-center">Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($suppliers as $s)
            <tr>
              <td>
                <div class="supplier-badge">
                  <div class="supplier-icon">
                    <i class="bi bi-truck"></i>
                  </div>
                  <span class="supplier-name">{{ $s->name }}</span>
                </div>
              </td>
              <td>
                @if($s->email)
                  <a href="mailto:{{ $s->email }}" class="email-link">
                    <i class="bi bi-envelope"></i>
                    {{ $s->email }}
                  </a>
                @else
                  <span style="color: #94a3b8;">—</span>
                @endif
              </td>
              <td>
                @if($s->phone)
                  <div class="phone-text">
                    <i class="bi bi-telephone"></i>
                    {{ $s->phone }}
                  </div>
                @else
                  <span style="color: #94a3b8;">—</span>
                @endif
              </td>
              <td class="text-center">
                @if($s->is_active)
                  <span class="status-badge active">
                    <i class="bi bi-check-circle-fill"></i>
                    Active
                  </span>
                @else
                  <span class="status-badge inactive">
                    <i class="bi bi-slash-circle"></i>
                    Inactive
                  </span>
                @endif
              </td>
              <td>
                <div class="action-group">
                  <a href="{{ route('suppliers.edit', $s) }}" class="btn-edit">
                    <i class="bi bi-pencil-square"></i>
                    Edit
                  </a>
                  <form action="{{ route('suppliers.destroy', $s) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                      <i class="bi bi-trash"></i>
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                <div class="empty-state">
                  <div class="empty-state-icon">
                    <i class="bi bi-truck"></i>
                  </div>
                  <h4 class="empty-state-title">No suppliers found</h4>
                  <p class="empty-state-text">Get started by adding your first supplier</p>
                  <a href="{{ route('suppliers.create') }}" class="btn-empty-action">
                    <i class="bi bi-plus-circle"></i>
                    Add Supplier
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      @if($suppliers->hasPages())
        <div class="pagination-wrapper">
          {{ $suppliers->links() }}
        </div>
      @endif
    </div>
  </div>
</x-app-layout>