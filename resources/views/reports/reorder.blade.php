<x-app-layout>
  <div class="container py-4">

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show modern-alert mb-4" role="alert">
        <div class="d-flex align-items-center">
          <div class="alert-icon success-icon me-3">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <div class="flex-grow-1">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    {{-- Header Section --}}
    <div class="row align-items-center mb-4">
      <div class="col">
        <div class="d-flex align-items-center">
          <div class="header-icon-wrapper me-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <div>
            <h1 class="h3 mb-1 fw-bold">Reorder Report</h1>
            <p class="text-muted mb-0 small">Monitor inventory levels and items requiring restocking</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Action Buttons Card --}}
    <div class="card action-card mb-4">
      <div class="card-body p-3">
        <div class="d-flex flex-wrap gap-2 align-items-center">
          <div class="me-auto">
            <span class="text-muted small">
              <i class="bi bi-info-circle me-1"></i>Quick Actions
            </span>
          </div>
          <form method="POST" action="{{ route('reports.email.lowstock') }}" class="mb-0">
            @csrf
            <button class="btn btn-email">
              <i class="bi bi-envelope me-2"></i>Email Low Stock
            </button>
          </form>
          <a class="btn btn-export-csv" href="{{ route('reports.export','reorder') }}">
            <i class="bi bi-filetype-csv me-2"></i>Export CSV
          </a>
          <a class="btn btn-export-pdf" href="{{ route('reports.export.pdf','reorder') }}">
            <i class="bi bi-filetype-pdf me-2"></i>Export PDF
          </a>
        </div>
      </div>
    </div>

    {{-- Filter Card --}}
    <div class="card filter-card mb-4">
      <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <label class="form-label small text-muted mb-2">Search Products</label>
            <div class="input-group modern-input">
              <span class="input-group-text">
                <i class="bi bi-search"></i>
              </span>
              <input class="form-control" name="q" value="{{ $q ?? '' }}" placeholder="Search by SKU or product name">
            </div>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-filter">
              <i class="bi bi-funnel me-2"></i>Apply Filter
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Stats Overview --}}
    @if($rows->total() > 0)
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="stats-card critical">
            <div class="stats-icon">
              <i class="bi bi-exclamation-circle-fill"></i>
            </div>
            <div>
              <div class="stats-label">Items Below Reorder Point</div>
              <div class="stats-value">{{ $rows->total() }}</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stats-card warning">
            <div class="stats-icon">
              <i class="bi bi-clock-history"></i>
            </div>
            <div>
              <div class="stats-label">Action Required</div>
              <div class="stats-value">{{ $rows->count() }} on page</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stats-card info">
            <div class="stats-icon">
              <i class="bi bi-arrow-repeat"></i>
            </div>
            <div>
              <div class="stats-label">Restocking Needed</div>
              <div class="stats-value">{{ $rows->where(function($r) { return (int)$r->on_hand < (int)$r->reorder_point; })->count() }} urgent</div>
            </div>
          </div>
        </div>
      </div>
    @endif

    {{-- Table Card --}}
    <div class="card modern-card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table modern-table align-middle mb-0">
            <thead>
              <tr>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-upc-scan me-2"></i>SKU
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-box-seam me-2"></i>Product Name
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-stack me-2"></i>On Hand
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-flag me-2"></i>Reorder Point
                  </div>
                </th>
                <th class="px-4 py-3 text-end" style="width: 180px;">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-gear me-2"></i>Action
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $r)
                @php
                  $isBelow = (int)$r->on_hand < (int)$r->reorder_point;
                  $isCritical = (int)$r->on_hand <= ((int)$r->reorder_point * 0.5);
                @endphp
                <tr class="inventory-row {{ $isBelow ? 'row-warning' : '' }}">
                  <td class="px-4 py-3">
                    <div class="sku-cell">
                      <div class="sku-icon {{ $isCritical ? 'critical' : ($isBelow ? 'warning' : 'normal') }}">
                        <i class="bi bi-{{ $isCritical ? 'exclamation-diamond-fill' : ($isBelow ? 'exclamation-triangle-fill' : 'check-circle-fill') }}"></i>
                      </div>
                      <span class="fw-bold">{{ $r->sku }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="product-name">{{ $r->name }}</div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <span class="stock-badge {{ $isCritical ? 'critical' : ($isBelow ? 'low' : 'good') }}">
                      <i class="bi bi-{{ $isCritical ? 'exclamation-circle-fill' : ($isBelow ? 'dash-circle' : 'check-circle') }} me-1"></i>
                      {{ $r->on_hand }}
                    </span>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <span class="reorder-point">{{ $r->reorder_point }}</span>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <a
                      class="btn-record-movement"
                      href="{{ route('movements.create', [
                          'product_id' => $r->product_id,
                          'type'       => 'IN',
                          'reference'  => 'REPLEN',
                          'return'     => url()->current(),
                      ]) }}">
                      <i class="bi bi-plus-circle me-1"></i>Record Movement
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-4 py-5">
                    <div class="empty-state">
                      <div class="empty-icon success">
                        <i class="bi bi-check-circle-fill"></i>
                      </div>
                      <h5 class="empty-title">All Stock Levels Healthy</h5>
                      <p class="empty-text">No items are currently below their reorder points</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Pagination --}}
    @if($rows->count())
      <div class="mt-4 d-flex justify-content-center">
        {{ $rows->links() }}
      </div>
    @endif

  </div>

  <style>
    :root {
      --primary-color: #6366f1;
      --success-color: #10b981;
      --danger-color: #ef4444;
      --warning-color: #f59e0b;
      --info-color: #3b82f6;
      --text-dark: #1f2937;
      --text-muted: #6b7280;
      --bg-light: #f9fafb;
      --border-color: #e5e7eb;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
      --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .header-icon-wrapper {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--warning-color), #fbbf24);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3);
    }

    /* Modern Alert */
    .modern-alert {
      border: none;
      border-radius: 12px;
      padding: 16px;
      box-shadow: var(--shadow-md);
    }

    .alert-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .success-icon {
      background: #d1fae5;
      color: var(--success-color);
    }

    /* Action Card */
    .action-card {
      border: none;
      border-radius: 12px;
      box-shadow: var(--shadow-sm);
      background: linear-gradient(135deg, #f9fafb, #f3f4f6);
    }

    .btn-email {
      background: white;
      border: 2px solid #6b7280;
      color: #374151;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .btn-email:hover {
      background: #374151;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(55, 65, 81, 0.3);
    }

    .btn-export-csv {
      background: linear-gradient(135deg, var(--success-color), #059669);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-export-csv:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-export-pdf {
      background: linear-gradient(135deg, var(--danger-color), #dc2626);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-export-pdf:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Filter Card */
    .filter-card {
      border: none;
      border-radius: 12px;
      box-shadow: var(--shadow-md);
    }

    .modern-input .input-group-text {
      background: var(--bg-light);
      border: 1px solid var(--border-color);
      border-right: none;
      color: var(--text-muted);
    }

    .modern-input .form-control {
      border-left: none;
      border-color: var(--border-color);
      padding: 10px 14px;
    }

    .modern-input .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .btn-filter {
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-filter:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    /* Stats Cards */
    .stats-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: var(--shadow-md);
      display: flex;
      align-items: center;
      gap: 16px;
      transition: all 0.3s ease;
    }

    .stats-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
    }

    .stats-card.critical {
      border-left: 4px solid var(--danger-color);
    }

    .stats-card.warning {
      border-left: 4px solid var(--warning-color);
    }

    .stats-card.info {
      border-left: 4px solid var(--info-color);
    }

    .stats-icon {
      width: 56px;
      height: 56px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }

    .stats-card.critical .stats-icon {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: var(--danger-color);
    }

    .stats-card.warning .stats-icon {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: var(--warning-color);
    }

    .stats-card.info .stats-icon {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      color: var(--info-color);
    }

    .stats-label {
      font-size: 13px;
      color: var(--text-muted);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .stats-value {
      font-size: 28px;
      font-weight: 700;
      color: var(--text-dark);
    }

    /* Modern Card */
    .modern-card {
      border: none;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
    }

    /* Table Styling */
    .modern-table thead {
      background: linear-gradient(135deg, #f9fafb, #f3f4f6);
      border-bottom: 2px solid var(--border-color);
    }

    .modern-table thead th {
      border: none;
      font-weight: 600;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--text-muted);
    }

    .th-content {
      display: flex;
      align-items: center;
    }

    .th-content i {
      opacity: 0.6;
    }

    .inventory-row {
      border-bottom: 1px solid var(--border-color);
      transition: all 0.3s ease;
    }

    .inventory-row:hover {
      background: rgba(99, 102, 241, 0.02);
    }

    .inventory-row.row-warning {
      background: linear-gradient(90deg, rgba(245, 158, 11, 0.05), transparent);
    }

    .inventory-row:last-child {
      border-bottom: none;
    }

    /* SKU Cell */
    .sku-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sku-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
    }

    .sku-icon.critical {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: var(--danger-color);
    }

    .sku-icon.warning {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: var(--warning-color);
    }

    .sku-icon.normal {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: var(--success-color);
    }

    /* Product Name */
    .product-name {
      font-size: 14px;
      color: var(--text-dark);
      max-width: 400px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    /* Stock Badge */
    .stock-badge {
      display: inline-flex;
      align-items: center;
      padding: 6px 14px;
      border-radius: 8px;
      font-weight: 700;
      font-size: 14px;
    }

    .stock-badge.critical {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #991b1b;
    }

    .stock-badge.low {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    .stock-badge.good {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #065f46;
    }

    /* Reorder Point */
    .reorder-point {
      color: var(--text-muted);
      font-weight: 600;
      font-size: 14px;
    }

    /* Record Movement Button */
    .btn-record-movement {
      display: inline-flex;
      align-items: center;
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-record-movement:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 40px 20px;
    }

    .empty-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 36px;
    }

    .empty-icon.success {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: var(--success-color);
    }

    .empty-title {
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .empty-text {
      color: var(--text-muted);
      margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .product-name {
        max-width: 200px;
      }
    }
  </style>

  <script>
    // Auto-dismiss alerts
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.modern-alert');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }, 5000);
      });
    });
  </script>
</x-app-layout>