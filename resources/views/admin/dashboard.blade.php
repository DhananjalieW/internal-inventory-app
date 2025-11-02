<x-app-layout>
  <div class="container py-3">

    <h1 class="mb-3">Admin Dashboard</h1>

    {{-- KPI cards --}}
    <div class="row g-3 mb-4">
      <div class="col-md-2">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="text-muted small">Users</div>
            <div class="display-6">{{ $usersCount }}</div>
            <a href="{{ route('admin.users.index') ?? '#' }}" class="small">Manage users</a>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card shadow-sm"><div class="card-body">
          <div class="text-muted small">Products</div>
          <div class="display-6">{{ $productsCount }}</div>
          <a href="{{ route('products.index') ?? '#' }}" class="small">Open products</a>
        </div></div>
      </div>
      <div class="col-md-2">
        <div class="card shadow-sm"><div class="card-body">
          <div class="text-muted small">Warehouses</div>
          <div class="display-6">{{ $warehousesCount }}</div>
          <a href="{{ route('warehouses.index') ?? '#' }}" class="small">Open warehouses</a>
        </div></div>
      </div>
      <div class="col-md-2">
        <div class="card shadow-sm"><div class="card-body">
          <div class="text-muted small">Open POs</div>
          <div class="display-6">{{ $openPoCount }}</div>
          <a href="{{ route('pos.index') ?? '#' }}" class="small">View POs</a>
        </div></div>
      </div>
      <div class="col-md-2">
        <div class="card shadow-sm"><div class="card-body">
          <div class="text-muted small">Low-stock items</div>
          <div class="display-6">{{ $lowStockCount }}</div>
          <a href="{{ route('reorder.index') ?? '#' }}" class="small">Reorder report</a>
        </div></div>
      </div>
      <div class="col-md-2">
        <div class="card shadow-sm"><div class="card-body">
          <div class="text-muted small">Approvals</div>
          <div>{{ $pendingTransfers }} transfers</div>
          <div>{{ $pendingAdjust }} adjustments</div>
          <a href="{{ route('admin.settings') ?? '#' }}" class="small">Configure approvals</a>
        </div></div>
      </div>
    </div>

    <div class="row g-4">
      {{-- Low Stock Table --}}
      <div class="col-lg-7">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-white"><strong>Low Stock (Top 10)</strong></div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-sm table-striped mb-0">
                <thead><tr>
                  <th>SKU</th><th>Name</th><th>WH</th>
                  <th class="text-end">On Hand</th>
                  <th class="text-end">Reorder</th>
                </tr></thead>
                <tbody>
                @forelse($lowStock as $r)
                  <tr>
                    <td>{{ $r->sku }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->wh }}</td>
                    <td class="text-end">{{ $r->qty_on_hand }}</td>
                    <td class="text-end">{{ $r->reorder_point }}</td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="text-muted text-center">Good news — no low stock.</td></tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Recent Activity --}}
      <div class="col-lg-5">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-white d-flex justify-content-between">
            <strong>Recent Activity</strong>
            <a href="{{ route('admin.activity.index') ?? '#' }}" class="small">View all</a>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @forelse($recent as $a)
                <li class="list-group-item px-0">
                  <div class="small">{{ $a->event }} — <span class="text-muted">{{ $a->created_at }}</span></div>
                  <div class="text-muted small">{{ $a->description }}</div>
                </li>
              @empty
                <li class="list-group-item px-0 text-muted small">No activity yet.</li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-app-layout>
