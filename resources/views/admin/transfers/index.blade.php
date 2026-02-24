<?php>
<x-app-layout>
  <style>
    /* ===== Transfers Page Styles ===== */
    .transfers-page {
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

    .page-title-section {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .page-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
    }

    .page-icon i {
      font-size: 24px;
      color: white;
    }

    .page-title {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      margin: 0 0 6px 0;
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

    .page-subtitle i {
      font-size: 14px;
    }

    .pending-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 2px solid #fbbf24;
      border-radius: 14px;
      color: #92400e;
      font-size: 15px;
      font-weight: 700;
      box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .pending-badge i {
      font-size: 20px;
    }

    .pending-badge .count {
      font-size: 20px;
    }

    /* ===== Stats Cards ===== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    .stat-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
    }

    .stat-card.pending::before {
      background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-card.today::before {
      background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
    }

    .stat-card.week::before {
      background: linear-gradient(180deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .stat-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .stat-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-icon.pending {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .stat-icon.pending i {
      color: #d97706;
    }

    .stat-icon.today {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .stat-icon.today i {
      color: #2563eb;
    }

    .stat-icon.week {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
    }

    .stat-icon.week i {
      color: #7c3aed;
    }

    .stat-icon i {
      font-size: 20px;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
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
      border: 1px solid #fbbf24;
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

    .alert-content.success {
      color: #065f46;
    }

    .alert-content.warning {
      color: #92400e;
    }

    .alert-content.error {
      color: #991b1b;
    }

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

    .alert-close.success {
      color: #065f46;
    }

    .alert-close.warning {
      color: #92400e;
    }

    .alert-close.error {
      color: #991b1b;
    }

    /* ===== Data Card ===== */
    .data-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }

    .data-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
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
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.02) 0%, rgba(217, 119, 6, 0.02) 100%);
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
      gap: 12px;
    }

    .date-icon {
      width: 40px;
      height: 40px;
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
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Warehouse Badges ===== */
    .warehouse-cell {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .warehouse-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
    }

    .warehouse-badge.from {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .warehouse-badge.to {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .warehouse-badge i {
      font-size: 14px;
    }

    /* ===== Transfer Arrow ===== */
    .transfer-flow {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .transfer-arrow {
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .transfer-arrow i {
      color: white;
      font-size: 14px;
    }

    /* ===== Quantity Badge ===== */
    .qty-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 20px;
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      color: white;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      font-variant-numeric: tabular-nums;
      box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);
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
      font-size: 14px;
      font-weight: 700;
      color: white;
    }

    .user-name {
      font-weight: 500;
      color: #475569;
      font-size: 14px;
    }

    /* ===== Action Buttons ===== */
    .action-group {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }

    .btn-approve {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 18px;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-approve:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-reject {
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

    .btn-reject:hover {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #dc2626;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(239, 68, 68, 0.2);
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 80px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-radius: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .empty-state-icon i {
      font-size: 44px;
      color: #10b981;
    }

    .empty-state-title {
      font-size: 22px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 15px;
      margin: 0;
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

    /* ===== Responsive ===== */
    @media (max-width: 1200px) {
      .stats-grid {
        grid-template-columns: repeat(3, 1fr);
      }

      .transfer-flow {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }

      .transfer-arrow {
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

      .page-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .pending-badge {
        width: 100%;
        justify-content: center;
      }

      .stats-grid {
        grid-template-columns: 1fr;
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

      .action-group {
        flex-direction: column;
      }

      .btn-approve,
      .btn-reject {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  @php
    $pendingCount = $items->count();
    $todayCount = $items->filter(fn($item) => \Illuminate\Support\Carbon::parse($item->created_at)->isToday())->count();
    $weekCount = $items->filter(fn($item) => \Illuminate\Support\Carbon::parse($item->created_at)->isCurrentWeek())->count();
  @endphp

  <div class="transfers-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div>
            <h1 class="page-title">Pending Transfers</h1>
            <p class="page-subtitle">
              <i class="bi bi-hourglass-split"></i>
              Review and process warehouse transfer requests
            </p>
          </div>
        </div>
        <div class="pending-badge">
          <i class="bi bi-clock-history"></i>
          <span class="count">{{ $pendingCount }}</span> awaiting approval
        </div>
      </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
      {{-- Pending --}}
      <div class="stat-card pending">
        <div class="stat-card-header">
          <div class="stat-icon pending">
            <i class="bi bi-hourglass-split"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($pendingCount) }}</div>
        <div class="stat-label">Pending Transfers</div>
      </div>

      {{-- Today --}}
      <div class="stat-card today">
        <div class="stat-card-header">
          <div class="stat-icon today">
            <i class="bi bi-calendar-check"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($todayCount) }}</div>
        <div class="stat-label">Requested Today</div>
      </div>

      {{-- This Week --}}
      <div class="stat-card week">
        <div class="stat-card-header">
          <div class="stat-icon week">
            <i class="bi bi-calendar-week"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($weekCount) }}</div>
        <div class="stat-label">This Week</div>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close success" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Warning Alert --}}
    @if(session('warning'))
      <div class="alert-custom alert-warning-custom">
        <div class="alert-icon warning">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content warning">{{ session('warning') }}</div>
        <button type="button" class="alert-close warning" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Error Alert --}}
    @if($errors->any())
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="alert-content error">{{ $errors->first() }}</div>
        <button type="button" class="alert-close error" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Transfers Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Product</th>
              <th>Transfer Route</th>
              <th class="text-center">Quantity</th>
              <th>Requested By</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $r)
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
                      <span class="product-name" title="{{ $r->product }}">{{ $r->product }}</span>
                    </div>
                  </div>
                </td>

                {{-- Transfer Route --}}
                <td>
                  <div class="transfer-flow">
                    <span class="warehouse-badge from">
                      <i class="bi bi-building"></i>
                      {{ $r->from_code }}
                    </span>
                    <div class="transfer-arrow">
                      <i class="bi bi-arrow-right"></i>
                    </div>
                    <span class="warehouse-badge to">
                      <i class="bi bi-building-check"></i>
                      {{ $r->to_code }}
                    </span>
                  </div>
                </td>

                {{-- Quantity --}}
                <td class="text-center">
                  <span class="qty-badge">{{ number_format($r->qty) }}</span>
                </td>

                {{-- Requested By --}}
                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      {{ strtoupper(substr($r->requested_by, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ $r->requested_by }}</span>
                  </div>
                </td>

                {{-- Actions --}}
                <td>
                  <div class="action-group">
                    <form method="POST" action="{{ route('admin.transfers.approve', $r->id) }}" 
                          onsubmit="return confirm('Approve this transfer request?');">
                      @csrf
                      <button type="submit" class="btn-approve">
                        <i class="bi bi-check-lg"></i>
                        Approve
                      </button>
                    </form>
                    <form method="POST" action="{{ route('admin.transfers.reject', $r->id) }}" 
                          onsubmit="return confirm('Reject this transfer request?');">
                      @csrf
                      <button type="submit" class="btn-reject">
                        <i class="bi bi-x-lg"></i>
                        Reject
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <h4 class="empty-state-title">All Clear!</h4>
                    <p class="empty-state-text">No pending transfer requests at the moment</p>
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
            Showing <span>{{ $items->count() }}</span> pending transfer{{ $items->count() !== 1 ? 's' : '' }}
          </div>
        </div>
      @endif
    </div>
  </div>

  <script>
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert-custom');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          alert.style.opacity = '0';
          alert.style.transform = 'translateY(-10px)';
          alert.style.transition = 'all 0.3s ease';
          setTimeout(() => alert.remove(), 300);
        }, 5000);
      });
    });
  </script>
</x-app-layout>