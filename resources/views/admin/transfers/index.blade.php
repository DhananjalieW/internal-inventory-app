<x-app-layout>
  <div class="container py-4">
    
    {{-- Header Section --}}
    <div class="row align-items-center mb-4">
      <div class="col">
        <div class="d-flex align-items-center">
          <div class="header-icon-wrapper me-3">
            <i class="bi bi-hourglass-split"></i>
          </div>
          <div>
            <h1 class="h3 mb-1 fw-bold">Pending Transfers</h1>
            <p class="text-muted mb-0 small">Review and process warehouse transfer requests</p>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="stats-badge">
          <i class="bi bi-clock-history me-2"></i>
          <span class="fw-semibold">{{ $items->count() }}</span> awaiting approval
        </div>
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

    {{-- Main Card --}}
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
                    <i class="bi bi-building me-2"></i>From
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-building-check me-2"></i>To
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-hash me-2"></i>Qty
                  </div>
                </th>
                <th class="px-4 py-3">
                  <div class="th-content">
                    <i class="bi bi-person me-2"></i>Requested by
                  </div>
                </th>
                <th class="px-4 py-3 text-end">
                  <div class="th-content justify-content-end">
                    <i class="bi bi-gear me-2"></i>Actions
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($items as $r)
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
                    <div class="warehouse-badge from-warehouse">
                      {{ $r->from_code }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="warehouse-badge to-warehouse">
                      {{ $r->to_code }}
                    </div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <div class="qty-badge">{{ $r->qty }}</div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="user-cell">
                      <div class="user-avatar">
                        {{ strtoupper(substr($r->requested_by, 0, 1)) }}
                      </div>
                      <span>{{ $r->requested_by }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <div class="action-buttons">
                      <form class="d-inline" method="POST" action="{{ route('admin.transfers.approve', $r->id) }}" onsubmit="return confirm('Are you sure you want to approve this transfer?');">
                        @csrf
                        <button type="submit" class="btn-action btn-approve">
                          <i class="bi bi-check-lg me-1"></i>Approve
                        </button>
                      </form>
                      <form class="d-inline" method="POST" action="{{ route('admin.transfers.reject', $r->id) }}" onsubmit="return confirm('Are you sure you want to reject this transfer?');">
                        @csrf
                        <button type="submit" class="btn-action btn-reject">
                          <i class="bi bi-x-lg me-1"></i>Reject
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-4 py-5">
                    <div class="empty-state">
                      <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                      </div>
                      <h5 class="empty-title">All Clear!</h5>
                      <p class="empty-text">No pending transfer requests at the moment</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <style>
    :root {
      --primary-color: #4f46e5;
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
      background: linear-gradient(135deg, var(--primary-color), #6366f1);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
    }

    .stats-badge {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
      padding: 12px 20px;
      border-radius: 12px;
      font-size: 14px;
      box-shadow: var(--shadow-sm);
      border: 2px solid #fbbf24;
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
      background: linear-gradient(90deg, rgba(79, 70, 229, 0.02), transparent);
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

    /* Warehouse Badges */
    .warehouse-badge {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      letter-spacing: 0.5px;
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

    /* User Cell */
    .user-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--primary-color), #6366f1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 14px;
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }

    .btn-action {
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
    }

    .btn-approve {
      background: linear-gradient(135deg, var(--success-color), #059669);
      color: white;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .btn-approve:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-reject {
      background: white;
      color: var(--danger-color);
      border: 2px solid var(--danger-color);
    }

    .btn-reject:hover {
      background: var(--danger-color);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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
      margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .action-buttons {
        flex-direction: column;
      }

      .btn-action {
        width: 100%;
        justify-content: center;
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