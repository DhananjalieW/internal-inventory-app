{{-- resources/views/dash/clerk.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Clerk Dashboard Styles ===== */
    .clerk-dashboard {
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

    .quick-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-quick {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .btn-quick:hover {
      background: rgba(99, 102, 241, 0.3);
      border-color: rgba(99, 102, 241, 0.5);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-quick i {
      font-size: 18px;
    }

    .btn-quick.primary {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-color: transparent;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-quick.primary:hover {
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }

    /* ===== KPI Cards ===== */
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    @media (max-width: 992px) {
      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .kpi-grid {
        grid-template-columns: 1fr;
      }
    }

    .kpi-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .kpi-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      border-color: transparent;
    }

    .kpi-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .kpi-card:hover::before {
      opacity: 1;
    }

    .kpi-card.orders::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .kpi-card.due::before { background: linear-gradient(90deg, #f59e0b, #ef4444); }
    .kpi-card.movements::before { background: linear-gradient(90deg, #10b981, #14b8a6); }

    .kpi-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .kpi-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .kpi-card:hover .kpi-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .kpi-icon i {
      font-size: 26px;
      color: white;
    }

    .kpi-icon.orders { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3); }
    .kpi-icon.due { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3); }
    .kpi-icon.movements { background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%); box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3); }

    .kpi-badge {
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .kpi-badge.warning {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    .kpi-badge.info {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      color: #1e40af;
    }

    .kpi-label {
      color: #64748b;
      font-size: 13px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
    }

    .kpi-value {
      color: #0f172a;
      font-size: 32px;
      font-weight: 800;
      line-height: 1;
      margin-bottom: 16px;
      letter-spacing: -1px;
    }

    .kpi-link {
      color: #6366f1;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.3s ease;
    }

    .kpi-link:hover {
      color: #4f46e5;
      gap: 10px;
    }

    /* ===== Data Cards ===== */
    .data-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
      margin-bottom: 28px;
    }

    .data-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .data-card-header {
      padding: 24px 28px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #f1f5f9;
    }

    .data-card-title {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .data-card-title i {
      color: #6366f1;
      font-size: 20px;
    }

    .data-card-action {
      color: #6366f1;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .data-card-action:hover {
      background: rgba(99, 102, 241, 0.1);
      color: #4f46e5;
    }

    .data-card-body {
      padding: 0;
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
      padding: 14px 24px;
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      text-align: left;
    }

    .data-table thead th:last-child {
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
      padding: 16px 24px;
      font-size: 14px;
      color: #334155;
    }

    .data-table tbody td:last-child {
      text-align: right;
    }

    /* ===== Badges ===== */
    .po-badge {
      font-family: 'SF Mono', 'Fira Code', monospace;
      font-size: 13px;
      font-weight: 700;
      color: #0f172a;
      background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
      padding: 8px 14px;
      border-radius: 8px;
      display: inline-block;
    }

    .sku-badge {
      font-family: 'SF Mono', 'Fira Code', monospace;
      font-size: 13px;
      font-weight: 600;
      color: #6366f1;
      background: rgba(99, 102, 241, 0.1);
      padding: 6px 12px;
      border-radius: 8px;
    }

    .product-info {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .product-name {
      font-weight: 500;
      color: #0f172a;
      font-size: 14px;
    }

    .product-sku {
      font-family: 'SF Mono', 'Fira Code', monospace;
      font-size: 12px;
      color: #6366f1;
    }

    .warehouse-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .warehouse-icon {
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 14px;
    }

    .warehouse-code {
      font-weight: 600;
      color: #0f172a;
    }

    .qty-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
    }

    .qty-badge.pending {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      color: #92400e;
    }

    .qty-badge.normal {
      background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
      color: #0f172a;
    }

    .date-info {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 8px;
      color: #64748b;
      font-size: 13px;
    }

    .date-info i {
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
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    /* ===== Action Buttons ===== */
    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .btn-action i {
      font-size: 16px;
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
      border-radius: 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
    }

    .empty-state-icon i {
      font-size: 36px;
      color: #059669;
    }

    .empty-state-icon.neutral {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-state-icon.neutral i {
      color: #64748b;
    }

    .empty-state-title {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 14px;
      margin-bottom: 24px;
    }

    .btn-empty-action {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 24px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-empty-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
      color: white;
    }

    /* ===== Time Display ===== */
    .time-display {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #64748b;
      font-size: 13px;
    }

    .time-display i {
      color: #94a3b8;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .page-header {
        padding: 24px;
      }

      .page-title {
        font-size: 1.5rem;
      }

      .quick-actions {
        width: 100%;
        justify-content: stretch;
      }

      .btn-quick {
        flex: 1;
        justify-content: center;
      }

      .data-table {
        display: block;
        overflow-x: auto;
      }

      .data-card-header {
        padding: 20px;
      }

      .data-table thead th,
      .data-table tbody td {
        padding: 12px 16px;
      }
    }
  </style>

  <div class="clerk-dashboard">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Clerk Dashboard</h1>
          <p class="page-subtitle">
            <i class="bi bi-speedometer2"></i>
            Quick access to daily tasks
          </p>
        </div>
        <div class="quick-actions">
          <a href="{{ route('movements.create') }}" class="btn-quick primary">
            <i class="bi bi-plus-circle"></i>
            Record Movement
          </a>
          <a href="{{ route('pos.index') }}" class="btn-quick">
            <i class="bi bi-receipt"></i>
            Open POs
          </a>
        </div>
      </div>
    </div>

    {{-- KPI Cards --}}
    <div class="kpi-grid">
      <div class="kpi-card orders">
        <div class="kpi-header">
          <div class="kpi-icon orders">
            <i class="bi bi-receipt"></i>
          </div>
        </div>
        <div class="kpi-label">Open Purchase Orders</div>
        <div class="kpi-value">{{ number_format($openPoCount ?? 0) }}</div>
        <a href="{{ route('pos.index') }}" class="kpi-link">
          View all POs <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card due">
        <div class="kpi-header">
          <div class="kpi-icon due">
            <i class="bi bi-calendar-event"></i>
          </div>
          <span class="kpi-badge warning">
            <i class="bi bi-exclamation-circle"></i>
            Urgent
          </span>
        </div>
        <div class="kpi-label">Due Soon</div>
        <div class="kpi-value">{{ number_format($openPoDueSoon ?? 0) }}</div>
        <a href="{{ route('pos.index') }}" class="kpi-link">
          Review items <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card movements">
        <div class="kpi-header">
          <div class="kpi-icon movements">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <span class="kpi-badge info">
            <i class="bi bi-clock-history"></i>
            Today
          </span>
        </div>
        <div class="kpi-label">My Movements</div>
        <div class="kpi-value">{{ $recentMovements->count() ?? 0 }}</div>
        <a href="{{ route('movements.index') }}" class="kpi-link">
          View history <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    {{-- Items to Receive --}}
    <div class="data-card">
      <div class="data-card-header">
        <h3 class="data-card-title">
          <i class="bi bi-box-arrow-in-down"></i>
          Items to Receive
        </h3>
        <a href="{{ route('pos.index') }}" class="data-card-action">
          Open POs <i class="bi bi-arrow-right"></i>
        </a>
      </div>
      <div class="data-card-body">
        <table class="data-table">
          <thead>
            <tr>
              <th>PO #</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th>Remaining</th>
              <th>Expected</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($toReceive as $r)
              <tr>
                <td>
                  <span class="po-badge">{{ $r->po_number }}</span>
                </td>
                <td>
                  <div class="product-info">
                    <span class="product-name">{{ $r->product_name }}</span>
                    <span class="product-sku">{{ $r->sku }}</span>
                  </div>
                </td>
                <td>
                  <div class="warehouse-badge">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <span class="warehouse-code">{{ $r->wh_code }}</span>
                  </div>
                </td>
                <td>
                  <span class="qty-badge pending">
                    <i class="bi bi-hourglass-split"></i>
                    {{ number_format($r->remaining) }} units
                  </span>
                </td>
                <td>
                  @if($r->expected_date)
                    <div class="date-info">
                      <i class="bi bi-calendar-check"></i>
                      <span>{{ $r->expected_date }}</span>
                    </div>
                  @else
                    <span style="color: #94a3b8;">—</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('pos.item.receive.form', $r->id) }}" class="btn-action">
                    <i class="bi bi-box-arrow-in-down"></i>
                    Receive
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <h4 class="empty-state-title">All caught up!</h4>
                    <p class="empty-state-text">Nothing to receive right now.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    {{-- My Recent Movements --}}
    <div class="data-card">
      <div class="data-card-header">
        <h3 class="data-card-title">
          <i class="bi bi-clock-history"></i>
          My Recent Movements
        </h3>
      </div>
      <div class="data-card-body">
        <table class="data-table">
          <thead>
            <tr>
              <th>When</th>
              <th>Type</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentMovements as $mv)
              <tr>
                <td>
                  <div class="time-display">
                    <i class="bi bi-clock"></i>
                    <span>{{ $mv->created_at->format('M d, H:i') }}</span>
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
                      <i class="bi bi-sliders"></i> ADJUST
                    </span>
                  @endif
                </td>
                <td>
                  <span class="sku-badge">{{ $mv->sku }}</span>
                </td>
                <td>
                  <div class="warehouse-badge">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <span class="warehouse-code">{{ $mv->code }}</span>
                  </div>
                </td>
                <td>
                  <span class="qty-badge normal">{{ number_format($mv->qty) }}</span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">
                  <div class="empty-state">
                    <div class="empty-state-icon neutral">
                      <i class="bi bi-inbox"></i>
                    </div>
                    <h4 class="empty-state-title">No movements yet</h4>
                    <p class="empty-state-text">Start recording your inventory movements</p>
                    <a href="{{ route('movements.create') }}" class="btn-empty-action">
                      <i class="bi bi-plus-circle"></i>
                      Record Movement
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
</x-app-layout>