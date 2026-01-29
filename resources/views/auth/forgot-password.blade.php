<?php>
<x-guest-layout>
  {{-- Modern Professional Forgot Password Styles - Matching Login Theme --}}
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* ===== Main Container ===== */
    .forgot-container {
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

    .brand-icon-wrapper {
      width: 120px;
      height: 120px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 40px;
      box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.4),
                  0 0 0 1px rgba(255, 255, 255, 0.1);
      transform: rotate(-3deg);
      transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .brand-icon-wrapper:hover {
      transform: rotate(0deg) scale(1.05);
    }

    .brand-icon-wrapper i {
      font-size: 56px;
      color: white;
    }

    .brand-title {
      font-size: 38px;
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

    .brand-steps {
      margin-top: 60px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .step-item {
      display: flex;
      align-items: center;
      gap: 16px;
      color: #cbd5e1;
      font-size: 15px;
      text-align: left;
    }

    .step-number {
      width: 44px;
      height: 44px;
      background: rgba(99, 102, 241, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #818cf8;
      font-size: 18px;
      font-weight: 700;
      border: 1px solid rgba(99, 102, 241, 0.3);
      flex-shrink: 0;
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
      margin-bottom: 32px;
    }

    .form-header h1 {
      font-size: 32px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 12px;
      letter-spacing: -0.5px;
    }

    .form-header p {
      color: #64748b;
      font-size: 15px;
      line-height: 1.6;
    }

    /* ===== Info Box ===== */
    .info-box {
      background: linear-gradient(135deg, #eef2ff, #e0e7ff);
      border: 1px solid #c7d2fe;
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 28px;
      display: flex;
      align-items: flex-start;
      gap: 14px;
    }

    .info-box i {
      color: #6366f1;
      font-size: 22px;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .info-box p {
      color: #4338ca;
      font-size: 14px;
      line-height: 1.5;
      margin: 0;
    }

    /* ===== Alerts ===== */
    .alert {
      padding: 14px 18px;
      border-radius: 12px;
      margin-bottom: 24px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 12px;
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

    .alert-success i {
      font-size: 20px;
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
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
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

    /* ===== Back to Login ===== */
    .back-link {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 28px;
      color: #64748b;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
      padding: 12px;
      border-radius: 10px;
    }

    .back-link:hover {
      color: #6366f1;
      background: rgba(99, 102, 241, 0.05);
    }

    .back-link i {
      transition: transform 0.3s ease;
    }

    .back-link:hover i {
      transform: translateX(-4px);
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
    }

    /* Mobile Brand Header */
    .mobile-brand {
      display: none;
      text-align: center;
      margin-bottom: 32px;
    }

    .mobile-brand-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #6366f1, #8b5cf6);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
      box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.4);
    }

    .mobile-brand-icon i {
      font-size: 36px;
      color: white;
    }

    @media (max-width: 1024px) {
      .mobile-brand {
        display: block;
      }
    }
  </style>

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <div class="forgot-container">
    {{-- Left Panel - Branding --}}
    <div class="brand-panel">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>

      <div class="brand-content">
        <div class="brand-icon-wrapper">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h1 class="brand-title">Password Recovery</h1>
        <p class="brand-subtitle">Don't worry, it happens to the best of us. We'll help you get back in.</p>

        <div class="brand-steps">
          <div class="step-item">
            <div class="step-number">1</div>
            <span>Enter your registered email address</span>
          </div>
          <div class="step-item">
            <div class="step-number">2</div>
            <span>Check your inbox for reset link</span>
          </div>
          <div class="step-item">
            <div class="step-number">3</div>
            <span>Create a new secure password</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Right Panel - Form --}}
    <div class="form-panel">
      <div class="form-wrapper">
        {{-- Mobile Brand --}}
        <div class="mobile-brand">
          <div class="mobile-brand-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>

        <div class="form-header">
          <h1>Forgot Password?</h1>
          <p>No worries! Enter your email address and we'll send you a link to reset your password.</p>
        </div>

        {{-- Info Box --}}
        <div class="info-box">
          <i class="bi bi-info-circle-fill"></i>
          <p>The password reset link will expire in 60 minutes for security reasons.</p>
        </div>

        {{-- Status Message --}}
        @if (session('status'))
          <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('status') }}</span>
          </div>
        @endif

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

        <form method="POST" action="{{ route('password.email') }}" novalidate>
          @csrf

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrapper">
              <input
                type="email"
                inputmode="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                required
                autofocus
                placeholder="Enter your registered email">
              <i class="bi bi-envelope input-icon"></i>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            <i class="bi bi-send"></i>
            Send Reset Link
          </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
          <i class="bi bi-arrow-left"></i>
          Back to Sign In
        </a>

        <div class="divider">
          <span>Secure Recovery</span>
        </div>

        <div class="security-badge">
          <i class="bi bi-shield-lock-fill"></i>
          <span>Your data is protected with 256-bit encryption</span>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
