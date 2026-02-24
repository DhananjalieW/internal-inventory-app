<?php>
{{-- resources/views/reports/index.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Reports Page Styles ===== */
    .reports-page {
      padding: 0;
    }

    /* ===== Page Header ===== */
    .page-header {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
      border-radius: 24px;
      padding: 36px 44px;
      margin-bottom: 32px;
      position: relative;
      overflow: hidden;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: -60%;
      right: -15%;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: 5%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header-content {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
    }

    .page-title-section {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .page-icon {
      width: 64px;
      height: 64px;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(10px);
    }

    .page-icon i {
      font-size: 28px;
      color: #86efac;
    }

    .page-title {
      color: white;
      font-size: 2.25rem;
      font-weight: 800;
      margin: 0 0 6px 0;
      letter-spacing: -0.5px;
    }

    .page-subtitle {
      color: #94a3b8;
      font-size: 1rem;
      margin: 0;
      font-weight: 500;
    }

    /* ===== Quick Stats ===== */
    .quick-stats {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .quick-stat {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 14px;
      padding: 14px 22px;
      backdrop-filter: blur(10px);
      text-align: center;
      min-width: 100px;
      transition: all 0.3s ease;
    }

    .quick-stat:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
    }

    .quick-stat-value {
      font-size: 24px;
      font-weight: 800;
      color: white;
      line-height: 1;
      margin-bottom: 4px;
    }

    .quick-stat-label {
      font-size: 11px;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* ===== Reports Grid ===== */
    .reports-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
      margin-bottom: 32px;
    }

    /* ===== Report Card ===== */
    .report-card {
      background: white;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      overflow: hidden;
      transition: all 0.3s ease;
      position: relative;
    }

    .report-card:hover {
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      transform: translateY(-4px);
    }

    .report-card-header {
      padding: 24px 24px 0;
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }

    .report-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .report-icon.inventory {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.35);
    }

    .report-icon.movements {
      background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
      box-shadow: 0 4px 15px rgba(139, 92, 246, 0.35);
    }

    .report-icon.low-stock {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.35);
    }

    .report-icon.valuation {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
    }

    .report-icon.suppliers {
      background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
      box-shadow: 0 4px 15px rgba(249, 115, 22, 0.35);
    }

    .report-icon.transfers {
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
      box-shadow: 0 4px 15px rgba(6, 182, 212, 0.35);
    }

    .report-icon.pos {
      background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
      box-shadow: 0 4px 15px rgba(236, 72, 153, 0.35);
    }

    .report-icon.audit {
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
    }

    .report-icon i {
      color: white;
      font-size: 24px;
    }

    .report-info {
      flex: 1;
    }

    .report-title {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0 0 6px 0;
    }

    .report-description {
      font-size: 14px;
      color: #64748b;
      margin: 0;
      line-height: 1.5;
    }

    .report-card-body {
      padding: 20px 24px;
    }

    .report-features {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .feature-tag {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 6px 12px;
      background: #f1f5f9;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      color: #475569;
    }

    .feature-tag i {
      font-size: 12px;
      color: #94a3b8;
    }

    .report-card-footer {
      padding: 16px 24px 24px;
      display: flex;
      gap: 12px;
    }

    .btn-generate {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 14px 20px;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-generate:hover {
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(15, 23, 42, 0.3);
      color: white;
    }

    .btn-generate i {
      font-size: 16px;
    }

    .btn-preview {
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

    .btn-preview:hover {
      border-color: #6366f1;
      color: #6366f1;
      background: #f5f3ff;
    }

    .btn-preview i {
      font-size: 18px;
    }

    /* ===== Section Title ===== */
    .section-title {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }

    .section-title h2 {
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
    }

    .section-title-line {
      flex: 1;
      height: 2px;
      background: linear-gradient(90deg, #e2e8f0, transparent);
    }

    /* ===== Recent Reports Card ===== */
    .recent-reports-card {
      background: white;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      overflow: hidden;
    }

    .recent-reports-header {
      padding: 24px 28px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .recent-reports-header h3 {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .recent-reports-header h3 i {
      color: #6366f1;
    }

    .recent-reports-body {
      padding: 0;
    }

    .recent-report-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 18px 28px;
      border-bottom: 1px solid #f1f5f9;
      transition: all 0.2s ease;
    }

    .recent-report-item:last-child {
      border-bottom: none;
    }

    .recent-report-item:hover {
      background: #f8fafc;
    }

    .recent-report-icon {
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .recent-report-icon i {
      color: #64748b;
      font-size: 20px;
    }

    .recent-report-info {
      flex: 1;
    }

    .recent-report-name {
      font-size: 15px;
      font-weight: 600;
      color: #0f172a;
      margin-bottom: 2px;
    }

    .recent-report-meta {
      font-size: 13px;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .recent-report-meta span {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .recent-report-meta i {
      font-size: 12px;
    }

    .btn-download {
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
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
    }

    .btn-download:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
      color: white;
    }

    /* ===== Empty Recent Reports ===== */
    .empty-recent {
      padding: 48px 24px;
      text-align: center;
    }

    .empty-recent-icon {
      width: 72px;
      height: 72px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .empty-recent-icon i {
      font-size: 32px;
      color: #94a3b8;
    }

    .empty-recent-text {
      font-size: 15px;
      color: #64748b;
      margin: 0;
    }

    /* ===== Quick Actions ===== */
    .quick-actions {
      display: flex;
      gap: 16px;
      margin-bottom: 32px;
      flex-wrap: wrap;
    }

    .quick-action-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 16px 24px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 14px;
      font-size: 14px;
      font-weight: 600;
      color: #475569;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
      border-color: #6366f1;
      color: #6366f1;
      background: #f5f3ff;
      transform: translateY(-2px);
    }

    .quick-action-btn i {
      font-size: 18px;
    }

    .quick-action-btn.primary {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-color: transparent;
      color: white;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
    }

    .quick-action-btn.primary:hover {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      color: white;
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
      .reports-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .page-header {
        padding: 28px;
      }

      .page-title {
        font-size: 1.75rem;
      }

      .page-header-content {
        flex-direction: column;
        align-items: flex-start;
      }

      .page-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }

      .quick-stats {
        width: 100%;
      }

      .quick-stat {
        flex: 1;
        min-width: 80px;
      }

      .reports-grid {
        grid-template-columns: 1fr;
      }

      .quick-actions {
        flex-direction: column;
      }

      .quick-action-btn {
        justify-content: center;
      }

      .recent-report-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .btn-download {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  @php
    // Sample data - replace with actual data from controller
    $totalProducts = \App\Models\Product::count() ?? 0;
    $totalWarehouses = \App\Models\Warehouse::count() ?? 0;
    $lowStockCount = \App\Models\Stock::whereColumn('qty', '<=', 'min_qty')->count() ?? 0;
  @endphp

  <div class="reports-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-file-earmark-bar-graph"></i>
          </div>
          <div>
            <h1 class="page-title">Reports</h1>
            <p class="page-subtitle">Generate and download inventory reports</p>
          </div>
        </div>
        <div class="quick-stats">
          <div class="quick-stat">
            <div class="quick-stat-value">{{ number_format($totalProducts) }}</div>
            <div class="quick-stat-label">Products</div>
          </div>
          <div class="quick-stat">
            <div class="quick-stat-value">{{ number_format($totalWarehouses) }}</div>
            <div class="quick-stat-label">Warehouses</div>
          </div>
          <div class="quick-stat">
            <div class="quick-stat-value" style="color: {{ $lowStockCount > 0 ? '#fbbf24' : 'white' }}">{{ number_format($lowStockCount) }}</div>
            <div class="quick-stat-label">Low Stock</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions">
      <a href="{{ route('reports.inventory') ?? '#' }}" class="quick-action-btn primary">
        <i class="bi bi-download"></i>
        Export All Inventory
      </a>
      <a href="{{ route('reports.low-stock') ?? '#' }}" class="quick-action-btn">
        <i class="bi bi-exclamation-triangle"></i>
        Low Stock Report
      </a>
      <a href="{{ route('reports.movements') ?? '#' }}" class="quick-action-btn">
        <i class="bi bi-clock-history"></i>
        Today's Movements
      </a>
    </div>

    {{-- Available Reports Section --}}
    <div class="section-title">
      <h2>Available Reports</h2>
      <div class="section-title-line"></div>
    </div>

    <div class="reports-grid">
      {{-- Inventory Summary Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon inventory">
            <i class="bi bi-boxes"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Inventory Summary</h3>
            <p class="report-description">Complete overview of current stock levels across all warehouses</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Stock Levels</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Warehouse Breakdown</span>
            <span class="feature-tag"><i class="bi bi-check"></i> SKU Details</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.inventory') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Stock Movements Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon movements">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Stock Movements</h3>
            <p class="report-description">Track all inventory transactions with detailed history</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Date Range</span>
            <span class="feature-tag"><i class="bi bi-check"></i> IN/OUT/ADJUST</span>
            <span class="feature-tag"><i class="bi bi-check"></i> User Activity</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.movements') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Low Stock Alert Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon low-stock">
            <i class="bi bi-exclamation-triangle"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Low Stock Alerts</h3>
            <p class="report-description">Items below minimum stock threshold requiring attention</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Critical Items</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Reorder Qty</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Supplier Info</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.low-stock') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Inventory Valuation Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon valuation">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Inventory Valuation</h3>
            <p class="report-description">Financial value of current inventory by category</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Cost Analysis</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Category Totals</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Warehouse Value</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.valuation') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Supplier Performance Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon suppliers">
            <i class="bi bi-truck"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Supplier Performance</h3>
            <p class="report-description">Analyze supplier delivery times and order accuracy</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Delivery Time</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Order History</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Quality Metrics</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.suppliers') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Transfer History Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon transfers">
            <i class="bi bi-building-gear"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Transfer History</h3>
            <p class="report-description">Inter-warehouse transfers and approval status</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> Transfer Log</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Approval Status</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Warehouse Flow</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.transfers') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Purchase Orders Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon pos">
            <i class="bi bi-receipt"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Purchase Orders</h3>
            <p class="report-description">PO summary with receiving status and pending items</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> PO Status</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Receiving Log</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Pending Items</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.pos') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>

      {{-- Audit Trail Report --}}
      <div class="report-card">
        <div class="report-card-header">
          <div class="report-icon audit">
            <i class="bi bi-shield-check"></i>
          </div>
          <div class="report-info">
            <h3 class="report-title">Audit Trail</h3>
            <p class="report-description">Complete system activity log for compliance</p>
          </div>
        </div>
        <div class="report-card-body">
          <div class="report-features">
            <span class="feature-tag"><i class="bi bi-check"></i> User Actions</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Timestamps</span>
            <span class="feature-tag"><i class="bi bi-check"></i> Change Log</span>
          </div>
        </div>
        <div class="report-card-footer">
          <a href="{{ route('reports.audit') ?? '#' }}" class="btn-generate">
            <i class="bi bi-file-earmark-pdf"></i>
            Generate PDF
          </a>
          <a href="#" class="btn-preview" title="Preview">
            <i class="bi bi-eye"></i>
          </a>
        </div>
      </div>
    </div>

    {{-- Recent Reports Section --}}
    <div class="section-title">
      <h2>Recent Reports</h2>
      <div class="section-title-line"></div>
    </div>

    <div class="recent-reports-card">
      <div class="recent-reports-header">
        <h3>
          <i class="bi bi-clock-history"></i>
          Recently Generated
        </h3>
      </div>
      <div class="recent-reports-body">
        {{-- Sample recent reports - replace with actual data --}}
        @php
          $recentReports = []; // Replace with actual query
        @endphp

        @if(count($recentReports) > 0)
          @foreach($recentReports as $report)
            <div class="recent-report-item">
              <div class="recent-report-icon">
                <i class="bi bi-file-earmark-pdf"></i>
              </div>
              <div class="recent-report-info">
                <div class="recent-report-name">{{ $report['name'] ?? 'Report' }}</div>
                <div class="recent-report-meta">
                  <span><i class="bi bi-calendar3"></i> {{ $report['date'] ?? 'Today' }}</span>
                  <span><i class="bi bi-person"></i> {{ $report['user'] ?? 'Admin' }}</span>
                </div>
              </div>
              <a href="#" class="btn-download">
                <i class="bi bi-download"></i>
                Download
              </a>
            </div>
          @endforeach
        @else
          <div class="empty-recent">
            <div class="empty-recent-icon">
              <i class="bi bi-file-earmark"></i>
            </div>
            <p class="empty-recent-text">No reports generated yet. Generate your first report above!</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>
