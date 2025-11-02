{{-- resources/views/pos/index.blade.php --}}
<x-app-layout>
  <div class="container py-4">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Purchase Orders</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-receipt me-1"></i>Manage supplier orders and deliveries
        </p>
      </div>
      <a href="{{ route('pos.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500;">
        <i class="bi bi-plus-circle"></i> New PO
      </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(40, 167, 69, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <div class="flex-grow-1">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    @if(session('warning'))
      <div class="alert alert-warning border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fff3cd 0%, #fff8e1 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255, 193, 7, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
          </div>
          <div class="flex-grow-1">{{ session('warning') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3 align-items-end">
            <div class="col-12 col-md-10">
              <label class="form-label small text-muted fw-semibold mb-2">Search Purchase Orders</label>
              <div class="input-group" style="border-radius: 10px; overflow: hidden;">
                <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e5e7eb; border-right: none;">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input class="form-control border-start-0 ps-0" name="q" value="{{ $q }}" 
                       placeholder="Search by PO number or supplier name..."
                       style="border: 2px solid #e5e7eb; border-left: none; box-shadow: none;">
                @if($q)
                  <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;">
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

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4">PO #</th>
                <th class="border-0 text-muted small fw-semibold py-3">Supplier</th>
                <th class="border-0 text-muted small fw-semibold py-3">Status</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-center">Items</th>
                <th class="border-0 text-muted small fw-semibold py-3">Order date</th>
                <th class="border-0 text-muted small fw-semibold py-3">Expected</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end px-4">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pos as $p)
                @php
                  // Map PO status to colors
                  $statusConfig = [
                    'open'      => ['bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => 'bi-circle'],
                    'draft'     => ['bg' => '#f3f4f6', 'color' => '#4b5563', 'icon' => 'bi-file-earmark'],
                    'approved'  => ['bg' => '#e0e7ff', 'color' => '#4338ca', 'icon' => 'bi-check-circle'],
                    'sent'      => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'bi-send'],
                    'closed'    => ['bg' => '#d1fae5', 'color' => '#065f46', 'icon' => 'bi-check-circle-fill'],
                    'cancelled' => ['bg' => '#fee', 'color' => '#7f1d1d', 'icon' => 'bi-x-circle-fill'],
                  ];
                  $config = $statusConfig[strtolower($p->status)] ?? ['bg' => '#f3f4f6', 'color' => '#4b5563', 'icon' => 'bi-circle'];

                  $canManage = in_array(Auth::user()->role, ['Admin','Inventory Manager']);
                @endphp

                <tr style="border-bottom: 1px solid #f1f3f5;">
                  {{-- PO Number --}}
                  <td class="px-4 py-3">
                    <span class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace;">{{ $p->po_number }}</span>
                  </td>

                  {{-- Supplier --}}
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                           style="width: 32px; height: 32px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 8px;">
                        <i class="bi bi-truck text-white" style="font-size: 0.75rem;"></i>
                      </div>
                      <span class="fw-medium" style="color: #1a202c;">{{ $p->supplier ?? '—' }}</span>
                    </div>
                  </td>

                  {{-- Status --}}
                  <td class="py-3">
                    <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                          style="background: {{ $config['bg'] }}; color: {{ $config['color'] }}; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                      <i class="bi {{ $config['icon'] }}"></i>
                      {{ strtoupper($p->status) }}
                    </span>
                  </td>

                  {{-- Items Count --}}
                  <td class="py-3 text-center">
                    <span class="badge d-inline-flex align-items-center justify-content-center" 
                          style="background: #e0e7ff; color: #4338ca; border-radius: 8px; font-weight: 600; width: 32px; height: 32px;">
                      {{ $p->items_count ?? 0 }}
                    </span>
                  </td>

                  {{-- Order Date --}}
                  <td class="py-3">
                    <div class="d-flex align-items-center gap-2 text-muted">
                      <i class="bi bi-calendar"></i>
                      <span>{{ $p->order_date }}</span>
                    </div>
                  </td>

                  {{-- Expected Date --}}
                  <td class="py-3">
                    @if($p->expected_date)
                      <div class="d-flex align-items-center justify-content-end gap-2 text-muted small">
                        <i class="bi bi-calendar-check"></i>
                        <span>{{ $p->expected_date }}</span>
                      </div>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>

                  {{-- Actions --}}
                  <td class="py-3 text-end px-4">
                    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">

                      {{-- Manager/Admin actions --}}
                      @if($canManage)
                        {{-- Show Approve button for DRAFT/OPEN status --}}
                        @if(in_array(strtolower($p->status), ['draft', 'open']))
                          <form class="d-inline" method="POST" action="{{ route('pos.approve', $p->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-success d-inline-flex align-items-center gap-1 px-3" 
                                    style="border-radius: 8px; font-weight: 500;">
                              <i class="bi bi-check-circle"></i> Approve
                            </button>
                          </form>
                        @endif

                        {{-- Show Send button for DRAFT/OPEN/APPROVED status --}}
                        @if(in_array(strtolower($p->status), ['draft', 'open', 'approved']))
                          <form class="d-inline" method="POST" action="{{ route('pos.send', $p->id) }}">
                            @csrf
                            <button class="btn btn-sm d-inline-flex align-items-center gap-1 px-3" 
                                    style="border-radius: 8px; font-weight: 500; background: #0ea5e9; color: white; border: none;">
                              <i class="bi bi-send"></i> Send
                            </button>
                          </form>
                        @endif

                        {{-- Cancel button (only if not already closed/cancelled) --}}
                        @if(!in_array(strtolower($p->status), ['closed', 'cancelled']))
                          <form class="d-inline" method="POST" action="{{ route('pos.cancel', $p->id) }}"
                                onsubmit="return confirm('Are you sure you want to cancel this PO?');">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-3"
                                    style="border-radius: 8px; font-weight: 500; border: 2px solid #ef4444;">
                              <i class="bi bi-x-circle"></i> Cancel
                            </button>
                          </form>
                        @endif
                      @endif

                      {{-- Receive buttons (for all users who can access POs) --}}
                      @if($p->items->count())
                        @foreach($p->items->take(3) as $item)
                          @php
                            $remaining = (int)$item->qty_ordered - (int)$item->received_qty;
                          @endphp
                          @if($remaining > 0)
                            <a href="{{ route('pos.item.receive.form', $item->id) }}" 
                               class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 px-3"
                               style="border-radius: 8px; font-weight: 500;">
                              <i class="bi bi-box-arrow-in-down"></i> Receive ({{ $remaining }}x)
                            </a>
                          @endif
                        @endforeach
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                      <div class="d-flex align-items-center justify-content-center mb-3" 
                           style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                        <i class="bi bi-receipt text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                      </div>
                      <h5 class="fw-semibold mb-2" style="color: #6b7280;">No purchase orders found</h5>
                      <p class="text-muted mb-3">Create your first purchase order to get started</p>
                      <a href="{{ route('pos.create') }}" class="btn btn-brand px-4" style="border-radius: 10px;">
                        <i class="bi bi-plus-circle me-1"></i> New PO
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      @if($pos->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
          <div class="d-flex justify-content-end">
            {{ $pos->links() }}
          </div>
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
    
    .btn:hover:not(:disabled) {
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