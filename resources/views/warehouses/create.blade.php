<x-app-layout>
  <div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Add Warehouse</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-building me-1"></i>Create a new storage location
        </p>
      </div>
      <a href="{{ route('warehouses.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
        <i class="bi bi-arrow-left"></i> Back to list
      </a>
    </div>

    {{-- Alert --}}
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

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold" style="color: #1a202c;">Warehouse Information</h5>
      </div>
      
      <div class="card-body p-4">
        <form method="POST" action="{{ route('warehouses.store') }}" class="row g-4">
          @csrf

          {{-- Code --}}
          <div class="col-md-4">
            <label class="form-label small text-muted fw-semibold mb-2">
              Code <span class="text-danger">*</span>
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-upc-scan"></i>
              </span>
              <input name="code"
                     class="form-control ps-5 @error('code') is-invalid @enderror"
                     value="{{ old('code') }}" 
                     required
                     placeholder="e.g., WH-NORTH"
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"/>
              @error('code')
                <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                  <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-text small text-muted mt-2">
              <i class="bi bi-info-circle me-1"></i>Short unique identifier
            </div>
          </div>

          {{-- Name --}}
          <div class="col-md-8">
            <label class="form-label small text-muted fw-semibold mb-2">
              Name <span class="text-danger">*</span>
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-building"></i>
              </span>
              <input name="name"
                     class="form-control ps-5 @error('name') is-invalid @enderror"
                     value="{{ old('name') }}" 
                     required
                     placeholder="e.g., Northern Distribution Center"
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"/>
              @error('name')
                <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                  <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          {{-- Location --}}
          <div class="col-md-8">
            <label class="form-label small text-muted fw-semibold mb-2">
              Location
            </label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-geo-alt"></i>
              </span>
              <input name="location"
                     class="form-control ps-5 @error('location') is-invalid @enderror"
                     value="{{ old('location') }}"
                     placeholder="City / Address / Notes"
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"/>
              @error('location')
                <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                  <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </div>
              @enderror
            </div>
          </div>

          {{-- Status --}}
          <div class="col-md-4">
            <label class="form-label small text-muted fw-semibold mb-2">
              Status
            </label>
            <div class="d-flex flex-column gap-2">
              <div class="form-check p-0">
                <input type="radio" name="is_active" value="1" id="status_active" 
                       class="btn-check" @checked(old('is_active', '1')=='1')>
                <label class="btn btn-outline-success d-flex align-items-center justify-content-center gap-2 w-100 py-3" 
                       for="status_active" style="border-radius: 10px; border: 2px solid #e5e7eb; font-weight: 500;">
                  <i class="bi bi-check-circle-fill"></i> Active
                </label>
              </div>
              <div class="form-check p-0">
                <input type="radio" name="is_active" value="0" id="status_inactive" 
                       class="btn-check" @checked(old('is_active')=='0')>
                <label class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2 w-100 py-3" 
                       for="status_inactive" style="border-radius: 10px; border: 2px solid #e5e7eb; font-weight: 500;">
                  <i class="bi bi-slash-circle"></i> Inactive
                </label>
              </div>
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          {{-- Actions --}}
          <div class="col-12 d-flex justify-content-end gap-3">
            <a href="{{ route('warehouses.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
              Cancel
            </a>
            <button class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
              <i class="bi bi-check-circle"></i> Create Warehouse
            </button>
          </div>
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
  </style>
</x-app-layout>