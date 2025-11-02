<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Movements ({{ $range }})</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    th { background: #f7f7f7; }
    .right { text-align: right; }
    .muted { color: #6b7280; }
  </style>
</head>
<body>
  <h3>Stock Movements — Last {{ $range }}</h3>
  <table>
    <thead><tr>
      <th>When</th><th>Type</th><th class="right">Qty</th><th>Reference</th>
      <th>SKU</th><th>Product</th><th>Warehouse</th><th>User</th>
    </tr></thead>
    <tbody>
      @forelse($rows as $r)
        <tr>
          <td class="muted">{{ \Illuminate\Support\Carbon::parse($r->created_at)->format('Y-m-d H:i') }}</td>
          <td>{{ $r->type }}</td>
          <td class="right">{{ $r->qty }}</td>
          <td>{{ $r->reference }}</td>
          <td>{{ $r->sku }}</td>
          <td>{{ $r->product }}</td>
          <td>{{ $r->warehouse }}</td>
          <td>{{ $r->user }}</td>
        </tr>
      @empty
        <tr><td colspan="8" class="right">No movements.</td></tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
