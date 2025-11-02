<x-app-layout>
  <div class="container py-4">
    
    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">New Purchase Order</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-receipt me-1"></i>Create a new order from a supplier
        </p>
      </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(40, 167, 69, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #155724;">{{ session('success') }}</span>
        </div>
      </div>
    @endif

    @if (session('warning'))
      <div class="alert alert-warning border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fff3cd 0%, #fff8e1 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255, 193, 7, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #856404;">{{ session('warning') }}</span>
        </div>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fee 0%, #ffebee 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
          </div>
          <div class="flex-grow-1">
            <div class="fw-medium mb-1" style="color: #7f1d1d;">Please fix the following errors:</div>
            <ul class="mb-0 small" style="color: #991b1b;">
              @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endif

    <form id="po-create-form" method="POST" action="{{ route('pos.store') }}" novalidate>
      @csrf

      {{-- Add this hidden field to auto-set order_date to today --}}
      <input type="hidden" name="order_date" value="{{ date('Y-m-d') }}">

      {{-- Header Info Card --}}
      <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 pt-4 px-4">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">Order Information</h5>
        </div>
        <div class="card-body p-4">
          <div class="row g-4">
            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">
                Supplier <span class="text-danger">*</span>
              </label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                  <i class="bi bi-truck"></i>
                </span>
                <select name="supplier_id" class="form-select ps-5 @error('supplier_id') is-invalid @enderror" required
                        style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                  <option value="">-- choose supplier --</option>
                  @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>{{ $s->name }}</option>
                  @endforeach
                </select>
                @error('supplier_id')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">Expected date</label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                  <i class="bi bi-calendar-check"></i>
                </span>
                <input name="expected_date" type="date" 
                       class="form-control ps-5 @error('expected_date') is-invalid @enderror"
                       value="{{ old('expected_date') }}"
                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                @error('expected_date')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <label class="form-label small text-muted fw-semibold mb-2">PO # (optional)</label>
              <div class="position-relative">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                  <i class="bi bi-hash"></i>
                </span>
                <input name="po_number" type="text" 
                       class="form-control ps-5 @error('po_number') is-invalid @enderror"
                       placeholder="Auto-generated if blank" 
                       value="{{ old('po_number') }}"
                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
                @error('po_number')
                  <div class="invalid-feedback d-flex align-items-center gap-2 mt-2">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Items Card --}}
      <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4 pb-3">
          <h5 class="mb-0 fw-bold" style="color: #1a202c;">Items</h5>
          <button type="button" id="addRow" class="btn btn-brand d-flex align-items-center gap-2 px-3 py-2" style="border-radius: 8px; font-weight: 500;">
            <i class="bi bi-plus-circle"></i> Add item
          </button>
        </div>

        <div class="table-responsive" style="max-height: 60vh;">
          <table class="table table-hover align-middle mb-0" id="itemsTable">
            <thead style="background: #f8f9fa; position: sticky; top: 0; z-index: 10;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width:34%">Product</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width:26%">Warehouse</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width:10%">Qty</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width:14%">Price</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end" style="width:12%">Amount</th>
                <th class="border-0 py-3" style="width:4%"></th>
              </tr>
            </thead>
            <tbody>
              {{-- starter row --}}
              <tr style="border-bottom: 1px solid #f1f3f5;">
                <td class="px-4 py-3">
                  <select name="items[0][product_id]" class="form-select" required
                          style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 500;">
                    <option value="">-- choose product --</option>
                    @foreach($products as $p)
                      <option value="{{ $p->id }}">{{ $p->sku }} — {{ $p->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="py-3">
                  <select name="items[0][warehouse_id]" class="form-select" required
                          style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 500;">
                    <option value="">-- choose warehouse --</option>
                    @foreach($warehouses as $w)
                      <option value="{{ $w->id }}">{{ $w->code }} — {{ $w->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="py-3">
                  <input name="items[0][qty]" type="number" min="1" value="1"
                         class="form-control text-end js-qty" required
                         style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 600;">
                </td>
                <td class="py-3">
                  <input name="items[0][price]" type="number" step="0.01" min="0"
                         class="form-control text-end js-price" placeholder="0.00"
                         style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 600;">
                </td>
                <td class="py-3 text-end">
                  <span class="badge px-3 py-2 js-amount" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">0.00</span>
                </td>
                <td class="py-3 text-end">
                  <button type="button" class="btn btn-sm btn-outline-danger removeRow d-inline-flex align-items-center justify-content-center" 
                          title="Remove" style="border-radius: 6px; width: 32px; height: 32px; padding: 0;">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </td>
              </tr>
            </tbody>

            <tfoot>
              <tr style="background: #f8f9fa; border-top: 2px solid #e5e7eb;">
                <td colspan="2" class="px-4 py-3 text-end fw-bold" style="color: #1a202c;">Summary:</td>
                <td class="py-3 text-end">
                  <span class="badge px-3 py-2" style="background: #e8f5e9; color: #2e7d32; border-radius: 8px; font-weight: 700;">
                    <span id="sumQty">1</span> items
                  </span>
                </td>
                <td class="py-3 text-end text-muted small fw-semibold">Total</td>
                <td class="py-3 text-end">
                  <span class="badge px-3 py-2" style="background: #1a202c; color: white; border-radius: 8px; font-weight: 700; font-size: 1rem;">
                    <span id="sumAmount">0.00</span>
                  </span>
                </td>
                <td class="py-3"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      {{-- Actions --}}
      <div class="d-flex justify-content-end gap-3">
        <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
          Cancel
        </a>
        <button id="submitBtn" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" type="submit" data-label="Create PO" style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none;">
          <i class="bi bi-check-circle"></i> Create PO
        </button>
      </div>
    </form>
  </div>

  <style>
    .form-control:focus,
    .form-select:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover:not(:disabled) {
      transform: translateY(-1px);
    }

    select.form-select {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    }

    .table tbody tr {
      transition: background-color 0.15s ease;
    }
    
    .table tbody tr:hover {
      background-color: #f8f9fa;
    }
  </style>

  <script>
    (function () {
      const products   = @json($products->map(fn($p)=>['id'=>$p->id,'label'=>$p->sku.' — '.$p->name]));
      const warehouses = @json($warehouses->map(fn($w)=>['id'=>$w->id,'label'=>$w->code.' — '.$w->name]));
      const tableBody  = document.querySelector('#itemsTable tbody');
      const addBtn     = document.getElementById('addRow');

      const sumQtyEl     = document.getElementById('sumQty');
      const sumAmountEl  = document.getElementById('sumAmount');

      function optionsHtml(list) {
        return ['<option value="">-- choose --</option>']
          .concat(list.map(o => `<option value="${o.id}">${o.label}</option>`))
          .join('');
      }

      function recalcRow(tr){
        const qty   = parseFloat(tr.querySelector('.js-qty')?.value || 0);
        const price = parseFloat(tr.querySelector('.js-price')?.value || 0);
        const amt   = (qty * price) || 0;
        tr.querySelector('.js-amount').textContent = amt.toFixed(2);
      }

      function recalcTotals(){
        let totalQty = 0, totalAmt = 0;
        tableBody.querySelectorAll('tr').forEach(tr=>{
          const qty = parseFloat(tr.querySelector('.js-qty')?.value || 0);
          const amt = parseFloat(tr.querySelector('.js-amount')?.textContent || 0);
          totalQty += qty;
          totalAmt += amt;
        });
        sumQtyEl.textContent    = totalQty.toString();
        sumAmountEl.textContent = totalAmt.toFixed(2);
      }

      function wireRow(tr){
        tr.addEventListener('input', (e)=>{
          if (e.target.classList.contains('js-qty') || e.target.classList.contains('js-price')) {
            recalcRow(tr); recalcTotals();
          }
        });
      }

      function addRow() {
        const index = tableBody.querySelectorAll('tr').length;
        const tr = document.createElement('tr');
        tr.style.borderBottom = '1px solid #f1f3f5';
        tr.innerHTML = `
          <td class="px-4 py-3">
            <select name="items[${index}][product_id]" class="form-select" required style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 500;">
              ${optionsHtml(products)}
            </select>
          </td>
          <td class="py-3">
            <select name="items[${index}][warehouse_id]" class="form-select" required style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 500;">
              ${optionsHtml(warehouses)}
            </select>
          </td>
          <td class="py-3"><input name="items[${index}][qty]" type="number" min="1" value="1" class="form-control text-end js-qty" required style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 600;"></td>
          <td class="py-3"><input name="items[${index}][price]" type="number" step="0.01" min="0" class="form-control text-end js-price" placeholder="0.00" style="border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 600;"></td>
          <td class="py-3 text-end"><span class="badge px-3 py-2 js-amount" style="background: #f3f4f6; color: #1a202c; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">0.00</span></td>
          <td class="py-3 text-end">
            <button type="button" class="btn btn-sm btn-outline-danger removeRow d-inline-flex align-items-center justify-content-center" title="Remove" style="border-radius: 6px; width: 32px; height: 32px; padding: 0;">
              <i class="bi bi-x-lg"></i>
            </button>
          </td>`;
        tableBody.appendChild(tr);
        wireRow(tr);
        recalcRow(tr); recalcTotals();
      }

      // Initial wire + calc for the starter row
      wireRow(tableBody.querySelector('tr')); recalcTotals();

      addBtn.addEventListener('click', addRow);

      tableBody.addEventListener('click', (e) => {
        if (e.target.closest('.removeRow')) {
          const rows = tableBody.querySelectorAll('tr');
          if (rows.length > 1) {
            const tr = e.target.closest('tr');
            tr.remove();
            recalcTotals();
          }
        }
      });

      // double-submit guard
      const form = document.getElementById('po-create-form');
      const btn  = document.getElementById('submitBtn');
      let locked = false;
      form.addEventListener('submit', function (e) {
        if (locked) { e.preventDefault(); return false; }
        locked = true; btn.disabled = true; btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Creating…';
      });
      window.addEventListener('pageshow', function (event) {
        if (event.persisted) { 
          locked = false; 
          btn.disabled = false; 
          btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>' + (btn.dataset.label || 'Create PO');
        }
      });
    })();
  </script>
</x-app-layout>