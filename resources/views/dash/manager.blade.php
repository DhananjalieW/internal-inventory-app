{{-- resources/views/dash/manager.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Manager Dashboard Styles ===== */
    .manager-dashboard {
      padding: 0;
    }

    /* ===== Page Header ===== */
    .dashboard-header {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
      border-radius: 20px;
      padding: 32px 40px;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
    }

    .dashboard-header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .dashboard-header::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: 10%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .dashboard-header-content {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .dashboard-title-section {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .dashboard-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .dashboard-icon i {
      font-size: 24px;
      color: white;
    }

    .dashboard-title {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      margin: 0 0 6px 0;
      letter-spacing: -0.5px;
    }

    .dashboard-subtitle {
      color: #94a3b8;
      font-size: 1rem;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dashboard-subtitle i {
      font-size: 14px;
    }

    /* Quick Actions */
    .quick-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .btn-action:hover {
      background: rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 255, 255, 0.3);
      color: white;
      transform: translateY(-2px);
    }

    .btn-action i {
      font-size: 16px;
    }

    /* ===== Low Stock Alert ===== */
    .low-stock-alert {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #fbbf24;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15);
    }

    .alert-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .alert-icon-warning {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .alert-icon-warning i {
      color: white;
      font-size: 22px;
    }

    .alert-text {
      color: #92400e;
      font-size: 15px;
      font-weight: 600;
    }

    .alert-text strong {
      font-weight: 800;
    }

    .alert-actions {
      display: flex;
      gap: 12px;
    }

    .btn-alert {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      background: white;
      border: 2px solid #f59e0b;
      border-radius: 10px;
      color: #92400e;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-alert:hover {
      background: #f59e0b;
      color: white;
      transform: translateY(-2px);
    }

    /* ===== Movement Summary Pills ===== */
    .movement-summary {
      background: white;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .summary-pills {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 700;
    }

    .pill.in {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .pill.out {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .pill.adjust {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    /* ===== Stats Grid ===== */
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

    .stat-card.po::before {
      background: linear-gradient(180deg, #ec4899 0%, #db2777 100%);
    }

    .stat-card.low-stock::before {
      background: linear-gradient(180deg, #f97316 0%, #ea580c 100%);
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .stat-icon.pending {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .stat-icon.pending i {
      color: #f59e0b;
      font-size: 22px;
    }

    .stat-icon.po {
      background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
    }

    .stat-icon.po i {
      color: #ec4899;
      font-size: 22px;
    }

    .stat-icon.low-stock {
      background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
    }

    .stat-icon.low-stock i {
      color: #f97316;
      font-size: 22px;
    }

    .stat-label {
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
    }

    .stat-value {
      font-size: 32px;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 12px;
      line-height: 1;
    }

    .stat-meta {
      font-size: 13px;
      color: #64748b;
      margin-bottom: 16px;
    }

    .stat-meta strong {
      color: #0f172a;
      font-weight: 700;
    }

    .stat-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #6366f1;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .stat-link:hover {
      color: #4f46e5;
      gap: 8px;
    }

    .stat-link i {
      font-size: 12px;
    }

    /* ===== Content Grid ===== */
    .content-grid {
      display: grid;
      grid-template-columns: 7fr 5fr;
      gap: 20px;
    }

    /* ===== Data Cards ===== */
    .data-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .card-header {
      padding: 20px 24px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-title {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
    }

    .card-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #6366f1;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .card-link:hover {
      color: #4f46e5;
      gap: 8px;
    }

    .card-link i {
      font-size: 12px;
    }

    /* ===== Tables ===== */
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
      text-align: left;
      border: none;
    }

    .data-table thead th.text-end {
      text-align: right;
    }

    .data-table tbody tr {
      border-bottom: 1px solid #f1f5f9;
      transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
    }

    .data-table tbody tr:last-child {
      border-bottom: none;
    }

    .data-table tbody td {
      padding: 16px 24px;
      font-size: 14px;
      color: #334155;
    }

    .data-table tbody td.text-end {
      text-align: right;
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
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 18px;
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
      font-size: 13px;
      letter-spacing: 0.5px;
      text-decoration: none;
    }

    .product-sku:hover {
      color: #6366f1;
    }

    .product-name {
      font-size: 13px;
      color: #64748b;
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
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 16px;
    }

    .warehouse-code {
      font-weight: 600;
      color: #0f172a;
      font-size: 13px;
    }

    /* ===== Quantity Badge ===== */
    .qty-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      font-variant-numeric: tabular-nums;
    }

    .qty-badge.danger {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .qty-badge.normal {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #0f172a;
    }

    /* ===== Type Badge ===== */
    .type-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 12px;
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

    /* ===== Action Button ===== */
    .btn-record {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    .btn-record:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
      color: white;
    }

    /* ===== Date Cell ===== */
    .date-cell {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      font-size: 13px;
    }

    .date-cell i {
      font-size: 14px;
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 60px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .empty-state-icon i {
      font-size: 36px;
      color: #10b981;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 14px;
    }

    /* ===== Export Buttons ===== */
    .export-section {
      padding: 20px 24px;
      border-top: 1px solid #f1f5f9;
    }

    .export-label {
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
      margin-bottom: 12px;
    }

    .export-buttons {
      display: flex;
      gap: 12px;
    }

    .btn-export {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 10px 16px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      color: #64748b;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-export:hover {
      border-color: #6366f1;
      color: #6366f1;
      background: #f8fafc;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1200px) {
      .content-grid {
        grid-template-columns: 1fr;
      }

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .dashboard-header {
        padding: 24px;
      }

      .dashboard-title {
        font-size: 1.5rem;
      }

      .dashboard-header-content {
        flex-direction: column;
        align-items: flex-start;
      }

      .quick-actions {
        width: 100%;
      }

      .btn-action {
        flex: 1;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .low-stock-alert {
        flex-direction: column;
        align-items: flex-start;
      }

      .alert-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-alert {
        width: 100%;
        justify-content: center;
      }

      .data-table {
        font-size: 13px;
      }

      .data-table thead th,
      .data-table tbody td {
        padding: 12px 16px;
      }
    }
  </style>

  <div class="manager-dashboard">
    {{-- Dashboard Header --}}
    <div class="dashboard-header">
      <div class="dashboard-header-content">
        <div class="dashboard-title-section">
          <div class="dashboard-icon">
            <i class="bi bi-speedometer2"></i>
          </div>
          <div>
            <h1 class="dashboard-title">Inventory Manager</h1>
            <p class="dashboard-subtitle">
              <i class="bi bi-grid-3x3-gap"></i>
              Overview and quick actions
            </p>
          </div>
        </div>
        <div class="quick-actions">
          <a href="{{ route('movements.create') }}" class="btn-action">
            <i class="bi bi-plus-circle"></i>
            Record Movement
          </a>
          <a href="{{ route('pos.index') }}" class="btn-action">
            <i class="bi bi-receipt"></i>
            Open POs
          </a>
          <a href="{{ route('products.create') }}" class="btn-action">
            <i class="bi bi-box-seam"></i>
            New Product
          </a>
          <a href="{{ route('reorder.index') }}" class="btn-action">
            <i class="bi bi-exclamation-triangle"></i>
            Reorder
          </a>
        </div>
      </div>
    </div>

    {{-- Low Stock Alert --}}
    @if(($lowStockCount ?? 0) > 0)
      <div class="low-stock-alert">
        <div class="alert-left">
          <div class="alert-icon-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <div class="alert-text">
            <strong>{{ number_format($lowStockCount) }}</strong> items are below reorder level
          </div>
        </div>
        <div class="alert-actions">
          <a href="{{ route('reorder.index') }}" class="btn-alert">
            <i class="bi bi-list-check"></i>
            View Report
          </a>
          <form method="POST" action="{{ route('reports.email.lowstock') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-alert" style="background: none; cursor: pointer;">
              <i class="bi bi-envelope"></i>
              Email Report
            </button>
          </form>
        </div>
      </div>
    @endif

    {{-- Movement Summary --}}
    <div class="movement-summary">
      <div class="summary-pills">
        <div class="pill in">
          <i class="bi bi-arrow-down-circle"></i>
          IN: {{ number_format($mvSummary['IN'] ?? 0) }}
        </div>
        <div class="pill out">
          <i class="bi bi-arrow-up-circle"></i>
          OUT: {{ number_format($mvSummary['OUT'] ?? 0) }}
        </div>
        <div class="pill adjust">
          <i class="bi bi-sliders"></i>
          ADJUST: {{ number_format($mvSummary['ADJUST'] ?? 0) }}
        </div>
      </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
      {{-- Pending Transfers --}}
      <div class="stat-card pending">
        <div class="stat-icon pending">
          <i class="bi bi-arrow-left-right"></i>
        </div>
        <div class="stat-label">Pending Transfers</div>
        <div class="stat-value">{{ number_format($pendingTransfers ?? 0) }}</div>
        <a href="{{ route('admin.transfers.index') }}" class="stat-link">
          View pending <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      {{-- Open Purchase Orders --}}
      <div class="stat-card po">
        <div class="stat-icon po">
          <i class="bi bi-receipt"></i>
        </div>
        <div class="stat-label">Open Purchase Orders</div>
        <div class="stat-value">{{ number_format($openPoCount ?? 0) }}</div>
        <div class="stat-meta">Due soon: <strong>{{ number_format($openPoDueSoon ?? 0) }}</strong></div>
        <a href="{{ route('pos.index') }}" class="stat-link">
          View all POs <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      {{-- Low Stock Items --}}
      <div class="stat-card low-stock">
        <div class="stat-icon low-stock">
          <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="stat-label">Low Stock Items</div>
        <div class="stat-value">{{ number_format($lowStockCount ?? 0) }}</div>
        <div class="stat-meta">Requires attention</div>
        <a href="{{ route('reorder.index') }}" class="stat-link">
          Open report <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
      {{-- Low Stock Table --}}
      <div class="data-card">
        <div class="card-header">
          <h3 class="card-title">Low Stock (Top 10)</h3>
          <a href="{{ route('reorder.index') }}" class="card-link">
            Open full report <i class="bi bi-arrow-right"></i>
          </a>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Product</th>
              <th class="text-end">On Hand</th>
              <th class="text-end">Reorder At</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lowStock as $r)
              <tr>
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="product-info">
                      <a href="{{ route('products.edit', $r->product_id) }}" class="product-sku">
                        {{ $r->sku }}
                      </a>
                      <span class="product-name">{{ $r->name }}</span>
                    </div>
                  </div>
                </td>
                <td class="text-end">
                  <span class="qty-badge danger">{{ number_format($r->qty_on_hand ?? 0) }}</span>
                </td>
                <td class="text-end">
                  <span style="font-weight: 600; color: #64748b;">{{ number_format($r->reorder_point) }}</span>
                </td>
                <td class="text-end">
                  <a class="btn-record" href="{{ route('movements.create', [
                    'product_id' => $r->product_id,
                    'type' => 'IN',
                    'reference' => 'REPLEN',
                    'return' => url()->current(),
                  ]) }}">
                    <i class="bi bi-plus-circle"></i> Record
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <p class="empty-state-text">No items below reorder level</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Right Column --}}
      <div style="display: flex; flex-direction: column; gap: 20px;">
        {{-- Stock by Warehouse --}}
        <div class="data-card">
          <div class="card-header">
            <h3 class="card-title">Stock by Warehouse</h3>
            <a href="{{ route('reports.stock') }}" class="card-link">
              Open report <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          <table class="data-table">
            <tbody>
              @forelse($stockByWh as $wh)
                <tr>
                  <td>
                    <div class="warehouse-cell">
                      <div class="warehouse-icon">
                        <i class="bi bi-building"></i>
                      </div>
                      <span class="warehouse-code">{{ $wh->code }}</span>
                    </div>
                  </td>
                  <td class="text-end">
                    <span class="qty-badge normal">{{ number_format($wh->qty) }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2">
                    <div class="empty-state">
                      <p class="empty-state-text">No stock yet.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Quick Export --}}
        <div class="data-card">
          <div class="card-header">
            <h3 class="card-title">Quick Export</h3>
          </div>
          <div class="export-section">
            <div class="export-label">Download Reports</div>
            <div class="export-buttons">
              <a href="{{ route('reports.export', 'stock') }}" class="btn-export">
                <i class="bi bi-filetype-csv"></i> CSV
              </a>
              <a href="{{ route('reports.export.pdf', 'stock') }}" class="btn-export">
                <i class="bi bi-filetype-pdf"></i> PDF
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Recent Movements --}}
    <div class="data-card" style="margin-top: 20px;">
      <div class="card-header">
        <h3 class="card-title">Recent Movements</h3>
      </div>
      <table class="data-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Product</th>
            <th>Warehouse</th>
            <th class="text-end">Quantity</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentMovements as $mv)
            <tr>
              <td>
                <div class="date-cell">
                  <i class="bi bi-clock"></i>
                  {{ $mv->created_at->format('Y-m-d H:i') }}
                </div>
              </td>
              <td>
                @if($mv->type === 'IN')
                  <span class="type-badge in">
                    <i class="bi bi-arrow-down-circle-fill"></i> IN
                  </span>
                @elseif($mv->type === 'OUT')
                  <span class="type-badge out">
                    <i class="bi bi-arrow-up-circle-fill"></i> OUT
                  </span>
                @else
                  <span class="type-badge adjust">
                    <i class="bi bi-sliders"></i> ADJ
                  </span>
                @endif
              </td>
              <td>
                <span style="font-family: 'SF Mono', monospace; font-weight: 600; color: #0f172a;">{{ $mv->sku }}</span>
              </td>
              <td>
                <span style="color: #64748b;">{{ $mv->code }}</span>
              </td>
              <td class="text-end">
                <span style="font-weight: 700; color: #0f172a;">{{ number_format($mv->qty) }}</span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                <div class="empty-state">
                  <p class="empty-state-text">No movements yet.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>