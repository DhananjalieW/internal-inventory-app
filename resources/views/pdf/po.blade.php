<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PO {{ $po->po_number }}</title>
  <style>
    body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; color: #222; }
    h1 { font-size: 18px; margin: 0 0 6px; }
    .meta td { padding: 2px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 12px; }
    th, td { border: 1px solid #ccc; padding: 6px; }
    th { background: #f4f4f4; text-align: left; }
    .right { text-align: right; }
  </style>
</head>
<body>
  <h1>Purchase Order — {{ $po->po_number }}</h1>

  <table class="meta" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td><strong>Supplier:</strong> {{ $po->supplier_name ?? '—' }}</td>
      <td><strong>Order date:</strong> {{ $po->order_date }}</td>
    </tr>
    <tr>
      <td><strong>Supplier email:</strong> {{ $po->supplier_email ?? '—' }}</td>
      <td><strong>Expected date:</strong> {{ $po->expected_date ?? '—' }}</td>
    </tr>
  </table>

  <table>
    <thead>
      <tr>
        <th>SKU</th>
        <th>Product</th>
        <th>Warehouse</th>
        <th class="right">Qty</th>
        <th class="right">Price</th>
        <th class="right">Line Total</th>
      </tr>
    </thead>
    <tbody>
      @php $grand = 0; @endphp
      @foreach($items as $it)
        @php $line = (float)$it->price * (int)$it->qty_ordered; $grand += $line; @endphp
        <tr>
          <td>{{ $it->sku }}</td>
          <td>{{ $it->product_name }}</td>
          <td>{{ $it->wh_code }} — {{ $it->wh_name }}</td>
          <td class="right">{{ $it->qty_ordered }}</td>
          <td class="right">{{ number_format((float)$it->price, 2) }}</td>
          <td class="right">{{ number_format($line, 2) }}</td>
        </tr>
      @endforeach
      <tr>
        <td colspan="5" class="right"><strong>Total</strong></td>
        <td class="right"><strong>{{ number_format($grand, 2) }}</strong></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
