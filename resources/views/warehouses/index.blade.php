<x-app-layout>
  <div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Warehouses</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-building me-1"></i>Manage locations and availability
        </p>
      </div>
      @if(!($isViewer ?? false))
        <a href="{{ route('warehouses.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500;">
          <i class="bi bi-plus-circle"></i> Add Warehouse
        </a>
      @else
        <span class="badge px-3 py-2" style="background: #e0e7ff; color: #4338ca; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
          <i class="bi bi-shield-lock me-1"></i>Read-Only Access
        </span>
      @endif
    </div>

    {{-- Alerts --}}
    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fee 0%, #ffebee 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
          </div>
          <div class="flex-grow-1">
            <div class="fw-medium mb-1" style="color: #7f1d1d;">Please fix the following errors:</div>
            <ul class="mb-0 small" style="color: #991b1b;">
              @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endif

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

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width: 140px;">Code</th>
                <th class="border-0 text-muted small fw-semibold py-3">Name</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 240px;">Location</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-center" style="width: 120px;">Status</th>
                
                {{-- Hide Actions column for Viewers --}}
                @if(!($isViewer ?? false))
                  <th class="border-0 text-muted small fw-semibold py-3 text-end px-4" style="width: 160px;">Actions</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $w)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 32px; height: 32px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                        <i class="bi bi-building text-white" style="font-size: 0.75rem;"></i>
                      </div>
                      <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                        {{ $w->code }}
                      </span>
                    </div>
                  </td>
                  <td class="py-3">
                    <span class="fw-medium" style="color: #1a202c;">{{ $w->name }}</span>
                  </td>
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2 text-muted">
                      <i class="bi bi-geo-alt"></i>
                      <span>{{ $w->location ?: '—' }}</span>
                    </div>
                  </td>
                  <td class="py-3 text-center">
                    @if($w->is_active)
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
                  
                  {{-- Hide Actions for Viewers --}}
                  @if(!($isViewer ?? false))
                    <td class="py-3 text-end px-4">
                      <div class="btn-group" role="group">
                        <a href="{{ route('warehouses.edit',$w) }}" 
                           class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-3" 
                           style="border-radius: 8px 0 0 8px; font-weight: 500; border: 2px solid #3b82f6;">
                          <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('warehouses.destroy',$w) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete {{ $w->name }}?');">
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
                  <td colspan="{{ ($isViewer ?? false) ? '4' : '5' }}" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-building text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No warehouses found</h5>
                      <p class="text-muted mb-0">Get started by adding your first warehouse</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($rows->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
          {{ $rows->links() }}
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
  </style>
</x-app-layout>