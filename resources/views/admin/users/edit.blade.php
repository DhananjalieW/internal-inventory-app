{{-- resources/views/admin/users/edit.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Edit User Page Styles ===== */
    .edit-user-page {
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
      background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: 10%;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(251, 191, 36, 0.1) 0%, transparent 70%);
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
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
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

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
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

    .btn-back:hover {
      background: rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 255, 255, 0.3);
      color: white;
      transform: translateX(-4px);
    }

    .btn-back i {
      transition: transform 0.3s ease;
    }

    .btn-back:hover i {
      transform: translateX(-4px);
    }

    /* ===== User Info Card ===== */
    .user-info-card {
      background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 20px;
      border: 1px solid #c4b5fd;
    }

    .user-avatar-large {
      width: 72px;
      height: 72px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      font-weight: 700;
      color: white;
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .user-details {
      flex: 1;
    }

    .user-details-name {
      font-size: 20px;
      font-weight: 700;
      color: #1e1b4b;
      margin-bottom: 4px;
    }

    .user-details-meta {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    .user-meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 14px;
      color: #5b21b6;
    }

    .user-meta-item i {
      font-size: 16px;
    }

    .current-role-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      background: white;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      color: #6366f1;
      box-shadow: 0 2px 8px rgba(99, 102, 241, 0.2);
    }

    .current-role-badge i {
      font-size: 14px;
    }

    /* ===== Alerts ===== */
    .alert-custom {
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: flex-start;
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
    }

    .alert-content.success {
      color: #065f46;
    }

    .alert-content.error {
      color: #991b1b;
    }

    .alert-title {
      font-size: 15px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .alert-list {
      margin: 0;
      padding-left: 20px;
      font-size: 14px;
    }

    .alert-list li {
      margin-bottom: 4px;
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
      flex-shrink: 0;
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

    /* ===== Form Card ===== */
    .form-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }

    .form-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .form-card-header {
      padding: 28px 32px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .header-icon i {
      color: white;
      font-size: 22px;
    }

    .header-text h3 {
      font-size: 18px;
      font-weight: 700;
      color: #0f172a;
      margin: 0 0 4px 0;
    }

    .header-text p {
      font-size: 14px;
      color: #64748b;
      margin: 0;
    }

    .form-card-body {
      padding: 32px;
    }

    /* ===== Form Grid ===== */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
    }

    .form-grid .full-width {
      grid-column: 1 / -1;
    }

    /* ===== Section Divider ===== */
    .section-divider {
      grid-column: 1 / -1;
      display: flex;
      align-items: center;
      gap: 16px;
      margin: 8px 0;
    }

    .section-divider-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .section-divider-icon i {
      color: #64748b;
      font-size: 18px;
    }

    .section-divider-text {
      font-size: 13px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .section-divider-line {
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, #e2e8f0, transparent);
    }

    .optional-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 10px;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      color: #92400e;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    /* ===== Form Groups ===== */
    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #475569;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .form-label .required {
      color: #ef4444;
      font-weight: 700;
    }

    .form-label i {
      color: #f59e0b;
      font-size: 16px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 18px;
      transition: color 0.3s ease;
      z-index: 1;
    }

    .form-input {
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

    .form-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .form-input:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .form-input:focus {
      outline: none;
      border-color: #f59e0b;
      background: white;
      box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }

    .form-input:focus + .input-icon,
    .input-wrapper:focus-within .input-icon {
      color: #f59e0b;
    }

    .form-input.is-invalid {
      border-color: #ef4444;
      background: #fef2f2;
    }

    .form-input.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    /* ===== Select Input ===== */
    .form-select {
      width: 100%;
      padding: 14px 16px 14px 50px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 12px;
    }

    .form-select:hover {
      border-color: #cbd5e1;
      background-color: white;
    }

    .form-select:focus {
      outline: none;
      border-color: #f59e0b;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }

    .form-select.is-invalid {
      border-color: #ef4444;
      background-color: #fef2f2;
    }

    /* ===== Password Input Group ===== */
    .password-input-group {
      position: relative;
      display: flex;
      align-items: center;
    }

    .password-input-group .form-input {
      padding-right: 50px;
    }

    .btn-toggle-password {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #94a3b8;
      cursor: pointer;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .btn-toggle-password:hover {
      color: #f59e0b;
    }

    .btn-toggle-password i {
      font-size: 18px;
    }

    /* ===== Form Help Text ===== */
    .form-help {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 8px;
      font-size: 12px;
      color: #64748b;
    }

    .form-help i {
      font-size: 14px;
      color: #94a3b8;
    }

    .form-help.warning {
      color: #92400e;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      padding: 10px 14px;
      border-radius: 10px;
      margin-top: 12px;
    }

    .form-help.warning i {
      color: #d97706;
    }

    /* ===== Error Message ===== */
    .invalid-feedback {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 8px;
      font-size: 13px;
      color: #dc2626;
      font-weight: 500;
    }

    .invalid-feedback i {
      font-size: 14px;
    }

    /* ===== Role Cards ===== */
    .role-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
    }

    .role-option {
      position: relative;
    }

    .role-option input[type="radio"] {
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
    }

    .role-card {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 16px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .role-card:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .role-option input[type="radio"]:checked + .role-card {
      border-color: #f59e0b;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
    }

    .role-option input[type="radio"]:checked + .role-card .role-icon {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .role-option input[type="radio"]:checked + .role-card .role-icon i {
      color: white;
    }

    .role-option input[type="radio"]:checked + .role-card .role-name {
      color: #92400e;
    }

    .role-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .role-icon i {
      color: #64748b;
      font-size: 18px;
      transition: all 0.3s ease;
    }

    .role-icon.admin { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); }
    .role-icon.admin i { color: #dc2626; }

    .role-icon.manager { background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); }
    .role-icon.manager i { color: #7c3aed; }

    .role-icon.clerk { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); }
    .role-icon.clerk i { color: #d97706; }

    .role-icon.viewer { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); }
    .role-icon.viewer i { color: #2563eb; }

    .role-info {
      flex: 1;
    }

    .role-name {
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 2px;
      transition: all 0.3s ease;
    }

    .role-desc {
      font-size: 12px;
      color: #64748b;
    }

    /* ===== Form Card Footer ===== */
    .form-card-footer {
      padding: 24px 32px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-top: 1px solid #e2e8f0;
      display: flex;
      justify-content: flex-end;
      gap: 16px;
    }

    .btn-cancel {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #64748b;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      border-color: #ef4444;
      color: #ef4444;
      background: #fef2f2;
      transform: translateY(-2px);
    }

    .btn-submit {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
    }

    .btn-submit i {
      font-size: 18px;
    }

    /* ===== Responsive ===== */
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

      .btn-back {
        width: 100%;
        justify-content: center;
      }

      .user-info-card {
        flex-direction: column;
        text-align: center;
      }

      .user-details-meta {
        justify-content: center;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .role-grid {
        grid-template-columns: 1fr;
      }

      .form-card-body {
        padding: 24px;
      }

      .form-card-footer {
        flex-direction: column;
        padding: 20px 24px;
      }

      .btn-cancel,
      .btn-submit {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  <div class="edit-user-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-pencil-square"></i>
          </div>
          <div>
            <h1 class="page-title">Edit User</h1>
            <p class="page-subtitle">
              <i class="bi bi-person-gear"></i>
              Update user information and permissions
            </p>
          </div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Users
        </a>
      </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
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
    @if ($errors->any())
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">
          <div class="alert-title">Please fix the following errors:</div>
          <ul class="alert-list">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="alert-close error" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- User Info Card --}}
    <div class="user-info-card">
      <div class="user-avatar-large">
        {{ strtoupper(substr($user->name, 0, 1)) }}
      </div>
      <div class="user-details">
        <div class="user-details-name">{{ $user->name }}</div>
        <div class="user-details-meta">
          <span class="user-meta-item">
            <i class="bi bi-envelope"></i>
            {{ $user->email }}
          </span>
          <span class="user-meta-item">
            <i class="bi bi-calendar3"></i>
            Joined {{ $user->created_at->format('M d, Y') }}
          </span>
        </div>
      </div>
      <div class="current-role-badge">
        <i class="bi bi-shield-check"></i>
        {{ $user->role }}
      </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" novalidate>
      @csrf
      @method('PUT')

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-person-vcard"></i>
          </div>
          <div class="header-text">
            <h3>User Information</h3>
            <p>Update the user's details and access level</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Name --}}
            <div class="form-group full-width">
              <label class="form-label">
                <i class="bi bi-person"></i>
                Full Name <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-person input-icon"></i>
                <input
                  type="text"
                  name="name"
                  class="form-input @error('name') is-invalid @enderror"
                  placeholder="Enter user's full name"
                  value="{{ old('name', $user->name) }}"
                  required
                >
              </div>
              @error('name')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="form-group full-width">
              <label class="form-label">
                <i class="bi bi-envelope"></i>
                Email Address <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-envelope input-icon"></i>
                <input
                  type="email"
                  name="email"
                  class="form-input @error('email') is-invalid @enderror"
                  placeholder="user@example.com"
                  value="{{ old('email', $user->email) }}"
                  required
                >
              </div>
              @error('email')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Role Section --}}
            <div class="section-divider">
              <div class="section-divider-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <span class="section-divider-text">User Role</span>
              <div class="section-divider-line"></div>
            </div>

            {{-- Role Selection --}}
            @php
              $roleList = $roles ?? (config('roles.list') ?? ['Admin','Inventory Manager','Clerk','Viewer']);
            @endphp
            <div class="form-group full-width">
              <label class="form-label">
                <i class="bi bi-shield-lock"></i>
                Select Role <span class="required">*</span>
              </label>
              <div class="role-grid">
                @foreach($roleList as $role)
                  @php
                    $roleClass = match($role) {
                      'Admin' => 'admin',
                      'Inventory Manager' => 'manager',
                      'Clerk' => 'clerk',
                      'Viewer' => 'viewer',
                      default => 'viewer'
                    };
                    $roleIcon = match($role) {
                      'Admin' => 'bi-shield-check',
                      'Inventory Manager' => 'bi-person-gear',
                      'Clerk' => 'bi-person-badge',
                      'Viewer' => 'bi-eye',
                      default => 'bi-person'
                    };
                    $roleDesc = match($role) {
                      'Admin' => 'Full system access',
                      'Inventory Manager' => 'Manage inventory',
                      'Clerk' => 'Basic operations',
                      'Viewer' => 'Read-only access',
                      default => ''
                    };
                  @endphp
                  <div class="role-option">
                    <input 
                      type="radio" 
                      name="role" 
                      value="{{ $role }}" 
                      id="role_{{ Str::slug($role) }}"
                      @checked(old('role', $user->role) === $role)
                    >
                    <label for="role_{{ Str::slug($role) }}" class="role-card">
                      <div class="role-icon {{ $roleClass }}">
                        <i class="bi {{ $roleIcon }}"></i>
                      </div>
                      <div class="role-info">
                        <div class="role-name">{{ $role }}</div>
                        <div class="role-desc">{{ $roleDesc }}</div>
                      </div>
                    </label>
                  </div>
                @endforeach
              </div>
              @error('role')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Change user's access level and permissions
              </div>
            </div>

            {{-- Password Section --}}
            <div class="section-divider">
              <div class="section-divider-icon">
                <i class="bi bi-lock"></i>
              </div>
              <span class="section-divider-text">Change Password</span>
              <span class="optional-badge">Optional</span>
              <div class="section-divider-line"></div>
            </div>

            {{-- Password Info --}}
            <div class="form-group full-width">
              <div class="form-help warning">
                <i class="bi bi-info-circle-fill"></i>
                Leave password fields blank to keep the current password unchanged
              </div>
            </div>

            {{-- Password --}}
            <div class="form-group">
              <label class="form-label">
                <i class="bi bi-key"></i>
                New Password
              </label>
              <div class="input-wrapper">
                <i class="bi bi-lock input-icon"></i>
                <div class="password-input-group">
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-input @error('password') is-invalid @enderror"
                    placeholder="Enter new password"
                    autocomplete="new-password"
                  >
                  <button type="button" class="btn-toggle-password" data-target="password">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Minimum 8 characters recommended
              </div>
              @error('password')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
              <label class="form-label">
                <i class="bi bi-key-fill"></i>
                Confirm New Password
              </label>
              <div class="input-wrapper">
                <i class="bi bi-lock-fill input-icon"></i>
                <div class="password-input-group">
                  <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-input"
                    placeholder="Re-enter new password"
                    autocomplete="new-password"
                  >
                  <button type="button" class="btn-toggle-password" data-target="password_confirmation">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Must match the password above
              </div>
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <a href="{{ route('admin.users.index') }}" class="btn-cancel">
            <i class="bi bi-x-circle"></i>
            Cancel
          </a>
          <button type="submit" class="btn-submit">
            <i class="bi bi-check-circle"></i>
            Save Changes
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Toggle password visibility
    document.querySelectorAll('.btn-toggle-password').forEach(button => {
      button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('bi-eye');
          icon.classList.add('bi-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.remove('bi-eye-slash');
          icon.classList.add('bi-eye');
        }
      });
    });

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert-custom');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          alert.style.opacity = '0';
          alert.style.transform = 'translateY(-10px)';
          alert.style.transition = 'all 0.3s ease';
          setTimeout(() => alert.remove(), 300);
        }, 5000);
      });
    });
  </script>
</x-app-layout>