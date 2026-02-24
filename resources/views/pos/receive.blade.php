{{-- resources/views/pos/receive_item.blade.php --}}
<x-app-layout>
  <style>
    /* ===== Receive PO Item Page Styles ===== */
    .receive-page {
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

    /* ===== Item Summary Card ===== */
    .summary-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      margin-bottom: 28px;
    }

    .summary-card-header {
      padding: 20px 28px;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-bottom: 1px solid #e2e8f0;
    }

    .summary-card-header h3 {
      font-size: 16px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .summary-card-header h3 i {
      color: #6366f1;
    }

    .summary-card-body {
      padding: 28px;
    }

    .summary-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px;
    }

    /* ===== Product Info ===== */
    .product-info {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .info-row {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .info-label {
      font-size: 12px;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .info-value {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 18px;
    }

    .product-details {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .product-sku {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
      letter-spacing: 0.5px;
    }

    .product-name {
      font-size: 13px;
      color: #64748b;
    }

    .po-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .po-number {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 15px;
      letter-spacing: 0.5px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      padding: 8px 14px;
      border-radius: 8px;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
    }

    /* ===== Progress Section ===== */
    .progress-section {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-radius: 16px;
      padding: 24px;
    }

    .progress-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .progress-label {
      font-size: 13px;
      font-weight: 600;
      color: #64748b;
    }

    .progress-value {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
    }

    .progress-bar-wrapper {
      height: 12px;
      background: #e2e8f0;
      border-radius: 6px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .progress-bar-fill {
      height: 100%;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border-radius: 6px;
      transition: width 0.5s ease;
    }

    .remaining-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 16px;
      border-top: 1px solid #e2e8f0;
    }

    .remaining-label {
      font-size: 14px;
      font-weight: 600;
      color: #64748b;
    }

    .remaining-badge {
      display: inline-flex;
      align-items: center;
      padding: 10px 18px;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
    }

    .remaining-badge.has-remaining {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .remaining-badge.complete {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
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

    .alert-content.success {
      color: #065f46;
    }

    .alert-content.error {
      color: #991b1b;
    }

    .alert-content ul {
      margin: 8px 0 0 0;
      padding-left: 20px;
    }

    .alert-content ul li {
      font-size: 14px;
      margin-bottom: 4px;
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
      padding: 24px 28px 20px;
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
      padding: 28px;
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

    .input-wrapper:focus-within .input-icon {
      color: #6366f1;
    }

    .form-input:disabled {
      background: #f1f5f9;
      color: #94a3b8;
      cursor: not-allowed;
    }

    textarea.form-input {
      resize: vertical;
      min-height: 100px;
      padding-top: 16px;
    }

    /* ===== Quantity Input Group ===== */
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

    .qty-max-badge {
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

    /* ===== Form Help ===== */
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

    /* ===== File Input ===== */
    .file-input-wrapper {
      position: relative;
    }

    .file-input {
      width: 100%;
      padding: 14px 16px 14px 50px;
      font-size: 15px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
      cursor: pointer;
    }

    .file-input:hover {
      border-color: #cbd5e1;
      background: white;
    }

    .file-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .file-input:disabled {
      background: #f1f5f9;
      cursor: not-allowed;
    }

    .file-input::file-selector-button {
      display: none;
    }

    /* ===== Section Divider ===== */
    .section-divider {
      grid-column: 1 / -1;
      height: 1px;
      background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
      margin: 8px 0;
    }

    /* ===== Form Footer ===== */
    .form-card-footer {
      padding: 24px 28px;
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
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
    }

    .btn-submit:disabled {
      opacity: 0.7;
      cursor: not-allowed;
      transform: none;
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

      .summary-grid {
        grid-template-columns: 1fr;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .form-card-body {
        padding: 20px;
      }

      .form-card-footer {
        flex-direction: column;
      }

      .btn-cancel,
      .btn-submit {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  @php
    $ordered   = (int) $item->qty_ordered;
    $received  = (int) $item->received_qty;
    $remaining = $ordered - $received;
    $pct       = $ordered > 0 ? min(100, round(($received / $ordered) * 100)) : 0;
  @endphp

  <div class="receive-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">Receive PO Item</h1>
          <p class="page-subtitle">
            <i class="bi bi-box-arrow-in-down"></i>
            Record the receipt of items from a purchase order
          </p>
        </div>
        <a href="{{ route('pos.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Purchase Orders
        </a>
      </div>
    </div>

    {{-- Item Summary Card --}}
    <div class="summary-card">
      <div class="summary-card-header">
        <h3>
          <i class="bi bi-info-circle"></i>
          Item Details
        </h3>
      </div>
      <div class="summary-card-body">
        <div class="summary-grid">
          {{-- Product Info --}}
          <div class="product-info">
            <div class="info-row">
              <span class="info-label">Product</span>
              <div class="info-value">
                <div class="product-icon">
                  <i class="bi bi-box-seam"></i>
                </div>
                <div class="product-details">
                  <span class="product-sku">{{ $item->sku }}</span>
                  <span class="product-name">{{ $item->product_name }}</span>
                </div>
              </div>
            </div>

            <div class="info-row">
              <span class="info-label">Purchase Order</span>
              <div class="info-value">
                <div class="po-badge">
                  <span class="po-number">{{ $item->po_number }}</span>
                  <span class="status-badge">
                    {{ strtoupper($item->po_status) }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          {{-- Progress Section --}}
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Receipt Progress</span>
              <span class="progress-value">{{ $received }} / {{ $ordered }}</span>
            </div>
            <div class="progress-bar-wrapper">
              <div class="progress-bar-fill" style="width: {{ $pct }}%;"></div>
            </div>
            <div class="remaining-section">
              <span class="remaining-label">Remaining to receive:</span>
              <span class="remaining-badge {{ $remaining > 0 ? 'has-remaining' : 'complete' }}">
                {{ $remaining }} units
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Fully Received Alert --}}
    @if ($remaining <= 0)
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">
          <strong>Fully Received!</strong> All ordered items have been received. No further action needed.
        </div>
      </div>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert-custom alert-error-custom">
        <div class="alert-icon error">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content error">
          <strong>Please fix the following errors:</strong>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">
      <div class="form-card-header">
        <div class="header-icon">
          <i class="bi bi-box-arrow-in-down"></i>
        </div>
        <div class="header-text">
          <h3>Receiving Information</h3>
          <p>Enter the details for items being received</p>
        </div>
      </div>

      <form method="POST" action="{{ route('pos.item.receive.store', $item->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Quantity --}}
            <div class="form-group">
              <label class="form-label">
                Quantity to Receive <span class="required">*</span>
              </label>
              <div class="qty-input-group">
                <div class="input-wrapper">
                  <i class="bi bi-123 input-icon"></i>
                  <input 
                    type="number" 
                    name="qty" 
                    id="qtyInput"
                    min="1" 
                    max="{{ $remaining }}"
                    value="{{ max(1, $remaining) }}"
                    class="form-input"
                    {{ $remaining <= 0 ? 'disabled' : '' }}
                    required
                  >
                </div>
                <span class="qty-max-badge">/ {{ $remaining }}</span>
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Maximum allowed is the remaining quantity
              </div>
            </div>

            {{-- Date --}}
            <div class="form-group">
              <label class="form-label">
                Receive Date
              </label>
              <div class="input-wrapper">
                <i class="bi bi-calendar3 input-icon"></i>
                <input 
                  type="date" 
                  name="date" 
                  class="form-input"
                  value="{{ date('Y-m-d') }}"
                  {{ $remaining <= 0 ? 'disabled' : '' }}
                >
              </div>
            </div>

            {{-- Reference --}}
            <div class="form-group">
              <label class="form-label">
                Reference / GRN Number
              </label>
              <div class="input-wrapper">
                <i class="bi bi-tag input-icon"></i>
                <input 
                  type="text" 
                  name="reference" 
                  class="form-input"
                  placeholder="e.g., GRN-2024-001"
                  {{ $remaining <= 0 ? 'disabled' : '' }}
                >
              </div>
            </div>

            {{-- Attachment --}}
            <div class="form-group">
              <label class="form-label">
                GRN Attachment
              </label>
              <div class="file-input-wrapper">
                <i class="bi bi-paperclip input-icon"></i>
                <input 
                  type="file" 
                  name="attachment" 
                  class="file-input form-input"
                  accept="image/*,application/pdf"
                  {{ $remaining <= 0 ? 'disabled' : '' }}
                >
              </div>
              <div class="form-help">
                <i class="bi bi-info-circle"></i>
                Upload a photo or PDF of the delivery note (optional)
              </div>
            </div>

            {{-- Section Divider --}}
            <div class="section-divider"></div>

            {{-- Notes --}}
            <div class="form-group full-width">
              <label class="form-label">
                Notes
              </label>
              <div class="input-wrapper">
                <i class="bi bi-chat-left-text input-icon textarea-icon"></i>
                <textarea 
                  name="notes" 
                  rows="3"
                  class="form-input"
                  placeholder="Optional delivery notes or observations..."
                  {{ $remaining <= 0 ? 'disabled' : '' }}
                ></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="form-card-footer">
          <a href="{{ route('pos.index') }}" class="btn-cancel">
            Cancel
          </a>
          <button type="submit" class="btn-submit" {{ $remaining <= 0 ? 'disabled' : '' }}>
            <i class="bi bi-check-circle"></i>
            Receive Items
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (function () {
      const qty = document.getElementById('qtyInput');
      if (!qty) return;
      
      qty.addEventListener('input', () => {
        const max = Number(qty.max || 0);
        let val = Number(qty.value || 0);
        if (val > max) val = max;
        if (val < 1) val = 1;
        qty.value = val;
      }, { passive: true });
    })();
  </script>
</x-app-layout>