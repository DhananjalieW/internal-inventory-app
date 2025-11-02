<x-app-layout>
  <div class="container py-4">

    {{-- Page header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Stock Movements</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-arrow-left-right me-1"></i>History of all inbound, outbound, and adjustments
        </p>
      </div>
      @if(!($isViewer ?? false))
        <a href="{{ route('movements.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500;">
          <i class="bi bi-plus-circle"></i> Record Movement
        </a>
      @else
        <span class="badge px-3 py-2" style="background: #e0e7ff; color: #4338ca; border-radius: 10px; font-weight: 500; font-size: 0.875rem;">
          <i class="bi bi-shield-lock me-1"></i>Read-Only Access
        </span>
      @endif
    </div>

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

    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-10">
              <label class="form-label small text-muted fw-semibold mb-2">Search Movements</label>
              <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e5e7eb; border-right: none;">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input name="q" class="form-control border-start-0 ps-0" 
                       placeholder="Search product, SKU, reference, or user…" 
                       value="{{ $q }}"
                       style="border: 2px solid #e5e7eb; border-left: none; box-shadow: none;">
                @if(!empty($q))
                  <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;">
                    <i class="bi bi-x-lg"></i>
                  </a>
                @endif
              </div>
            </div>
            <div class="col-12 col-md-2">
              <button class="btn btn-outline-secondary w-100 px-4" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
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
        <div class="table-responsive" style="max-height: 65vh;">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa; position: sticky; top: 0; z-index: 10;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4 text-nowrap">Date</th>
                <th class="border-0 text-muted small fw-semibold py-3">Product</th>
                <th class="border-0 text-muted small fw-semibold py-3">Warehouse</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-center">Type</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end">Qty</th>
                <th class="border-0 text-muted small fw-semibold py-3">Reference</th>
                <th class="border-0 text-muted small fw-semibold py-3 px-4">User</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $r)
                @php
                  $sign  = $r->type === 'IN' ? '+' : ($r->type === 'OUT' ? '-' : '±');
                @endphp
                <tr style="border-bottom: 1px solid #f1f3f5;">
                  {{-- Date --}}
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2 text-muted small text-nowrap">
                      <i class="bi bi-clock"></i>
                      <span>{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('Y-m-d H:i') }}</span>
                    </div>
                  </td>

                  {{-- Product --}}
                  <td class="py-3">
                    <div class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                      {{ $r->sku }}
                    </div>
                    <div class="text-muted small text-truncate" style="max-width: 260px;">
                      {{ $r->product_name }}
                    </div>
                  </td>

                  {{-- Warehouse --}}
                  <td class="py-3">
                    <div class="d-flex align-items-start gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 28px; height: 28px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 6px;">
                        <i class="bi bi-building text-white" style="font-size: 0.7rem;"></i>
                      </div>
                      <div>
                        <div class="fw-semibold" style="color: #1a202c;">{{ $r->wh_code }}</div>
                        <div class="text-muted small text-truncate" style="max-width: 220px;">
                          {{ $r->wh_name }}
                        </div>
                      </div>
                    </div>
                  </td>

                  {{-- Type --}}
                  <td class="py-3 text-center">
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

                  {{-- Quantity --}}
                  <td class="py-3 text-end">
                    <span class="badge px-3 py-2" 
                          style="background: {{ $r->type === 'IN' ? '#d1fae5' : ($r->type === 'OUT' ? '#fee' : '#f3f4f6') }}; 
                                 color: {{ $r->type === 'IN' ? '#065f46' : ($r->type === 'OUT' ? '#7f1d1d' : '#1a202c') }}; 
                                 border-radius: 8px; font-weight: 700; font-size: 0.9rem; font-variant-numeric: tabular-nums;">
                      {{ $sign }}{{ number_format($r->qty) }}
                    </span>
                  </td>

                  {{-- Reference --}}
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2">
                      <span class="text-muted small text-truncate d-inline-block" style="max-width: 280px;" title="{{ $r->reference }}">
                        {{ $r->reference }}
                      </span>
                      @if(!empty($r->attachment_path))
                        <a class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center" 
                           title="View attachment" 
                           target="_blank"
                           href="{{ \Illuminate\Support\Facades\Storage::url($r->attachment_path) }}"
                           style="border-radius: 6px; padding: 4px 8px;">
                          <i class="bi bi-paperclip"></i>
                        </a>
                      @endif
                    </div>
                  </td>

                  {{-- User --}}
                  <td class="py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 28px; height: 28px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 6px;">
                        <i class="bi bi-person text-white" style="font-size: 0.7rem;"></i>
                      </div>
                      <span class="text-muted small">{{ $r->user_name ?? '—' }}</span>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-inbox text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No movements found</h5>
                      <p class="text-muted mb-3">Start by recording your first stock movement</p>
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

      {{-- Footer meta / pagination --}}
      <div class="card-footer bg-white border-0 d-flex flex-wrap justify-content-between align-items-center py-3 px-4">
        <div class="text-muted" style="font-size: 0.9rem;">
          Showing latest <span class="fw-semibold text-dark">{{ $items->count() }}</span> records
        </div>
        @if(method_exists($items, 'links'))
          <div>
            {{ $items->links() }}
          </div>
        @endif
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