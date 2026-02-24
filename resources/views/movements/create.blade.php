{{-- resources/views/movements/create.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Create Movement Page Styles ===== */
    .create-movement-page {
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

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 24px;
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

    .btn-back:hover {
      background: rgba(99, 102, 241, 0.3);
      border-color: rgba(99, 102, 241, 0.5);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-back i {
      transition: transform 0.3s ease;
    }

    .btn-back:hover i {
      transform: translateX(-4px);
    }

    /* ===== Alerts ===== */
    .alert-error {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border: 1px solid #fecaca;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
    }

    .alert-success {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border: 1px solid #6ee7b7;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
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

    .alert-icon.error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .alert-icon.success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
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

    .alert-content.error {
      color: #991b1b;
    }

    .alert-content.success {
      color: #065f46;
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
      padding: 28px 32px 24px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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
      grid-template-columns: repeat(12, 1fr);
      gap: 24px;
    }

    .col-3 { grid-column: span 3; }
    .col-4 { grid-column: span 4; }
    .col-6 { grid-column: span 6; }
    .col-8 { grid-column: span 8; }
    .col-9 { grid-column: span 9; }
    .col-12 { grid-column: span 12; }

    /* ===== Section Divider ===== */
    .section-divider {
      grid-column: span 12;
      height: 1px;
      background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
      margin: 8px 0;
    }

    .section-title {
      grid-column: span 12;
      font-size: 13px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: -8px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, #e2e8f0, transparent);
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

    .input-icon.textarea-icon {
      top: 18px;
      transform: none;
    }

    .form-input,
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
    }

    .form-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .form-input:hover,
    .form-select:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .input-wrapper:focus-within .input-icon {
      color: #6366f1;
    }

    .form-input.is-invalid,
    .form-select.is-invalid {
      border-color: #ef4444;
    }

    .form-input.is-invalid:focus,
    .form-select.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    textarea.form-input {
      resize: vertical;
      min-height: 100px;
      padding-top: 16px;
    }

    .form-select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 16px 12px;
      padding-right: 48px;
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

    /* ===== Help Text ===== */
    .form-help {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 8px;
      font-size: 12px;
      color: #94a3b8;
    }

    .form-help i {
      font-size: 14px;
    }

    /* ===== Type Selection Cards ===== */
    .type-cards {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
    }

    .type-card {
      position: relative;
    }

    .type-card input[type="radio"] {
      position: absolute;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
      z-index: 2;
    }

    .type-card-label {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      padding: 16px 12px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
    }

    .type-card-label:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .type-card-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .type-card-icon i {
      font-size: 18px;
      transition: all 0.3s ease;
    }

    .type-card-label .type-name {
      font-size: 14px;
      font-weight: 700;
      color: #475569;
      transition: color 0.3s ease;
    }

    .type-card-label .type-desc {
      font-size: 11px;
      color: #94a3b8;
      transition: color 0.3s ease;
    }

    /* Type: IN */
    .type-card.type-in .type-card-icon {
      background: rgba(16, 185, 129, 0.1);
    }
    .type-card.type-in .type-card-icon i {
      color: #10b981;
    }
    .type-card.type-in input:checked + .type-card-label {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-color: #10b981;
    }
    .type-card.type-in input:checked + .type-card-label .type-card-icon {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .type-card.type-in input:checked + .type-card-label .type-card-icon i {
      color: white;
    }
    .type-card.type-in input:checked + .type-card-label .type-name {
      color: #065f46;
    }

    /* Type: OUT */
    .type-card.type-out .type-card-icon {
      background: rgba(239, 68, 68, 0.1);
    }
    .type-card.type-out .type-card-icon i {
      color: #ef4444;
    }
    .type-card.type-out input:checked + .type-card-label {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      border-color: #ef4444;
    }
    .type-card.type-out input:checked + .type-card-label .type-card-icon {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    .type-card.type-out input:checked + .type-card-label .type-card-icon i {
      color: white;
    }
    .type-card.type-out input:checked + .type-card-label .type-name {
      color: #991b1b;
    }

    /* Type: TRANSFER */
    .type-card.type-transfer .type-card-icon {
      background: rgba(99, 102, 241, 0.1);
    }
    .type-card.type-transfer .type-card-icon i {
      color: #6366f1;
    }
    .type-card.type-transfer input:checked + .type-card-label {
      background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
      border-color: #6366f1;
    }
    .type-card.type-transfer input:checked + .type-card-label .type-card-icon {
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    .type-card.type-transfer input:checked + .type-card-label .type-card-icon i {
      color: white;
    }
    .type-card.type-transfer input:checked + .type-card-label .type-name {
      color: #3730a3;
    }

    /* Type: ADJUST */
    .type-card.type-adjust .type-card-icon {
      background: rgba(245, 158, 11, 0.1);
    }
    .type-card.type-adjust .type-card-icon i {
      color: #f59e0b;
    }
    .type-card.type-adjust input:checked + .type-card-label {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border-color: #f59e0b;
    }
    .type-card.type-adjust input:checked + .type-card-label .type-card-icon {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    .type-card.type-adjust input:checked + .type-card-label .type-card-icon i {
      color: white;
    }
    .type-card.type-adjust input:checked + .type-card-label .type-name {
      color: #92400e;
    }

    /* ===== Form Footer ===== */
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
      border-color: #cbd5e1;
      color: #475569;
      transform: translateY(-2px);
    }

    .btn-submit {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }

    .btn-submit i {
      font-size: 18px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 992px) {
      .type-cards {
        grid-template-columns: repeat(2, 1fr);
      }

      .col-3, .col-4, .col-6, .col-8, .col-9 {
        grid-column: span 12;
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

      .btn-back {
        width: 100%;
        justify-content: center;
      }

      .form-card-body {
        padding: 24px;
      }

      .form-card-footer {
        flex-direction: column;
      }

      .btn-cancel,
      .btn-submit {
        width: 100%;
        justify-content: center;
      }

      .type-cards {
        grid-template-columns: 1fr 1fr;
      }
    }
  </style>

  <div class="create-movement-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Record Movement</h1>
          <p class="page-subtitle">
            <i class="bi bi-arrow-left-right"></i>
            Create a new stock transaction
          </p>
        </div>
        <a href="{{ route('movements.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Movements
        </a>
      </div>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert-error">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">
          {{ $errors->first() }}
        </div>
      </div>
    @endif

    {{-- Success Alert --}}
    @if (session('success'))
      <div class="alert-success">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">
          {{ session('success') }}
        </div>
      </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('movements.store') }}" novalidate>
      @csrf

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div class="header-text">
            <h3>Movement Details</h3>
            <p>Select the type and enter transaction information</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Movement Type --}}
            <div class="form-group col-12">
              <label class="form-label">
                Movement Type <span class="required">*</span>
              </label>
              @php($prefType = old('type', request('type', 'IN')))
              <div class="type-cards">
                <div class="type-card type-in">
                  <input type="radio" name="type" value="IN" id="type_in" 
                         {{ $prefType === 'IN' ? 'checked' : '' }} required>
                  <label for="type_in" class="type-card-label">
                    <div class="type-card-icon">
                      <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                    <span class="type-name">IN</span>
                    <span class="type-desc">Receive stock</span>
                  </label>
                </div>
                <div class="type-card type-out">
                  <input type="radio" name="type" value="OUT" id="type_out" 
                         {{ $prefType === 'OUT' ? 'checked' : '' }}>
                  <label for="type_out" class="type-card-label">
                    <div class="type-card-icon">
                      <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                    <span class="type-name">OUT</span>
                    <span class="type-desc">Issue stock</span>
                  </label>
                </div>
                <div class="type-card type-transfer">
                  <input type="radio" name="type" value="TRANSFER" id="type_transfer" 
                         {{ $prefType === 'TRANSFER' ? 'checked' : '' }}>
                  <label for="type_transfer" class="type-card-label">
                    <div class="type-card-icon">
                      <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <span class="type-name">TRANSFER</span>
                    <span class="type-desc">Move between</span>
                  </label>
                </div>
                <div class="type-card type-adjust">
                  <input type="radio" name="type" value="ADJUST" id="type_adjust" 
                         {{ $prefType === 'ADJUST' ? 'checked' : '' }}>
                  <label for="type_adjust" class="type-card-label">
                    <div class="type-card-icon">
                      <i class="bi bi-sliders"></i>
                    </div>
                    <span class="type-name">ADJUST</span>
                    <span class="type-desc">Correct count</span>
                  </label>
                </div>
              </div>
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Product Information</div>

            {{-- Product --}}
            <div class="form-group col-12">
              <label class="form-label">
                Product <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-box-seam input-icon"></i>
                <select name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                  <option value="" disabled {{ old('product_id', request('product_id')) ? '' : 'selected' }}>
                    Select a product...
                  </option>
                  @foreach($products as $p)
                    <option value="{{ $p->id }}"
                      {{ (string) old('product_id', request('product_id')) === (string) $p->id ? 'selected' : '' }}>
                      {{ $p->sku }} — {{ $p->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('product_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Warehouse Selection</div>

            {{-- From Warehouse --}}
            <div class="form-group col-6">
              <label class="form-label">
                From Warehouse
              </label>
              <div class="input-wrapper">
                <i class="bi bi-building input-icon"></i>
                <select name="from_warehouse_id" class="form-select @error('from_warehouse_id') is-invalid @enderror">
                  <option value="">— Not applicable —</option>
                  @foreach($warehouses as $w)
                    <option value="{{ $w->id }}"
                      {{ (string) old('from_warehouse_id', request('from_warehouse_id')) === (string) $w->id ? 'selected' : '' }}>
                      {{ $w->code }} — {{ $w->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Required for OUT and TRANSFER
              </div>
              @error('from_warehouse_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- To Warehouse --}}
            <div class="form-group col-6">
              <label class="form-label">
                To Warehouse
              </label>
              <div class="input-wrapper">
                <i class="bi bi-building input-icon"></i>
                <select name="to_warehouse_id" class="form-select @error('to_warehouse_id') is-invalid @enderror">
                  <option value="">— Not applicable —</option>
                  @foreach($warehouses as $w)
                    <option value="{{ $w->id }}"
                      {{ (string) old('to_warehouse_id', request('warehouse_id') ?? request('to_warehouse_id')) === (string) $w->id ? 'selected' : '' }}>
                      {{ $w->code }} — {{ $w->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Required for IN, TRANSFER, and ADJUST
              </div>
              @error('to_warehouse_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Quantity & Reference</div>

            {{-- Quantity --}}
            <div class="form-group col-3">
              <label class="form-label">
                Quantity <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-123 input-icon"></i>
                <input 
                  type="number" 
                  name="qty" 
                  min="1" 
                  class="form-input @error('qty') is-invalid @enderror"
                  value="{{ old('qty') }}" 
                  placeholder="0"
                  required
                >
              </div>
              @error('qty')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Reference --}}
            <div class="form-group col-9">
              <label class="form-label">
                Reference
              </label>
              <div class="input-wrapper">
                <i class="bi bi-tag input-icon"></i>
                <input 
                  type="text"
                  name="reference" 
                  class="form-input @error('reference') is-invalid @enderror"
                  value="{{ old('reference', request('reference')) }}"
                  placeholder="e.g., PO-1001, ADJ-2024, Transfer #123"
                >
              </div>
              @error('reference')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Notes --}}
            <div class="form-group col-12">
              <label class="form-label">
                Notes
              </label>
              <div class="input-wrapper">
                <i class="bi bi-chat-left-text input-icon textarea-icon"></i>
                <textarea 
                  name="notes" 
                  rows="3"
                  class="form-input @error('notes') is-invalid @enderror"
                  placeholder="Optional details or comments about this movement..."
                >{{ old('notes') }}</textarea>
              </div>
              @error('notes')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <a href="{{ route('movements.index') }}" class="btn-cancel">
            Cancel
          </a>
          <button type="submit" class="btn-submit">
            <i class="bi bi-check-circle"></i>
            Save Movement
          </button>
        </div>
      </div>

      {{-- Return URL --}}
      <input type="hidden" name="return" value="{{ request('return', url()->previous()) }}">
    </form>
  </div>
</x-app-layout>