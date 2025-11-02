<x-app-layout>
  <div class="container py-4">
    
    {{-- Header Section --}}
    <div class="row align-items-center mb-4">
      <div class="col">
        <h1 class="h3 mb-1 fw-bold">Transfer Requests</h1>
        <p class="text-muted mb-0">Manage and track your warehouse transfers</p>
      </div>
      <div class="col-auto">
        <a href="{{ route('transfers.create') }}" class="btn btn-primary px-4">
          <i class="bi bi-plus-circle me-2"></i>New Transfer
        </a>
      </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('warning'))
      <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-x-circle me-2"></i>{{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Filters Card --}}
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-body p-4">
        <form method="GET">
          <div class="row g-3">
            <div class="col-12 col-lg-4">
              <label class="form-label small text-muted mb-2">Search</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                  <i class="bi bi-search"></i>
                </span>
                <input name="q" value="{{ $q ?? '' }}" class="form-control border-start-0" placeholder="SKU, product, warehouse, reason...">
              </div>
            </div>

            <div class="col-6 col-lg-2">
              <label class="form-label small text-muted mb-2">Status</label>
              @php($s = $status ?? 'all')
              <select name="status" class="form-select">
                <option value="all" {{ $s === 'all' ? 'selected' : '' }}>All Status</option>
                <option value="pending" {{ $s === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $s === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $s === 'rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>

            <div class="col-6 col-lg-2">
              <label class="form-label small text-muted mb-2">From Date</label>
              <input type="date" name="from" class="form-control" value="{{ $dateFrom ?? '' }}">
            </div>

            <div class="col-6 col-lg-2">
              <label class="form-label small text-muted mb-2">To Date</label>
              <input type="date" name="to" class="form-control" value="{{ $dateTo ?? '' }}">
            </div>

            <div class="col-6 col-lg-2 d-flex align-items-end">
              <button type="submit" class="btn btn-dark w-100">
                <i class="bi bi-funnel me-2"></i>Apply Filters
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Transfers List --}}
    <div class="card shadow-sm border-0">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
              <tr>
                <th class="px-4 py-3 text-muted fw-semibold small">Date & Time</th>
                <th class="px-4 py-3 text-muted fw-semibold small">Product Details</th>
                <th class="px-4 py-3 text-muted fw-semibold small">Transfer Route</th>
                <th class="px-4 py-3 text-muted fw-semibold small text-center">Quantity</th>
                <th class="px-4 py-3 text-muted fw-semibold small">Status</th>
                <th class="px-4 py-3 text-muted fw-semibold small">Reference</th>
                <th class="px-4 py-3 text-muted fw-semibold small text-end">Actions</th>
              </tr>
            </thead>

            <tbody>
              @if($items->count())
                @foreach($items as $r)
                  @php($badge = match($r->status){'approved'=>'success','rejected'=>'danger',default=>'warning'})
                  @php($icon = match($r->status){'approved'=>'check-circle','rejected'=>'x-circle',default=>'clock'})
                  <tr class="border-bottom">
                    <td class="px-4 py-3">
                      <div class="text-dark fw-semibold">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y') }}</div>
                      <div class="text-muted small">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('h:i A') }}</div>
                    </td>
                    <td class="px-4 py-3">
                      <div class="d-flex align-items-start">
                        <div class="bg-light rounded p-2 me-3">
                          <i class="bi bi-box-seam text-primary fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">{{ $r->sku }}</div>
                          <div class="text-muted small">{{ $r->product }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3">
                      <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark px-3 py-2 fw-semibold">{{ $r->from_code }}</span>
                        <i class="bi bi-arrow-right mx-2 text-muted"></i>
                        <span class="badge bg-light text-dark px-3 py-2 fw-semibold">{{ $r->to_code }}</span>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-center">
                      <span class="badge bg-dark px-3 py-2">{{ $r->qty }}</span>
                    </td>
                    <td class="px-4 py-3">
                      <span class="badge bg-{{ $badge }} px-3 py-2">
                        <i class="bi bi-{{ $icon }} me-1"></i>{{ ucfirst($r->status) }}
                      </span>
                    </td>
                    <td class="px-4 py-3">
                      <span class="text-muted small">{{ $r->reference ?: '—' }}</span>
                    </td>
                    <td class="px-4 py-3 text-end">
                      @if(Route::has('transfers.show'))
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('transfers.show', $r->id) }}">
                          <i class="bi bi-eye me-1"></i>View
                        </a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="text-muted">
                      <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                      <p class="mb-0">No transfer requests found</p>
                      <p class="small">Try adjusting your filters or create a new transfer</p>
                    </div>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Pagination --}}
    @if($items->count())
      <div class="mt-4 d-flex justify-content-center">
        {{ $items->onEachSide(1)->links() }}
      </div>
    @endif

  </div>

  <style>
    .table > :not(caption) > * > * {
      padding: 1rem 1.5rem;
    }
    
    .form-control:focus,
    .form-select:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .btn-primary {
      background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
      border: none;
      box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
    }

    .card {
      transition: all 0.3s ease;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(13, 110, 253, 0.03);
    }

    .badge {
      font-weight: 600;
      letter-spacing: 0.3px;
    }

    .input-group-text {
      background-color: #f8f9fa;
    }
  </style>
</x-app-layout>