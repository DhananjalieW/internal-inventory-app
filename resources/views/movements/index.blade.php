<?php>
<x-app-layout>
  <style>
    /* ===== Movements Page Styles ===== */
    .movements-page {
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

    .viewer-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(99, 102, 241, 0.15);
      border: 1px solid rgba(99, 102, 241, 0.3);
      border-radius: 12px;
      color: #a5b4fc;
      font-size: 14px;
      font-weight: 500;
    }

    .viewer-badge i {
      font-size: 16px;
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
      padding: 18px 24px;
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

    /* ===== Date Cell ===== */
    .date-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .date-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .date-icon i {
      color: #64748b;
      font-size: 16px;
    }

    .date-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .date-text {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    .time-text {
      font-size: 12px;
      color: #94a3b8;
    }

    /* ===== Product Cell ===== */
    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 20px;
    }

    .product-info {
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
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Warehouse Cell ===== */
    .warehouse-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .warehouse-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 16px;
    }

    .warehouse-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .warehouse-code {
      font-weight: 700;
      color: #0f172a;
      font-size: 14px;
    }

    .warehouse-name {
      font-size: 12px;
      color: #94a3b8;
      max-width: 160px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Type Badges ===== */
    .type-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
    }

    .type-badge.in {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .type-badge.out {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .type-badge.adjust {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    .type-badge i {
      font-size: 14px;
    }

    /* ===== Quantity Badge ===== */
    .qty-badge {
      display: inline-flex;
      align-items: center;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      font-variant-numeric: tabular-nums;
    }

    .qty-badge.positive {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .qty-badge.negative {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .qty-badge.neutral {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #475569;
    }

    /* ===== Reference Cell ===== */
    .reference-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .reference-text {
      color: #64748b;
      font-size: 13px;
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .btn-attachment {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 8px;
      color: #64748b;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-attachment:hover {
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4f46e5;
      transform: translateY(-2px);
    }

    .btn-attachment i {
      font-size: 14px;
    }

    /* ===== User Cell ===== */
    .user-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .user-avatar i {
      color: white;
      font-size: 16px;
    }

    .user-name {
      font-weight: 500;
      color: #475569;
      font-size: 14px;
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

      .data-table-wrapper {
        overflow-x: auto;
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

  <div class="movements-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Stock Movements</h1>
          <p class="page-subtitle">
            <i class="bi bi-arrow-left-right"></i>
            Track all inventory transactions
          </p>
        </div>
        @if(!($isViewer ?? false))
          <a href="{{ route('movements.create') }}" class="btn-new">
            <i class="bi bi-plus-circle"></i>
            Record Movement
          </a>
        @else
          <div class="viewer-badge">
            <i class="bi bi-shield-lock"></i>
            Read-Only Access
          </div>
        @endif
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
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
          <label class="search-label">Search Movements</label>
          <div class="search-input-group">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="search-input" 
              value="{{ $q ?? '' }}" 
              placeholder="Search by product, SKU, reference, or user..."
            >
          </div>
        </div>
        <button type="submit" class="btn-search">
          <i class="bi bi-funnel"></i>
          Search
        </button>
        @if(!empty($q))
          <a href="{{ route('movements.index') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
          </a>
        @endif
      </form>
    </div>

    {{-- Movements Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th class="text-center">Type</th>
              <th class="text-end">Quantity</th>
              <th>Reference</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($items as $r)
              @php
                $sign = $r->type === 'IN' ? '+' : ($r->type === 'OUT' ? '-' : '±');
                $qtyClass = $r->type === 'IN' ? 'positive' : ($r->type === 'OUT' ? 'negative' : 'neutral');
              @endphp
              <tr>
                {{-- Date --}}
                <td>
                  <div class="date-cell">
                    <div class="date-icon">
                      <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="date-info">
                      <span class="date-text">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</span>
                      <span class="time-text">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}</span>
                    </div>
                  </div>
                </td>

                {{-- Product --}}
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="product-info">
                      <span class="product-sku">{{ $r->sku }}</span>
                      <span class="product-name" title="{{ $r->product_name }}">{{ $r->product_name }}</span>
                    </div>
                  </div>
                </td>

                {{-- Warehouse --}}
                <td>
                  <div class="warehouse-cell">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="warehouse-info">
                      <span class="warehouse-code">{{ $r->wh_code }}</span>
                      <span class="warehouse-name" title="{{ $r->wh_name }}">{{ $r->wh_name }}</span>
                    </div>
                  </div>
                </td>

                {{-- Type --}}
                <td class="text-center">
                  @if($r->type === 'IN')
                    <span class="type-badge in">
                      <i class="bi bi-arrow-down-circle-fill"></i>
                      IN
                    </span>
                  @elseif($r->type === 'OUT')
                    <span class="type-badge out">
                      <i class="bi bi-arrow-up-circle-fill"></i>
                      OUT
                    </span>
                  @else
                    <span class="type-badge adjust">
                      <i class="bi bi-sliders"></i>
                      ADJUST
                    </span>
                  @endif
                </td>

                {{-- Quantity --}}
                <td class="text-end">
                  <span class="qty-badge {{ $qtyClass }}">
                    {{ $sign }}{{ number_format($r->qty) }}
                  </span>
                </td>

                {{-- Reference --}}
                <td>
                  <div class="reference-cell">
                    <span class="reference-text" title="{{ $r->reference }}">
                      {{ $r->reference ?: '—' }}
                    </span>
                    @if(!empty($r->attachment_path))
                      <a href="{{ \Illuminate\Support\Facades\Storage::url($r->attachment_path) }}" 
                         target="_blank" 
                         class="btn-attachment"
                         title="View attachment">
                        <i class="bi bi-paperclip"></i>
                      </a>
                    @endif
                  </div>
                </td>

                {{-- User --}}
                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      <i class="bi bi-person"></i>
                    </div>
                    <span class="user-name">{{ $r->user_name ?? '—' }}</span>
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
                    <h4 class="empty-state-title">No movements found</h4>
                    <p class="empty-state-text">Start by recording your first stock movement</p>
                    @if(!($isViewer ?? false))
                      <a href="{{ route('movements.create') }}" class="btn-empty-action">
                        <i class="bi bi-plus-circle"></i>
                        Record Movement
                      </a>
                    @endif
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Table Footer --}}
      @if($items->count() > 0)
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $items->count() }}</span> records
            @if(method_exists($items, 'total'))
              of <span>{{ $items->total() }}</span> total
            @endif
          </div>
          @if(method_exists($items, 'links'))
            {{ $items->links() }}
          @endif
        </div>
      @endif
    </div>
  </div>
</x-app-layout>