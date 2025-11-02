<x-app-layout>
  <div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Create Product</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-box-seam me-1"></i>Add a new product to your inventory
        </p>
      </div>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
        <i class="bi bi-arrow-left"></i> Back to list
      </a>
    </div>

    {{-- Top-level errors --}}
    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fee 0%, #ffebee 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #7f1d1d;">Please fix the errors below and try again.</span>
        </div>
      </div>
    @endif

    <form method="post" action="{{ route('products.store') }}" novalidate>
      @csrf

      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">Product Information</h5>
        </div>
        
        <div class="card-body p-4">
          <div class="row g-4">

            {{-- SKU --}}
            <div class="col-md-6">
              <label class="form-label small text-muted fw-semibold mb-2">
                SKU <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                  <i class="bi bi-upc-scan"></i>
                </span>
                <input
                  name="sku"
                  class="form-control ps-5 @error('sku') is-invalid @enderror"
                  placeholder="e.g., WDG-A100"
                  value="{{ old('sku') }}"
                  required
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
                >
                @error('sku')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Product Name --}}
            <div class="col-md-6">
              <label class="form-label small text-muted fw-semibold mb-2">
                Product Name <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                  <i class="bi bi-tag"></i>
                </span>
                <input
                  name="name"
                  class="form-control ps-5 @error('name') is-invalid @enderror"
                  placeholder="e.g., Widget A-100"
                  value="{{ old('name') }}"
                  required
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
                >
                @error('name')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Description --}}
            <div class="col-12">
              <label class="form-label small text-muted fw-semibold mb-2">
                Description
              </label>
              <div class="position-relative">
                <span class="position-absolute top-0 start-0 ms-3 mt-3 text-muted">
                  <i class="bi bi-text-left"></i>
                </span>
                <textarea
                  name="description"
                  rows="4"
                  class="form-control ps-5 @error('description') is-invalid @enderror"
                  placeholder="Enter a detailed product description..."
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px;"
                >{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-12">
              <hr style="border-color: #f1f3f5; margin: 1rem 0;">
            </div>

            {{-- Category --}}
            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">
                Category <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                  <i class="bi bi-grid"></i>
                </span>
                <select
                  name="category"
                  class="form-select ps-5 @error('category') is-invalid @enderror"
                  required
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
                >
                  <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                  @foreach($categories as $c)
                    <option value="{{ $c }}" @selected(old('category')===$c)>{{ $c }}</option>
                  @endforeach
                </select>
                @error('category')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Unit of Measure --}}
            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">
                Unit of Measure <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                  <i class="bi bi-rulers"></i>
                </span>
                <select
                  name="uom"
                  class="form-select ps-5 @error('uom') is-invalid @enderror"
                  required
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
                >
                  <option value="" disabled {{ old('uom') ? '' : 'selected' }}>Select unit</option>
                  @foreach($uoms as $u)
                    <option value="{{ $u }}" @selected(old('uom')===$u)>{{ $u }}</option>
                  @endforeach
                </select>
                @error('uom')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            {{-- Reorder Point --}}
            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">
                Reorder Point <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                  <i class="bi bi-arrow-repeat"></i>
                </span>
                <input
                  type="number"
                  name="reorder_point"
                  class="form-control ps-5 @error('reorder_point') is-invalid @enderror"
                  value="{{ old('reorder_point',0) }}"
                  min="0"
                  required
                  placeholder="0"
                  style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
                >
                @error('reorder_point')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-12">
              <hr style="border-color: #f1f3f5; margin: 1rem 0;">
            </div>

            {{-- Status --}}
            <div class="col-12">
              <label class="form-label small text-muted fw-semibold mb-3">
                Status
              </label>
              <div class="d-flex gap-3">
                <div class="form-check p-0">
                  <input type="radio" name="is_active" value="1" id="status_active" 
                         class="btn-check" @checked(old('is_active',1)==1)>
                  <label class="btn btn-outline-success d-flex align-items-center gap-2 px-4 py-3" 
                         for="status_active" style="border-radius: 10px; border: 2px solid #e5e7eb; font-weight: 500;">
                    <i class="bi bi-check-circle-fill"></i> Active
                  </label>
                </div>
                <div class="form-check p-0">
                  <input type="radio" name="is_active" value="0" id="status_inactive" 
                         class="btn-check" @checked(old('is_active',1)==0)>
                  <label class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-3" 
                         for="status_inactive" style="border-radius: 10px; border: 2px solid #e5e7eb; font-weight: 500;">
                    <i class="bi bi-slash-circle"></i> Inactive
                  </label>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end gap-3 p-4">
          <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
            Cancel
          </a>
          <button class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
            <i class="bi bi-check-circle"></i> Create Product
          </button>
        </div>
      </div>
    </form>

  </div>

  <style>
    .form-control:focus,
    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
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
    
    .btn-check:checked + .btn-outline-success {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
      border-color: #10b981 !important;
    }
    
    .btn-check:checked + .btn-outline-secondary {
      background: #f3f4f6;
      color: #4b5563;
      border-color: #9ca3af !important;
    }
    
    .btn-outline-success:hover,
    .btn-outline-secondary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .card {
      transition: box-shadow 0.2s ease;
    }
    
    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
  </style>
</x-app-layout>