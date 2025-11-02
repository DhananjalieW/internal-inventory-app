<x-app-layout>
  <div class="container py-4">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Stock by Warehouse</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-grid-3x3-gap me-1"></i>View inventory levels across all locations
        </p>
      </div>
    </div>

    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-8 col-lg-6">
              <label class="form-label small text-muted fw-semibold mb-2">Search Products</label>
              <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e5e7eb; border-right: none;">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input class="form-control border-start-0 ps-0" name="q" value="{{ $q }}" 
                       placeholder="Search by SKU or name..." 
                       style="border: 2px solid #e5e7eb; border-left: none; box-shadow: none;">
                @if($q)
                  <a href="{{ route('reports.stock') }}" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;">
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

    <div class="row g-4">
      {{-- Main Products Table --}}
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Products</h5>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8f9fa;">
                  <tr>
                    <th class="border-0 text-muted small fw-semibold py-3 px-4">SKU</th>
                    <th class="border-0 text-muted small fw-semibold py-3">Name</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end">On hand</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end px-4">Reorder</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($rows as $r)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                      <td class="px-4 py-3">
                        <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace;">{{ $r->sku }}</span>
                      </td>
                      <td class="py-3">
                        <div class="fw-medium text-truncate" style="max-width:360px; color: #1a202c;">{{ $r->name }}</div>
                      </td>
                      <td class="py-3 text-end">
                        <span class="badge px-3 py-2" style="background: #e8f5e9; color: #2e7d32; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                          {{ number_format($r->on_hand) }}
                        </span>
                      </td>
                      <td class="py-3 text-end px-4">
                        <span class="fw-semibold" style="color: #6b7280;">{{ number_format($r->reorder_point) }}</span>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                          <div class="d-flex align-items-center justify-content-center mb-3" 
                               style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                            <i class="bi bi-inbox text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                          </div>
                          <h5 class="fw-semibold mb-2" style="color: #6b7280;">No results found</h5>
                          <p class="text-muted mb-0">Try adjusting your search criteria</p>
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
              {{ $rows->withQueryString()->links() }}
            </div>
          @endif
        </div>
      </div>

      {{-- Warehouse Totals Sidebar --}}
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Totals by warehouse</h5>
          </div>
          <div class="card-body p-0 pb-3">
            <table class="table align-middle mb-0">
              @forelse($stockByWh as $wh)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                        <i class="bi bi-building text-white small"></i>
                      </div>
                      <span class="fw-semibold" style="color: #1a202c;">{{ $wh->code }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">
                      {{ number_format($wh->qty) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-4">
                    <div class="d-flex flex-column align-items-center justify-content-center py-3">
                      <div class="d-flex align-items-center justify-content-center mb-2" 
                           style="width: 48px; height: 48px; background: #f3f4f6; border-radius: 12px;">
                        <i class="bi bi-inbox text-muted" style="font-size: 1.5rem; opacity: 0.5;"></i>
                      </div>
                      <p class="text-muted small mb-0">No stock yet.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </table>
          </div>
        </div>

        {{-- Quick Stats Card --}}
        <div class="card border-0 shadow-sm mt-4" style="border-radius: 12px;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px;">
                <i class="bi bi-graph-up text-white"></i>
              </div>
              <div>
                <div class="small text-muted fw-semibold">Total Stock</div>
                <div class="h4 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($stockByWh->sum('qty')) }}</div>
              </div>
            </div>
            <div class="d-flex align-items-center gap-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px;">
                <i class="bi bi-box-seam text-white"></i>
              </div>
              <div>
                <div class="small text-muted fw-semibold">Products</div>
                <div class="h4 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($rows->total()) }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
    
    .input-group:focus-within {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
      border-radius: 10px;
    }
    
    .form-control:focus {
      box-shadow: none !important;
    }
  </style>
</x-app-layout>