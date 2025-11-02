{{-- resources/views/admin/users/create.blade.php --}}
<x-app-layout>
  <div class="container py-4" style="max-width: 720px;">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="d-flex align-items-center">
        <div class="header-icon-wrapper me-3">
          <i class="bi bi-person-plus-fill"></i>
        </div>
        <div>
          <h1 class="h3 mb-1 fw-bold">Create New User</h1>
          <p class="text-muted mb-0 small">Add a new user to the system</p>
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
    @endif

    {{-- Form Card --}}
    <div class="card modern-card">
      <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.users.store') }}" novalidate>
          @csrf

          {{-- Name Field --}}
          <div class="mb-4">
            <label class="form-label fw-semibold">
              <i class="bi bi-person text-primary me-2"></i>Full Name
            </label>
            <input
              name="name"
              class="form-control modern-input @error('name') is-invalid @enderror"
              value="{{ old('name') }}"
              placeholder="Enter user's full name"
              required
            >
            @error('name') 
              <div class="invalid-feedback d-flex align-items-center">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          {{-- Email Field --}}
          <div class="mb-4">
            <label class="form-label fw-semibold">
              <i class="bi bi-envelope text-primary me-2"></i>Email Address
            </label>
            <input
              name="email"
              type="email"
              class="form-control modern-input @error('email') is-invalid @enderror"
              value="{{ old('email') }}"
              placeholder="user@example.com"
              required
            >
            @error('email') 
              <div class="invalid-feedback d-flex align-items-center">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          {{-- Role Field --}}
          <div class="mb-4">
            <label class="form-label fw-semibold">
              <i class="bi bi-shield-check text-primary me-2"></i>User Role
            </label>
            <select
              name="role"
              class="form-select modern-select @error('role') is-invalid @enderror"
              required
            >
              <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose a role</option>
              @foreach($roles as $r)
                <option value="{{ $r }}" @selected(old('role') === $r)>
                  {{ ucfirst($r) }}
                </option>
              @endforeach
            </select>
            @error('role') 
              <div class="invalid-feedback d-flex align-items-center">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
              </div>
            @enderror
            <div class="form-text">
              <i class="bi bi-info-circle me-1"></i>Select the appropriate role for this user
            </div>
          </div>

          {{-- Password Section --}}
          <div class="password-section">
            <div class="section-header mb-3">
              <i class="bi bi-lock-fill me-2"></i>
              <span class="fw-semibold">Security Credentials</span>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Password</label>
              <div class="input-group modern-input-group">
                <span class="input-group-text">
                  <i class="bi bi-key"></i>
                </span>
                <input
                  name="password"
                  type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Enter secure password"
                  required
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

            <div class="mb-4">
              <label class="form-label fw-semibold">Confirm Password</label>
              <div class="input-group modern-input-group">
                <span class="input-group-text">
                  <i class="bi bi-key-fill"></i>
                </span>
                <input
                  name="password_confirmation"
                  type="password"
                  class="form-control"
                  placeholder="Re-enter password"
                  required
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
          <div class="d-flex gap-3 pt-3 border-top">
            <a href="{{ route('admin.users.index') }}" class="btn btn-cancel flex-grow-1">
              <i class="bi bi-x-circle me-2"></i>Cancel
            </a>
            <button type="submit" class="btn btn-create flex-grow-1">
              <i class="bi bi-check-circle me-2"></i>Create User
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
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
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

    .danger-icon {
      background: #fee2e2;
      color: var(--danger-color);
    }

    .alert-heading {
      font-size: 15px;
      font-weight: 600;
      color: var(--danger-color);
    }

    /* Modern Card */
    .modern-card {
      border: none;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
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
      background: linear-gradient(135deg, #f9fafb, #f3f4f6);
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
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

    .btn-create {
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      transition: all 0.3s ease;
    }

    .btn-create:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
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
  </script>
</x-app-layout>
