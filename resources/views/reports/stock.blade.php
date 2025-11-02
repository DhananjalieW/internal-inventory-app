<x-app-layout>
  <div class="container py-4">

    {{-- Header + actions --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Stock by Product &amp; Warehouse</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-grid-3x3-gap me-1"></i>Detailed inventory breakdown by location
        </p>
      </div>
      <a class="btn btn-brand d-flex align-items-center gap-2 px-4 mt-3 mt-md-0" 
         href="{{ route('reports.export','stock') }}"
         style="border-radius: 10px; font-weight: 500;">
        <i class="bi bi-download"></i> Export CSV
      </a>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width: 160px;">Warehouse</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 140px;">SKU</th>
                <th class="border-0 text-muted small fw-semibold py-3">Name</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width: 120px;">On hand</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width: 120px;">Allocated</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end px-4" style="width: 120px;">On order</th>
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $r)
                @php
                  $neg    = (int)$r->on_hand < 0;
                  $alloc  = (int)$r->allocated > 0;
                  $onord  = (int)$r->on_order > 0;
                @endphp
                <tr style="border-bottom: 1px solid #f1f3f5; {{ $neg ? 'background: #fee2e2;' : '' }}">
                  {{-- Warehouse --}}
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 32px; height: 32px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                        <i class="bi bi-building text-white" style="font-size: 0.75rem;"></i>
                      </div>
                      <span class="fw-semibold text-nowrap" style="color: #1a202c;">{{ $r->wh_code }}</span>
                    </div>
                  </td>

                  {{-- SKU --}}
                  <td class="py-3">
                    <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                      {{ $r->sku }}
                    </span>
                  </td>

                  {{-- Name --}}
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 420px;">
                      <span class="fw-medium" style="color: #1a202c;">{{ $r->product_name }}</span>
                    </div>
                  </td>

                  {{-- On hand --}}
                  <td class="py-3 text-end">
                    @if($neg)
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #fee; color: #7f1d1d; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ number_format($r->on_hand) }}
                      </span>
                    @else
                      <span class="badge px-3 py-2" 
                            style="background: #e8f5e9; color: #2e7d32; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                        {{ number_format($r->on_hand) }}
                      </span>
                    @endif
                  </td>

                  {{-- Allocated --}}
                  <td class="py-3 text-end">
                    @if($alloc)
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #fef3c7; color: #92400e; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                        <i class="bi bi-lock-fill"></i> {{ number_format($r->allocated) }}
                      </span>
                    @else
                      <span class="text-muted">{{ number_format($r->allocated) }}</span>
                    @endif
                  </td>

                  {{-- On order --}}
                  <td class="py-3 text-end px-4">
                    @if($onord)
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #dbeafe; color: #1e40af; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                        <i class="bi bi-truck"></i> {{ number_format($r->on_order) }}
                      </span>
                    @else
                      <span class="text-muted">{{ number_format($r->on_order) }}</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-box-seam text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No stock records found</h5>
                      <p class="text-muted mb-0">No stock data available at this time.</p>
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

    {{-- Legend Card --}}
    <div class="card border-0 shadow-sm mt-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <h6 class="fw-bold mb-3" style="color: #1a202c;">
          <i class="bi bi-info-circle me-2"></i>Legend
        </h6>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-2">
              <span class="badge px-3 py-2" style="background: #e8f5e9; color: #2e7d32; border-radius: 8px; font-weight: 700;">
                150
              </span>
              <span class="small text-muted">On hand (in stock)</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-2">
              <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" style="background: #fef3c7; color: #92400e; border-radius: 8px; font-weight: 700;">
                <i class="bi bi-lock-fill"></i> 25
              </span>
              <span class="small text-muted">Allocated (reserved)</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex align-items-center gap-2">
              <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" style="background: #dbeafe; color: #1e40af; border-radius: 8px; font-weight: 700;">
                <i class="bi bi-truck"></i> 50
              </span>
              <span class="small text-muted">On order (incoming)</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="d-flex align-items-center gap-2 pt-2" style="border-top: 1px solid #f1f3f5;">
              <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" style="background: #fee; color: #7f1d1d; border-radius: 8px; font-weight: 700;">
                <i class="bi bi-exclamation-triangle-fill"></i> -10
              </span>
              <span class="small text-muted">Negative stock (oversold or adjustment error)</span>
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
    
    .table tbody tr:hover:not([style*="background: #fee2e2"]) {
      background-color: #f8f9fa;
    }
  </style>
</x-app-layout>