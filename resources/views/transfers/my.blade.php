<?php>
<x-app-layout>
  <style>
    /* ===== My Transfer Requests Page Styles ===== */
    .my-transfers-page {
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

    /* ===== Alerts ===== */
    .alert-custom {
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .alert-success-custom {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border: 1px solid #6ee7b7;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
    }

    .alert-warning-custom {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #fcd34d;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15);
    }

    .alert-error-custom {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border: 1px solid #fecaca;
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

    .alert-icon.warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
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

    .alert-content.success { color: #065f46; }
    .alert-content.warning { color: #92400e; }
    .alert-content.error { color: #991b1b; }

    .alert-close {
      background: rgba(0, 0, 0, 0.05);
      border: none;
      border-radius: 10px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .alert-close:hover {
      background: rgba(0, 0, 0, 0.1);
    }

    /* ===== Filter Card ===== */
    .filter-card {
      background: white;
      border-radius: 16px;
      padding: 24px 28px;
      margin-bottom: 28px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .filter-form {
      display: flex;
      gap: 16px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .filter-group.search {
      flex: 1;
      min-width: 280px;
    }

    .filter-group.status {
      min-width: 160px;
    }

    .filter-label {
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
    }

    .filter-input-group {
      position: relative;
      display: flex;
      align-items: center;
    }

    .filter-input-group i {
      position: absolute;
      left: 16px;
      color: #94a3b8;
      font-size: 18px;
      z-index: 1;
    }

    .filter-input {
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

    .filter-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .filter-input:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .filter-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .filter-select {
      width: 100%;
      padding: 14px 16px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 16px 12px;
      padding-right: 48px;
    }

    .filter-select:hover {
      border-color: #cbd5e1;
      background-color: white;
    }

    .filter-select:focus {
      outline: none;
      border-color: #6366f1;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-filter {
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

    .btn-filter:hover {
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

    .data-table-wrapper {
      overflow-x: auto;
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
      padding: 16px 20px;
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      text-align: left;
      white-space: nowrap;
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
      padding: 18px 20px;
      font-size: 14px;
      color: #334155;
      vertical-align: middle;
    }

    .data-table tbody td.text-center {
      text-align: center;
    }

    .data-table tbody td.text-end {
      text-align: right;
    }

    /* ===== Date & Time Cell ===== */
    .datetime-cell {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .datetime-date {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    .datetime-time {
      font-size: 12px;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .datetime-time i {
      font-size: 12px;
    }

    /* ===== Product Cell ===== */
    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 18px;
    }

    .product-details {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .product-sku {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 14px;
      letter-spacing: 0.5px;
    }

    .product-name {
      font-size: 13px;
      color: #64748b;
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Transfer Route Cell ===== */
    .transfer-route {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .warehouse-badge {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 10px;
    }

    .warehouse-badge i {
      color: #64748b;
      font-size: 14px;
    }

    .warehouse-badge span {
      font-weight: 600;
      color: #475569;
      font-size: 13px;
    }

    .route-arrow {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    .route-arrow i {
      color: white;
      font-size: 14px;
    }

    /* ===== Quantity Badge ===== */
    .qty-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 48px;
      padding: 10px 16px;
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4338ca;
      border-radius: 10px;
      font-weight: 700;
      font-size: 15px;
    }

    /* ===== Status Badges ===== */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .status-badge.pending {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .status-badge.approved {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .status-badge.rejected {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .status-badge i {
      font-size: 12px;
    }

    /* ===== Reference Cell ===== */
    .reference-cell {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .reference-text {
      font-size: 13px;
      color: #64748b;
      max-width: 150px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .reason-text {
      font-size: 12px;
      color: #94a3b8;
      font-style: italic;
    }

    /* ===== Action Buttons ===== */
    .action-group {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }

    .btn-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 10px;
      font-size: 16px;
      text-decoration: none;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .btn-view {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #475569;
    }

    .btn-view:hover {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-edit {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    .btn-edit:hover {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-cancel-action {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #dc2626;
    }

    .btn-cancel-action:hover {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

    /* ===== Table Footer ===== */
    .table-footer {
      padding: 20px 24px;
      border-top: 1px solid #f1f5f9;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .record-count {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #64748b;
    }

    .record-count span {
      font-weight: 700;
      color: #0f172a;
    }

    /* ===== Pagination ===== */
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
    @media (max-width: 1200px) {
      .transfer-route {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }

      .route-arrow {
        transform: rotate(90deg);
      }
    }

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

      .filter-form {
        flex-direction: column;
      }

      .filter-group.search,
      .filter-group.status {
        width: 100%;
        min-width: unset;
      }

      .btn-filter {
        width: 100%;
        justify-content: center;
      }

      .data-table {
        min-width: 900px;
      }

      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>

  <div class="my-transfers-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">My Transfer Requests</h1>
          <p class="page-subtitle">
            <i class="bi bi-arrow-left-right"></i>
            Track and manage your stock transfer requests
          </p>
        </div>
        <a href="{{ route('transfers.create') }}" class="btn-new">
          <i class="bi bi-plus-circle"></i>
          New Request
        </a>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-lg"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Warning Alert --}}
    @if(session('warning'))
      <div class="alert-custom alert-warning-custom">
        <div class="alert-icon warning">
          <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="alert-content warning">{{ session('warning') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Error Alert --}}
    @if($errors->any())
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-x-circle"></i>
        </div>
        <div class="alert-content error">{{ $errors->first() }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Filter Card --}}
    <div class="filter-card">
      <form method="GET" class="filter-form">
        <div class="filter-group search">
          <label class="filter-label">Search</label>
          <div class="filter-input-group">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="filter-input" 
              value="{{ $q ?? '' }}" 
              placeholder="SKU, product, warehouse, reason..."
            >
          </div>
        </div>

        <div class="filter-group status">
          <label class="filter-label">Status</label>
          @php $s = $status ?? 'all'; @endphp
          <select name="status" class="filter-select">
            <option value="all" {{ $s === 'all' ? 'selected' : '' }}>All Status</option>
            <option value="pending" {{ $s === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $s === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ $s === 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
        </div>

        <button type="submit" class="btn-filter">
          <i class="bi bi-funnel"></i>
          Filter
        </button>

        @if(($q ?? '') || ($status ?? 'all') !== 'all')
          <a href="{{ route('transfers.my') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
          </a>
        @endif
      </form>
    </div>

    {{-- Transfer Requests Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Product</th>
              <th>Transfer Route</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Status</th>
              <th>Reference</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $r)
              <tr>
                {{-- Date & Time --}}
                <td>
                  <div class="datetime-cell">
                    <span class="datetime-date">{{ \Carbon\Carbon::parse($r->created_at)->format('M d, Y') }}</span>
                    <span class="datetime-time">
                      <i class="bi bi-clock"></i>
                      {{ \Carbon\Carbon::parse($r->created_at)->format('h:i A') }}
                    </span>
                  </div>
                </td>

                {{-- Product --}}
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="product-details">
                      <span class="product-sku">{{ $r->sku ?? 'N/A' }}</span>
                      <span class="product-name" title="{{ $r->product_name ?? '' }}">{{ $r->product_name ?? 'Unknown Product' }}</span>
                    </div>
                  </div>
                </td>

                {{-- Transfer Route --}}
                <td>
                  <div class="transfer-route">
                    <div class="warehouse-badge">
                      <i class="bi bi-building"></i>
                      <span>{{ $r->from_warehouse ?? 'N/A' }}</span>
                    </div>
                    <div class="route-arrow">
                      <i class="bi bi-arrow-right"></i>
                    </div>
                    <div class="warehouse-badge">
                      <i class="bi bi-building-fill"></i>
                      <span>{{ $r->to_warehouse ?? 'N/A' }}</span>
                    </div>
                  </div>
                </td>

                {{-- Quantity --}}
                <td class="text-center">
                  <span class="qty-badge">{{ number_format($r->qty ?? 0) }}</span>
                </td>

                {{-- Status --}}
                <td class="text-center">
                  @php
                    $statusIcons = [
                      'pending'  => 'bi-hourglass-split',
                      'approved' => 'bi-check-circle-fill',
                      'rejected' => 'bi-x-circle-fill',
                    ];
                    $statusIcon = $statusIcons[$r->status] ?? 'bi-circle';
                  @endphp
                  <span class="status-badge {{ $r->status }}">
                    <i class="bi {{ $statusIcon }}"></i>
                    {{ strtoupper($r->status) }}
                  </span>
                </td>

                {{-- Reference --}}
                <td>
                  <div class="reference-cell">
                    @if(!empty($r->reference))
                      <span class="reference-text" title="{{ $r->reference }}">{{ $r->reference }}</span>
                    @endif
                    @if(!empty($r->reason))
                      <span class="reason-text" title="{{ $r->reason }}">{{ Str::limit($r->reason, 25) }}</span>
                    @endif
                    @if(empty($r->reference) && empty($r->reason))
                      <span style="color: #94a3b8;">—</span>
                    @endif
                  </div>
                </td>

                {{-- Actions --}}
                <td>
                  <div class="action-group">
                    {{-- View Button --}}
                    @if(Route::has('transfers.show'))
                      <a href="{{ route('transfers.show', $r->id) }}" class="btn-action btn-view" title="View Details">
                        <i class="bi bi-eye"></i>
                      </a>
                    @endif

                    {{-- Edit Button (only for pending) --}}
                    @if($r->status === 'pending' && Route::has('transfers.edit'))
                      <a href="{{ route('transfers.edit', $r->id) }}" class="btn-action btn-edit" title="Edit Request">
                        <i class="bi bi-pencil"></i>
                      </a>
                    @endif

                    {{-- Cancel Button (only for pending) --}}
                    @if($r->status === 'pending' && Route::has('transfers.cancel'))
                      <form method="POST" action="{{ route('transfers.cancel', $r->id) }}" class="d-inline" onsubmit="return confirm('Cancel this transfer request?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-cancel-action" title="Cancel Request">
                          <i class="bi bi-x-lg"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <h4 class="empty-state-title">No transfer requests found</h4>
                    <p class="empty-state-text">Create your first transfer request to move stock between warehouses</p>
                    <a href="{{ route('transfers.create') }}" class="btn-empty-action">
                      <i class="bi bi-plus-circle"></i>
                      New Request
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Table Footer with Pagination --}}
      @if($items->count())
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $items->firstItem() ?? 0 }}</span> to <span>{{ $items->lastItem() ?? 0 }}</span> of <span>{{ $items->total() }}</span> requests
          </div>
          @if($items->hasPages())
            {{ $items->withQueryString()->links() }}
          @endif
        </div>
      @endif
    </div>
  </div>
</x-app-layout>