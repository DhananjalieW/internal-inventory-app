<x-app-layout>
  <div class="container py-4">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Stock Movements</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-clock-history me-1"></i>Track all inventory transactions and changes
        </p>
      </div>
    </div>

    {{-- Filters Card --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold" style="color: #1a202c;">Filters</h5>
      </div>
      <div class="card-body p-4">
        <form method="GET" class="row g-4 align-items-end">
          
          {{-- Search --}}
          <div class="col-md-4">
            <label class="form-label small text-muted fw-semibold mb-2">Search</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-search"></i>
              </span>
              <input class="form-control ps-5" name="q" value="{{ $q }}" 
                     placeholder="SKU, name, warehouse, reference..."
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
            </div>
          </div>

          {{-- Type --}}
          <div class="col-md-3">
            <label class="form-label small text-muted fw-semibold mb-2">Type</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-filter"></i>
              </span>
              <select name="type" class="form-select ps-5" 
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="">All Types</option>
                <option value="IN" @selected($type==='IN')>IN (Incoming)</option>
                <option value="OUT" @selected($type==='OUT')>OUT (Outgoing)</option>
                <option value="ADJUST" @selected($type==='ADJUST')>ADJUST (Adjustment)</option>
              </select>
            </div>
          </div>

          {{-- Range --}}
          <div class="col-md-3">
            <label class="form-label small text-muted fw-semibold mb-2">Date Range</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-calendar-range"></i>
              </span>
              <select name="range" class="form-select ps-5" 
                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                <option value="7d" @selected($range==='7d')>Last 7 days</option>
                <option value="30d" @selected($range==='30d')>Last 30 days</option>
                <option value="90d" @selected($range==='90d')>Last 90 days</option>
              </select>
            </div>
          </div>

          {{-- Apply Button --}}
          <div class="col-md-2 d-grid">
            <button class="btn btn-brand d-flex align-items-center justify-content-center gap-2 py-3" 
                    style="border-radius: 10px; font-weight: 500;">
              <i class="bi bi-funnel"></i> Apply
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Results Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">Results</h5>
          @if($rows->total() > 0)
            <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 600;">
              {{ number_format($rows->total()) }} movements
            </span>
          @endif
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4">When</th>
                <th class="border-0 text-muted small fw-semibold py-3">Type</th>
                <th class="border-0 text-muted small fw-semibold py-3">Product</th>
                <th class="border-0 text-muted small fw-semibold py-3">Warehouse</th>
                <th class="border-0 text-muted small fw-semibold py-3">Reference</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end px-4">Quantity</th>
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $r)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  {{-- When --}}
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2 text-muted small">
                      <i class="bi bi-clock"></i>
                      <span class="text-nowrap">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('Y-m-d H:i') }}</span>
                    </div>
                  </td>

                  {{-- Type --}}
                  <td class="py-3">
                    @if($r->type === 'IN')
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #d1fae5; color: #065f46; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-arrow-down-circle-fill"></i> IN
                      </span>
                    @elseif($r->type === 'OUT')
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #fee; color: #7f1d1d; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-arrow-up-circle-fill"></i> OUT
                      </span>
                    @else
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #e3f2fd; color: #1565c0; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-sliders"></i> ADJUST
                      </span>
                    @endif
                  </td>

                  {{-- Product --}}
                  <td class="py-3">
                    <div class="text-nowrap">
                      <div class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $r->sku }}</div>
                      <div class="small text-muted text-truncate" style="max-width: 340px" title="{{ $r->product_name }}">{{ $r->product_name }}</div>
                    </div>
                  </td>

                  {{-- Warehouse --}}
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 28px; height: 28px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 6px;">
                        <i class="bi bi-building text-white" style="font-size: 0.7rem;"></i>
                      </div>
                      <span class="fw-medium text-nowrap" style="color: #1a202c;">{{ $r->wh_code }}</span>
                    </div>
                  </td>

                  {{-- Reference --}}
                  <td class="py-3">
                    <div class="text-muted small text-truncate" style="max-width: 240px;" title="{{ $r->reference }}">
                      {{ $r->reference }}
                    </div>
                  </td>

                  {{-- Quantity --}}
                  <td class="py-3 text-end px-4">
                    <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700; font-size: 0.9rem; font-variant-numeric: tabular-nums;">
                      {{ number_format($r->qty) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-inbox text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No movements found</h5>
                      <p class="text-muted mb-0">No movements in this period. Try adjusting your filters.</p>
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

    .form-control:focus,
    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
  </style>
</x-app-layout>