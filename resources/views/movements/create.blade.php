{{-- resources/views/movements/create.blade.php --}}
<x-app-layout>
  <div class="container py-4">

    {{-- Page header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">New Stock Movement</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-arrow-left-right me-1"></i>Record an IN, OUT, TRANSFER, or ADJUST entry
        </p>
      </div>
      <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
        <i class="bi bi-arrow-left"></i> Back to Movements
      </a>
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

    {{-- Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold" style="color: #1a202c;">Movement Details</h5>
      </div>
      
      <div class="card-body p-4">
        <form method="POST" action="{{ route('movements.store') }}" class="row g-4">
          @csrf

          {{-- Type --}}
          <div class="col-md-4">
            <label class="form-label small text-muted fw-semibold mb-2">
              Type <span class="text-danger">*</span>
            </label>
            @php($prefType = old('type', request('type','IN')))
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-filter-circle"></i>
              </span>
              <select name="type" class="form-select ps-5" required
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="IN" {{ $prefType==='IN' ? 'selected' : '' }}>IN (receive)</option>
                <option value="OUT" {{ $prefType==='OUT' ? 'selected' : '' }}>OUT (issue)</option>
                <option value="TRANSFER" {{ $prefType==='TRANSFER' ? 'selected' : '' }}>TRANSFER</option>
                <option value="ADJUST" {{ $prefType==='ADJUST' ? 'selected' : '' }}>ADJUST (+qty)</option>
              </select>
            </div>
            <div class="form-text small mt-2">
              <i class="bi bi-info-circle me-1"></i>
              <strong>IN</strong> adds stock; <strong>OUT</strong> removes; <strong>TRANSFER</strong> moves; <strong>ADJUST</strong> corrects counts
            </div>
          </div>

          {{-- Product --}}
          <div class="col-md-8">
            <label class="form-label small text-muted fw-semibold mb-2">
              Product <span class="text-danger">*</span>
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-box-seam"></i>
              </span>
              <select name="product_id" class="form-select ps-5" required
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="" disabled {{ old('product_id', request('product_id')) ? '' : 'selected' }}>Select a product</option>
                @foreach($products as $p)
                  <option value="{{ $p->id }}"
                    {{ (string) old('product_id', request('product_id')) === (string) $p->id ? 'selected' : '' }}>
                    {{ $p->sku }} — {{ $p->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          {{-- From / To warehouses --}}
          <div class="col-md-6">
            <label class="form-label small text-muted fw-semibold mb-2">
              From Warehouse
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-building"></i>
              </span>
              <select name="from_warehouse_id" class="form-select ps-5"
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="">— Not applicable —</option>
                @foreach($warehouses as $w)
                  <option value="{{ $w->id }}"
                    {{ (string) old('from_warehouse_id', request('from_warehouse_id')) === (string) $w->id ? 'selected' : '' }}>
                    {{ $w->code }} — {{ $w->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-text small mt-2">
              <i class="bi bi-info-circle me-1"></i>Required for OUT and TRANSFER
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label small text-muted fw-semibold mb-2">
              To Warehouse
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-building"></i>
              </span>
              <select name="to_warehouse_id" class="form-select ps-5"
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="">— Not applicable —</option>
                @foreach($warehouses as $w)
                  <option value="{{ $w->id }}"
                    {{ (string) old('to_warehouse_id', request('warehouse_id') ?? request('to_warehouse_id')) === (string) $w->id ? 'selected' : '' }}>
                    {{ $w->code }} — {{ $w->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-text small mt-2">
              <i class="bi bi-info-circle me-1"></i>Required for IN, TRANSFER, and ADJUST
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          {{-- Qty + Reference --}}
          <div class="col-md-3">
            <label class="form-label small text-muted fw-semibold mb-2" for="qty">
              Quantity <span class="text-danger">*</span>
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-123"></i>
              </span>
              <input id="qty" type="number" name="qty" min="1" class="form-control ps-5"
                     value="{{ old('qty') }}" required
                     placeholder="0"
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
            </div>
          </div>

          <div class="col-md-9">
            <label class="form-label small text-muted fw-semibold mb-2">Reference</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-tag"></i>
              </span>
              <input name="reference" class="form-control ps-5"
                     value="{{ old('reference', request('reference')) }}"
                     placeholder="e.g., PO-1001 / ADJ / TRANSFER"
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
            </div>
          </div>

          {{-- Notes --}}
          <div class="col-12">
            <label class="form-label small text-muted fw-semibold mb-2">Notes</label>
            <div class="position-relative">
              <span class="position-absolute top-0 start-0 ms-3 mt-3 text-muted">
                <i class="bi bi-text-left"></i>
              </span>
              <textarea name="notes" class="form-control ps-5" rows="3" 
                        placeholder="Optional details or comments about this movement..."
                        style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px;">{{ old('notes') }}</textarea>
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          {{-- Actions --}}
          <div class="col-12 d-flex justify-content-end gap-3">
            <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
              Cancel
            </a>
            <button class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" id="saveBtn" style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
              <i class="bi bi-check-circle"></i> Save Movement
            </button>
          </div>

          {{-- Return-to URL --}}
          <input type="hidden" name="return" value="{{ request('return', url()->previous()) }}">
        </form>
      </div>
    </div>

  </div>

  <style>
    .form-control:focus,
    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover {
      transform: translateY(-1px);
    }
    
    .card {
      transition: box-shadow 0.2s ease;
    }
    
    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
  </style>
</x-app-layout>