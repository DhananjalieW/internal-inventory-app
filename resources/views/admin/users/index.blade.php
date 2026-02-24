{{-- resources/views/admin/users/index.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Users Page Styles ===== */
    .users-page {
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

    .page-title-section {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .page-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .page-icon i {
      font-size: 24px;
      color: white;
    }

    .page-title {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      margin: 0 0 6px 0;
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

    .page-subtitle i {
      font-size: 14px;
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

    /* ===== Stats Cards ===== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
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

    .stat-card.total::before {
      background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
    }

    .stat-card.admin::before {
      background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
    }

    .stat-card.manager::before {
      background: linear-gradient(180deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .stat-card.clerk::before {
      background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .stat-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-icon.total {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .stat-icon.total i {
      color: #2563eb;
    }

    .stat-icon.admin {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .stat-icon.admin i {
      color: #dc2626;
    }

    .stat-icon.manager {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
    }

    .stat-icon.manager i {
      color: #7c3aed;
    }

    .stat-icon.clerk {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .stat-icon.clerk i {
      color: #d97706;
    }

    .stat-icon i {
      font-size: 20px;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
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

    .alert-error-custom {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border: 1px solid #fecaca;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
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

    .alert-icon.error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

    .alert-content.error {
      color: #991b1b;
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

    .alert-close.error {
      color: #991b1b;
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

    /* ===== User Cell ===== */
    .user-cell {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .user-avatar {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      font-size: 18px;
      font-weight: 700;
      color: white;
    }

    .user-info {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .user-name {
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .user-badge {
      display: inline-flex;
      align-items: center;
      padding: 2px 8px;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border-radius: 6px;
      font-size: 10px;
      font-weight: 700;
      color: #92400e;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .user-created {
      font-size: 12px;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .user-created i {
      font-size: 12px;
    }

    /* ===== Email Cell ===== */
    .email-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .email-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .email-icon i {
      color: #2563eb;
      font-size: 16px;
    }

    .email-text {
      color: #475569;
      font-weight: 500;
    }

    /* ===== Role Badges ===== */
    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 700;
    }

    .role-badge.admin {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .role-badge.manager {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
      color: #5b21b6;
    }

    .role-badge.clerk {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .role-badge.viewer {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #475569;
    }

    .role-badge i {
      font-size: 14px;
    }

    /* ===== Action Buttons ===== */
    .action-group {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }

    .btn-edit {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 18px;
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

    .btn-edit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .btn-delete {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 18px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      color: #64748b;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-delete:hover {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #dc2626;
      transform: translateY(-2px);
    }

    .btn-delete:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none !important;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
      color: #94a3b8 !important;
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 80px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
      border-radius: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .empty-state-icon i {
      font-size: 44px;
      color: #8b5cf6;
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
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
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

      .page-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .btn-new {
        width: 100%;
        justify-content: center;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .data-table-wrapper {
        overflow-x: auto;
      }

      .data-table {
        min-width: 700px;
      }

      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }

      .action-group {
        flex-direction: column;
      }
    }
  </style>

  @php
    $adminCount = \App\Models\User::where('role', 'Admin')->count();
    $managerCount = \App\Models\User::where('role', 'Inventory Manager')->count();
    $clerkCount = \App\Models\User::where('role', 'Clerk')->count();
    $totalUsers = \App\Models\User::count();
  @endphp

  <div class="users-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-people-fill"></i>
          </div>
          <div>
            <h1 class="page-title">Users</h1>
            <p class="page-subtitle">
              <i class="bi bi-people"></i>
              Manage user accounts and roles
            </p>
          </div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-new">
          <i class="bi bi-plus-circle"></i>
          New User
        </a>
      </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
      {{-- Total Users --}}
      <div class="stat-card total">
        <div class="stat-card-header">
          <div class="stat-icon total">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($totalUsers) }}</div>
        <div class="stat-label">Total Users</div>
      </div>

      {{-- Admin --}}
      <div class="stat-card admin">
        <div class="stat-card-header">
          <div class="stat-icon admin">
            <i class="bi bi-shield-check"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($adminCount) }}</div>
        <div class="stat-label">Administrators</div>
      </div>

      {{-- Managers --}}
      <div class="stat-card manager">
        <div class="stat-card-header">
          <div class="stat-icon manager">
            <i class="bi bi-person-gear"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($managerCount) }}</div>
        <div class="stat-label">Inventory Managers</div>
      </div>

      {{-- Clerks --}}
      <div class="stat-card clerk">
        <div class="stat-card-header">
          <div class="stat-icon clerk">
            <i class="bi bi-person-badge"></i>
          </div>
        </div>
        <div class="stat-value">{{ number_format($clerkCount) }}</div>
        <div class="stat-label">Clerks</div>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close success" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">{{ session('error') }}</div>
        <button type="button" class="alert-close error" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Users Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 30%;">Name</th>
              <th style="width: 30%;">Email</th>
              <th style="width: 20%;">Role</th>
              <th class="text-end" style="width: 20%;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $u)
              @php
                $roleClass = match($u->role) {
                  'Admin' => 'admin',
                  'Inventory Manager' => 'manager',
                  'Clerk' => 'clerk',
                  'Viewer' => 'viewer',
                  default => 'viewer'
                };
                $roleIcon = match($u->role) {
                  'Admin' => 'bi-shield-check',
                  'Inventory Manager' => 'bi-person-gear',
                  'Clerk' => 'bi-person-badge',
                  'Viewer' => 'bi-eye',
                  default => 'bi-person'
                };
                $initials = strtoupper(substr($u->name, 0, 1));
              @endphp
              <tr>
                {{-- Name --}}
                <td>
                  <div class="user-cell">
                    <div class="user-avatar">
                      {{ $initials }}
                    </div>
                    <div class="user-info">
                      <span class="user-name">
                        {{ $u->name }}
                        @if($u->id === auth()->id())
                          <span class="user-badge">You</span>
                        @endif
                      </span>
                      <span class="user-created">
                        <i class="bi bi-calendar3"></i>
                        Joined {{ $u->created_at->format('M d, Y') }}
                      </span>
                    </div>
                  </div>
                </td>

                {{-- Email --}}
                <td>
                  <div class="email-cell">
                    <div class="email-icon">
                      <i class="bi bi-envelope"></i>
                    </div>
                    <span class="email-text">{{ $u->email }}</span>
                  </div>
                </td>

                {{-- Role --}}
                <td>
                  <span class="role-badge {{ $roleClass }}">
                    <i class="bi {{ $roleIcon }}"></i>
                    {{ $u->role }}
                  </span>
                </td>

                {{-- Actions --}}
                <td>
                  <div class="action-group">
                    <a href="{{ route('admin.users.edit', $u) }}" class="btn-edit">
                      <i class="bi bi-pencil-square"></i>
                      Edit
                    </a>
                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST"
                          onsubmit="return confirm('Delete user {{ $u->name }}? This cannot be undone.');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-delete" {{ $u->id === auth()->id() ? 'disabled' : '' }}>
                        <i class="bi bi-trash"></i>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <h4 class="empty-state-title">No users found</h4>
                    <p class="empty-state-text">Get started by adding your first user.</p>
                    <a href="{{ route('admin.users.create') }}" class="btn-empty-action">
                      <i class="bi bi-plus-circle"></i>
                      Add New User
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Table Footer with Pagination --}}
      @if($users->count() > 0)
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $users->firstItem() ?? 0 }}</span> to <span>{{ $users->lastItem() ?? 0 }}</span> 
            of <span>{{ $users->total() }}</span> users
          </div>
          @if($users->hasPages())
            {{ $users->links() }}
          @endif
        </div>
      @endif
    </div>
  </div>
</x-app-layout>