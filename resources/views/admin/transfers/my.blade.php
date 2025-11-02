<x-app-layout>
  <div class="container py-4">

    {{-- Header Section --}}
    <div class="row align-items-center mb-4">
      <div class="col">
        <div class="d-flex align-items-center">
          <div class="header-icon-wrapper me-3">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div>
            <h1 class="h3 mb-1 fw-bold">My Transfers</h1>
            <p class="text-muted mb-0 small">Track and manage your transfer requests</p>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <a href="{{ route('transfers.create') }}" class="btn btn-create">
          <i class="bi bi-plus-circle me-2"></i>Request Transfer
        </a>
      </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
        <div class="d-flex align-items-center">
          <div class="alert-icon success-icon me-3">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <div class="flex-grow-1">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif
    
    @if(session('warning'))
      <div class="alert alert-warning alert-dismissible fade show modern-alert" role="alert">
        <div class="d-flex align-items-center">
          <div class="alert-icon warning-icon me-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <div class="flex-grow-1">{{ session('warning') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif
    
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert">
        <div class="d-flex align-items-center">
          <div class="alert-icon danger-icon me-3">
            <i class="bi bi-x-circle-fill"></i>
          </div>
          <div class="flex-grow-1">{{ $errors->first() }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    {{-- Filters Card --}}
    <div class="card filter-card mb-4">
      <div class="card-body p-4">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-funnel filter-icon me-2"></i>
          <h6 class="mb-0 fw-semibold">Filter Transfers</h6>
        </div>
        <form method="GET">
          <div class="row g-3">
            <div class="col-12 col-md-4">
              <label class="form-label small text-muted mb-2">Search</label>
              <div class="input-group modern-input">
                <span class="input-group-text">
                  <i class="bi bi-search"></i>
                </span>
                <input name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="SKU, product, warehouse, reason...">
              </div>
            </div>
            <div class="col-6 col-md-2">
              <label class="form-label small text-muted mb-2">Status</label>
              <select name="status" class="form-select modern-select">
                @php($s = $status ?? 'all')
                <option value="all" {{ $s==='all' ? 'selected' : '' }}>All Status</option>
                <option value="pending" {{ $s==='pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $s==='approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $s==='rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>
            <div class="col-6 col-md-2">
              <label class="form-label small text-muted mb-2">From Date</label>
              <input type="date" name="from" class="form-control modern-input" value="{{ $dateFrom ?? '' }}">
            </div>
            <div class="col-6 col-md-2">
              <label class="form-label small text-muted mb-2">To Date</label>
              <input type="date" name="to" class="form-control modern-input" value="{{ $dateTo ?? '' }}">
            </div>
            <div class="col-6 col-md-2 d-flex align-items-end">
              <button type="submit" class="btn btn-filter w-100">
                <i class="bi bi-filter me-2"></i>Apply
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Transfers Table Card --}}
    <div class="card modern-card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table modern-table align-middle mb-0">
            <thead>
              <tr>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-calendar3 me-2"></i>Date
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-box-seam me-2"></i>Product
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-arrow-left-right me-2"></i>From → To
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-hash me-2"></i>Qty
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-info-circle me-2"></i>Status
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-file-text me-2"></i>Ref / Reason
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-gear me-2"></i>Action
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($items as $r)
                @php
                  $badge = $r->status === 'approved' ? 'success'
                          : ($r->status === 'rejected' ? 'danger' : 'warning');
                  $statusIcon = $r->status === 'approved' ? 'check-circle-fill'
                              : ($r->status === 'rejected' ? 'x-circle-fill' : 'clock-fill');
                @endphp
                <tr class="transfer-row">
                  <td class="px-4 py-3">
                    <div class="date-wrapper">
                      <div class="date-main">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</div>
                      <div class="date-time">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}</div>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="product-cell">
                      <div class="product-icon">
                        <i class="bi bi-box"></i>
                      </div>
                      <div>
                        <div class="product-sku">{{ $r->sku }}</div>
                        <div class="product-name">{{ $r->product }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="route-cell">
                      <span class="warehouse-badge from-warehouse">{{ $r->from_code }}</span>
                      <i class="bi bi-arrow-right route-arrow"></i>
                      <span class="warehouse-badge to-warehouse">{{ $r->to_code }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <div class="qty-badge">{{ $r->qty }}</div>
                  </td>
                  <td class="px-4 py-3">
                    <span class="status-badge status-{{ $badge }}">
                      <i class="bi bi-{{ $statusIcon }} me-1"></i>{{ ucfirst($r->status) }}
                    </span>
                  </td>
                  <td class="px-4 py-3">
                    <span class="reference-text">{{ $r->reference ?: '—' }}</span>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <a class="btn-view" href="{{ route('transfers.show', $r->id) }}">
                      <i class="bi bi-eye me-1"></i>View
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-4 py-5">
                    <div class="empty-state">
                      <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                      </div>
                      <h5 class="empty-title">No Transfers Found</h5>
                      <p class="empty-text">You haven't made any transfer requests yet</p>
                      <a href="{{ route('transfers.create') }}" class="btn btn-create mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Create Your First Transfer
                      </a>
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
    @if($items->count())
      <div class="mt-4 d-flex justify-content-center">
        {{ $items->links() }}
      </div>
    @endif

  </div>

  <style>
    :root {
      --primary-color: #6366f1;
      --success-color: #10b981;
      --danger-color: #ef4444;
      --warning-color: #f59e0b;
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
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
    }

    .btn-create {
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      transition: all 0.3s ease;
    }

    .btn-create:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
      color: white;
    }

    /* Modern Alerts */
    .modern-alert {
      border: none;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 20px;
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
    }

    .success-icon {
      background: #d1fae5;
      color: var(--success-color);
    }

    .warning-icon {
      background: #fef3c7;
      color: var(--warning-color);
    }

    .danger-icon {
      background: #fee2e2;
      color: var(--danger-color);
    }

    /* Filter Card */
    .filter-card {
      border: none;
      border-radius: 16px;
      box-shadow: var(--shadow-md);
      background: white;
    }

    .filter-icon {
      color: var(--primary-color);
      font-size: 18px;
    }

    .modern-input .input-group-text {
      background: var(--bg-light);
      border: 1px solid var(--border-color);
      border-right: none;
      color: var(--text-muted);
    }

    .modern-input .form-control,
    .modern-select {
      border-left: none;
      border-color: var(--border-color);
      padding: 10px 14px;
    }

    .modern-input .form-control:focus,
    .modern-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .btn-filter {
      background: linear-gradient(135deg, #1f2937, #374151);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-filter:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(31, 41, 55, 0.3);
    }

    /* Modern Card */
    .modern-card {
      border: none;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
      background: white;
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

    .transfer-row {
      border-bottom: 1px solid var(--border-color);
      transition: all 0.3s ease;
    }

    .transfer-row:hover {
      background: linear-gradient(90deg, rgba(99, 102, 241, 0.02), transparent);
      transform: scale(1.001);
    }

    .transfer-row:last-child {
      border-bottom: none;
    }

    /* Date Cell */
    .date-wrapper {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .date-main {
      font-weight: 600;
      color: var(--text-dark);
      font-size: 14px;
    }

    .date-time {
      font-size: 12px;
      color: var(--text-muted);
    }

    /* Product Cell */
    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #1e40af;
    }

    .product-sku {
      font-weight: 700;
      color: var(--text-dark);
      font-size: 14px;
    }

    .product-name {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* Route Cell */
    .route-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .warehouse-badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 12px;
      letter-spacing: 0.3px;
    }

    .from-warehouse {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    .to-warehouse {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #065f46;
      border: 1px solid #6ee7b7;
    }

    .route-arrow {
      color: var(--text-muted);
      font-size: 16px;
    }

    /* Quantity Badge */
    .qty-badge {
      display: inline-block;
      background: linear-gradient(135deg, #1f2937, #374151);
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 700;
      font-size: 14px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Status Badge */
    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 8px 14px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      letter-spacing: 0.3px;
    }

    .status-success {
      background: linear-gradient(135deg, #d1fae5, #a7f3d0);
      color: #065f46;
    }

    .status-danger {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #991b1b;
    }

    .status-warning {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    /* Reference Text */
    .reference-text {
      color: var(--text-muted);
      font-size: 13px;
    }

    /* View Button */
    .btn-view {
      display: inline-flex;
      align-items: center;
      padding: 8px 16px;
      background: white;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-view:hover {
      background: var(--primary-color);
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
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 36px;
      color: #1e40af;
    }

    .empty-title {
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .empty-text {
      color: var(--text-muted);
      margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .route-cell {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
      }

      .product-cell {
        flex-direction: column;
        align-items: flex-start;
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