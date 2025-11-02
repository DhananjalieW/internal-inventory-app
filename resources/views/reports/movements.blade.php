<x-app-layout>
  <div class="container py-4">

    {{-- Header + actions --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Movement History</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-arrow-left-right me-1"></i>Complete log of all inventory transactions
        </p>
      </div>
      <div class="d-flex gap-2 mt-3 mt-md-0">
        <form method="GET" class="mb-0">
          <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
              <i class="bi bi-calendar-range"></i>
            </span>
            <select class="form-select ps-5" name="range" onchange="this.form.submit()"
                    style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 10px 16px 10px 40px; font-weight: 500; min-width: 180px;">
              <option value="7d" {{ ($range ?? '7d')==='7d' ? 'selected' : '' }}>Last 7 days</option>
              <option value="30d" {{ ($range ?? '7d')==='30d' ? 'selected' : '' }}>Last 30 days</option>
              <option value="90d" {{ ($range ?? '7d')==='90d' ? 'selected' : '' }}>Last 90 days</option>
            </select>
          </div>
        </form>
        <a class="btn btn-brand d-flex align-items-center gap-2 px-4"
           href="{{ route('reports.export',['which'=>'movements','range'=>$range ?? '7d']) }}"
           style="border-radius: 10px; font-weight: 500;">
          <i class="bi bi-download"></i> Export CSV
        </a>
      </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width: 150px;">When</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 110px;">Type</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width: 100px;">Qty</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="min-width: 180px;">Reference</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 140px;">SKU</th>
                <th class="border-0 text-muted small fw-semibold py-3">Product</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width: 140px;">Warehouse</th>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width: 140px;">User</th>
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $r)
                @php
                  $sign = $r->type==='IN' ? '+' : ($r->type==='OUT' ? '-' : '±');
                @endphp
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
                    @elseif($r->type === 'TRANSFER')
                      <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                            style="background: #dbeafe; color: #1e40af; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="bi bi-arrow-left-right"></i> TRANSFER
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
                    <div class="text-muted small text-truncate" style="max-width: 260px;" title="{{ $r->reference }}">
                      {{ $r->reference ?: '—' }}
                    </div>
                  </td>

                  {{-- SKU --}}
                  <td class="py-3">
                    <span class="fw-bold text-nowrap" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">
                      {{ $r->sku }}
                    </span>
                  </td>

                  {{-- Product - FIXED: Use $r->product_name instead of $r->product --}}
                  <td class="py-3">
                    <div class="text-truncate" style="max-width: 360px;" title="{{ $r->product_name }}">
                      <span class="fw-medium" style="color: #1a202c;">{{ $r->product_name }}</span>
                    </div>
                  </td>

                  {{-- Warehouse - FIXED: Use $r->wh_code instead of $r->warehouse --}}
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 28px; height: 28px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 6px;">
                        <i class="bi bi-building text-white" style="font-size: 0.7rem;"></i>
                      </div>
                      <span class="fw-medium text-nowrap" style="color: #1a202c;">{{ $r->wh_code }}</span>
                    </div>
                  </td>

                  {{-- User - FIXED: Use $r->user_name instead of $r->user --}}
                  <td class="py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 28px; height: 28px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 6px;">
                        <i class="bi bi-person text-white" style="font-size: 0.7rem;"></i>
                      </div>
                      <span class="text-nowrap text-muted small">{{ $r->user_name ?: '—' }}</span>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-arrow-left-right text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No movements found</h5>
                      <p class="text-muted mb-0">No movements in this range. Try selecting a different time period.</p>
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

    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }
  </style>
</x-app-layout>