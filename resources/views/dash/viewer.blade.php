<x-app-layout>
  <div class="container py-4">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Viewer Dashboard</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-eye me-1"></i>Read-only view of stock &amp; reports
        </p>
      </div>
      <span class="badge px-3 py-2" style="background: #e0e7ff; color: #4338ca; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
        <i class="bi bi-shield-lock me-1"></i>Read-Only Access
      </span>
    </div>

    {{-- Top stats --}}
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px;">
                <i class="bi bi-box-seam text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Total Products</div>
            <div class="h2 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($productsCount) }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px;">
                <i class="bi bi-building text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Warehouses</div>
            <div class="h2 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($warehousesCount) }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); border-radius: 12px;">
                <i class="bi bi-exclamation-triangle text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Low Stock Items</div>
            <div class="h2 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($lowStockCount) }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4">
      {{-- Low Stock Table --}}
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Low Stock (Top 10)</h5>
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
                  @forelse($lowStock as $r)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                      <td class="px-4 py-3">
                        <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $r->sku }}</span>
                      </td>
                      <td class="py-3">
                        <div class="text-truncate" style="max-width:320px;">
                          <span class="fw-medium" style="color: #1a202c;">{{ $r->name }}</span>
                        </div>
                      </td>
                      <td class="py-3 text-end">
                        <span class="badge px-3 py-2" style="background: #ffebee; color: #c62828; border-radius: 8px; font-weight: 700;">
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
                        <div class="d-flex flex-column align-items-center justify-content-center py-3">
                          <div class="d-flex align-items-center justify-content-center mb-2" 
                               style="width: 48px; height: 48px; background: #f3f4f6; border-radius: 12px;">
                            <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                          </div>
                          <p class="text-muted small mb-0">No items below reorder level</p>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Right Column --}}
      <div class="col-lg-5 d-flex flex-column gap-4">
        {{-- Stock by Warehouse --}}
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Stock by warehouse</h5>
          </div>
          <div class="card-body p-0 pb-3">
            <table class="table align-middle mb-0">
              @forelse($stockByWh as $wh)
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                        <i class="bi bi-building text-white small"></i>
                      </div>
                      <span class="fw-semibold" style="color: #1a202c;">{{ $wh->code }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700;">
                      {{ number_format($wh->qty) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-3 px-3">
                    <p class="text-muted small mb-0">No stock yet.</p>
                  </td>
                </tr>
              @endforelse
            </table>
          </div>
        </div>

        {{-- Recent Movements --}}
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Recent movements</h5>
          </div>
          <div class="card-body p-0 pb-3">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8f9fa;">
                  <tr>
                    <th class="border-0 text-muted small fw-semibold py-3 px-4">When</th>
                    <th class="border-0 text-muted small fw-semibold py-3">Type</th>
                    <th class="border-0 text-muted small fw-semibold py-3">Product</th>
                    <th class="border-0 text-muted small fw-semibold py-3">WH</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end px-4">Qty</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentMovements as $mv)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                      <td class="px-4 py-3">
                        <div class="d-flex align-items-center gap-2 text-muted small">
                          <i class="bi bi-clock"></i>
                          <span class="text-nowrap">{{ $mv->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                      </td>
                      <td class="py-3">
                        @if($mv->type === 'IN')
                          <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" 
                                style="background: #d1fae5; color: #065f46; font-weight: 500; font-size: 0.75rem; border-radius: 6px;">
                            <i class="bi bi-arrow-down-circle-fill"></i> IN
                          </span>
                        @elseif($mv->type === 'OUT')
                          <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" 
                                style="background: #fee; color: #7f1d1d; font-weight: 500; font-size: 0.75rem; border-radius: 6px;">
                            <i class="bi bi-arrow-up-circle-fill"></i> OUT
                          </span>
                        @else
                          <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" 
                                style="background: #e3f2fd; color: #1565c0; font-weight: 500; font-size: 0.75rem; border-radius: 6px;">
                            <i class="bi bi-sliders"></i> ADJ
                          </span>
                        @endif
                      </td>
                      <td class="py-3" title="{{ $mv->product_name }}">
                        <span class="fw-semibold small" style="color: #1a202c; font-family: 'Courier New', monospace;">{{ $mv->sku }}</span>
                      </td>
                      <td class="py-3">
                        <span class="small text-muted">{{ $mv->code }}</span>
                      </td>
                      <td class="py-3 text-end px-4">
                        <span class="fw-bold small" style="color: #1a202c;">{{ number_format($mv->qty) }}</span>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center py-3 px-3">
                        <p class="text-muted small mb-0">No movements yet.</p>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <style>
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
    }
    
    .table tbody tr {
      transition: background-color 0.15s ease;
    }
    
    .table tbody tr:hover {
      background-color: #f8f9fa;
    }
  </style>
</x-app-layout>