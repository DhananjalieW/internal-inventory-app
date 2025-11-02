{{-- resources/views/dash/clerk.blade.php --}}
<x-app-layout>
  <div class="container py-4">
    
    {{-- Header + quick actions --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Clerk Dashboard</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-speedometer2 me-1"></i>Quick access to daily tasks
        </p>
      </div>
      <div class="d-flex gap-2 mt-3 mt-md-0">
        <a href="{{ route('movements.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500;">
          <i class="bi bi-plus-circle"></i> Record Movement
        </a>
        <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500; border: 2px solid #e5e7eb;">
          <i class="bi bi-receipt"></i> Open POs
        </a>
      </div>
    </div>

    {{-- Top stat card --}}
    <div class="row g-3 mb-4">
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.2s;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px;">
                <i class="bi bi-receipt text-white fs-5"></i>
              </div>
            </div>
            <div class="text-muted small mb-1" style="font-weight: 500;">Open Purchase Orders</div>
            <div class="d-flex align-items-end justify-content-between mt-2">
              <div class="h2 mb-0 fw-bold" style="color: #1a202c;">{{ number_format($openPoCount ?? 0) }}</div>
              <span class="badge d-flex align-items-center gap-1 px-3 py-2" style="background: #e9f1ff; color: #1a3e73; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                <i class="bi bi-calendar2-week"></i> Due soon: {{ number_format($openPoDueSoon ?? 0) }}
              </span>
            </div>
            <div class="mt-3">
              <a href="{{ route('pos.index') }}" class="small text-decoration-none fw-medium">View all POs <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Items to receive - Full width --}}
    <div class="mb-4">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">Items to receive</h5>
          <a class="small text-decoration-none fw-medium" href="{{ route('pos.index') }}">Open POs <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead style="background: #f8f9fa;">
                <tr>
                  <th class="border-0 text-muted small fw-semibold py-3 px-4">PO #</th>
                  <th class="border-0 text-muted small fw-semibold py-3">Product</th>
                  <th class="border-0 text-muted small fw-semibold py-3">Warehouse</th>
                  <th class="border-0 text-muted small fw-semibold py-3 text-end">Remaining</th>
                  <th class="border-0 text-muted small fw-semibold py-3 text-end">Expected</th>
                  <th class="border-0 text-muted small fw-semibold py-3 text-end px-4"></th>
                </tr>
              </thead>
              <tbody>
                @forelse($toReceive as $r)
                  <tr style="border-bottom: 1px solid #f1f3f5;">
                    <td class="px-4 py-3">
                      <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $r->po_number }}</span>
                    </td>
                    <td class="py-3">
                      <div>
                        <div class="fw-semibold" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $r->sku }}</div>
                        <div class="text-muted small text-truncate" style="max-width: 400px;">{{ $r->product_name }}</div>
                      </div>
                    </td>
                    <td class="py-3">
                      <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 32px; height: 32px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                          <i class="bi bi-building text-white" style="font-size: 0.75rem;"></i>
                        </div>
                        <span class="fw-medium" style="color: #1a202c;">{{ $r->wh_code }}</span>
                      </div>
                    </td>
                    <td class="py-3 text-end">
                      <span class="badge px-3 py-2" style="background: #fef3c7; color: #92400e; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">
                        {{ number_format($r->remaining) }} units
                      </span>
                    </td>
                    <td class="py-3 text-end">
                      @if($r->expected_date)
                        <div class="d-flex align-items-center justify-content-end gap-2 text-muted small">
                          <i class="bi bi-calendar-check"></i>
                          <span>{{ $r->expected_date }}</span>
                        </div>
                      @else
                        <span class="text-muted">—</span>
                      @endif
                    </td>
                    <td class="py-3 text-end px-4">
                      <a class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 px-4 py-2" 
                         href="{{ route('pos.item.receive.form', $r->id) }}"
                         style="border-radius: 8px; font-weight: 500;">
                        <i class="bi bi-box-arrow-in-down"></i> Receive
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-5">
                      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                        <div class="d-flex align-items-center justify-content-center mb-3" 
                             style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                          <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: #6b7280;">All caught up!</h5>
                        <p class="text-muted mb-0">Nothing to receive right now.</p>
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

    {{-- My recent movements - Full width --}}
    <div>
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">My recent movements</h5>
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
                  <th class="border-0 text-muted small fw-semibold py-3 text-end px-4">Quantity</th>
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
                        <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                              style="background: #d1fae5; color: #065f46; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                          <i class="bi bi-arrow-down-circle-fill"></i> IN
                        </span>
                      @elseif($mv->type === 'OUT')
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
                    <td class="py-3">
                      <span class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $mv->sku }}</span>
                    </td>
                    <td class="py-3">
                      <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 28px; height: 28px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 6px;">
                          <i class="bi bi-building text-white" style="font-size: 0.7rem;"></i>
                        </div>
                        <span class="small fw-medium" style="color: #1a202c;">{{ $mv->code }}</span>
                      </div>
                    </td>
                    <td class="py-3 text-end px-4">
                      <span class="badge px-3 py-2" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">
                        {{ number_format($mv->qty) }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-5">
                      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                        <div class="d-flex align-items-center justify-content-center mb-3" 
                             style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                          <i class="bi bi-inbox text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                        </div>
                        <h5 class="fw-semibold mb-2" style="color: #6b7280;">No movements yet</h5>
                        <p class="text-muted mb-3">Start recording your movements</p>
                        <a href="{{ route('movements.create') }}" class="btn btn-brand px-4" style="border-radius: 10px;">
                          <i class="bi bi-plus-circle me-1"></i> Record Movement
                        </a>
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