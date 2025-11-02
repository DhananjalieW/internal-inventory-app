<x-app-layout>
  <div class="container py-3">

    <div class="d-flex align-items-center gap-2 mb-3">
      <h1 class="h4 mb-0">Reorder Report</h1>
      <span class="badge text-bg-secondary">{{ $count }}</span>
    </div>

    <form method="GET" class="d-flex gap-2 mb-3">
      <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Search SKU or name"
        value="{{ $q }}"
      />
      <button class="btn btn-outline-secondary">Filter</button>
      @if($q !== '')
        <a class="btn btn-link" href="{{ route('reorder.index') }}">Clear</a>
      @endif
    </form>

    @if($rows->isEmpty())
      <div class="alert alert-success mb-0">
        ✅ All good — nothing below reorder.
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-sm align-middle">
          <thead>
            <tr>
              <th>SKU</th>
              <th>Name</th>
              <th class="text-end">On hand</th>
              <th class="text-end">Reorder point</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rows as $r)
              <tr>
                <td>
                  <a href="{{ route('products.edit', $r->product_id) }}">
                    {{ $r->sku }}
                  </a>
                </td>
                <td>{{ $r->name }}</td>
                <td class="text-end">{{ $r->on_hand }}</td>
                <td class="text-end">{{ $r->reorder_point }}</td>
                <td class="text-end">
                  <a class="btn btn-sm btn-primary"
                     href="{{ route('movements.create', ['product_id' => $r->product_id]) }}">
                    Record movement
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
</x-app-layout>
