<?php>
<x-app-layout>
  <style>
    /* ===== Edit Supplier Page Styles ===== */
    .edit-supplier-page {
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

    .supplier-header-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(249, 115, 22, 0.2);
      border: 1px solid rgba(249, 115, 22, 0.4);
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      color: #fb923c;
    }

    .supplier-header-badge i {
      font-size: 14px;
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
      background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
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
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }

    .footer-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-delete-supplier {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: white;
      border: 2px solid #fee2e2;
      border-radius: 12px;
      color: #ef4444;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-delete-supplier:hover {
      background: #fef2f2;
      border-color: #ef4444;
      transform: translateY(-2px);
    }

    .footer-right {
      display: flex;
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

    /* ===== Info Card ===== */
    .info-card {
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
      border: 1px solid #bae6fd;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }

    .info-icon {
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .info-icon i {
      color: white;
      font-size: 20px;
    }

    .info-content {
      flex: 1;
    }

    .info-content h4 {
      font-size: 15px;
      font-weight: 700;
      color: #0c4a6e;
      margin: 0 0 4px 0;
    }

    .info-content p {
      font-size: 14px;
      color: #0369a1;
      margin: 0;
    }

    .info-meta {
      display: flex;
      gap: 20px;
      margin-top: 12px;
    }

    .info-meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: #0369a1;
    }

    .info-meta-item i {
      font-size: 14px;
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

      .footer-left {
        width: 100%;
      }

      .footer-right {
        width: 100%;
        flex-direction: column;
      }

      .btn-cancel,
      .btn-submit,
      .btn-delete-supplier {
        width: 100%;
        justify-content: center;
      }

      .status-group {
        flex-direction: column;
      }

      .info-card {
        flex-direction: column;
      }

      .info-meta {
        flex-direction: column;
        gap: 8px;
      }
    }
  </style>

  <div class="edit-supplier-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Edit Supplier</h1>
          <p class="page-subtitle">
            <i class="bi bi-pencil-square"></i>
            Update supplier information
            <span class="supplier-header-badge">
              <i class="bi bi-truck"></i>
              {{ $supplier->name }}
            </span>
          </p>
        </div>
        <a href="{{ route('suppliers.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Suppliers
        </a>
      </div>
    </div>

    {{-- Info Card --}}
    <div class="info-card">
      <div class="info-icon">
        <i class="bi bi-info-lg"></i>
      </div>
      <div class="info-content">
        <h4>Supplier Record</h4>
        <p>You are editing the supplier profile. Changes will be saved immediately upon submission.</p>
        <div class="info-meta">
          <div class="info-meta-item">
            <i class="bi bi-calendar-plus"></i>
            Created: {{ $supplier->created_at->format('M d, Y') }}
          </div>
          <div class="info-meta-item">
            <i class="bi bi-calendar-check"></i>
            Last Updated: {{ $supplier->updated_at->format('M d, Y') }}
          </div>
        </div>
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
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" novalidate>
      @csrf
      @method('PUT')

      <div class="form-card">
        <div class="form-card-header">
          <div class="header-icon">
            <i class="bi bi-truck"></i>
          </div>
          <div class="header-text">
            <h3>Supplier Information</h3>
            <p>Update the details for this supplier</p>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Name --}}
            <div class="form-group full-width">
              <label class="form-label">
                Supplier Name <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-building input-icon"></i>
                <input
                  type="text"
                  name="name"
                  class="form-input @error('name') is-invalid @enderror"
                  placeholder="e.g., Acme Components Ltd"
                  value="{{ old('name', $supplier->name) }}"
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

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Contact Details</div>

            {{-- Email, Phone, Status --}}
            <div class="form-grid-3 full-width">
              {{-- Email --}}
              <div class="form-group">
                <label class="form-label">
                  Email
                </label>
                <div class="input-wrapper">
                  <i class="bi bi-envelope input-icon"></i>
                  <input
                    type="email"
                    name="email"
                    class="form-input @error('email') is-invalid @enderror"
                    placeholder="name@company.com"
                    value="{{ old('email', $supplier->email) }}"
                  >
                </div>
                @error('email')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>

              {{-- Phone --}}
              <div class="form-group">
                <label class="form-label">
                  Phone
                </label>
                <div class="input-wrapper">
                  <i class="bi bi-telephone input-icon"></i>
                  <input
                    type="text"
                    name="phone"
                    class="form-input @error('phone') is-invalid @enderror"
                    placeholder="+94 77 123 4567"
                    value="{{ old('phone', $supplier->phone) }}"
                  >
                </div>
                @error('phone')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>

              {{-- Status --}}
              <div class="form-group">
                <label class="form-label">
                  Status
                </label>
                <div class="status-group">
                  <div class="status-option">
                    <input type="radio" name="is_active" value="1" id="status_active" 
                           @checked(old('is_active', $supplier->is_active) == 1)>
                    <label for="status_active" class="status-label active">
                      <i class="bi bi-check-circle-fill"></i>
                      Active
                    </label>
                  </div>
                  <div class="status-option">
                    <input type="radio" name="is_active" value="0" id="status_inactive" 
                           @checked(old('is_active', $supplier->is_active) == 0)>
                    <label for="status_inactive" class="status-label inactive">
                      <i class="bi bi-slash-circle"></i>
                      Inactive
                    </label>
                  </div>
                </div>
                @error('is_active')
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>
            <div class="section-title">Address Information</div>

            {{-- Address --}}
            <div class="form-group full-width">
              <label class="form-label">
                Address
              </label>
              <div class="input-wrapper">
                <i class="bi bi-geo-alt input-icon textarea-icon"></i>
                <textarea
                  name="address"
                  rows="4"
                  class="form-input @error('address') is-invalid @enderror"
                  placeholder="Street, City, State/Province, Postal Code"
                >{{ old('address', $supplier->address) }}</textarea>
              </div>
              @error('address')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <div class="footer-left">
            <button type="button" class="btn-delete-supplier" onclick="confirmDelete()">
              <i class="bi bi-trash"></i>
              Delete Supplier
            </button>
          </div>
          <div class="footer-right">
            <a href="{{ route('suppliers.index') }}" class="btn-cancel">
              Cancel
            </a>
            <button type="submit" class="btn-submit">
              <i class="bi bi-check-circle"></i>
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </form>

    {{-- Hidden Delete Form --}}
    <form id="delete-form" action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display: none;">
      @csrf
      @method('DELETE')
    </form>
  </div>

  <script>
    function confirmDelete() {
      if (confirm('Are you sure you want to delete this supplier? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
      }
    }
  </script>
</x-app-layout>