<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Stock on Hand</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    th { background: #f7f7f7; }
    .right { text-align: right; }
  </style>
</head>
<body>
  <h3>Stock on Hand</h3>
  <table>
    <thead><tr><th>Warehouse</th><th>SKU</th><th>Name</th><th class="right">On hand</th><th class="right">Allocated</th><th class="right">On order</th></tr></thead>
    <tbody>
      @forelse($rows as $r)
        <tr>
          <td>{{ $r->warehouse }}</td>
          <td>{{ $r->sku }}</td>
          <td>{{ $r->name }}</td>
          <td class="right">{{ $r->on_hand }}</td>
          <td class="right">{{ $r->allocated }}</td>
          <td class="right">{{ $r->on_order }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="right">No data.</td></tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
