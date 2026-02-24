<x-app-layout>
  <style>
    /* ===== Movements Report Page Styles ===== */
    .movements-report-page {
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
      background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: 5%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
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
      color: #a5b4fc;
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

    .range-selector {
      position: relative;
    }

    .range-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 16px;
      z-index: 1;
      pointer-events: none;
    }

    .range-select {
      padding: 14px 20px 14px 46px;
      font-size: 14px;
      font-weight: 600;
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 180px;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 12px;
    }

    .range-select:hover {
      border-color: rgba(255, 255, 255, 0.3);
      background: rgba(255, 255, 255, 0.15);
    }

    .range-select:focus {
      outline: none;
      border-color: #6366f1;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    }

    .range-select option {
      background: #1e293b;
      color: white;
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
    }

    .summary-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .summary-icon.in {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .summary-icon.out {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .summary-icon.adjust {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .summary-icon i {
      color: white;
      font-size: 22px;
    }

    .summary-trend {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .summary-trend.up {
      background: #d1fae5;
      color: #065f46;
    }

    .summary-trend.down {
      background: #fee2e2;
      color: #991b1b;
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
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
    }

    .data-table tbody tr:last-child {
      border-bottom: none;
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
      font-size: 18px;
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
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .type-badge.transfer {
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4338ca;
    }

    .type-badge i {
      font-size: 12px;
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
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    /* ===== SKU Cell ===== */
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

    .product-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .product-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .product-sku {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-size: 12px;
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
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 10px rgba(20, 184, 166, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 16px;
    }

    .warehouse-code {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    /* ===== Reference Cell ===== */
    .reference-text {
      color: #64748b;
      font-size: 13px;
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
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
      box-shadow: 0 3px 10px rgba(139, 92, 246, 0.3);
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

      .range-select {
        width: 100%;
      }

      .btn-export,
      .btn-pdf {
        width: 100%;
        justify-content: center;
      }

      .summary-grid {
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
    }
  </style>

  @php
    $rows = $rows ?? collect();
    $range = $range ?? '7d';
    $rangeLabels = [
      '7d' => 'Last 7 Days',
      '30d' => 'Last 30 Days',
      '90d' => 'Last 90 Days',
      'all' => 'All Time'
    ];
    
    // Calculate stats
    $totalIn = $rows->where('type', 'IN')->sum('qty');
    $totalOut = $rows->where('type', 'OUT')->sum('qty');
    $countIn = $rows->where('type', 'IN')->count();
    $countOut = $rows->where('type', 'OUT')->count();
    $countAdjust = $rows->whereIn('type', ['ADJUST', 'TRANSFER'])->count();
  @endphp

  <div class="movements-report-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div>
            <h1 class="page-title">Movement History</h1>
            <p class="page-subtitle">Complete log of all inventory transactions</p>
          </div>
        </div>
        <div class="header-actions">
          <form method="GET" class="range-selector">
            <i class="bi bi-calendar-range range-icon"></i>
            <select name="range" class="range-select" onchange="this.form.submit()">
              <option value="7d" {{ $range === '7d' ? 'selected' : '' }}>Last 7 days</option>
              <option value="30d" {{ $range === '30d' ? 'selected' : '' }}>Last 30 days</option>
              <option value="90d" {{ $range === '90d' ? 'selected' : '' }}>Last 90 days</option>
              <option value="all" {{ $range === 'all' ? 'selected' : '' }}>All time</option>
            </select>
          </form>
          <a href="{{ route('reports.export', ['which' => 'movements', 'range' => $range]) }}" class="btn-export">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Export CSV
          </a>
          <a href="{{ route('reports.export.pdf', ['which' => 'movements', 'range' => $range]) }}" class="btn-pdf" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i>
            Download PDF
          </a>
        </div>
      </div>
    </div>

    {{-- Summary Cards --}}
    <div class="summary-grid">
      {{-- Total Movements --}}
      <div class="summary-card">
        <div class="summary-card-header">
          <div class="summary-icon total">
            <i class="bi bi-activity"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($rows->count()) }}</div>
        <div class="summary-label">Total Movements</div>
        <div class="summary-sub">
          In <span>{{ $rangeLabels[$range] ?? $range }}</span>
        </div>
      </div>

      {{-- Stock In --}}
      <div class="summary-card">
        <div class="summary-card-header">
          <div class="summary-icon in">
            <i class="bi bi-arrow-down-circle"></i>
          </div>
          @if($countIn > 0)
            <span class="summary-trend up">
              <i class="bi bi-plus"></i>
              {{ $countIn }}
            </span>
          @endif
        </div>
        <div class="summary-value">{{ number_format($totalIn) }}</div>
        <div class="summary-label">Units Received</div>
        <div class="summary-sub">
          <span>{{ $countIn }}</span> transactions
        </div>
      </div>

      {{-- Stock Out --}}
      <div class="summary-card">
        <div class="summary-card-header">
          <div class="summary-icon out">
            <i class="bi bi-arrow-up-circle"></i>
          </div>
          @if($countOut > 0)
            <span class="summary-trend down">
              <i class="bi bi-dash"></i>
              {{ $countOut }}
            </span>
          @endif
        </div>
        <div class="summary-value">{{ number_format($totalOut) }}</div>
        <div class="summary-label">Units Issued</div>
        <div class="summary-sub">
          <span>{{ $countOut }}</span> transactions
        </div>
      </div>

      {{-- Adjustments --}}
      <div class="summary-card">
        <div class="summary-card-header">
          <div class="summary-icon adjust">
            <i class="bi bi-sliders"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($countAdjust) }}</div>
        <div class="summary-label">Adjustments</div>
        <div class="summary-sub">
          Net change: <span>{{ number_format($totalIn - $totalOut) }}</span>
        </div>
      </div>
    </div>

    {{-- Movements Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th class="text-center">Type</th>
              <th class="text-end">Qty</th>
              <th>Reference</th>
              <th>SKU</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rows as $r)
              @php
                $type = strtoupper($r->type ?? 'ADJUST');
                $sign = $type === 'IN' ? '+' : ($type === 'OUT' ? '-' : '±');
                $qtyClass = $type === 'IN' ? 'positive' : ($type === 'OUT' ? 'negative' : 'neutral');
                $typeClass = strtolower($type);
                $typeIcon = match($type) {
                  'IN' => 'bi-arrow-down-circle-fill',
                  'OUT' => 'bi-arrow-up-circle-fill',
                  'TRANSFER' => 'bi-arrow-left-right',
                  default => 'bi-sliders'
                };
              @endphp
              <tr>
                {{-- Date & Time --}}
                <td>
                  <div class="date-cell">
                    <div class="date-icon">
                      <i class="bi bi-clock"></i>
                    </div>
                    <div class="date-info">
                      <span class="date-text">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</span>
                      <span class="time-text">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}</span>
                    </div>
                  </div>
                </td>

                {{-- Type --}}
                <td class="text-center">
                  <span class="type-badge {{ $typeClass }}">
                    <i class="bi {{ $typeIcon }}"></i>
                    {{ $type }}
                  </span>
                </td>

                {{-- Quantity --}}
                <td class="text-end">
                  <span class="qty-badge {{ $qtyClass }}">
                    {{ $sign }}{{ number_format((int) $r->qty) }}
                  </span>
                </td>

                {{-- Reference --}}
                <td>
                  @if($r->reference)
                    <span class="reference-text" title="{{ $r->reference }}">{{ $r->reference }}</span>
                  @else
                    <span style="color: #94a3b8;">—</span>
                  @endif
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
                    <span class="product-name" title="{{ $r->product_name ?? $r->product ?? '' }}">{{ $r->product_name ?? $r->product ?? '—' }}</span>
                  </div>
                </td>

                {{-- Warehouse --}}
                <td>
                  <div class="warehouse-cell">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <span class="warehouse-code">{{ $r->wh_code ?? $r->warehouse ?? '—' }}</span>
                  </div>
                </td>

                {{-- User --}}
                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      <i class="bi bi-person"></i>
                    </div>
                    <span class="user-name">{{ $r->user_name ?? $r->user ?? '—' }}</span>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <h4 class="empty-state-title">No Movements Found</h4>
                    <p class="empty-state-text">There are no stock movements in this date range. Try selecting a different time period.</p>
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
            Showing <span>{{ $rows->count() }}</span> movements
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
  </div>
</x-app-layout>