{{-- resources/views/pos/index.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Purchase Orders Page Styles ===== */
    .pos-page {
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

    .btn-new {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border: none;
      border-radius: 14px;
      color: white;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-new:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
      color: white;
    }

    .btn-new i {
      font-size: 18px;
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

    .alert-warning-custom {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #fcd34d;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15);
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

    .alert-icon.warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
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

    .alert-content.success {
      color: #065f46;
    }

    .alert-content.warning {
      color: #92400e;
    }

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

    .alert-close.success {
      color: #065f46;
    }

    .alert-close.warning {
      color: #92400e;
    }

    /* ===== Search Card ===== */
    .search-card {
      background: white;
      border-radius: 16px;
      padding: 24px 28px;
      margin-bottom: 28px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .search-form {
      display: flex;
      gap: 16px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .search-input-wrapper {
      flex: 1;
      min-width: 280px;
    }

    .search-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
      margin-bottom: 10px;
    }

    .search-input-group {
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input-group i {
      position: absolute;
      left: 16px;
      color: #94a3b8;
      font-size: 18px;
      z-index: 1;
    }

    .search-input {
      width: 100%;
      padding: 14px 16px 14px 50px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
    }

    .search-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .search-input:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .search-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-search {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #475569;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      border-color: #6366f1;
      color: #6366f1;
      background: white;
    }

    .btn-clear {
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

    .btn-clear:hover {
      border-color: #ef4444;
      color: #ef4444;
      background: #fef2f2;
    }

    /* ===== Data Card ===== */
    .data-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
    }

    .data-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
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
      padding: 16px 24px;
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
      padding: 18px 24px;
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

    /* ===== PO Number Cell ===== */
    .po-number {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
      letter-spacing: 0.5px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      padding: 8px 14px;
      border-radius: 8px;
      display: inline-block;
    }

    /* ===== Supplier Cell ===== */
    .supplier-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .supplier-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    .supplier-icon i {
      color: white;
      font-size: 18px;
    }

    .supplier-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    /* ===== Status Badges ===== */
    .status-badge {
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

    .status-badge.draft {
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      color: #4b5563;
    }

    .status-badge.open {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    .status-badge.approved {
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4338ca;
    }

    .status-badge.sent {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .status-badge.closed {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .status-badge.cancelled {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .status-badge i {
      font-size: 12px;
    }

    /* ===== Items Count Badge ===== */
    .items-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 36px;
      height: 36px;
      padding: 0 12px;
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      color: #4338ca;
      border-radius: 10px;
      font-weight: 700;
      font-size: 14px;
    }

    /* ===== Date Cell ===== */
    .date-cell {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      font-size: 14px;
    }

    .date-cell i {
      color: #94a3b8;
      font-size: 16px;
    }

    .date-cell.expected {
      color: #0d9488;
    }

    .date-cell.expected i {
      color: #14b8a6;
    }

    /* ===== Action Buttons ===== */
    .action-group {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
      flex-wrap: wrap;
    }

    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .btn-action i {
      font-size: 14px;
    }

    .btn-approve {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-approve:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
      color: white;
    }

    .btn-send {
      background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .btn-send:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
      color: white;
    }

    .btn-receive {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-receive:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .btn-cancel-po {
      background: white;
      color: #ef4444;
      border: 2px solid #fecaca;
    }

    .btn-cancel-po:hover {
      background: #fef2f2;
      border-color: #ef4444;
      transform: translateY(-2px);
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
      margin-bottom: 28px;
    }

    .btn-empty-action {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 14px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-empty-action:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
      color: white;
    }

    /* ===== Table Footer ===== */
    .table-footer {
      padding: 20px 24px;
      border-top: 1px solid #f1f5f9;
      display: flex;
      justify-content: flex-end;
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
      .action-group {
        flex-direction: column;
        align-items: flex-end;
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

      .btn-new {
        width: 100%;
        justify-content: center;
      }

      .search-form {
        flex-direction: column;
      }

      .search-input-wrapper {
        width: 100%;
        min-width: unset;
      }

      .btn-search {
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
        gap: 16px;
      }
    }
  </style>

  <div class="pos-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Purchase Orders</h1>
          <p class="page-subtitle">
            <i class="bi bi-receipt"></i>
            Manage supplier orders and deliveries
          </p>
        </div>
        <a href="{{ route('pos.create') }}" class="btn-new">
          <i class="bi bi-plus-circle"></i>
          New PO
        </a>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-lg"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close success" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Warning Alert --}}
    @if(session('warning'))
      <div class="alert-custom alert-warning-custom">
        <div class="alert-icon warning">
          <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="alert-content warning">{{ session('warning') }}</div>
        <button type="button" class="alert-close warning" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Search Card --}}
    <div class="search-card">
      <form method="GET" class="search-form">
        <div class="search-input-wrapper">
          <label class="search-label">Search Purchase Orders</label>
          <div class="search-input-group">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="search-input" 
              value="{{ $q }}" 
              placeholder="Search by PO number or supplier name..."
            >
          </div>
        </div>
        <button type="submit" class="btn-search">
          <i class="bi bi-funnel"></i>
          Search
        </button>
        @if($q)
          <a href="{{ route('pos.index') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
          </a>
        @endif
      </form>
    </div>

    {{-- Purchase Orders Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>PO Number</th>
              <th>Supplier</th>
              <th class="text-center">Status</th>
              <th class="text-center">Items</th>
              <th>Order Date</th>
              <th>Expected</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pos as $p)
              @php
                $statusLower = strtolower($p->status);
                $statusIcons = [
                  'draft'     => 'bi-file-earmark',
                  'open'      => 'bi-circle',
                  'approved'  => 'bi-check-circle',
                  'sent'      => 'bi-send',
                  'closed'    => 'bi-check-circle-fill',
                  'cancelled' => 'bi-x-circle-fill',
                ];
                $statusIcon = $statusIcons[$statusLower] ?? 'bi-circle';
                $canManage = in_array(Auth::user()->role, ['Admin','Inventory Manager']);
              @endphp

              <tr>
                {{-- PO Number --}}
                <td>
                  <span class="po-number">{{ $p->po_number }}</span>
                </td>

                {{-- Supplier --}}
                <td>
                  <div class="supplier-cell">
                    <div class="supplier-icon">
                      <i class="bi bi-truck"></i>
                    </div>
                    <span class="supplier-name">{{ $p->supplier ?? '—' }}</span>
                  </div>
                </td>

                {{-- Status --}}
                <td class="text-center">
                  <span class="status-badge {{ $statusLower }}">
                    <i class="bi {{ $statusIcon }}"></i>
                    {{ strtoupper($p->status) }}
                  </span>
                </td>

                {{-- Items Count --}}
                <td class="text-center">
                  <span class="items-badge">{{ $p->items_count ?? 0 }}</span>
                </td>

                {{-- Order Date --}}
                <td>
                  <div class="date-cell">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ $p->order_date }}</span>
                  </div>
                </td>

                {{-- Expected Date --}}
                <td>
                  @if($p->expected_date)
                    <div class="date-cell expected">
                      <i class="bi bi-calendar-check"></i>
                      <span>{{ $p->expected_date }}</span>
                    </div>
                  @else
                    <span style="color: #94a3b8;">—</span>
                  @endif
                </td>

                {{-- Actions --}}
                <td>
                  <div class="action-group">
                    {{-- Manager/Admin actions --}}
                    @if($canManage)
                      {{-- Approve button for DRAFT/OPEN status --}}
                      @if(in_array($statusLower, ['draft', 'open']))
                        <form class="d-inline" method="POST" action="{{ route('pos.approve', $p->id) }}">
                          @csrf
                          <button type="submit" class="btn-action btn-approve">
                            <i class="bi bi-check-circle"></i>
                            Approve
                          </button>
                        </form>
                      @endif

                      {{-- Send button for DRAFT/OPEN/APPROVED status --}}
                      @if(in_array($statusLower, ['draft', 'open', 'approved']))
                        <form class="d-inline" method="POST" action="{{ route('pos.send', $p->id) }}">
                          @csrf
                          <button type="submit" class="btn-action btn-send">
                            <i class="bi bi-send"></i>
                            Send
                          </button>
                        </form>
                      @endif

                      {{-- Cancel button (only if not already closed/cancelled) --}}
                      @if(!in_array($statusLower, ['closed', 'cancelled']))
                        <form class="d-inline" method="POST" action="{{ route('pos.cancel', $p->id) }}"
                              onsubmit="return confirm('Are you sure you want to cancel this PO?');">
                          @csrf
                          <button type="submit" class="btn-action btn-cancel-po">
                            <i class="bi bi-x-circle"></i>
                            Cancel
                          </button>
                        </form>
                      @endif
                    @endif

                    {{-- Receive buttons --}}
                    @if($p->items->count())
                      @foreach($p->items->take(3) as $item)
                        @php
                          $remaining = (int)$item->qty_ordered - (int)$item->received_qty;
                        @endphp
                        @if($remaining > 0)
                          <a href="{{ route('pos.item.receive.form', $item->id) }}" class="btn-action btn-receive">
                            <i class="bi bi-box-arrow-in-down"></i>
                            Receive ({{ $remaining }}x)
                          </a>
                        @endif
                      @endforeach
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-receipt"></i>
                    </div>
                    <h4 class="empty-state-title">No purchase orders found</h4>
                    <p class="empty-state-text">Create your first purchase order to get started</p>
                    <a href="{{ route('pos.create') }}" class="btn-empty-action">
                      <i class="bi bi-plus-circle"></i>
                      New PO
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($pos->hasPages())
        <div class="table-footer">
          {{ $pos->links() }}
        </div>
      @endif
    </div>
  </div>
</x-app-layout>