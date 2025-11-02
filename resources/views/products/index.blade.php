<x-app-layout>
  <div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Products</h1>
        @isset($products)
          <p class="text-muted mb-0" style="font-size: 0.95rem;">
            <i class="bi bi-box-seam me-1"></i>{{ number_format($products->total()) }} total products
          </p>
        @endisset
      </div>
      
      {{-- Hide "New Product" button for Viewers --}}
      @if(!($isViewer ?? false))
        <a href="{{ route('products.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500;">
          <i class="bi bi-plus-circle"></i> New Product
        </a>
      @else
        <span class="badge px-3 py-2" style="background: #e0e7ff; color: #4338ca; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
          <i class="bi bi-shield-lock me-1"></i>Read-Only Access
        </span>
      @endif
    </div>

    {{-- Flash --}}
    @if (session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(46, 125, 50, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <div class="flex-grow-1">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-10">
              <label class="form-label small text-muted fw-semibold mb-2">Search Products</label>
              <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e5e7eb; border-right: none;">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input class="form-control border-start-0 ps-0" name="q" value="{{ $q }}" 
                       placeholder="Search by SKU or product name..." 
                       style="border: 2px solid #e5e7eb; border-left: none; box-shadow: none;">
                @if($q)
                  <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;">
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

    {{-- Table --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width: 140px;">SKU</th>
                <th class="border-0 text-muted small fw-semibold py-3">Name</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 140px;">Category</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-center" style="width: 100px;">UOM</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width: 120px;">Reorder Pt.</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-center" style="width: 100px;">Status</th>
                
                {{-- Hide Actions column for Viewers --}}
                @if(!($isViewer ?? false))
                  <th class="border-0 text-muted small fw-semibold py-3 text-end px-4" style="width: 140px;">Actions</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @forelse($products as $p)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  <td class="px-4 py-3">
                    <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                      {{ $p->sku }}
                    </span>
                  </td>
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 420px;">
                      <span class="fw-medium" style="color: #1a202c;">{{ $p->name }}</span>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="text-muted small">{{ $p->category ?: '—' }}</span>
                  </td>
                  <td class="py-3 text-center">
                    <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 600;">
                      {{ $p->uom ?: '—' }}
                    </span>
                  </td>
                  <td class="py-3 text-end">
                    <span class="fw-semibold" style="color: #6b7280;">{{ number_format($p->reorder_point) }}</span>
                  </td>
                  <td class="py-3 text-center">
                    @if($p->is_active)
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" style="background: #d1fae5; color: #065f46; border-radius: 8px; font-weight: 600;">
                        <i class="bi bi-check-circle-fill"></i> Active
                      </span>
                    @else
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" style="background: #fee; color: #7f1d1d; border-radius: 8px; font-weight: 600;">
                        <i class="bi bi-x-circle-fill"></i> Inactive
                      </span>
                    @endif
                  </td>
                  
                  {{-- Hide Actions for Viewers --}}
                  @if(!($isViewer ?? false))
                    <td class="py-3 text-end px-4">
                      <div class="btn-group" role="group">
                        <a href="{{ route('products.edit',$p) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-3" style="border-radius: 8px 0 0 8px; font-weight: 500; border: 2px solid #3b82f6; border-right: 1px solid #3b82f6;">
                          <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('products.destroy',$p) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete {{ $p->name }}?');">
                          @csrf @method('DELETE')
                          <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-3"
                                  style="border-radius: 0 8px 8px 0; font-weight: 500; border: 2px solid #ef4444; border-left: 1px solid #ef4444;">
                            <i class="bi bi-trash"></i> Delete
                          </button>
                        </form>
                      </div>
                    </td>
                  @endif
                </tr>
              @empty
                <tr>
                  <td colspan="{{ ($isViewer ?? false) ? '6' : '7' }}" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-box-seam text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No products found</h5>
                      <p class="text-muted mb-0">{{ $q ? 'Try adjusting your search criteria' : 'Get started by creating your first product' }}</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Pagination --}}
    @if($products->count())
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 gap-3">
        <div class="text-muted small">
          Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ number_format($products->total()) }} products
        </div>
        {{ $products->withQueryString()->links() }}
      </div>
    @endif

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
  </style>
</x-app-layout>