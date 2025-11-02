{{-- resources/views/dash/manager.blade.php --}}
<x-app-layout>
  <div class="container py-4">

    {{-- Heads-up for low stock --}}
    @if(($lowStockCount ?? 0) > 0)
      <div class="alert alert-warning border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fff3cd 0%, #fff8e1 100%); border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255, 193, 7, 0.2); border-radius: 10px;">
              <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
            </div>
            <span class="fw-medium">
              <strong>{{ number_format($lowStockCount) }}</strong> items are below reorder level
            </span>
          </div>
          <a class="btn btn-warning px-4" href="{{ route('reorder.index') }}" style="border-radius: 8px; font-weight: 500;">View Report</a>
        </div>
      </div>
    @endif

    {{-- Page title + quick actions --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Inventory Manager Dashboard</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-speedometer2 me-1"></i>Overview and quick actions
        </p>
      </div>

      <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">
        <a href="{{ route('movements.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500;">
          <i class="bi bi-plus-circle"></i> Record Movement
        </a>
        <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500; border: 2px solid #e5e7eb;">
          <i class="bi bi-receipt"></i> Open POs
        </a>
        <a href="{{ route('products.create') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500; border: 2px solid #e5e7eb;">
          <i class="bi bi-box-seam"></i> New Product
        </a>
        <a href="{{ route('reorder.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500; border: 2px solid #e5e7eb;">
          <i class="bi bi-exclamation-triangle"></i> Reorder
        </a>

        {{-- Send the low-stock email immediately --}}
        <form method="POST" action="{{ route('reports.email.lowstock') }}" class="mb-0">
          @csrf
          <button class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500; border: 2px solid #e5e7eb;">
            <i class="bi bi-envelope"></i> Email Low Stock
          </button>
        </form>
      </div>
    </div>

    {{-- Movement summary pills --}}
    <div class="d-flex align-items-center gap-3 flex-wrap mb-4 p-3" style="background: #f8f9fa; border-radius: 12px;">
      <span class="badge d-flex align-items-center gap-2 px-3 py-2" style="background: #e8f5e9; color: #2e7d32; font-weight: 500; font-size: 0.9rem; border-radius: 8px;">
        <i class="bi bi-arrow-down-circle"></i>IN: {{ number_format($mvSummary['IN'] ?? 0) }}
      </span>
      <span class="badge d-flex align-items-center gap-2 px-3 py-2" style="background: #ffebee; color: #c62828; font-weight: 500; font-size: 0.9rem; border-radius: 8px;">
        <i class="bi bi-arrow-up-circle"></i>OUT: {{ number_format($mvSummary['OUT'] ?? 0) }}
      </span>
      <span class="badge d-flex align-items-center gap-2 px-3 py-2" style="background: #e3f2fd; color: #1565c0; font-weight: 500; font-size: 0.9rem; border-radius: 8px;">
        <i class="bi bi-sliders"></i>ADJUST: {{ number_format($mvSummary['ADJUST'] ?? 0) }}
      </span>
    </div>

    {{-- KPI Cards --}}
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px;">
                <i class="bi bi-receipt text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Open Purchase Orders</div>
            <div class="h2 mb-2 fw-bold" style="color: #1a202c;">{{ number_format($openPoCount) }}</div>
            <div class="small text-muted mb-2">Due soon: <span class="fw-semibold">{{ number_format($openPoDueSoon) }}</span></div>
            <a href="{{ route('pos.index') }}" class="small text-decoration-none fw-medium">View all POs <i class="bi bi-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); border-radius: 12px;">
                <i class="bi bi-exclamation-triangle text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Low Stock Items</div>
            <div class="h2 mb-2 fw-bold" style="color: #1a202c;">{{ number_format($lowStockCount) }}</div>
            <a href="{{ route('reorder.index') }}" class="small text-decoration-none fw-medium">Open reorder report <i class="bi bi-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px;">
                <i class="bi bi-download text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-3" style="font-weight: 500;">Quick Export</div>
            <div class="d-flex gap-2">
              <a href="{{ route('reports.export','stock') }}" class="btn btn-sm btn-outline-secondary flex-fill d-flex align-items-center justify-content-center gap-1" style="border-radius: 8px; font-weight: 500;">
                <i class="bi bi-filetype-csv"></i> CSV
              </a>
              <a href="{{ route('reports.export.pdf','stock') }}" class="btn btn-sm btn-outline-secondary flex-fill d-flex align-items-center justify-content-center gap-1" style="border-radius: 8px; font-weight: 500;">
                <i class="bi bi-filetype-pdf"></i> PDF
              </a>
            </div>
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
            <a class="small text-decoration-none fw-medium" href="{{ route('reorder.index') }}">Open full report <i class="bi bi-arrow-right ms-1"></i></a>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8f9fa; position: sticky; top: 0; z-index: 10;">
                  <tr>
                    <th class="border-0 text-muted small fw-semibold py-3 px-4">SKU</th>
                    <th class="border-0 text-muted small fw-semibold py-3">Name</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end">On hand</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end">Reorder</th>
                    <th class="border-0 text-muted small fw-semibold py-3 text-end px-4"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($lowStock as $r)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                      <td class="px-4 py-3">
                        <a href="{{ route('products.edit',$r->product_id) }}" class="fw-bold text-decoration-none" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                          {{ $r->sku }}
                        </a>
                      </td>
                      <td class="py-3">
                        <span class="fw-medium" style="color: #1a202c;">{{ $r->name }}</span>
                      </td>
                      <td class="py-3 text-end">
                        <span class="badge px-3 py-2" style="background: #ffebee; color: #c62828; border-radius: 8px; font-weight: 700;">
                         {{ number_format($r->qty_on_hand ?? 0) }}

                        </span>
                      </td>
                      <td class="py-3 text-end">
                        <span class="fw-semibold" style="color: #6b7280;">{{ number_format($r->reorder_point) }}</span>
                      </td>
                      <td class="py-3 text-end px-4">
                        <a class="btn btn-sm btn-brand d-inline-flex align-items-center gap-1 px-3" style="border-radius: 8px; font-weight: 500;"
                           href="{{ route('movements.create', [
                             'product_id' => $r->product_id,
                             'type'       => 'IN',
                             'reference'  => 'REPLEN',
                             'return'     => url()->current(),
                           ]) }}">
                          <i class="bi bi-plus-circle"></i> Record
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center py-4">
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
          <div class="card-header bg-white border-0 d-flex justify-content-between pt-4 px-4">
            <h5 class="mb-0 fw-bold" style="color: #1a202c;">Stock by warehouse</h5>
            <a class="small text-decoration-none fw-medium" href="{{ route('reports.stock') }}">Open report <i class="bi bi-arrow-right ms-1"></i></a>
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
            <table class="table table-hover align-middle mb-0">
              <thead style="background: #f8f9fa; position: sticky; top: 0; z-index: 10;">
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
                              style="background: #d1fae5; color: #065f46; border-radius: 6px; font-weight: 500; font-size: 0.75rem;">
                          <i class="bi bi-arrow-down-circle-fill"></i> IN
                        </span>
                      @elseif($mv->type === 'OUT')
                        <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" 
                              style="background: #fee; color: #7f1d1d; border-radius: 6px; font-weight: 500; font-size: 0.75rem;">
                          <i class="bi bi-arrow-up-circle-fill"></i> OUT
                        </span>
                      @else
                        <span class="badge d-inline-flex align-items-center gap-1 px-2 py-1" 
                              style="background: #e3f2fd; color: #1565c0; border-radius: 6px; font-weight: 500; font-size: 0.75rem;">
                          <i class="bi bi-sliders"></i> ADJ
                        </span>
                      @endif
                    </td>
                    <td class="py-3">
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

  <style>
    .card:hover {
      transform: translateY(-2px);
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
  </style>
</x-app-layout>