<?php>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Stock Movements Report</title>
  <style>
    /* ===== Base Styles ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 9px;
      line-height: 1.4;
      color: #1e293b;
      background: #fff;
    }

    /* ===== Page Setup ===== */
    @page {
      margin: 15mm 10mm 20mm 10mm;
    }

    /* ===== Header ===== */
    .report-header {
      padding: 15px 20px;
      background: #0f172a;
      margin-bottom: 15px;
      color: white;
    }

    .header-table {
      width: 100%;
    }

    .company-name {
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      margin-bottom: 3px;
    }

    .report-title {
      font-size: 12px;
      color: #94a3b8;
      font-weight: normal;
    }

    .report-meta {
      font-size: 9px;
      color: #94a3b8;
      text-align: right;
    }

    .report-meta div {
      margin-bottom: 2px;
    }

    .report-meta strong {
      color: #fff;
    }

    /* ===== Summary Section ===== */
    .summary-section {
      margin-bottom: 15px;
    }

    .summary-table {
      width: 100%;
      border-collapse: collapse;
    }

    .summary-table td {
      width: 25%;
      padding: 12px 10px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      text-align: center;
      vertical-align: top;
    }

    .summary-value {
      font-size: 16px;
      font-weight: bold;
      color: #0f172a;
      margin-bottom: 3px;
    }

    .summary-label {
      font-size: 8px;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .green { color: #059669; }
    .red { color: #dc2626; }
    .yellow { color: #d97706; }
    .purple { color: #7c3aed; }

    /* ===== Section Title ===== */
    .section-title {
      font-size: 11px;
      font-weight: bold;
      color: #0f172a;
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 2px solid #e2e8f0;
    }

    /* ===== Table Styles ===== */
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }

    .data-table thead tr {
      background: #f1f5f9;
    }

    .data-table thead th {
      padding: 8px 6px;
      font-size: 7px;
      font-weight: bold;
      color: #475569;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      text-align: left;
      border-bottom: 2px solid #e2e8f0;
    }

    .data-table thead th.text-center {
      text-align: center;
    }

    .data-table thead th.text-right {
      text-align: right;
    }

    .data-table tbody tr {
      border-bottom: 1px solid #f1f5f9;
    }

    .data-table tbody tr:nth-child(even) {
      background: #fafafa;
    }

    .data-table tbody td {
      padding: 6px;
      font-size: 8px;
      color: #334155;
      vertical-align: middle;
    }

    .data-table tbody td.text-center {
      text-align: center;
    }

    .data-table tbody td.text-right {
      text-align: right;
    }

    /* ===== Cell Styles ===== */
    .date-primary {
      font-weight: bold;
      color: #0f172a;
      font-size: 8px;
    }

    .date-secondary {
      font-size: 7px;
      color: #94a3b8;
    }

    .sku-cell {
      font-family: DejaVu Sans Mono, monospace;
      font-weight: bold;
      color: #0f172a;
      font-size: 8px;
      background: #f1f5f9;
      padding: 2px 5px;
    }

    .product-name {
      color: #334155;
      font-size: 8px;
      max-width: 120px;
      overflow: hidden;
    }

    .warehouse-cell {
      font-weight: 600;
      color: #0f172a;
      font-size: 8px;
    }

    /* ===== Type Badges ===== */
    .type-badge {
      display: inline-block;
      padding: 2px 6px;
      font-size: 7px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .type-in {
      background: #d1fae5;
      color: #065f46;
    }

    .type-out {
      background: #fee2e2;
      color: #991b1b;
    }

    .type-adjust {
      background: #fef3c7;
      color: #92400e;
    }

    .type-transfer {
      background: #e0e7ff;
      color: #4338ca;
    }

    /* ===== Quantity Badges ===== */
    .qty-badge {
      display: inline-block;
      padding: 2px 8px;
      font-size: 9px;
      font-weight: bold;
      text-align: center;
    }

    .qty-positive {
      background: #d1fae5;
      color: #065f46;
    }

    .qty-negative {
      background: #fee2e2;
      color: #991b1b;
    }

    .qty-neutral {
      background: #f1f5f9;
      color: #475569;
    }

    /* ===== Reference & User ===== */
    .reference-text {
      color: #64748b;
      font-size: 7px;
      max-width: 80px;
      overflow: hidden;
    }

    .user-cell {
      color: #475569;
      font-size: 8px;
    }

    /* ===== Footer ===== */
    .report-footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 8px 10mm;
      border-top: 1px solid #e2e8f0;
      font-size: 7px;
      color: #94a3b8;
    }

    .footer-left {
      float: left;
    }

    .footer-right {
      float: right;
    }

    /* ===== No Data State ===== */
    .no-data {
      text-align: center;
      padding: 30px 15px;
      background: #f8fafc;
      border: 1px dashed #e2e8f0;
    }

    .no-data-title {
      font-size: 12px;
      font-weight: bold;
      color: #64748b;
      margin-bottom: 3px;
    }

    .no-data-text {
      font-size: 9px;
      color: #94a3b8;
    }

    /* ===== Totals Row ===== */
    .totals-row {
      background: #f8fafc !important;
      font-weight: bold;
    }

    .totals-row td {
      border-top: 2px solid #e2e8f0 !important;
      padding: 8px 6px !important;
    }

    .total-label {
      font-size: 8px;
      font-weight: bold;
      color: #475569;
      text-transform: uppercase;
    }

    .total-value {
      font-size: 10px;
      font-weight: bold;
      color: #0f172a;
    }

    /* Page break handling */
    .page-break {
      page-break-after: always;
    }
  </style>
</head>
<body>
  @php
    $rows = $rows ?? collect();
    $range = $range ?? '7d';
    $rangeLabels = [
      '7d' => 'Last 7 Days',
      '30d' => 'Last 30 Days',
      '90d' => 'Last 90 Days',
      'all' => 'All Time'
    ];
    
    // Calculate summary stats
    $totalIn = $rows->where('type', 'IN')->sum('qty');
    $totalOut = $rows->where('type', 'OUT')->sum('qty');
    $totalAdjust = $rows->whereIn('type', ['ADJUST', 'TRANSFER'])->sum('qty');
    $totalMovements = $rows->count();
    
    $countIn = $rows->where('type', 'IN')->count();
    $countOut = $rows->where('type', 'OUT')->count();
    $countAdjust = $rows->whereIn('type', ['ADJUST', 'TRANSFER'])->count();
  @endphp

  {{-- Report Header --}}
  <div class="report-header">
    <table class="header-table">
      <tr>
        <td style="width: 60%;">
          <div class="company-name">{{ config('app.name', 'Inventory System') }}</div>
          <div class="report-title">Stock Movements Report</div>
        </td>
        <td style="width: 40%;">
          <div class="report-meta">
            <div><strong>Period:</strong> {{ $rangeLabels[$range] ?? $range }}</div>
            <div><strong>Generated:</strong> {{ now()->format('M d, Y h:i A') }}</div>
            <div><strong>By:</strong> {{ auth()->user()->name ?? 'System' }}</div>
          </div>
        </td>
      </tr>
    </table>
  </div>

  {{-- Summary Cards --}}
  <div class="summary-section">
    <table class="summary-table">
      <tr>
        <td>
          <div class="summary-value purple">{{ number_format($totalMovements) }}</div>
          <div class="summary-label">Total Movements</div>
        </td>
        <td>
          <div class="summary-value green">{{ number_format($countIn) }}</div>
          <div class="summary-label">Stock In ({{ number_format($totalIn) }} units)</div>
        </td>
        <td>
          <div class="summary-value red">{{ number_format($countOut) }}</div>
          <div class="summary-label">Stock Out ({{ number_format($totalOut) }} units)</div>
        </td>
        <td>
          <div class="summary-value yellow">{{ number_format($countAdjust) }}</div>
          <div class="summary-label">Adjustments</div>
        </td>
      </tr>
    </table>
  </div>

  {{-- Movements Table --}}
  <div class="section-title">Movement Details</div>

  @if($rows->count() > 0)
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 70px;">Date/Time</th>
          <th class="text-center" style="width: 55px;">Type</th>
          <th class="text-right" style="width: 55px;">Qty</th>
          <th style="width: 65px;">SKU</th>
          <th style="width: 120px;">Product</th>
          <th style="width: 55px;">Warehouse</th>
          <th style="width: 70px;">Reference</th>
          <th style="width: 60px;">User</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rows as $r)
          @php
            $type = strtoupper($r->type ?? 'ADJUST');
            $sign = $type === 'IN' ? '+' : ($type === 'OUT' ? '-' : '±');
            $qtyClass = $type === 'IN' ? 'qty-positive' : ($type === 'OUT' ? 'qty-negative' : 'qty-neutral');
            $typeClass = 'type-' . strtolower($type);
          @endphp
          <tr>
            {{-- Date/Time --}}
            <td>
              <div class="date-primary">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</div>
              <div class="date-secondary">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}</div>
            </td>

            {{-- Type --}}
            <td class="text-center">
              <span class="type-badge {{ $typeClass }}">{{ $type }}</span>
            </td>

            {{-- Quantity --}}
            <td class="text-right">
              <span class="qty-badge {{ $qtyClass }}">{{ $sign }}{{ number_format((int) $r->qty) }}</span>
            </td>

            {{-- SKU --}}
            <td>
              <span class="sku-cell">{{ $r->sku ?? '—' }}</span>
            </td>

            {{-- Product --}}
            <td>
              <div class="product-name">{{ $r->product_name ?? '—' }}</div>
            </td>

            {{-- Warehouse --}}
            <td>
              <span class="warehouse-cell">{{ $r->wh_code ?? '—' }}</span>
            </td>

            {{-- Reference --}}
            <td>
              <span class="reference-text">{{ $r->reference ?: '—' }}</span>
            </td>

            {{-- User --}}
            <td>
              <span class="user-cell">{{ $r->user_name ?? '—' }}</span>
            </td>
          </tr>
        @endforeach

        {{-- Totals Row --}}
        <tr class="totals-row">
          <td colspan="2" style="text-align: right;">
            <span class="total-label">Totals:</span>
          </td>
          <td class="text-right">
            <span class="total-value">{{ number_format($rows->sum('qty')) }}</span>
          </td>
          <td colspan="5"></td>
        </tr>
      </tbody>
    </table>
  @else
    <div class="no-data">
      <div class="no-data-title">No Movements Found</div>
      <div class="no-data-text">There are no stock movements in the selected date range.</div>
    </div>
  @endif

  {{-- Footer --}}
  <div class="report-footer">
    <span class="footer-left">{{ config('app.name', 'Inventory System') }} • Stock Movements Report • {{ $rangeLabels[$range] ?? $range }}</span>
    <span class="footer-right">Page 1 • Generated on {{ now()->format('F d, Y') }}</span>
  </div>
</body>
</html>
