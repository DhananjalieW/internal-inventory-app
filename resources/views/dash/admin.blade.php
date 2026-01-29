<?php>
<x-app-layout>
  <style>
    /* ===== Admin Dashboard Styles ===== */
    .admin-dashboard {
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

    /* ===== Alert Banner ===== */
    .alert-banner {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #fcd34d;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      box-shadow: 0 4px 15px rgba(251, 191, 36, 0.2);
    }

    .alert-banner-content {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .alert-icon-wrapper {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    .alert-icon-wrapper i {
      color: white;
      font-size: 22px;
    }

    .alert-text {
      color: #92400e;
      font-size: 15px;
      font-weight: 500;
    }

    .alert-text strong {
      color: #78350f;
      font-weight: 700;
    }

    .btn-alert {
      padding: 12px 24px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    .btn-alert:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
      color: white;
    }

    /* ===== Movement Summary ===== */
    .movement-summary {
      background: white;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      border: 1px solid #e2e8f0;
    }

    .movement-chip {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 10px 18px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .movement-chip:hover {
      transform: translateY(-2px);
    }

    .movement-chip.in {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .movement-chip.out {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .movement-chip.adjust {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    .movement-chip i {
      font-size: 18px;
    }

    .movement-link {
      margin-left: auto;
      color: #6366f1;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 10px 16px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .movement-link:hover {
      background: rgba(99, 102, 241, 0.1);
      color: #4f46e5;
    }

    /* ===== KPI Cards ===== */
    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    @media (max-width: 1400px) {
      .kpi-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 768px) {
      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
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

    .kpi-card.users::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .kpi-card.products::before { background: linear-gradient(90deg, #ec4899, #f43f5e); }
    .kpi-card.warehouses::before { background: linear-gradient(90deg, #06b6d4, #0ea5e9); }
    .kpi-card.pos::before { background: linear-gradient(90deg, #f59e0b, #ef4444); }
    .kpi-card.lowstock::before { background: linear-gradient(90deg, #f97316, #ea580c); }
    .kpi-card.approvals::before { background: linear-gradient(90deg, #10b981, #14b8a6); }

    .kpi-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .kpi-card:hover .kpi-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .kpi-icon i {
      font-size: 26px;
      color: white;
    }

    .kpi-icon.users { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3); }
    .kpi-icon.products { background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%); box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3); }
    .kpi-icon.warehouses { background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%); box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3); }
    .kpi-icon.pos { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3); }
    .kpi-icon.lowstock { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3); }
    .kpi-icon.approvals { background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%); box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3); }

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

    .sku-badge {
      font-family: 'SF Mono', 'Fira Code', monospace;
      font-size: 13px;
      font-weight: 600;
      color: #0f172a;
      background: #f1f5f9;
      padding: 6px 12px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .sku-badge:hover {
      background: #e2e8f0;
      color: #6366f1;
    }

    .stock-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
    }

    .stock-badge.low {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .stock-badge.normal {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #475569;
    }

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
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-record:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
      color: white;
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 48px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .empty-state-icon i {
      font-size: 28px;
      color: #059669;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 14px;
      margin: 0;
    }

    /* ===== Warehouse List ===== */
    .warehouse-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 24px;
      border-bottom: 1px solid #f1f5f9;
      transition: all 0.2s ease;
    }

    .warehouse-item:hover {
      background: rgba(99, 102, 241, 0.02);
    }

    .warehouse-item:last-child {
      border-bottom: none;
    }

    .warehouse-info {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .warehouse-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 18px;
    }

    .warehouse-code {
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
    }

    .warehouse-qty {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
      background: #f1f5f9;
      padding: 8px 16px;
      border-radius: 10px;
    }

    /* ===== Activity List ===== */
    .activity-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 16px 24px;
      border-bottom: 1px solid #f1f5f9;
      transition: all 0.2s ease;
    }

    .activity-item:hover {
      background: rgba(99, 102, 241, 0.02);
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .activity-icon i {
      color: white;
      font-size: 16px;
    }

    .activity-content {
      flex: 1;
    }

    .activity-text {
      color: #0f172a;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 4px;
    }

    .activity-time {
      color: #94a3b8;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* ===== Movement Type Badges ===== */
    .type-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
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

      .alert-banner {
        flex-direction: column;
        text-align: center;
      }

      .movement-summary {
        flex-direction: column;
        align-items: stretch;
      }

      .movement-link {
        margin-left: 0;
        justify-content: center;
      }

      .data-table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>

  <div class="admin-dashboard">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Admin Dashboard</h1>
          <p class="page-subtitle">
            <i class="bi bi-speedometer2"></i>
            Overview, status & quick actions
          </p>
        </div>
        <div class="quick-actions">
          <a href="{{ route('movements.create') }}" class="btn-quick">
            <i class="bi bi-arrow-left-right"></i>
            Record Movement
          </a>
          <a href="{{ route('pos.create') }}" class="btn-quick">
            <i class="bi bi-receipt"></i>
            New PO
          </a>
          <a href="{{ route('admin.users.index') }}" class="btn-quick">
            <i class="bi bi-person-plus"></i>
            Invite User
          </a>
        </div>
      </div>
    </div>

    {{-- Low Stock Alert --}}
    @if($lowStockCount > 0)
      <div class="alert-banner">
        <div class="alert-banner-content">
          <div class="alert-icon-wrapper">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <span class="alert-text">
            There are <strong>{{ $lowStockCount }}</strong> items below reorder level that need attention
          </span>
        </div>
        <a href="{{ route('reorder.index') }}" class="btn-alert">View Report</a>
      </div>
    @endif

    {{-- Movement Summary --}}
    <div class="movement-summary">
      <div class="movement-chip in">
        <i class="bi bi-arrow-down-circle-fill"></i>
        IN: {{ $mvSummary['IN'] ?? 0 }}
      </div>
      <div class="movement-chip out">
        <i class="bi bi-arrow-up-circle-fill"></i>
        OUT: {{ $mvSummary['OUT'] ?? 0 }}
      </div>
      <div class="movement-chip adjust">
        <i class="bi bi-sliders"></i>
        ADJUST: {{ $mvSummary['ADJUST'] ?? 0 }}
      </div>
      <a href="{{ route('reports.movements', ['range'=>'7d']) }}" class="movement-link">
        View movements (7d)
        <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    {{-- KPI Cards --}}
    <div class="kpi-grid">
      <div class="kpi-card users">
        <div class="kpi-icon users">
          <i class="bi bi-people"></i>
        </div>
        <div class="kpi-label">Users</div>
        <div class="kpi-value">{{ $usersCount }}</div>
        <a href="{{ route('admin.users.index') }}" class="kpi-link">
          Manage users <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card products">
        <div class="kpi-icon products">
          <i class="bi bi-box-seam"></i>
        </div>
        <div class="kpi-label">Products</div>
        <div class="kpi-value">{{ $productsCount }}</div>
        <a href="{{ route('products.index') }}" class="kpi-link">
          View products <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card warehouses">
        <div class="kpi-icon warehouses">
          <i class="bi bi-building"></i>
        </div>
        <div class="kpi-label">Warehouses</div>
        <div class="kpi-value">{{ $warehousesCount }}</div>
        <a href="{{ route('warehouses.index') }}" class="kpi-link">
          View warehouses <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card pos">
        <div class="kpi-icon pos">
          <i class="bi bi-receipt"></i>
        </div>
        <div class="kpi-label">Open POs</div>
        <div class="kpi-value">{{ $openPoCount }}</div>
        <a href="{{ route('pos.index') }}" class="kpi-link">
          View POs <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card lowstock">
        <div class="kpi-icon lowstock">
          <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="kpi-label">Low Stock</div>
        <div class="kpi-value">{{ $lowStockCount }}</div>
        <a href="{{ route('reorder.index') }}" class="kpi-link">
          Reorder report <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="kpi-card approvals">
        <div class="kpi-icon approvals">
          <i class="bi bi-check2-circle"></i>
        </div>
        <div class="kpi-label">Pending</div>
        <div class="kpi-value">{{ $pendingApprovals }}</div>
        <a href="{{ route('admin.approvals.index') }}" class="kpi-link">
          Open approvals <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="row g-4">
      {{-- Low Stock Table --}}
      <div class="col-lg-7">
        <div class="data-card h-100">
          <div class="data-card-header">
            <h3 class="data-card-title">
              <i class="bi bi-exclamation-diamond"></i>
              Low Stock Items
            </h3>
            <a href="{{ route('reorder.index') }}" class="data-card-action">
              View all <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          <div class="data-card-body">
            <table class="data-table">
              <thead>
                <tr>
                  <th>SKU</th>
                  <th>Product Name</th>
                  <th>On Hand</th>
                  <th>Reorder Point</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($lowStock as $r)
                  <tr>
                    <td>
                      <a href="{{ route('products.edit', $r->product_id) }}" class="sku-badge">
                        {{ $r->sku }}
                      </a>
                    </td>
                    <td>
                      <span style="font-weight: 500; color: #0f172a;">{{ $r->name }}</span>
                    </td>
                    <td>
                      <span class="stock-badge low">
                        <i class="bi bi-arrow-down"></i>
                        {{ $r->on_hand }}
                      </span>
                    </td>
                    <td>
                      <span class="stock-badge normal">{{ $r->reorder_point }}</span>
                    </td>
                    <td>
                      <a class="btn-record" href="{{ route('movements.create', [
                          'product_id' => $r->product_id,
                          'type' => 'IN',
                          'reference' => 'REPLEN',
                          'return' => url()->current(),
                      ]) }}">
                        <i class="bi bi-plus-circle"></i>
                        Record
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5">
                      <div class="empty-state">
                        <div class="empty-state-icon">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <p class="empty-state-text">All items are above reorder level</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- Right Column --}}
      <div class="col-lg-5">
        <div class="d-flex flex-column gap-4">
          {{-- Stock by Warehouse --}}
          <div class="data-card">
            <div class="data-card-header">
              <h3 class="data-card-title">
                <i class="bi bi-building"></i>
                Stock by Warehouse
              </h3>
              <a href="{{ route('reports.stock') }}" class="data-card-action">
                Full report <i class="bi bi-arrow-right"></i>
              </a>
            </div>
            <div class="data-card-body">
              @forelse($stockByWh as $wh)
                <div class="warehouse-item">
                  <div class="warehouse-info">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <span class="warehouse-code">{{ $wh->code }}</span>
                  </div>
                  <span class="warehouse-qty">{{ number_format($wh->qty) }}</span>
                </div>
              @empty
                <div class="empty-state">
                  <div class="empty-state-icon">
                    <i class="bi bi-inbox"></i>
                  </div>
                  <p class="empty-state-text">No stock data yet</p>
                </div>
              @endforelse
            </div>
          </div>

          {{-- Recent Activity --}}
          <div class="data-card">
            <div class="data-card-header">
              <h3 class="data-card-title">
                <i class="bi bi-activity"></i>
                Recent Activity
              </h3>
            </div>
            <div class="data-card-body">
              @forelse($recent->take(5) as $a)
                <div class="activity-item">
                  <div class="activity-icon">
                    <i class="bi bi-lightning"></i>
                  </div>
                  <div class="activity-content">
                    <div class="activity-text">{{ $a->event }}</div>
                    <div class="activity-time">
                      <i class="bi bi-clock"></i>
                      {{ $a->created_at ?? '—' }}
                    </div>
                  </div>
                </div>
              @empty
                <div class="empty-state">
                  <div class="empty-state-icon">
                    <i class="bi bi-clock-history"></i>
                  </div>
                  <p class="empty-state-text">No activity yet</p>
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Bottom Row --}}
    <div class="row g-4 mt-1">
      {{-- Top Movers --}}
      <div class="col-lg-7">
        <div class="data-card">
          <div class="data-card-header">
            <h3 class="data-card-title">
              <i class="bi bi-graph-up-arrow"></i>
              Top Movers (30 days)
            </h3>
          </div>
          <div class="data-card-body">
            <table class="data-table">
              <thead>
                <tr>
                  <th>SKU</th>
                  <th>Product Name</th>
                  <th>Movements</th>
                </tr>
              </thead>
              <tbody>
                @forelse($topMovers as $m)
                  <tr>
                    <td>
                      <span class="sku-badge">{{ $m->product->sku ?? '' }}</span>
                    </td>
                    <td>
                      <span style="font-weight: 500; color: #0f172a;">{{ $m->product->name ?? '' }}</span>
                    </td>
                    <td>
                      <span style="font-weight: 700; color: #6366f1; font-size: 16px;">{{ $m->cnt }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3">
                      <div class="empty-state">
                        <div class="empty-state-icon">
                          <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <p class="empty-state-text">No movements recorded yet</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- Recent Movements --}}
      <div class="col-lg-5">
        <div class="data-card">
          <div class="data-card-header">
            <h3 class="data-card-title">
              <i class="bi bi-arrow-left-right"></i>
              Recent Movements
            </h3>
          </div>
          <div class="data-card-body">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Type</th>
                  <th>SKU</th>
                  <th>Qty</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentMovements as $mv)
                  <tr>
                    <td>
                      <span style="color: #64748b; font-size: 13px;">
                        {{ $mv->created_at->format('M d, H:i') }}
                      </span>
                    </td>
                    <td>
                      @if($mv->type === 'IN')
                        <span class="type-badge in">
                          <i class="bi bi-arrow-down"></i> IN
                        </span>
                      @elseif($mv->type === 'OUT')
                        <span class="type-badge out">
                          <i class="bi bi-arrow-up"></i> OUT
                        </span>
                      @else
                        <span class="type-badge adjust">
                          <i class="bi bi-sliders"></i> ADJ
                        </span>
                      @endif
                    </td>
                    <td>
                      <span class="sku-badge" style="padding: 4px 10px; font-size: 12px;">
                        {{ $mv->product->sku ?? '' }}
                      </span>
                    </td>
                    <td>
                      <span style="font-weight: 700; color: #0f172a;">{{ $mv->qty }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4">
                      <div class="empty-state">
                        <div class="empty-state-icon">
                          <i class="bi bi-inbox"></i>
                        </div>
                        <p class="empty-state-text">No movements yet</p>
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
  </div>
</x-app-layout>