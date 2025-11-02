<!doctype html>
<html>
  <body style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#222">
    <p>Hi,</p>
    <p>Here’s the latest low-stock summary.</p>

    @if($items->isEmpty())
      <p><em>No items are currently below their reorder point.</em></p>
    @else
      <table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse;">
        <thead>
          <tr>
            <th align="left">SKU</th>
            <th align="left">Name</th>
            <th align="right">On hand</th>
            <th align="right">Reorder point</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $it)
            <tr>
              <td>{{ $it->sku }}</td>
              <td>{{ $it->name }}</td>
              <td align="right">{{ (int)$it->on_hand }}</td>
              <td align="right">{{ (int)$it->reorder_point }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    <p style="margin-top:16px;">
      — Inventory System
    </p>
  </body>
</html>
