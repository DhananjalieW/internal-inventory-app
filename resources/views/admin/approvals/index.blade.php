{{-- resources/views/admin/approvals/index.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Approvals Page Styles ===== */
    .approvals-page {
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

    /* ===== Stats Cards ===== */
    .stats-row {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
    }

    .stat-card {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 14px;
      padding: 16px 24px;
      backdrop-filter: blur(10px);
      min-width: 140px;
    }

    .stat-label {
      font-size: 12px;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 4px;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 700;
      color: white;
    }

    .stat-value.warning {
      color: #fbbf24;
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

    .data-table thead th.text-center { text-align: center; }
    .data-table thead th.text-end { text-align: right; }

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

    .data-table tbody td.text-center { text-align: center; }
    .data-table tbody td.text-end { text-align: right; }

    /* ===== Date Cell ===== */
    .date-cell {
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
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .time-text i {
      font-size: 12px;
    }

    /* ===== User Cell ===== */
    .user-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .user-avatar i {
      color: white;
      font-size: 18px;
    }

    .user-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    /* ===== Type Badges ===== */
    .type-badge {
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

    .type-badge.in {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .type-badge.out {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .type-badge.adjust {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #475569;
    }

    .type-badge.transfer {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .type-badge.po {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    .type-badge i {
      font-size: 12px;
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

    /* ===== SKU Badge ===== */
    .sku-badge {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 13px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      padding: 6px 12px;
      border-radius: 8px;
      letter-spacing: 0.5px;
    }

    /* ===== Product Cell ===== */
    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 40px;
      height: 40px;
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

    .product-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Warehouse Badge ===== */
    .warehouse-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
      border: 1px solid #bbf7d0;
      border-radius: 10px;
    }

    .warehouse-badge i {
      color: #16a34a;
      font-size: 14px;
    }

    .warehouse-badge span {
      font-weight: 600;
      color: #166534;
      font-size: 13px;
    }

    /* ===== Reference Cell ===== */
    .reference-text {
      color: #64748b;
      font-size: 13px;
      max-width: 120px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
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
      background: white;
      color: #dc2626;
      border: 2px solid #fecaca;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-reject:hover {
      background: #fef2f2;
      border-color: #ef4444;
      transform: translateY(-2px);
    }

    .btn-approve i,
    .btn-reject i {
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
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 15px;
      margin-bottom: 0;
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
      .action-group {
        flex-direction: column;
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

      .stats-row {
        width: 100%;
      }

      .stat-card {
        flex: 1;
        min-width: 100px;
      }

      .data-table-wrapper {
        overflow-x: auto;
      }

      .data-table {
        min-width: 1000px;
      }

      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>

  @php
    $list = $list ?? collect();
    
    // Count by type
    $typeCount = $list->groupBy(function($item) {
      return strtoupper($item->movement_type ?? 'OTHER');
    })->map->count();
  @endphp

  <div class="approvals-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Pending Approvals</h1>
          <p class="page-subtitle">
            <i class="bi bi-shield-check"></i>
            Review and process pending inventory requests
          </p>
        </div>
        <div class="stats-row">
          <div class="stat-card">
            <div class="stat-label">Total Pending</div>
            <div class="stat-value warning">{{ $list->count() }}</div>
          </div>
          @if($typeCount->get('TRANSFER', 0) > 0)
            <div class="stat-card">
              <div class="stat-label">Transfers</div>
              <div class="stat-value">{{ $typeCount->get('TRANSFER', 0) }}</div>
            </div>
          @endif
          @if($typeCount->get('PO', 0) > 0)
            <div class="stat-card">
              <div class="stat-label">PO Receipts</div>
              <div class="stat-value">{{ $typeCount->get('PO', 0) }}</div>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">{{ session('error') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Approvals Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Requested By</th>
              <th class="text-center">Type</th>
              <th class="text-end">Qty</th>
              <th>SKU</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th>Reference</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $r)
              @php
                $kind = strtoupper($r->movement_type ?? '');
                $typeClass = match($kind) {
                  'IN' => 'in',
                  'OUT' => 'out',
                  'ADJUST' => 'adjust',
                  'TRANSFER' => 'transfer',
                  'PO' => 'po',
                  default => 'adjust'
                };
                $typeIcon = match($kind) {
                  'IN' => 'bi-arrow-down-circle-fill',
                  'OUT' => 'bi-arrow-up-circle-fill',
                  'ADJUST' => 'bi-sliders',
                  'TRANSFER' => 'bi-arrow-left-right',
                  'PO' => 'bi-receipt',
                  default => 'bi-circle'
                };
              @endphp
              <tr>
                {{-- Date & Time --}}
                <td>
                  <div class="date-cell">
                    <span class="date-text">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</span>
                    <span class="time-text">
                      <i class="bi bi-clock"></i>
                      {{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}
                    </span>
                  </div>
                </td>

                {{-- User --}}
                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="user-name">{{ $r->user ?? '—' }}</span>
                  </div>
                </td>

                {{-- Type --}}
                <td class="text-center">
                  <span class="type-badge {{ $typeClass }}">
                    <i class="bi {{ $typeIcon }}"></i>
                    {{ $kind ?: '—' }}
                  </span>
                </td>

                {{-- Quantity --}}
                <td class="text-end">
                  <span class="qty-badge">{{ number_format((int) $r->qty) }}</span>
                </td>

                {{-- SKU --}}
                <td>
                  <span class="sku-badge">{{ $r->sku ?? '—' }}</span>
                </td>

                {{-- Product --}}
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <span class="product-name" title="{{ $r->product }}">{{ $r->product ?? '—' }}</span>
                  </div>
                </td>

                {{-- Warehouse --}}
                <td>
                  @if($r->warehouse)
                    <div class="warehouse-badge">
                      <i class="bi bi-building"></i>
                      <span>{{ $r->warehouse }}</span>
                    </div>
                  @else
                    <span style="color: #94a3b8;">—</span>
                  @endif
                </td>

                {{-- Reference --}}
                <td>
                  @if($r->reference)
                    <span class="reference-text" title="{{ $r->reference }}">{{ $r->reference }}</span>
                  @else
                    <span style="color: #94a3b8;">—</span>
                  @endif
                </td>

                {{-- Actions --}}
                <td>
                  <div class="action-group">
                    <form method="POST" action="{{ route('admin.approvals.approve', $r->id) }}">
                      @csrf
                      <input type="hidden" name="type" value="{{ $r->type }}">
                      <button type="submit" class="btn-approve">
                        <i class="bi bi-check-circle"></i>
                        Approve
                      </button>
                    </form>
                    <form method="POST" action="{{ route('admin.approvals.reject', $r->id) }}"
                          onsubmit="return confirm('Are you sure you want to reject this request?');">
                      @csrf
                      <input type="hidden" name="type" value="{{ $r->type }}">
                      <button type="submit" class="btn-reject">
                        <i class="bi bi-x-circle"></i>
                        Reject
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <h4 class="empty-state-title">All Caught Up!</h4>
                    <p class="empty-state-text">No pending approvals at the moment. Great job!</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($list->count() > 0)
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $list->count() }}</span> pending {{ Str::plural('request', $list->count()) }}
          </div>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>