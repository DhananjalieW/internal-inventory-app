<?php>
<x-app-layout>
  <style>
    /* ===== Create PO Page Styles ===== */
    .create-po-page {
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

    .alert-warning-custom {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #fcd34d;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15);
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

    .alert-icon.warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
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
    .alert-content.warning { color: #92400e; }
    .alert-content.error { color: #991b1b; }

    .alert-content ul {
      margin: 8px 0 0 0;
      padding-left: 20px;
    }

    .alert-content ul li {
      font-size: 14px;
      margin-bottom: 4px;
    }

    /* ===== Form Cards ===== */
    .form-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
      margin-bottom: 28px;
    }

    .form-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .form-card-header {
      padding: 24px 32px 20px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .header-icon.blue {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .header-icon.purple {
      background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
      padding: 28px 32px;
    }

    /* ===== Form Grid ===== */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
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

    .form-select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 16px center;
      background-size: 16px 12px;
      padding-right: 48px;
    }

    .invalid-feedback {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 8px;
      font-size: 13px;
      color: #dc2626;
      font-weight: 500;
    }

    /* ===== Items Table ===== */
    .items-table-wrapper {
      overflow-x: auto;
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 700px;
    }

    .items-table thead {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .items-table thead th {
      padding: 14px 20px;
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      text-align: left;
      white-space: nowrap;
    }

    .items-table thead th.text-end {
      text-align: right;
    }

    .items-table thead th.text-center {
      text-align: center;
    }

    .items-table tbody tr {
      border-bottom: 1px solid #f1f5f9;
      transition: all 0.2s ease;
    }

    .items-table tbody tr:hover {
      background: rgba(99, 102, 241, 0.02);
    }

    .items-table tbody td {
      padding: 16px 20px;
      vertical-align: middle;
    }

    .items-table tbody td.text-end {
      text-align: right;
    }

    .items-table tbody td.text-center {
      text-align: center;
    }

    /* Item inputs */
    .item-select {
      width: 100%;
      padding: 12px 14px;
      font-size: 14px;
      font-weight: 500;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 14px 10px;
      padding-right: 36px;
    }

    .item-select:focus {
      outline: none;
      border-color: #6366f1;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .item-input {
      width: 100%;
      padding: 12px 14px;
      font-size: 14px;
      font-weight: 600;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      background: #f8fafc;
      transition: all 0.3s ease;
      color: #0f172a;
      text-align: right;
    }

    .item-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .item-input::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    /* Amount Badge */
    .amount-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 16px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
      min-width: 80px;
    }

    /* Remove Button */
    .btn-remove {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      background: white;
      border: 2px solid #fee2e2;
      border-radius: 10px;
      color: #ef4444;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-remove:hover {
      background: #fef2f2;
      border-color: #ef4444;
      transform: translateY(-2px);
    }

    .btn-remove i {
      font-size: 16px;
    }

    /* Table Footer */
    .items-table tfoot {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-top: 2px solid #e2e8f0;
    }

    .items-table tfoot td {
      padding: 16px 20px;
    }

    .summary-label {
      font-size: 14px;
      font-weight: 700;
      color: #475569;
    }

    .summary-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 18px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
    }

    .summary-badge.items {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .summary-badge.total {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      color: white;
      font-size: 16px;
      padding: 12px 20px;
    }

    /* Add Item Button */
    .btn-add-item {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-add-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    }

    /* ===== Form Footer ===== */
    .form-footer {
      display: flex;
      justify-content: flex-end;
      gap: 16px;
      padding-top: 8px;
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

    .btn-submit:disabled {
      opacity: 0.7;
      cursor: not-allowed;
      transform: none;
    }

    .btn-submit i {
      font-size: 18px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 992px) {
      .form-grid {
        grid-template-columns: 1fr;
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
        padding: 20px;
      }

      .form-card-header {
        padding: 20px;
        flex-direction: column;
        align-items: flex-start;
      }

      .form-footer {
        flex-direction: column;
      }

      .btn-cancel,
      .btn-submit {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  <div class="create-po-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div>
          <h1 class="page-title">New Purchase Order</h1>
          <p class="page-subtitle">
            <i class="bi bi-receipt"></i>
            Create a new order from a supplier
          </p>
        </div>
        <a href="{{ route('pos.index') }}" class="btn-back">
          <i class="bi bi-arrow-left"></i>
          Back to Purchase Orders
        </a>
      </div>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
      </div>
    @endif

    {{-- Warning Alert --}}
    @if (session('warning'))
      <div class="alert-custom alert-warning-custom">
        <div class="alert-icon warning">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content warning">{{ session('warning') }}</div>
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

    {{-- Form --}}
    <form id="po-create-form" method="POST" action="{{ route('pos.store') }}" novalidate>
      @csrf
      <input type="hidden" name="order_date" value="{{ date('Y-m-d') }}">

      {{-- Order Information Card --}}
      <div class="form-card">
        <div class="form-card-header">
          <div class="header-left">
            <div class="header-icon blue">
              <i class="bi bi-info-circle"></i>
            </div>
            <div class="header-text">
              <h3>Order Information</h3>
              <p>Enter the basic details for this purchase order</p>
            </div>
          </div>
        </div>

        <div class="form-card-body">
          <div class="form-grid">
            {{-- Supplier --}}
            <div class="form-group">
              <label class="form-label">
                Supplier <span class="required">*</span>
              </label>
              <div class="input-wrapper">
                <i class="bi bi-truck input-icon"></i>
                <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                  <option value="">Select a supplier...</option>
                  @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>{{ $s->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('supplier_id')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- PO Number --}}
            <div class="form-group">
              <label class="form-label">
                PO Number
              </label>
              <div class="input-wrapper">
                <i class="bi bi-hash input-icon"></i>
                <input 
                  type="text" 
                  name="po_number" 
                  class="form-input @error('po_number') is-invalid @enderror"
                  placeholder="Auto-generated if blank"
                  value="{{ old('po_number') }}"
                >
              </div>
              @error('po_number')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Expected Date --}}
            <div class="form-group">
              <label class="form-label">
                Expected Delivery
              </label>
              <div class="input-wrapper">
                <i class="bi bi-calendar-check input-icon"></i>
                <input 
                  type="date" 
                  name="expected_date" 
                  class="form-input @error('expected_date') is-invalid @enderror"
                  value="{{ old('expected_date') }}"
                >
              </div>
              @error('expected_date')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>
      </div>

      {{-- Items Card --}}
      <div class="form-card">
        <div class="form-card-header">
          <div class="header-left">
            <div class="header-icon purple">
              <i class="bi bi-box-seam"></i>
            </div>
            <div class="header-text">
              <h3>Order Items</h3>
              <p>Add products and quantities to this order</p>
            </div>
          </div>
          <button type="button" id="addRow" class="btn-add-item">
            <i class="bi bi-plus-circle"></i>
            Add Item
          </button>
        </div>

        <div class="items-table-wrapper">
          <table class="items-table" id="itemsTable">
            <thead>
              <tr>
                <th style="width: 34%">Product</th>
                <th style="width: 26%">Warehouse</th>
                <th style="width: 10%" class="text-end">Qty</th>
                <th style="width: 14%" class="text-end">Price</th>
                <th style="width: 12%" class="text-end">Amount</th>
                <th style="width: 4%" class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              {{-- Starter Row --}}
              <tr>
                <td>
                  <select name="items[0][product_id]" class="item-select" required>
                    <option value="">Select product...</option>
                    @foreach($products as $p)
                      <option value="{{ $p->id }}">{{ $p->sku }} — {{ $p->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <select name="items[0][warehouse_id]" class="item-select" required>
                    <option value="">Select warehouse...</option>
                    @foreach($warehouses as $w)
                      <option value="{{ $w->id }}">{{ $w->code }} — {{ $w->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <input name="items[0][qty]" type="number" min="1" value="1" class="item-input js-qty" required>
                </td>
                <td>
                  <input name="items[0][price]" type="number" step="0.01" min="0" class="item-input js-price" placeholder="0.00">
                </td>
                <td class="text-end">
                  <span class="amount-badge js-amount">0.00</span>
                </td>
                <td class="text-center">
                  <button type="button" class="btn-remove removeRow" title="Remove">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="text-end">
                  <span class="summary-label">Summary:</span>
                </td>
                <td class="text-end">
                  <span class="summary-badge items">
                    <span id="sumQty">1</span> items
                  </span>
                </td>
                <td class="text-end">
                  <span class="summary-label">Total</span>
                </td>
                <td class="text-end">
                  <span class="summary-badge total">
                    <span id="sumAmount">0.00</span>
                  </span>
                </td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      {{-- Form Footer --}}
      <div class="form-footer">
        <a href="{{ route('pos.index') }}" class="btn-cancel">
          Cancel
        </a>
        <button id="submitBtn" type="submit" class="btn-submit" data-label="Create PO">
          <i class="bi bi-check-circle"></i>
          Create PO
        </button>
      </div>
    </form>
  </div>

  <script>
    (function () {
      const products   = @json($products->map(fn($p)=>['id'=>$p->id,'label'=>$p->sku.' — '.$p->name]));
      const warehouses = @json($warehouses->map(fn($w)=>['id'=>$w->id,'label'=>$w->code.' — '.$w->name]));
      const tableBody  = document.querySelector('#itemsTable tbody');
      const addBtn     = document.getElementById('addRow');
      const sumQtyEl   = document.getElementById('sumQty');
      const sumAmountEl = document.getElementById('sumAmount');

      function optionsHtml(list, placeholder) {
        return [`<option value="">${placeholder}</option>`]
          .concat(list.map(o => `<option value="${o.id}">${o.label}</option>`))
          .join('');
      }

      function recalcRow(tr) {
        const qty   = parseFloat(tr.querySelector('.js-qty')?.value || 0);
        const price = parseFloat(tr.querySelector('.js-price')?.value || 0);
        const amt   = (qty * price) || 0;
        tr.querySelector('.js-amount').textContent = amt.toFixed(2);
      }

      function recalcTotals() {
        let totalQty = 0, totalAmt = 0;
        tableBody.querySelectorAll('tr').forEach(tr => {
          const qty = parseFloat(tr.querySelector('.js-qty')?.value || 0);
          const amt = parseFloat(tr.querySelector('.js-amount')?.textContent || 0);
          totalQty += qty;
          totalAmt += amt;
        });
        sumQtyEl.textContent = totalQty.toString();
        sumAmountEl.textContent = totalAmt.toFixed(2);
      }

      function wireRow(tr) {
        tr.addEventListener('input', (e) => {
          if (e.target.classList.contains('js-qty') || e.target.classList.contains('js-price')) {
            recalcRow(tr);
            recalcTotals();
          }
        });
      }

      function addRow() {
        const index = tableBody.querySelectorAll('tr').length;
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>
            <select name="items[${index}][product_id]" class="item-select" required>
              ${optionsHtml(products, 'Select product...')}
            </select>
          </td>
          <td>
            <select name="items[${index}][warehouse_id]" class="item-select" required>
              ${optionsHtml(warehouses, 'Select warehouse...')}
            </select>
          </td>
          <td>
            <input name="items[${index}][qty]" type="number" min="1" value="1" class="item-input js-qty" required>
          </td>
          <td>
            <input name="items[${index}][price]" type="number" step="0.01" min="0" class="item-input js-price" placeholder="0.00">
          </td>
          <td class="text-end">
            <span class="amount-badge js-amount">0.00</span>
          </td>
          <td class="text-center">
            <button type="button" class="btn-remove removeRow" title="Remove">
              <i class="bi bi-x-lg"></i>
            </button>
          </td>`;
        tableBody.appendChild(tr);
        wireRow(tr);
        recalcRow(tr);
        recalcTotals();
      }

      // Initial wire + calc
      wireRow(tableBody.querySelector('tr'));
      recalcTotals();

      addBtn.addEventListener('click', addRow);

      tableBody.addEventListener('click', (e) => {
        if (e.target.closest('.removeRow')) {
          const rows = tableBody.querySelectorAll('tr');
          if (rows.length > 1) {
            e.target.closest('tr').remove();
            recalcTotals();
          }
        }
      });

      // Double-submit guard
      const form = document.getElementById('po-create-form');
      const btn  = document.getElementById('submitBtn');
      let locked = false;

      form.addEventListener('submit', function (e) {
        if (locked) {
          e.preventDefault();
          return false;
        }
        locked = true;
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating...';
      });

      window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
          locked = false;
          btn.disabled = false;
          btn.innerHTML = '<i class="bi bi-check-circle"></i> ' + (btn.dataset.label || 'Create PO');
        }
      });
    })();
  </script>
</x-app-layout>