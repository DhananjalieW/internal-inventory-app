<?php>
<x-app-layout>
  <style>
    /* ===== Warehouses Page Styles ===== */
    .warehouses-page {
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

    .readonly-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(99, 102, 241, 0.15);
      border: 1px solid rgba(99, 102, 241, 0.3);
      border-radius: 12px;
      color: #a5b4fc;
      font-size: 14px;
      font-weight: 600;
    }

    /* ===== Alerts ===== */
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

    .alert-error-custom {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border: 1px solid #fecaca;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
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

    .alert-icon.error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .alert-icon i {
      color: white;
      font-size: 22px;
    }

    .alert-content {
      flex: 1;
      font-size: 15px;
      font-weight: 500;
    }

    .alert-content.success {
      color: #065f46;
    }

    .alert-content.error {
      color: #991b1b;
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

    /* ===== Code Badge ===== */
    .code-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .code-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .code-icon i {
      color: white;
      font-size: 16px;
    }

    .code-text {
      font-family: 'SF Mono', 'Fira Code', 'Courier New', monospace;
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
    }

    /* ===== Warehouse Name ===== */
    .warehouse-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 15px;
    }

    /* ===== Location ===== */
    .location-text {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      font-size: 14px;
    }

    .location-text i {
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 24px 0;
      gap: 20px;
      flex-wrap: wrap;
    }

    .pagination-info {
      color: #64748b;
      font-size: 14px;
      font-weight: 500;
    }

    .pagination-info strong {
      color: #0f172a;
      font-weight: 700;
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

      .pagination-wrapper {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
      }

      .pagination {
        justify-content: center;
      }
    }
  </style>

  <div class="warehouses-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Warehouses</h1>
          <p class="page-subtitle">
            <i class="bi bi-building"></i>
            Manage locations and availability
          </p>
        </div>
        
        @if(!($isViewer ?? false))
          <a href="{{ route('warehouses.create') }}" class="btn-new">
            <i class="bi bi-plus-circle"></i>
            Add Warehouse
          </a>
        @else
          <span class="readonly-badge">
            <i class="bi bi-shield-lock"></i>
            Read-Only Access
          </span>
        @endif
      </div>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">
          <strong>Please fix the following errors:</strong>
          <ul style="margin: 8px 0 0 0; padding-left: 18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    {{-- Success Alert --}}
    @if (session('success'))
      <div class="alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-lg"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Warehouses Table --}}
    <div class="data-card">
      <table class="data-table">
        <thead>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Location</th>
            <th class="text-center">Status</th>
            @if(!($isViewer ?? false))
              <th class="text-end">Actions</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($rows as $w)
            <tr>
              <td>
                <div class="code-badge">
                  <div class="code-icon">
                    <i class="bi bi-building"></i>
                  </div>
                  <span class="code-text">{{ $w->code }}</span>
                </div>
              </td>
              <td>
                <span class="warehouse-name">{{ $w->name }}</span>
              </td>
              <td>
                <div class="location-text">
                  <i class="bi bi-geo-alt"></i>
                  <span>{{ $w->location ?: '—' }}</span>
                </div>
              </td>
              <td class="text-center">
                @if($w->is_active)
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
              @if(!($isViewer ?? false))
                <td>
                  <div class="action-group">
                    <a href="{{ route('warehouses.edit', $w) }}" class="btn-edit">
                      <i class="bi bi-pencil-square"></i>
                      Edit
                    </a>
                    <form action="{{ route('warehouses.destroy', $w) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete {{ $w->name }}?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-delete">
                        <i class="bi bi-trash"></i>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              @endif
            </tr>
          @empty
            <tr>
              <td colspan="{{ ($isViewer ?? false) ? '4' : '5' }}">
                <div class="empty-state">
                  <div class="empty-state-icon">
                    <i class="bi bi-building"></i>
                  </div>
                  <h4 class="empty-state-title">No warehouses found</h4>
                  <p class="empty-state-text">Get started by adding your first warehouse</p>
                  @if(!($isViewer ?? false))
                    <a href="{{ route('warehouses.create') }}" class="btn-empty-action">
                      <i class="bi bi-plus-circle"></i>
                      Add Warehouse
                    </a>
                  @endif
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if($rows->hasPages())
      <div class="pagination-wrapper">
        <div class="pagination-info">
          Showing <strong>{{ $rows->firstItem() }}</strong> to <strong>{{ $rows->lastItem() }}</strong> 
          of <strong>{{ number_format($rows->total()) }}</strong> warehouses
        </div>
        {{ $rows->links() }}
      </div>
    @endif
  </div>
</x-app-layout>