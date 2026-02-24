<?php>
<x-app-layout>
  <style>
    /* ===== Stock Report Page Styles ===== */
    .stock-report-page {
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
      background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: 5%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
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
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
    }

    .page-icon i {
      font-size: 28px;
      color: white;
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

    /* ===== Header Actions ===== */
    .header-actions {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn-export {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
    }

    .btn-export:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.45);
      color: white;
    }

    .btn-export i {
      font-size: 18px;
    }

    .btn-pdf {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.35);
    }

    .btn-pdf:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(239, 68, 68, 0.45);
      color: white;
    }

    .btn-pdf i {
      font-size: 18px;
    }

    /* ===== Summary Cards ===== */
    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    .summary-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .summary-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .summary-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
    }

    .summary-card.total::before {
      background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
    }

    .summary-card.onhand::before {
      background: linear-gradient(180deg, #10b981 0%, #059669 100%);
    }

    .summary-card.allocated::before {
      background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
    }

    .summary-card.onorder::before {
      background: linear-gradient(180deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .summary-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .summary-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .summary-icon.total {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .summary-icon.total i {
      color: #2563eb;
    }

    .summary-icon.onhand {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .summary-icon.onhand i {
      color: #059669;
    }

    .summary-icon.allocated {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .summary-icon.allocated i {
      color: #d97706;
    }

    .summary-icon.onorder {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
    }

    .summary-icon.onorder i {
      color: #7c3aed;
    }

    .summary-icon i {
      font-size: 22px;
    }

    .summary-value {
      font-size: 32px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1;
      margin-bottom: 4px;
    }

    .summary-label {
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
    }

    .summary-sub {
      font-size: 13px;
      color: #94a3b8;
      margin-top: 8px;
    }

    .summary-sub span {
      font-weight: 700;
      color: #475569;
    }

    /* ===== Search Card ===== */
    .search-card {
      background: white;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .search-form {
      display: flex;
      gap: 16px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .search-group {
      flex: 1;
      min-width: 200px;
    }

    .search-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #475569;
      margin-bottom: 8px;
    }

    .search-input-wrapper {
      position: relative;
    }

    .search-input-wrapper i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 18px;
    }

    .search-input {
      width: 100%;
      padding: 14px 16px 14px 48px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      color: #0f172a;
      transition: all 0.3s ease;
      background: #f8fafc;
    }

    .search-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .search-input::placeholder {
      color: #94a3b8;
    }

    .filter-select {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      color: #0f172a;
      transition: all 0.3s ease;
      background: #f8fafc;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 12px;
    }

    .filter-select:focus {
      outline: none;
      border-color: #6366f1;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-search {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(15, 23, 42, 0.3);
    }

    .btn-clear {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 20px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #64748b;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-clear:hover {
      border-color: #cbd5e1;
      color: #475569;
      background: #f8fafc;
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
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(16, 185, 129, 0.02) 100%);
    }

    .data-table tbody tr:last-child {
      border-bottom: none;
    }

    .data-table tbody tr.negative-row {
      background: linear-gradient(90deg, rgba(239, 68, 68, 0.04) 0%, transparent 100%);
    }

    .data-table tbody tr.negative-row:hover {
      background: linear-gradient(90deg, rgba(239, 68, 68, 0.08) 0%, transparent 100%);
    }

    .data-table tbody td {
      padding: 16px 20px;
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

    /* ===== Warehouse Cell ===== */
    .warehouse-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .warehouse-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 10px rgba(20, 184, 166, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 18px;
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
      color: #64748b;
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
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 18px;
    }

    .product-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
      max-width: 250px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ===== Stock Badges ===== */
    .stock-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
    }

    .stock-badge.positive {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .stock-badge.negative {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .stock-badge.zero {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #64748b;
    }

    .stock-badge i {
      font-size: 14px;
    }

    /* ===== Allocated Badge ===== */
    .allocated-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .allocated-badge i {
      font-size: 14px;
    }

    .allocated-zero {
      color: #94a3b8;
      font-weight: 500;
    }

    /* ===== On Order Badge ===== */
    .onorder-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
      color: #5b21b6;
    }

    .onorder-badge i {
      font-size: 14px;
    }

    .onorder-zero {
      color: #94a3b8;
      font-weight: 500;
    }

    /* ===== Available Badge ===== */
    .available-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
    }

    .available-badge.positive {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .available-badge.negative {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .available-badge.zero {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #64748b;
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

    /* ===== Legend Card ===== */
    .legend-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      margin-top: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .legend-title {
      font-size: 16px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .legend-title i {
      color: #6366f1;
    }

    .legend-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .legend-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
    }

    .legend-badge.onhand {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .legend-badge.allocated {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .legend-badge.onorder {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
      color: #5b21b6;
    }

    .legend-badge.negative {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .legend-text {
      font-size: 13px;
      color: #64748b;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1200px) {
      .summary-grid {
        grid-template-columns: repeat(2, 1fr);
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

      .header-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-export,
      .btn-pdf {
        width: 100%;
        justify-content: center;
      }

      .summary-grid {
        grid-template-columns: 1fr;
      }

      .search-form {
        flex-direction: column;
      }

      .search-group {
        width: 100%;
        min-width: unset;
      }

      .btn-search,
      .btn-clear {
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

      .legend-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  @php
    $rows = $rows ?? collect();
    $q = request('q', '');
    $warehouse = request('warehouse', '');
    
    // Calculate stats
    $totalRecords = method_exists($rows, 'total') ? $rows->total() : $rows->count();
    $totalOnHand = $rows->sum('on_hand');
    $totalAllocated = $rows->sum('allocated');
    $totalOnOrder = $rows->sum('on_order');
    $negativeCount = $rows->filter(fn($r) => (int)$r->on_hand < 0)->count();
    
    // Get unique warehouses for filter
    $warehouses = \App\Models\Warehouse::orderBy('code')->get();
  @endphp

  <div class="stock-report-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-boxes"></i>
          </div>
          <div>
            <h1 class="page-title">Inventory Stock Report</h1>
            <p class="page-subtitle">Complete stock levels by product and warehouse</p>
          </div>
        </div>
        <div class="header-actions">
          <a href="{{ route('reports.export', 'stock') }}?q={{ $q }}&warehouse={{ $warehouse }}" class="btn-export">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Export CSV
          </a>
          <a href="{{ route('reports.export.pdf', 'stock') }}" class="btn-pdf" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i>
            Download PDF
          </a>
        </div>
      </div>
    </div>

    {{-- Summary Cards --}}
    <div class="summary-grid">
      {{-- Total Records --}}
      <div class="summary-card total">
        <div class="summary-card-header">
          <div class="summary-icon total">
            <i class="bi bi-grid-3x3-gap-fill"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalRecords) }}</div>
        <div class="summary-label">Total Stock Records</div>
        <div class="summary-sub">
          Across <span>{{ $warehouses->count() }}</span> warehouses
        </div>
      </div>

      {{-- Total On Hand --}}
      <div class="summary-card onhand">
        <div class="summary-card-header">
          <div class="summary-icon onhand">
            <i class="bi bi-box-seam-fill"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalOnHand) }}</div>
        <div class="summary-label">Total On Hand</div>
        <div class="summary-sub">
          @if($negativeCount > 0)
            <span style="color: #dc2626;">{{ $negativeCount }}</span> negative stock items
          @else
            All stock <span>positive</span>
          @endif
        </div>
      </div>

      {{-- Total Allocated --}}
      <div class="summary-card allocated">
        <div class="summary-card-header">
          <div class="summary-icon allocated">
            <i class="bi bi-lock-fill"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalAllocated) }}</div>
        <div class="summary-label">Total Allocated</div>
        <div class="summary-sub">
          Reserved for <span>orders</span>
        </div>
      </div>

      {{-- Total On Order --}}
      <div class="summary-card onorder">
        <div class="summary-card-header">
          <div class="summary-icon onorder">
            <i class="bi bi-truck"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalOnOrder) }}</div>
        <div class="summary-label">Total On Order</div>
        <div class="summary-sub">
          Incoming <span>shipments</span>
        </div>
      </div>
    </div>

    {{-- Search & Filter Card --}}
    <div class="search-card">
      <form method="GET" class="search-form">
        <div class="search-group">
          <label class="search-label">Search Products</label>
          <div class="search-input-wrapper">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="search-input" 
              value="{{ $q }}" 
              placeholder="Search by SKU or product name..."
            >
          </div>
        </div>
        <div class="search-group" style="min-width: 180px; flex: 0.5;">
          <label class="search-label">Warehouse</label>
          <select name="warehouse" class="filter-select">
            <option value="">All Warehouses</option>
            @foreach($warehouses as $wh)
              <option value="{{ $wh->id }}" {{ $warehouse == $wh->id ? 'selected' : '' }}>
                {{ $wh->code }} — {{ $wh->name }}
              </option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn-search">
          <i class="bi bi-funnel"></i>
          Filter
        </button>
        @if($q || $warehouse)
          <a href="{{ route('reports.stock') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
            Clear
          </a>
        @endif
      </form>
    </div>

    {{-- Data Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Warehouse</th>
              <th>SKU</th>
              <th>Product</th>
              <th class="text-end">On Hand</th>
              <th class="text-end">Allocated</th>
              <th class="text-end">On Order</th>
              <th class="text-end">Available</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rows as $r)
              @php
                $onHand = (int)$r->on_hand;
                $allocated = (int)$r->allocated;
                $onOrder = (int)$r->on_order;
                $available = $onHand - $allocated;
                $isNegative = $onHand < 0;
              @endphp
              <tr class="{{ $isNegative ? 'negative-row' : '' }}">
                {{-- Warehouse --}}
                <td>
                  <div class="warehouse-cell">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="warehouse-info">
                      <span class="warehouse-code">{{ $r->wh_code }}</span>
                      @if(isset($r->wh_name))
                        <span class="warehouse-name">{{ $r->wh_name }}</span>
                      @endif
                    </div>
                  </div>
                </td>

                {{-- SKU --}}
                <td>
                  <span class="sku-badge">{{ $r->sku }}</span>
                </td>

                {{-- Product --}}
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <span class="product-name" title="{{ $r->product_name }}">{{ $r->product_name }}</span>
                  </div>
                </td>

                {{-- On Hand --}}
                <td class="text-end">
                  @if($isNegative)
                    <span class="stock-badge negative">
                      <i class="bi bi-exclamation-triangle-fill"></i>
                      {{ number_format($onHand) }}
                    </span>
                  @elseif($onHand == 0)
                    <span class="stock-badge zero">
                      {{ number_format($onHand) }}
                    </span>
                  @else
                    <span class="stock-badge positive">
                      {{ number_format($onHand) }}
                    </span>
                  @endif
                </td>

                {{-- Allocated --}}
                <td class="text-end">
                  @if($allocated > 0)
                    <span class="allocated-badge">
                      <i class="bi bi-lock-fill"></i>
                      {{ number_format($allocated) }}
                    </span>
                  @else
                    <span class="allocated-zero">{{ number_format($allocated) }}</span>
                  @endif
                </td>

                {{-- On Order --}}
                <td class="text-end">
                  @if($onOrder > 0)
                    <span class="onorder-badge">
                      <i class="bi bi-truck"></i>
                      {{ number_format($onOrder) }}
                    </span>
                  @else
                    <span class="onorder-zero">{{ number_format($onOrder) }}</span>
                  @endif
                </td>

                {{-- Available --}}
                <td class="text-end">
                  @if($available < 0)
                    <span class="available-badge negative">
                      {{ number_format($available) }}
                    </span>
                  @elseif($available == 0)
                    <span class="available-badge zero">
                      {{ number_format($available) }}
                    </span>
                  @else
                    <span class="available-badge positive">
                      {{ number_format($available) }}
                    </span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <h4 class="empty-state-title">No Stock Records Found</h4>
                    <p class="empty-state-text">There are no inventory records matching your criteria.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Table Footer --}}
      @if($rows->count() > 0)
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $rows->count() }}</span> records
            @if(method_exists($rows, 'total'))
              of <span>{{ $rows->total() }}</span> total
            @endif
          </div>
          @if(method_exists($rows, 'links'))
            {{ $rows->links() }}
          @endif
        </div>
      @endif
    </div>

    {{-- Legend Card --}}
    <div class="legend-card">
      <h4 class="legend-title">
        <i class="bi bi-info-circle"></i>
        Legend
      </h4>
      <div class="legend-grid">
        <div class="legend-item">
          <span class="legend-badge onhand">150</span>
          <span class="legend-text">On Hand (in stock)</span>
        </div>
        <div class="legend-item">
          <span class="legend-badge allocated">
            <i class="bi bi-lock-fill"></i> 25
          </span>
          <span class="legend-text">Allocated (reserved)</span>
        </div>
        <div class="legend-item">
          <span class="legend-badge onorder">
            <i class="bi bi-truck"></i> 50
          </span>
          <span class="legend-text">On Order (incoming)</span>
        </div>
        <div class="legend-item">
          <span class="legend-badge negative">
            <i class="bi bi-exclamation-triangle-fill"></i> -10
          </span>
          <span class="legend-text">Negative stock (error)</span>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>