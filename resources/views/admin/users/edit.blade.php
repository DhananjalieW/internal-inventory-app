{{-- resources/views/admin/users/edit.blade.php --}}
<x-app-layout>
  <div class="container py-4" style="max-width: 720px;">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="d-flex align-items-center">
        <div class="header-icon-wrapper me-3">
          <i class="bi bi-pencil-square"></i>
        </div>
        <div>
          <h1 class="h3 mb-1 fw-bold">Edit User</h1>
          <p class="text-muted mb-0 small">Update user information and permissions</p>
        </div>
      </div>
      <a href="{{ route('admin.users.index') }}" class="btn btn-back">
        <i class="bi bi-arrow-left me-2"></i>Back
      </a>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show modern-alert mb-4" role="alert">
        <div class="d-flex align-items-start">
          <div class="alert-icon danger-icon me-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <div class="flex-grow-1">
            <h6 class="alert-heading mb-2">Please fix the following errors:</h6>
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $e) 
                <li>{{ $e }}</li> 
              @endforeach
            </ul>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
<<<<<<< HEAD
    @endif

    {{-- Success Alert --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show modern-alert mb-4" role="alert">
        <div class="d-flex align-items-center">
          <div class="alert-icon success-icon me-3">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <div class="flex-grow-1">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
=======
      <div class="mb-3"><label class="form-label">Role</label>
        <select name="role" class="form-select" required>
          @foreach(config('roles.list') as $r)
            <option value="{{ $r }}" @selected(old('role',$user->role)===$r)>{{ $r }}</option>
          @endforeach
        </select>
>>>>>>> parent of d4eb4b7 (Merge branch 'main' into develop)
      </div>
    @endif

    {{-- User Info Card --}}
    <div class="card info-card mb-4">
      <div class="card-body p-3">
        <div class="d-flex align-items-center">
          <div class="user-avatar-large me-3">
            {{ strtoupper(substr($user->name, 0, 1)) }}
          </div>
          <div>
            <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
            <div class="d-flex align-items-center gap-3">
              <span class="text-muted small">
                <i class="bi bi-envelope me-1"></i>{{ $user->email }}
              </span>
              <span class="role-badge">
                <i class="bi bi-shield-check me-1"></i>{{ $user->role }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Form Card --}}
    <div class="card modern-card">
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" novalidate>
          @csrf
          @method('PUT')

          {{-- Basic Information Section --}}
          <div class="form-section mb-4">
            <div class="section-header mb-3">
              <i class="bi bi-person-fill me-2"></i>
              <span class="fw-semibold">Basic Information</span>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">
                <i class="bi bi-person text-primary me-2"></i>Full Name
              </label>
              <input
                name="name"
                class="form-control modern-input @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                placeholder="Enter user's full name"
                required
              >
              @error('name') 
                <div class="invalid-feedback d-flex align-items-center">
                  <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">
                <i class="bi bi-envelope text-primary me-2"></i>Email Address
              </label>
              <input
                name="email"
                type="email"
                class="form-control modern-input @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                placeholder="user@example.com"
                required
              >
              @error('email') 
                <div class="invalid-feedback d-flex align-items-center">
                  <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
              @enderror
            </div>

            @php
              $roleList = $roles ?? (config('roles.list') ?? ['Admin','Inventory Manager','Clerk','Viewer']);
            @endphp
            <div class="mb-0">
              <label class="form-label fw-semibold">
                <i class="bi bi-shield-check text-primary me-2"></i>User Role
              </label>
              <select
                name="role"
                class="form-select modern-select @error('role') is-invalid @enderror"
                required
              >
                @foreach($roleList as $r)
                  <option value="{{ $r }}" @selected(old('role', $user->role) === $r)>
                    {{ $r }}
                  </option>
                @endforeach
              </select>
              @error('role') 
                <div class="invalid-feedback d-flex align-items-center">
                  <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
              @enderror
              <div class="form-text">
                <i class="bi bi-info-circle me-1"></i>Change user's access level and permissions
              </div>
            </div>
          </div>

          {{-- Password Section --}}
          <div class="password-section">
            <div class="section-header mb-3">
              <i class="bi bi-lock-fill me-2"></i>
              <span class="fw-semibold">Change Password</span>
              <span class="badge bg-secondary ms-2">Optional</span>
            </div>

            <div class="alert alert-info border-0 mb-3">
              <i class="bi bi-info-circle-fill me-2"></i>
              <small>Leave password fields blank to keep the current password unchanged</small>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">New Password</label>
              <div class="input-group modern-input-group">
                <span class="input-group-text">
                  <i class="bi bi-key"></i>
                </span>
                <input
                  name="password"
                  type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Enter new password"
                  autocomplete="new-password"
                  id="password"
                >
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password') 
                <div class="invalid-feedback d-flex align-items-center mt-1">
                  <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
              @enderror
              <div class="form-text">
                <i class="bi bi-info-circle me-1"></i>Minimum 8 characters recommended
              </div>
            </div>

            <div class="mb-0">
              <label class="form-label fw-semibold">Confirm New Password</label>
              <div class="input-group modern-input-group">
                <span class="input-group-text">
                  <i class="bi bi-key-fill"></i>
                </span>
                <input
                  name="password_confirmation"
                  type="password"
                  class="form-control"
                  placeholder="Re-enter new password"
                  autocomplete="new-password"
                  id="password_confirmation"
                >
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
          </div>

          {{-- Action Buttons --}}
          <div class="d-flex gap-3 pt-4 border-top mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-cancel flex-grow-1">
              <i class="bi bi-x-circle me-2"></i>Cancel
            </a>
            <button type="submit" class="btn btn-save flex-grow-1">
              <i class="bi bi-check-circle me-2"></i>Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <style>
    :root {
      --primary-color: #6366f1;
      --success-color: #10b981;
      --danger-color: #ef4444;
      --info-color: #3b82f6;
      --text-dark: #1f2937;
      --text-muted: #6b7280;
      --bg-light: #f9fafb;
      --border-color: #e5e7eb;
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
      --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .header-icon-wrapper {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #f59e0b, #fbbf24);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3);
    }

    .btn-back {
      background: white;
      border: 2px solid var(--border-color);
      color: var(--text-dark);
      padding: 8px 20px;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
      transform: translateX(-4px);
      box-shadow: var(--shadow-sm);
    }

    /* Modern Alert */
    .modern-alert {
      border: none;
      border-radius: 12px;
      padding: 20px;
      box-shadow: var(--shadow-md);
    }

    .alert-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .success-icon {
      background: #d1fae5;
      color: var(--success-color);
    }

    .danger-icon {
      background: #fee2e2;
      color: var(--danger-color);
    }

    .alert-heading {
      font-size: 15px;
      font-weight: 600;
      color: var(--danger-color);
    }

    /* Info Card */
    .info-card {
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #ede9fe, #ddd6fe);
      box-shadow: var(--shadow-sm);
    }

    .user-avatar-large {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 24px;
      box-shadow: 0 4px 8px rgba(99, 102, 241, 0.3);
    }

    .role-badge {
      display: inline-flex;
      align-items: center;
      background: white;
      color: var(--primary-color);
      padding: 4px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      box-shadow: var(--shadow-sm);
    }

    /* Modern Card */
    .modern-card {
      border: none;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
    }

    /* Form Sections */
    .form-section {
      background: white;
      border-radius: 12px;
    }

    .section-header {
      display: flex;
      align-items: center;
      color: var(--text-dark);
      font-size: 15px;
    }

    .section-header i {
      color: var(--primary-color);
      font-size: 18px;
    }

    /* Form Labels */
    .form-label {
      color: var(--text-dark);
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-label i {
      font-size: 16px;
    }

    /* Modern Inputs */
    .modern-input,
    .modern-select {
      border: 2px solid var(--border-color);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .modern-input:focus,
    .modern-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
      outline: none;
    }

    .modern-input.is-invalid,
    .modern-select.is-invalid {
      border-color: var(--danger-color);
    }

    .modern-input.is-invalid:focus,
    .modern-select.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    /* Input Group */
    .modern-input-group .input-group-text {
      background: var(--bg-light);
      border: 2px solid var(--border-color);
      border-right: none;
      border-radius: 10px 0 0 10px;
      color: var(--text-muted);
    }

    .modern-input-group .form-control {
      border: 2px solid var(--border-color);
      border-left: none;
      border-right: none;
      padding: 12px 16px;
      font-size: 15px;
    }

    .modern-input-group .toggle-password {
      border: 2px solid var(--border-color);
      border-left: none;
      border-radius: 0 10px 10px 0;
      background: white;
      color: var(--text-muted);
      transition: all 0.3s ease;
    }

    .modern-input-group .toggle-password:hover {
      background: var(--bg-light);
      color: var(--text-dark);
    }

    .modern-input-group .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: none;
    }

    .modern-input-group .form-control:focus ~ .toggle-password {
      border-color: var(--primary-color);
    }

    .modern-input-group:focus-within .input-group-text {
      border-color: var(--primary-color);
    }

    /* Password Section */
    .password-section {
      background: linear-gradient(135deg, #fef3c7, #fde68a);
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
    }

    .alert-info {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
      color: #1e40af;
      font-size: 14px;
      padding: 12px;
      border-radius: 8px;
    }

    /* Form Text */
    .form-text {
      color: var(--text-muted);
      font-size: 13px;
      margin-top: 6px;
    }

    /* Invalid Feedback */
    .invalid-feedback {
      display: block;
      color: var(--danger-color);
      font-size: 13px;
      font-weight: 500;
    }

    /* Action Buttons */
    .btn-cancel {
      background: white;
      border: 2px solid var(--border-color);
      color: var(--text-dark);
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      border-color: var(--danger-color);
      color: var(--danger-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .btn-save {
      background: linear-gradient(135deg, var(--success-color), #059669);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
      transition: all 0.3s ease;
    }

    .btn-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    /* Responsive */
    @media (max-width: 576px) {
      .d-flex.gap-3 {
        flex-direction: column;
      }
    }
  </style>

  <script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
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

    // Auto-dismiss alerts
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.modern-alert');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }, 5000);
      });
    });
  </script>
</x-app-layout>