<!doctype html>
<html>
  <body style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#222">
    <p>Hi {{ $supplierName }},</p>

    <p>Please find our purchase order <strong>{{ $po->po_number }}</strong> attached as a PDF.</p>

    <p>
      <strong>Order date:</strong> {{ $po->order_date }}<br>
      <strong>Expected date:</strong> {{ $po->expected_date ?? '—' }}
    </p>

    <p>Summary:</p>
    <table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse;">
      <thead>
        <tr>
          <th align="left">SKU</th>
          <th align="left">Product</th>
          <th align="left">Warehouse</th>
          <th align="right">Qty</th>
          <th align="right">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $it)
          <tr>
            <td>{{ $it->sku }}</td>
            <td>{{ $it->product_name }}</td>
            <td>{{ $it->wh_code }}</td>
            <td align="right">{{ $it->qty_ordered }}</td>
            <td align="right">{{ number_format((float)$it->price, 2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <p style="margin-top:16px;">Best regards,<br>Inventory Team</p>
  </body>
</html>
