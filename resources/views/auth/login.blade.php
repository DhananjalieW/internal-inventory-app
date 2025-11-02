<x-guest-layout>
  {{-- Bootstrap-only styles, scoped to this page --}}
  <style>
    /* ===== Layout / Background ===== */
    .login-wrap{
      min-height:100vh;
      display:grid;
      place-items:center;
      background: radial-gradient(1200px 420px at 50% -140px,#eef3fb 0%,#f7f9fc 40%,#ffffff 100%);
    }

    /* ===== Card ===== */
    .login-card{
      position:relative;
      max-width:420px;
      width:100%;
      border:0;
      border-radius:1rem;
      background: linear-gradient(180deg,#ffffff 0%,#fcfdff 100%);
      box-shadow:0 12px 28px rgba(16,24,40,.10), 0 2px 6px rgba(16,24,40,.06);
      padding-top:78px; /* space for the badge */
    }

    /* ===== Circular brand badge ===== */
    .brand-circle{
      position:absolute; left:50%; top:0; transform:translate(-50%,-50%);
      width:104px; height:104px; border-radius:50%;
      background:#fff; border:5px solid #1a3e73;          /* outer brand ring */
      box-shadow:0 10px 24px rgba(16,24,40,.12);
      display:flex; align-items:center; justify-content:center;
      overflow:hidden;
    }
    /* inner fine ring */
    .brand-circle::after{
      content:""; position:absolute; inset:7px; border:2px solid #e6eef9; border-radius:50%;
    }
    .brand-circle img{
      width:88%; height:88%; object-fit:contain; border-radius:50%;
    }

    /* ===== Controls & Button ===== */
    .btn-brand{background-color:#1a3e73;border:none;transition:transform .06s ease, box-shadow .2s}
    .btn-brand:hover{background-color:#173763;transform:translateY(-1px);box-shadow:0 8px 20px rgba(26,62,115,.25)}
    .btn-brand:active{transform:translateY(0)}
    .form-control:focus,.form-select:focus{
      border-color:#1a3e73; box-shadow:0 0 0 .2rem rgba(26,62,115,.15)
    }
    .card-body .form-label{margin-bottom:.35rem}

    /* ===== Responsive badge/spacing so it never overlaps the title ===== */
    @media (max-width:1200px){ .login-card{padding-top:88px} }
    @media (max-width:992px) { .brand-circle{width:96px;height:96px} .login-card{padding-top:92px} }
    @media (max-width:768px) { .brand-circle{width:90px;height:90px}  .login-card{padding-top:96px;margin:0 12px} }
  </style>

  <div class="login-wrap">
    <div class="card login-card bg-white">
      <div class="brand-circle">
        <img src="{{ asset('brand/innovior-logo.jpeg') }}" alt="Innovior">
      </div>

      <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
          <h5 class="mb-1 fw-semibold">Welcome back</h5>
          <div class="text-muted small">Sign in to manage inventory</div>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Status --}}
        @if (session('status'))
          <div class="alert alert-success small">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
          @csrf

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input
              type="email" inputmode="email" name="email"
              value="{{ old('email') }}"
              class="form-control" required autofocus autocomplete="username"
              placeholder="you@company.com">
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input
              type="password" name="password"
              class="form-control" required autocomplete="current-password"
              placeholder="••••••••">
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
              @foreach(config('roles.list') as $r)
                <option value="{{ $r }}" @selected(old('role')===$r)>{{ $r }}</option>
              @endforeach
            </select>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>
            @if (Route::has('password.request'))
              <a class="small text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
          </div>

          <button class="btn btn-brand w-100 py-2">Log in</button>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
