{{-- resources/views/transfers/create.blade.php --}}
<x-app-layout>
  <div class="container py-4" style="max-width: 960px;">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Request Transfer</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-arrow-left-right me-1"></i>Move inventory between warehouse locations
        </p>
      </div>
    </div>

    {{-- Alerts --}}
    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fee 0%, #ffebee 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #7f1d1d;">{{ $errors->first() }}</span>
        </div>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(40, 167, 69, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #155724;">{{ session('success') }}</span>
        </div>
      </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2" style="color: #1a202c;">
          <div class="d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px;">
            <i class="bi bi-arrow-left-right text-white small"></i>
          </div>
          Transfer Details
        </h5>
      </div>

      <form method="POST" action="{{ route('transfers.store') }}" class="card-body p-4 row g-4" id="transferForm" novalidate>
        @csrf

        {{-- Product --}}
        <div class="col-md-6">
          <label class="form-label small text-muted fw-semibold mb-2">
            Product <span class="text-danger">*</span>
          </label>
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
              <i class="bi bi-box-seam"></i>
            </span>
            <select name="product_id" class="form-select ps-5" required
                    style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
              <option value="" disabled selected>Select a product</option>
              @foreach($products as $p)
                <option value="{{ $p->id }}">{{ $p->sku }} — {{ $p->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-text small mt-2">
            <i class="bi bi-info-circle me-1"></i>Choose the SKU you want to move
          </div>
        </div>

        {{-- From Warehouse --}}
        <div class="col-md-3">
          <label class="form-label small text-muted fw-semibold mb-2">
            From warehouse <span class="text-danger">*</span>
          </label>
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
              <i class="bi bi-building"></i>
            </span>
            <select name="from_warehouse_id" id="fromWh" class="form-select ps-5" required
                    style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
              <option value="" disabled selected>Select</option>
              @foreach($warehouses as $w)
                <option value="{{ $w->id }}" data-code="{{ $w->code }}">{{ $w->code }} — {{ $w->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
            <i class="bi bi-exclamation-circle"></i>Choose a different warehouse than "To"
          </div>
        </div>

        {{-- To Warehouse --}}
        <div class="col-md-3">
          <label class="form-label small text-muted fw-semibold mb-2">
            To warehouse <span class="text-danger">*</span>
          </label>
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
              <i class="bi bi-building"></i>
            </span>
            <select name="to_warehouse_id" id="toWh" class="form-select ps-5" required
                    style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
              <option value="" disabled selected>Select</option>
              @foreach($warehouses as $w)
                <option value="{{ $w->id }}" data-code="{{ $w->code }}">{{ $w->code }} — {{ $w->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
            <i class="bi bi-exclamation-circle"></i>Choose a different warehouse than "From"
          </div>
        </div>

        <div class="col-12">
          <hr style="border-color: #f1f3f5; margin: 1rem 0;">
        </div>

        {{-- Quantity --}}
        <div class="col-md-6">
          <label class="form-label small text-muted fw-semibold mb-2">
            Quantity <span class="text-danger">*</span>
          </label>
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
              <i class="bi bi-123"></i>
            </span>
            <input type="number" min="1" name="qty" id="qty" class="form-control ps-5" required
                   placeholder="Enter quantity"
                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 600;">
          </div>
          <div class="form-text small mt-2">
            <i class="bi bi-info-circle me-1"></i>Must be at least 1
          </div>
        </div>

        {{-- Reference --}}
        <div class="col-md-6">
          <label class="form-label small text-muted fw-semibold mb-2">Reference</label>
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
              <i class="bi bi-tag"></i>
            </span>
            <input type="text" name="reference" id="reference" class="form-control ps-5" 
                   placeholder="TRANSFER"
                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
          </div>
          <div class="form-text small mt-2">
            <i class="bi bi-info-circle me-1"></i>Optional. E.g., ticket # or reason code
          </div>
        </div>

        {{-- Notes --}}
        <div class="col-12">
          <label class="form-label small text-muted fw-semibold mb-2">Notes</label>
          <div class="position-relative">
            <span class="position-absolute top-0 start-0 ms-3 mt-3 text-muted">
              <i class="bi bi-text-left"></i>
            </span>
            <textarea name="notes" rows="3" class="form-control ps-5" 
                      placeholder="Anything approvers should know about this transfer..."
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px;"></textarea>
          </div>
        </div>

        <div class="col-12">
          <hr style="border-color: #f1f3f5; margin: 1rem 0;">
        </div>

        {{-- Actions --}}
        <div class="col-12 d-flex justify-content-end gap-3">
          <a class="btn btn-outline-secondary px-4 py-2" href="{{ route('transfers.my') }}" 
             style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
            Cancel
          </a>
          <button class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" 
                  style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
            <i class="bi bi-send"></i> Submit Request
          </button>
        </div>
      </form>
    </div>
  </div>

  <style>
    .form-control:focus,
    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    .form-control.is-invalid,
    .form-select.is-invalid {
      border-color: #ef4444 !important;
    }
    
    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
      border-color: #ef4444 !important;
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover {
      transform: translateY(-1px);
    }
    
    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
  </style>

  <script>
    (function () {
      const fromWh = document.getElementById('fromWh');
      const toWh   = document.getElementById('toWh');
      const qty    = document.getElementById('qty');
      const ref    = document.getElementById('reference');
      const form   = document.getElementById('transferForm');

      // Default reference helper
      if (!ref.value) ref.placeholder = 'TRANSFER';

      // Prevent same From/To
      function validateWarehouses() {
        const same = fromWh.value && toWh.value && fromWh.value === toWh.value;
        if (same) {
          fromWh.classList.add('is-invalid');
          toWh.classList.add('is-invalid');
        } else {
          fromWh.classList.remove('is-invalid');
          toWh.classList.remove('is-invalid');
        }
        return !same;
      }
      fromWh.addEventListener('change', validateWarehouses);
      toWh.addEventListener('change', validateWarehouses);

      // Clamp qty to min 1
      qty.addEventListener('input', () => {
        let v = Number(qty.value || 0);
        if (v < 1) v = 1;
        qty.value = v;
      }, { passive: true });

      // Block submit if invalid
      form.addEventListener('submit', (e) => {
        if (!validateWarehouses()) {
          e.preventDefault();
          e.stopPropagation();
        }
      });
    })();
  </script>
</x-app-layout>