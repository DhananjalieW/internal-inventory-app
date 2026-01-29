<?php>
<x-app-layout>
  <style>
    /* ===== Edit Warehouse Page Styles ===== */
    .edit-warehouse-page {
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

    .code-header-badge {
      font-family: 'SF Mono', 'Fira Code', 'Courier New', monospace;
      font-size: 13px;
      font-weight: 700;
      color: white;
      background: rgba(6, 182, 212, 0.3);
      border: 1px solid rgba(6, 182, 212, 0.5);
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
      background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
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
      min-height: 100px;
      padding-top: 16px;
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
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-color: #94a3b8;
      color: #475569;
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

      .status-group {
        flex-direction: column;
      }
    }
  </style>

  <div class="edit-warehouse-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Edit Warehouse</h1>
          <p class="page-subtitle">
            <i class="bi bi-pencil-square"></i>
            Update warehouse information
            <span class="code-header-badge">{{ $warehouse->code }}</span>
          </p>
        </div>
        <a href="{{ route('warehouses.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Warehouses
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
    <form method="POST" action="{{ route('warehouses.update', $warehouse) }}" novalidate>
      @csrf
      @method('PUT')

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-pencil-square"></i>
          </div>
          <div class="header-text">
            <h3>Warehouse Information</h3>
            <p>Update the details for this warehouse</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Code --}}
            <div class="form-group">
              <label class="form-label">
                Warehouse Code <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-upc-scan input-icon"></i>
                <input
                  type="text"
                  name="code"
                  class="form-input @error('code') is-invalid @enderror"
                  placeholder="e.g., WH-001"
                  value="{{ old('code', $warehouse->code) }}"
                  required
                  maxlength="20"
                >
              </div>
              @error('code')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Name --}}
            <div class="form-group">
              <label class="form-label">
                Warehouse Name <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-tag input-icon"></i>
                <input
                  type="text"
                  name="name"
                  class="form-input @error('name') is-invalid @enderror"
                  placeholder="e.g., Main Distribution Center"
                  value="{{ old('name', $warehouse->name) }}"
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

            {{-- Location --}}
            <div class="form-group full-width">
              <label class="form-label">
                Location
              </label>
              <div class="input-wrapper">
                <i class="bi bi-geo-alt input-icon textarea-icon"></i>
                <textarea
                  name="location"
                  rows="3"
                  class="form-input @error('location') is-invalid @enderror"
                  placeholder="Enter the warehouse address or location details..."
                >{{ old('location', $warehouse->location) }}</textarea>
              </div>
              @error('location')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Warehouse Status</div>

            {{-- Status --}}
            <div class="form-group full-width">
              <label class="form-label">
                Status
              </label>
              <div class="status-group">
                <div class="status-option">
                  <input type="radio" name="is_active" value="1" id="status_active" 
                         @checked(old('is_active', $warehouse->is_active) == 1)>
                  <label for="status_active" class="status-label active">
                    <i class="bi bi-check-circle-fill"></i>
                    Active
                  </label>
                </div>
                <div class="status-option">
                  <input type="radio" name="is_active" value="0" id="status_inactive" 
                         @checked(old('is_active', $warehouse->is_active) == 0)>
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
          <a href="{{ route('warehouses.index') }}" class="btn-cancel">
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