{{-- resources/views/transfers/create.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Create Transfer Page Styles ===== */
    .create-transfer-page {
      padding: 0;
      max-width: 900px;
      margin: 0 auto;
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

    .alert-content.success { color: #065f46; }
    .alert-content.error { color: #991b1b; }

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
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
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
      height: 1px;
      background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
      margin: 8px 0;
    }

    .section-title {
      grid-column: 1 / -1;
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

    /* ===== Quantity Input ===== */
    .qty-input-group {
      display: flex;
      align-items: stretch;
    }

    .qty-input-group .input-wrapper {
      flex: 1;
    }

    .qty-input-group .form-input {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      border-right: 1px solid #e2e8f0;
    }

    .qty-unit-badge {
      display: flex;
      align-items: center;
      padding: 0 18px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border: 2px solid #e2e8f0;
      border-left: none;
      border-radius: 0 12px 12px 0;
      font-size: 14px;
      font-weight: 700;
      color: #475569;
      white-space: nowrap;
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

    /* ===== Transfer Direction Visual ===== */
    .transfer-direction {
      grid-column: 1 / -1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      padding: 20px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-radius: 16px;
      margin: 8px 0;
    }

    .warehouse-preview {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      padding: 16px 24px;
      background: white;
      border-radius: 12px;
      border: 2px solid #e2e8f0;
      min-width: 140px;
      transition: all 0.3s ease;
    }

    .warehouse-preview.from {
      border-color: #fecaca;
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    }

    .warehouse-preview.to {
      border-color: #bbf7d0;
      background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .warehouse-preview-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .warehouse-preview.from .warehouse-preview-icon {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .warehouse-preview.to .warehouse-preview-icon {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }

    .warehouse-preview-icon i {
      color: white;
      font-size: 18px;
    }

    .warehouse-preview-label {
      font-size: 11px;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .warehouse-preview-name {
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
    }

    .transfer-arrow {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .transfer-arrow i {
      color: white;
      font-size: 20px;
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

      .form-grid {
        grid-template-columns: 1fr;
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

      .transfer-direction {
        flex-direction: column;
      }

      .transfer-arrow {
        transform: rotate(90deg);
      }
    }
  </style>

  <div class="create-transfer-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Request Transfer</h1>
          <p class="page-subtitle">
            <i class="bi bi-arrow-left-right"></i>
            Move inventory between warehouse locations
          </p>
        </div>
        <a href="{{ route('transfers.my') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to My Transfers
        </a>
      </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">{{ $errors->first() }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('transfers.store') }}" novalidate>
      @csrf

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <div class="header-text">
            <h3>Transfer Details</h3>
            <p>Specify the product and warehouse locations for this transfer</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Section: Product Selection --}}
            <div class="section-title">Product Information</div>

            {{-- Product --}}
            <div class="form-group full-width">
              <label class="form-label">
                Product <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-box-seam input-icon"></i>
                <select 
                  name="product_id" 
                  id="productSelect"
                  class="form-select @error('product_id') is-invalid @enderror" 
                  required
                >
                  <option value="" disabled {{ old('product_id') ? '' : 'selected' }}>
                    Select a product...
                  </option>
                  @foreach($products as $p)
                    <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>
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
            <div class="section-title">Warehouse Locations</div>

            {{-- From Warehouse --}}
            <div class="form-group">
              <label class="form-label">
                From Warehouse <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-building input-icon"></i>
                <select 
                  name="from_warehouse_id" 
                  id="fromWh"
                  class="form-select @error('from_warehouse_id') is-invalid @enderror" 
                  required
                >
                  <option value="" disabled {{ old('from_warehouse_id') ? '' : 'selected' }}>
                    Select source warehouse...
                  </option>
                  @foreach($warehouses as $w)
                    <option value="{{ $w->id }}" {{ old('from_warehouse_id') == $w->id ? 'selected' : '' }}>
                      {{ $w->code }} — {{ $w->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('from_warehouse_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- To Warehouse --}}
            <div class="form-group">
              <label class="form-label">
                To Warehouse <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-building-fill input-icon"></i>
                <select 
                  name="to_warehouse_id" 
                  id="toWh"
                  class="form-select @error('to_warehouse_id') is-invalid @enderror" 
                  required
                >
                  <option value="" disabled {{ old('to_warehouse_id') ? '' : 'selected' }}>
                    Select destination warehouse...
                  </option>
                  @foreach($warehouses as $w)
                    <option value="{{ $w->id }}" {{ old('to_warehouse_id') == $w->id ? 'selected' : '' }}>
                      {{ $w->code }} — {{ $w->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('to_warehouse_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Transfer Direction Visual --}}
            <div class="transfer-direction" id="transferVisual" style="display: none;">
              <div class="warehouse-preview from">
                <div class="warehouse-preview-icon">
                  <i class="bi bi-box-arrow-right"></i>
                </div>
                <span class="warehouse-preview-label">From</span>
                <span class="warehouse-preview-name" id="fromName">—</span>
              </div>
              <div class="transfer-arrow">
                <i class="bi bi-arrow-right"></i>
              </div>
              <div class="warehouse-preview to">
                <div class="warehouse-preview-icon">
                  <i class="bi bi-box-arrow-in-right"></i>
                </div>
                <span class="warehouse-preview-label">To</span>
                <span class="warehouse-preview-name" id="toName">—</span>
              </div>
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Transfer Quantity</div>

            {{-- Quantity --}}
            <div class="form-group">
              <label class="form-label">
                Quantity <span class="required">*</span>
              </label>
              <div class="qty-input-group">
                <div class="input-wrapper">
                  <i class="bi bi-123 input-icon"></i>
                  <input 
                    type="number" 
                    name="qty" 
                    id="qty"
                    min="1" 
                    value="{{ old('qty', 1) }}"
                    class="form-input @error('qty') is-invalid @enderror"
                    placeholder="Enter quantity"
                    required
                  >
                </div>
                <span class="qty-unit-badge">Units</span>
              </div>
              @error('qty')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Enter the number of units to transfer
              </div>
            </div>

            {{-- Reference --}}
            <div class="form-group">
              <label class="form-label">
                Reference Number
              </label>
              <div class="input-wrapper">
                <i class="bi bi-tag input-icon"></i>
                <input 
                  type="text" 
                  name="reference" 
                  id="reference"
                  value="{{ old('reference') }}"
                  class="form-input @error('reference') is-invalid @enderror"
                  placeholder="e.g., TRF-2024-001"
                >
              </div>
              @error('reference')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>

            {{-- Reason --}}
            <div class="form-group full-width">
              <label class="form-label">
                Reason for Transfer
              </label>
              <div class="input-wrapper">
                <i class="bi bi-chat-left-text input-icon textarea-icon"></i>
                <textarea 
                  name="reason" 
                  rows="3"
                  class="form-input @error('reason') is-invalid @enderror"
                  placeholder="Explain the reason for this transfer request..."
                >{{ old('reason') }}</textarea>
              </div>
              @error('reason')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <a href="{{ route('transfers.my') }}" class="btn-cancel">
            Cancel
          </a>
          <button type="submit" class="btn-submit">
            <i class="bi bi-send"></i>
            Submit Request
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    (function () {
      const fromWh = document.getElementById('fromWh');
      const toWh = document.getElementById('toWh');
      const transferVisual = document.getElementById('transferVisual');
      const fromName = document.getElementById('fromName');
      const toName = document.getElementById('toName');

      function updateVisual() {
        const fromSelected = fromWh.options[fromWh.selectedIndex];
        const toSelected = toWh.options[toWh.selectedIndex];

        if (fromWh.value && toWh.value) {
          transferVisual.style.display = 'flex';
          fromName.textContent = fromSelected.textContent.split(' — ')[0] || '—';
          toName.textContent = toSelected.textContent.split(' — ')[0] || '—';
        } else {
          transferVisual.style.display = 'none';
        }
      }

      // Prevent selecting same warehouse
      function validateWarehouses() {
        if (fromWh.value && toWh.value && fromWh.value === toWh.value) {
          toWh.value = '';
          alert('Source and destination warehouses cannot be the same.');
        }
        updateVisual();
      }

      fromWh.addEventListener('change', validateWarehouses);
      toWh.addEventListener('change', validateWarehouses);

      // Initial update
      updateVisual();
    })();
  </script>
</x-app-layout>