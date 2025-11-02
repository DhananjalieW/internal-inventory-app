<x-app-layout>
  <div class="container py-4">

    {{-- Flash --}}
    @if(session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(40, 167, 69, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #155724;">{{ session('success') }}</span>
        </div>
      </div>
    @endif

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Suppliers</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-truck me-1"></i>Manage supplier contacts and status
        </p>
      </div>
      <a class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" href="{{ route('suppliers.create') }}" style="border-radius: 10px; font-weight: 500;">
        <i class="bi bi-plus-circle"></i> New Supplier
      </a>
    </div>

    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-8 col-lg-6">
              <label class="form-label small text-muted fw-semibold mb-2">Search Suppliers</label>
              <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e5e7eb; border-right: none;">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input class="form-control border-start-0 ps-0" name="q" value="{{ $q ?? '' }}" 
                       placeholder="Search by name, email or phone..." 
                       style="border: 2px solid #e5e7eb; border-left: none; box-shadow: none;">
                @if($q ?? '')
                  <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;">
                    <i class="bi bi-x-lg"></i>
                  </a>
                @endif
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-outline-secondary px-4" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
                <i class="bi bi-funnel me-1"></i> Search
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Table card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="min-width:220px;">Name</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="min-width:220px;">Email</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="min-width:140px;">Phone</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width:120px;">Status</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end px-4" style="width:200px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($suppliers as $s)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 10px;">
                        <i class="bi bi-truck text-white"></i>
                      </div>
                      <span class="fw-bold" style="color: #1a202c;">{{ $s->name }}</span>
                    </div>
                  </td>
                  <td class="py-3">
                    @if($s->email)
                      <a href="mailto:{{ $s->email }}" class="text-decoration-none d-flex align-items-center gap-2" style="color: #3b82f6;">
                        <i class="bi bi-envelope"></i>
                        <span>{{ $s->email }}</span>
                      </a>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td class="py-3">
                    @if($s->phone)
                      <div class="d-flex align-items-center gap-2 text-muted">
                        <i class="bi bi-telephone"></i>
                        <span>{{ $s->phone }}</span>
                      </div>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td class="py-3">
                    @if($s->is_active)
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #d1fae5; color: #065f46; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-check-circle-fill"></i> Active
                      </span>
                    @else
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #e5e7eb; color: #4b5563; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-slash-circle"></i> Inactive
                      </span>
                    @endif
                  </td>
                  <td class="py-3 text-end px-4">
                    <div class="btn-group" role="group">
                      <a class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-3" 
                         href="{{ route('suppliers.edit',$s) }}"
                         style="border-radius: 8px 0 0 8px; font-weight: 500; border: 2px solid #3b82f6;">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <form method="POST" action="{{ route('suppliers.destroy',$s) }}" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-3"
                                style="border-radius: 0 8px 8px 0; font-weight: 500; border: 2px solid #ef4444; border-left: 1px solid #ef4444;">
                          <i class="bi bi-trash"></i> Delete
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-truck text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No suppliers found</h5>
                      <p class="text-muted mb-3">Get started by adding your first supplier</p>
                      <a href="{{ route('suppliers.create') }}" class="btn btn-brand px-4" style="border-radius: 10px;">
                        <i class="bi bi-plus-circle me-1"></i> Add Supplier
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- Pagination --}}
      @if($suppliers->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
          <div class="d-flex justify-content-end">
            {{ $suppliers->links() }}
          </div>
        </div>
      @endif
    </div>

  </div>

  <style>
    .card:hover {
      box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover {
      transform: translateY(-1px);
    }
    
    .table tbody tr {
      transition: background-color 0.15s ease;
    }
    
    .table tbody tr:hover {
      background-color: #f8f9fa;
    }
    
    .btn-group .btn:hover {
      z-index: 2;
    }
    
    .input-group:focus-within {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
      border-radius: 10px;
    }
    
    .form-control:focus {
      box-shadow: none !important;
    }

    a[href^="mailto:"]:hover {
      text-decoration: underline !important;
    }
  </style>
</x-app-layout>