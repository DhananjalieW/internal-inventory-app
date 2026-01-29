<?php>
<x-guest-layout>
  {{-- Modern Professional Login Styles --}}
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* ===== Main Container ===== */
    .login-container {
      min-height: 100vh;
      display: flex;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* ===== Left Panel - Branding ===== */
    .brand-panel {
      flex: 1;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 60px;
      position: relative;
      overflow: hidden;
    }

    .brand-panel::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at 30% 70%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                  radial-gradient(circle at 70% 30%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
      animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0) rotate(0deg); }
      25% { transform: translate(2%, 2%) rotate(1deg); }
      50% { transform: translate(0, 4%) rotate(0deg); }
      75% { transform: translate(-2%, 2%) rotate(-1deg); }
    }

    /* Animated shapes */
    .shape {
      position: absolute;
      border-radius: 50%;
      opacity: 0.1;
    }

    .shape-1 {
      width: 400px;
      height: 400px;
      background: linear-gradient(135deg, #6366f1, #3b82f6);
      top: -100px;
      left: -100px;
      animation: pulse1 8s ease-in-out infinite;
    }

    .shape-2 {
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, #8b5cf6, #6366f1);
      bottom: -50px;
      right: -50px;
      animation: pulse2 10s ease-in-out infinite;
    }

    .shape-3 {
      width: 150px;
      height: 150px;
      background: linear-gradient(135deg, #06b6d4, #3b82f6);
      top: 40%;
      right: 20%;
      animation: pulse3 6s ease-in-out infinite;
    }

    @keyframes pulse1 {
      0%, 100% { transform: scale(1) translate(0, 0); }
      50% { transform: scale(1.1) translate(20px, 20px); }
    }

    @keyframes pulse2 {
      0%, 100% { transform: scale(1) translate(0, 0); }
      50% { transform: scale(1.15) translate(-30px, -30px); }
    }

    @keyframes pulse3 {
      0%, 100% { transform: scale(1); opacity: 0.1; }
      50% { transform: scale(1.2); opacity: 0.15; }
    }

    .brand-content {
      position: relative;
      z-index: 1;
      text-align: center;
      color: white;
    }

    .brand-logo-wrapper {
      width: 120px;
      height: 120px;
      background: white;
      border-radius: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 40px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4),
                  0 0 0 1px rgba(255, 255, 255, 0.1);
      transform: rotate(-3deg);
      transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .brand-logo-wrapper:hover {
      transform: rotate(0deg) scale(1.05);
    }

    .brand-logo-wrapper img {
      width: 80%;
      height: 80%;
      object-fit: contain;
      border-radius: 20px;
    }

    .brand-title {
      font-size: 42px;
      font-weight: 700;
      margin-bottom: 16px;
      letter-spacing: -1px;
      background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .brand-subtitle {
      font-size: 18px;
      color: #94a3b8;
      font-weight: 400;
      line-height: 1.6;
      max-width: 320px;
    }

    .brand-features {
      margin-top: 60px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 16px;
      color: #cbd5e1;
      font-size: 15px;
    }

    .feature-icon {
      width: 44px;
      height: 44px;
      background: rgba(99, 102, 241, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #818cf8;
      font-size: 20px;
      border: 1px solid rgba(99, 102, 241, 0.3);
    }

    /* ===== Right Panel - Form ===== */
    .form-panel {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px;
      background: #ffffff;
      position: relative;
    }

    .form-panel::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4);
    }

    .form-wrapper {
      width: 100%;
      max-width: 420px;
    }

    .form-header {
      margin-bottom: 40px;
    }

    .form-header h1 {
      font-size: 32px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
      letter-spacing: -0.5px;
    }

    .form-header p {
      color: #64748b;
      font-size: 16px;
    }

    /* ===== Alerts ===== */
    .alert {
      padding: 14px 18px;
      border-radius: 12px;
      margin-bottom: 24px;
      font-size: 14px;
    }

    .alert-danger {
      background: linear-gradient(135deg, #fef2f2, #fee2e2);
      border: 1px solid #fecaca;
      color: #dc2626;
    }

    .alert-danger ul {
      margin: 0;
      padding-left: 18px;
    }

    .alert-success {
      background: linear-gradient(135deg, #f0fdf4, #dcfce7);
      border: 1px solid #bbf7d0;
      color: #16a34a;
    }

    /* ===== Form Groups ===== */
    .form-group {
      margin-bottom: 24px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 8px;
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
    }

    .form-control {
      width: 100%;
      padding: 14px 16px 14px 48px;
      font-size: 15px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #1e293b;
    }

    .form-control::placeholder {
      color: #94a3b8;
    }

    .form-control:hover {
      border-color: #cbd5e1;
      background: #ffffff;
    }

    .form-control:focus {
      outline: none;
      border-color: #6366f1;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-control:focus + .input-icon,
    .input-wrapper:focus-within .input-icon {
      color: #6366f1;
    }

    .form-select {
      width: 100%;
      padding: 14px 16px 14px 48px;
      font-size: 15px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 16px center;
      background-size: 20px;
      transition: all 0.3s ease;
      color: #1e293b;
      cursor: pointer;
      -webkit-appearance: none;
      appearance: none;
    }

    .form-select:hover {
      border-color: #cbd5e1;
      background-color: #ffffff;
    }

    .form-select:focus {
      outline: none;
      border-color: #6366f1;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    /* ===== Remember & Forgot ===== */
    .form-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
    }

    .form-check {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-check-input {
      width: 18px;
      height: 18px;
      border: 2px solid #cbd5e1;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.2s ease;
      -webkit-appearance: none;
      appearance: none;
      position: relative;
    }

    .form-check-input:checked {
      background: linear-gradient(135deg, #6366f1, #8b5cf6);
      border-color: #6366f1;
    }

    .form-check-input:checked::after {
      content: '✓';
      position: absolute;
      color: white;
      font-size: 12px;
      font-weight: bold;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .form-check-label {
      font-size: 14px;
      color: #475569;
      cursor: pointer;
    }

    .forgot-link {
      font-size: 14px;
      color: #6366f1;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .forgot-link:hover {
      color: #4f46e5;
      text-decoration: underline;
    }

    /* ===== Submit Button ===== */
    .btn-submit {
      width: 100%;
      padding: 16px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-submit::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.5);
    }

    .btn-submit:hover::before {
      left: 100%;
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    /* ===== Divider ===== */
    .divider {
      display: flex;
      align-items: center;
      margin: 32px 0;
      color: #94a3b8;
      font-size: 13px;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #e2e8f0;
    }

    .divider span {
      padding: 0 16px;
    }

    /* ===== Security Badge ===== */
    .security-badge {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      color: #64748b;
      font-size: 13px;
    }

    .security-badge i {
      color: #10b981;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
      .brand-panel {
        display: none;
      }

      .form-panel {
        padding: 40px 24px;
      }

      .form-panel::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.02) 0%, rgba(99, 102, 241, 0.03) 100%);
        pointer-events: none;
        z-index: -1;
      }
    }

    @media (max-width: 480px) {
      .form-wrapper {
        max-width: 100%;
      }

      .form-header h1 {
        font-size: 26px;
      }

      .form-footer {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
      }

      .forgot-link {
        align-self: flex-end;
      }
    }

    /* Mobile Brand Header */
    .mobile-brand {
      display: none;
      text-align: center;
      margin-bottom: 32px;
    }

    .mobile-brand-logo {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
      box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.3);
    }

    .mobile-brand-logo img {
      width: 60%;
      height: 60%;
      object-fit: contain;
      border-radius: 12px;
    }

    @media (max-width: 1024px) {
      .mobile-brand {
        display: block;
      }
    }
  </style>

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <div class="login-container">
    {{-- Left Panel - Branding --}}
    <div class="brand-panel">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>

      <div class="brand-content">
        <div class="brand-logo-wrapper">
          <img src="{{ asset('brand/innovior-logo.jpeg') }}" alt="Innovior">
        </div>
        <h1 class="brand-title">Inventory System</h1>
        <p class="brand-subtitle">Streamline your inventory management with powerful tools and real-time insights</p>

        <div class="brand-features">
          <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-box-seam"></i></div>
            <span>Real-time stock tracking</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <span>Advanced analytics & reports</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
            <span>Secure role-based access</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Right Panel - Login Form --}}
    <div class="form-panel">
      <div class="form-wrapper">
        {{-- Mobile Brand --}}
        <div class="mobile-brand">
          <div class="mobile-brand-logo">
            <img src="{{ asset('brand/innovior-logo.jpeg') }}" alt="Innovior">
          </div>
        </div>

        <div class="form-header">
          <h1>Welcome back</h1>
          <p>Sign in to continue to your dashboard</p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Status --}}
        @if (session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
          @csrf

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrapper">
              <input
                type="email" inputmode="email" name="email"
                value="{{ old('email') }}"
                class="form-control" required autofocus autocomplete="username"
                placeholder="Enter your email">
              <i class="bi bi-envelope input-icon"></i>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrapper">
              <input
                type="password" name="password"
                class="form-control" required autocomplete="current-password"
                placeholder="Enter your password">
              <i class="bi bi-lock input-icon"></i>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Select Role</label>
            <div class="input-wrapper">
              <select name="role" class="form-select" required>
                @foreach(config('roles.list') as $r)
                  <option value="{{ $r }}" @selected(old('role')===$r)>{{ $r }}</option>
                @endforeach
              </select>
              <i class="bi bi-person-badge input-icon"></i>
            </div>
          </div>

          <div class="form-footer">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>
            @if (Route::has('password.request'))
              <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
          </div>

          <button type="submit" class="btn-submit">
            Sign In
          </button>
        </form>

        <div class="divider">
          <span>Protected Access</span>
        </div>

        
      </div>
    </div>
  </div>
</x-guest-layout>
