<?php>
<x-app-layout>
  <style>
    /* ===== Edit Product Page Styles ===== */
    .edit-product-page {
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
      gap: 12px;
    }

    .sku-header-badge {
      font-family: 'SF Mono', 'Fira Code', 'Courier New', monospace;
      font-size: 13px;
      font-weight: 700;
      color: white;
      background: rgba(99, 102, 241, 0.3);
      border: 1px solid rgba(99, 102, 241, 0.5);
      padding: 6px 12px;
      border-radius: 8px;
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

    /* ===== Alert ===== */
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

    .alert-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .alert-icon i {
      color: white;
      font-size: 22px;
    }

    .alert-content {
      flex: 1;
      color: #991b1b;
      font-size: 15px;
      font-weight: 500;
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

    @media (min-width: 992px) {
      .form-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
      }
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
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-input:focus + .input-icon,
    .input-wrapper:focus-within .input-icon {
      color: #6366f1;
    }

    .form-input.is-invalid {
      border-color: #ef4444;
    }

    .form-input.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    textarea.form-input {
      resize: vertical;
      min-height: 120px;
      padding-top: 16px;
    }

    /* ===== Select Styling ===== */
    .form-select {
      width: 100%;
      padding: 14px 40px 14px 50px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") no-repeat right 16px center;
      background-size: 16px;
      transition: all 0.3s ease;
      color: #0f172a;
      cursor: pointer;
      -webkit-appearance: none;
      appearance: none;
    }

    .form-select:hover {
      border-color: #cbd5e1;
      background-color: white;
    }

    .form-select:focus {
      outline: none;
      border-color: #6366f1;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-select.is-invalid {
      border-color: #ef4444;
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

    /* ===== Status Toggle ===== */
    .status-group {
      display: flex;
      gap: 16px;
    }

    .status-option {
      flex: 1;
    }

    .status-option input[type="radio"] {
      display: none;
    }

    .status-label {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 16px 24px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
      font-weight: 600;
      color: #64748b;
    }

    .status-label:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .status-label i {
      font-size: 20px;
    }

    .status-option input[type="radio"]:checked + .status-label.active {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-color: #10b981;
      color: #065f46;
    }

    .status-option input[type="radio"]:checked + .status-label.inactive {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      border-color: #f87171;
      color: #991b1b;
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

      .form-grid-3 {
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

      .status-group {
        flex-direction: column;
      }
    }
  </style>

  <div class="edit-product-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Edit Product</h1>
          <p class="page-subtitle">
            <i class="bi bi-pencil-square"></i>
            Update product information
            <span class="sku-header-badge">{{ $product->sku }}</span>
          </p>
        </div>
        <a href="{{ route('products.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Products
        </a>
      </div>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert-error">
        <div class="alert-icon">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content">
          Please fix the errors below and try again.
        </div>
      </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('products.update', $product) }}" novalidate>
      @csrf
      @method('PUT')

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-pencil-square"></i>
          </div>
          <div class="header-text">
            <h3>Product Information</h3>
            <p>Update the details for this product</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- SKU --}}
            <div class="form-group">
              <label class="form-label">
                SKU <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-upc-scan input-icon"></i>
                <input
                  type="text"
                  name="sku"
                  class="form-input @error('sku') is-invalid @enderror"
                  placeholder="e.g., PRD-00001"
                  value="{{ old('sku', $product->sku) }}"
                  required
                >
              </div>
              @error('sku')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Product Name --}}
            <div class="form-group">
              <label class="form-label">
                Product Name <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-tag input-icon"></i>
                <input
                  type="text"
                  name="name"
                  class="form-input @error('name') is-invalid @enderror"
                  placeholder="e.g., Widget A-100"
                  value="{{ old('name', $product->name) }}"
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

            {{-- Description --}}
            <div class="form-group full-width">
              <label class="form-label">
                Description
              </label>
              <div class="input-wrapper">
                <i class="bi bi-text-left input-icon textarea-icon"></i>
                <textarea
                  name="description"
                  rows="4"
                  class="form-input @error('description') is-invalid @enderror"
                  placeholder="Enter a detailed product description..."
                >{{ old('description', $product->description) }}</textarea>
              </div>
              @error('description')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Classification & Stock</div>

            {{-- Category, UOM, Reorder Point --}}
            <div class="form-grid-3 full-width">
              {{-- Category --}}
              <div class="form-group">
                <label class="form-label">
                  Category <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                  <i class="bi bi-grid input-icon"></i>
                  <select
                    name="category"
                    class="form-select @error('category') is-invalid @enderror"
                    required
                  >
                    @foreach($categories as $c)
                      <option value="{{ $c }}" @selected(old('category', $product->category) === $c)>{{ $c }}</option>
                    @endforeach
                  </select>
                </div>
                @error('category')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>

              {{-- Unit of Measure --}}
              <div class="form-group">
                <label class="form-label">
                  Unit of Measure <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                  <i class="bi bi-rulers input-icon"></i>
                  <select
                    name="uom"
                    class="form-select @error('uom') is-invalid @enderror"
                    required
                  >
                    @foreach($uoms as $u)
                      <option value="{{ $u }}" @selected(old('uom', $product->uom) === $u)>{{ $u }}</option>
                    @endforeach
                  </select>
                </div>
                @error('uom')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>

              {{-- Reorder Point --}}
              <div class="form-group">
                <label class="form-label">
                  Reorder Point <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                  <i class="bi bi-arrow-repeat input-icon"></i>
                  <input
                    type="number"
                    name="reorder_point"
                    class="form-input @error('reorder_point') is-invalid @enderror"
                    value="{{ old('reorder_point', $product->reorder_point) }}"
                    min="0"
                    required
                    placeholder="0"
                  >
                </div>
                @error('reorder_point')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Product Status</div>

            {{-- Status --}}
            <div class="form-group full-width">
              <label class="form-label">
                Status
              </label>
              <div class="status-group">
                <div class="status-option">
                  <input type="radio" name="is_active" value="1" id="status_active" 
                         @checked(old('is_active', $product->is_active) == 1)>
                  <label for="status_active" class="status-label active">
                    <i class="bi bi-check-circle-fill"></i>
                    Active
                  </label>
                </div>
                <div class="status-option">
                  <input type="radio" name="is_active" value="0" id="status_inactive" 
                         @checked(old('is_active', $product->is_active) == 0)>
                  <label for="status_inactive" class="status-label inactive">
                    <i class="bi bi-slash-circle"></i>
                    Inactive
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <a href="{{ route('products.index') }}" class="btn-cancel">
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
</x-app-layout>