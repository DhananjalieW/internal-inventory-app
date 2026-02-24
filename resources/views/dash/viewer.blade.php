<x-app-layout>
  <style>
    /* ===== Viewer Dashboard Styles ===== */
    .viewer-dashboard {
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
      background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .dashboard-header::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: 10%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(6, 182, 212, 0.1) 0%, transparent 70%);
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
      background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
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

    .read-only-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      border: 2px solid #93c5fd;
      border-radius: 14px;
      color: #1e40af;
      font-size: 15px;
      font-weight: 700;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .read-only-badge i {
      font-size: 20px;
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

    .stat-card.products::before {
      background: linear-gradient(180deg, #ec4899 0%, #db2777 100%);
    }

    .stat-card.warehouses::before {
      background: linear-gradient(180deg, #3b82f6 0%, #06b6d4 100%);
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

    .stat-icon.products {
      background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
    }

    .stat-icon.products i {
      color: #ec4899;
      font-size: 22px;
    }

    .stat-icon.warehouses {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .stat-icon.warehouses i {
      color: #3b82f6;
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
      line-height: 1;
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
    }

    .card-title {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
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
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(6, 182, 212, 0.02) 100%);
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

    /* ===== Info Banner ===== */
    .info-banner {
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      border: 1px solid #a5b4fc;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.15);
    }

    .info-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .info-icon i {
      color: white;
      font-size: 22px;
    }

    .info-text {
      flex: 1;
      color: #3730a3;
      font-size: 15px;
      font-weight: 600;
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

      .read-only-badge {
        width: 100%;
        justify-content: center;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .data-table thead th,
      .data-table tbody td {
        padding: 12px 16px;
      }
    }
  </style>

  <div class="viewer-dashboard">
    {{-- Dashboard Header --}}
    <div class="dashboard-header">
      <div class="dashboard-header-content">
        <div class="dashboard-title-section">
          <div class="dashboard-icon">
            <i class="bi bi-eye"></i>
          </div>
          <div>
            <h1 class="dashboard-title">Viewer Dashboard</h1>
            <p class="dashboard-subtitle">
              <i class="bi bi-shield-lock"></i>
              Read-only view of stock & reports
            </p>
          </div>
        </div>
        <div class="read-only-badge">
          <i class="bi bi-shield-lock"></i>
          Read-Only Access
        </div>
      </div>
    </div>

    {{-- Info Banner --}}
    <div class="info-banner">
      <div class="info-icon">
        <i class="bi bi-info-circle-fill"></i>
      </div>
      <div class="info-text">
        You have view-only access to inventory data. Contact an administrator for editing permissions.
      </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
      {{-- Total Products --}}
      <div class="stat-card products">
        <div class="stat-icon products">
          <i class="bi bi-box-seam"></i>
        </div>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ number_format($productsCount ?? 0) }}</div>
      </div>

      {{-- Warehouses --}}
      <div class="stat-card warehouses">
        <div class="stat-icon warehouses">
          <i class="bi bi-building"></i>
        </div>
        <div class="stat-label">Warehouses</div>
        <div class="stat-value">{{ number_format($warehousesCount ?? 0) }}</div>
      </div>

      {{-- Low Stock Items --}}
      <div class="stat-card low-stock">
        <div class="stat-icon low-stock">
          <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="stat-label">Low Stock Items</div>
        <div class="stat-value">{{ number_format($lowStockCount ?? 0) }}</div>
      </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
      {{-- Low Stock Table --}}
      <div class="data-card">
        <div class="card-header">
          <h3 class="card-title">Low Stock (Top 10)</h3>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Product</th>
              <th class="text-end">On Hand</th>
              <th class="text-end">Reorder At</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lowStock ?? [] as $r)
              <tr>
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="product-info">
                      <span class="product-sku">{{ $r->sku }}</span>
                      <span class="product-name">{{ $r->name }}</span>
                    </div>
                  </div>
                </td>
                <td class="text-end">
                  <span class="qty-badge danger">{{ number_format($r->on_hand ?? 0) }}</span>
                </td>
                <td class="text-end">
                  <span style="font-weight: 600; color: #64748b;">{{ number_format($r->reorder_point ?? 0) }}</span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3">
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
          </div>
          <table class="data-table">
            <tbody>
              @forelse($stockByWh ?? [] as $wh)
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
                    <span class="qty-badge normal">{{ number_format($wh->qty ?? 0) }}</span>
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

        {{-- Quick Links --}}
        <div class="data-card">
          <div class="card-header">
            <h3 class="card-title">Quick Links</h3>
          </div>
          <div style="padding: 20px 24px; display: flex; flex-direction: column; gap: 12px;">
            <a href="{{ route('viewer.products.index') }}" 
               style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 10px; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.background='linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%)'; this.style.transform='translateX(4px)'" 
               onmouseout="this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)'; this.style.transform='translateX(0)'">
              <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-box-seam" style="color: white; font-size: 16px;"></i>
              </div>
              <span style="font-weight: 600; color: #0f172a; font-size: 14px;">View Products</span>
            </a>

            <a href="{{ route('viewer.warehouses.index') }}" 
               style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 10px; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.background='linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%)'; this.style.transform='translateX(4px)'" 
               onmouseout="this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)'; this.style.transform='translateX(0)'">
              <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-building" style="color: white; font-size: 16px;"></i>
              </div>
              <span style="font-weight: 600; color: #0f172a; font-size: 14px;">View Warehouses</span>
            </a>

            <a href="{{ route('viewer.movements.index') }}" 
               style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 10px; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.background='linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%)'; this.style.transform='translateX(4px)'" 
               onmouseout="this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)'; this.style.transform='translateX(0)'">
              <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-arrow-left-right" style="color: white; font-size: 16px;"></i>
              </div>
              <span style="font-weight: 600; color: #0f172a; font-size: 14px;">View Movements</span>
            </a>
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
          @forelse($recentMovements ?? [] as $mv)
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