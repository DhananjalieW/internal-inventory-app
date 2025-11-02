{{-- resources/views/admin/approvals/index.blade.php --}}
<x-app-layout>
  <div class="container-fluid py-4">

    @php
      // Use the passed $list (controller sends it as $list)
      $list = $list ?? collect();
    @endphp

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-1 fw-bold text-dark">
          <i class="bi bi-check-circle text-primary me-2"></i>Pending Approvals
        </h1>
        <p class="text-muted mb-0 small">Review and approve pending requests</p>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="bg-light border rounded-3 px-3 py-2">
          <span class="text-muted small">Total Items</span>
          <h5 class="mb-0 fw-bold text-primary">{{ $list->count() }}</h5>
        </div>
      </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
              <tr>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">When</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">User</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">Type</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase text-end">Qty</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">SKU</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">Product</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">WH</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase">Ref</th>
                <th class="px-4 py-3 text-muted small fw-semibold text-uppercase text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($list as $r)
                @php
                  $kind  = strtoupper($r->movement_type ?? '');  // IN/OUT/ADJUST/TRANSFER/PO
                  $badge = match($kind) {
                    'IN' => 'success', 'OUT' => 'danger', 'ADJUST' => 'secondary',
                    'TRANSFER' => 'warning', 'PO' => 'primary', default => 'secondary'
                  };
                @endphp
                <tr class="border-bottom">
                  <td class="px-4 py-3">
                    <div class="d-flex flex-column">
                      <span class="small text-dark fw-medium">
                        {{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}
                      </span>
                      <span class="small text-muted">
                        {{ \Illuminate\Support\Carbon::parse($r->created_at)->format('H:i') }}
                      </span>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                      <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                           style="width: 32px; height: 32px;">
                        <i class="bi bi-person-fill text-muted"></i>
                      </div>
                      <span class="fw-medium text-dark">{{ $r->user ?? '—' }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <span class="badge bg-{{ $badge }} rounded-pill px-3 py-2">
                      {{ $kind ?: '—' }}
                    </span>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <span class="fw-semibold text-dark">{{ $r->qty }}</span>
                  </td>
                  <td class="px-4 py-3">
                    <code class="bg-light px-2 py-1 rounded text-dark small">{{ $r->sku }}</code>
                  </td>
                  <td class="px-4 py-3">
                    <div class="text-truncate fw-medium text-dark" style="max-width:220px">
                      {{ $r->product }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <span class="badge bg-light text-dark border">{{ $r->warehouse }}</span>
                  </td>
                  <td class="px-4 py-3">
                    <span class="text-muted small">{{ $r->reference ?: '—' }}</span>
                  </td>
                  <td class="px-4 py-3 text-end">
                    <div class="d-flex gap-2 justify-content-end">
                      <form method="POST" action="{{ route('admin.approvals.approve', $r->id) }}">
                        @csrf
                        <input type="hidden" name="type" value="{{ $r->type }}">
                        <button type="submit" class="btn btn-success btn-sm px-3 d-flex align-items-center gap-1">
                          <i class="bi bi-check-circle"></i>
                          <span>Approve</span>
                        </button>
                      </form>
                      <form method="POST" action="{{ route('admin.approvals.reject', $r->id) }}"
                            onsubmit="return confirm('Reject this item?');">
                        @csrf
                        <input type="hidden" name="type" value="{{ $r->type }}">
                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center gap-1">
                          <i class="bi bi-x-circle"></i>
                          <span>Reject</span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center py-4">
                      <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" 
                           style="width: 80px; height: 80px;">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                      </div>
                      <h5 class="text-dark mb-2">No Pending Approvals</h5>
                      <p class="text-muted mb-0">All requests have been processed</p>
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

  <style>
    .table > tbody > tr:hover {
      background-color: #f8f9fa;
    }

    .btn-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      font-weight: 600;
      transition: all 0.2s;
    }

    .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-outline-danger {
      border-width: 2px;
      font-weight: 600;
      transition: all 0.2s;
    }

    .btn-outline-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
    }

    .badge {
      font-weight: 600;
      letter-spacing: 0.3px;
    }

    .card {
      border-radius: 12px;
      overflow: hidden;
    }

    .table thead th {
      border-bottom: 2px solid #e5e7eb;
    }

    .table tbody tr:last-child {
      border-bottom: none;
    }

    code {
      font-family: 'Courier New', monospace;
      font-weight: 600;
    }
  </style>
</x-app-layout>