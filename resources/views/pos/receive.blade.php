{{-- resources/views/pos/receive_item.blade.php --}}
<x-app-layout>
  <div class="container py-4" style="max-width: 860px;">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Receive PO Item</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-box-arrow-in-down me-1"></i>Record the receipt of items from a purchase order
        </p>
      </div>
    </div>

    {{-- Item summary --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold" style="color: #1a202c;">Item Details</h5>
      </div>
      <div class="card-body p-4">
        <div class="row g-4 align-items-center">
          <div class="col-md-7">
            <div class="mb-3">
              <div class="text-muted small fw-semibold mb-1">Product</div>
              <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                     style="width: 32px; height: 32px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 8px;">
                  <i class="bi bi-box-seam text-white" style="font-size: 0.75rem;"></i>
                </div>
                <div>
                  <div class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace; font-size: 0.9rem;">{{ $item->sku }}</div>
                  <div class="text-muted small">{{ $item->product_name }}</div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <div class="text-muted small fw-semibold mb-1">Warehouse</div>
              <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                     style="width: 32px; height: 32px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px;">
                  <i class="bi bi-building text-white" style="font-size: 0.75rem;"></i>
                </div>
                <div>
                  <div class="fw-semibold" style="color: #1a202c;">{{ $item->wh_code }}</div>
                  <div class="text-muted small">{{ $item->wh_name }}</div>
                </div>
              </div>
            </div>

            <div>
              <div class="text-muted small fw-semibold mb-1">Purchase Order</div>
              <div class="d-flex align-items-center gap-2">
                <span class="fw-bold" style="color: #1a202c; font-family: 'Courier New', monospace;">{{ $item->po_number }}</span>
                <span class="badge px-2 py-1" style="background: #f3f4f6; color: #1a202c; border-radius: 6px; font-weight: 500; font-size: 0.75rem;">
                  {{ strtoupper($item->po_status) }}
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small fw-semibold text-muted">Receipt Progress</span>
                <span class="fw-bold" style="color: #1a202c;">{{ (int)$item->received_qty }} / {{ (int)$item->qty_ordered }}</span>
              </div>
              @php
                $ordered   = (int) $item->qty_ordered;
                $received  = (int) $item->received_qty;
                $pct       = $ordered > 0 ? min(100, round(($received / $ordered) * 100)) : 0;
              @endphp
              <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);"></div>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted fw-semibold">Remaining:</span>
                <span class="badge px-3 py-2" style="background: {{ $remaining > 0 ? '#fef3c7' : '#d1fae5' }}; color: {{ $remaining > 0 ? '#92400e' : '#065f46' }}; border-radius: 8px; font-weight: 700;">
                  {{ $remaining }} units
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Status / Errors --}}
    @if ($remaining <= 0)
      <div class="alert border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <div>
            <div class="fw-bold mb-1" style="color: #065f46;">Item Fully Received</div>
            <div class="small" style="color: #047857;">This item has been completely received. No quantity remaining.</div>
          </div>
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

    {{-- Form --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="mb-0 fw-bold" style="color: #1a202c;">Receiving Information</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('pos.item.receive.store', $item->id) }}" class="row g-4" enctype="multipart/form-data">
          @csrf

          <div class="col-12 col-md-6">
            <label class="form-label small text-muted fw-semibold mb-2">
              Quantity to receive <span class="text-danger">*</span>
            </label>
            <div class="input-group" style="border-radius: 10px; overflow: hidden;">
              <span class="input-group-text bg-white" style="border: 2px solid #e5e7eb; border-right: 1px solid #e5e7eb;">
                <i class="bi bi-123 text-muted"></i>
              </span>
              <input
                name="qty"
                type="number"
                min="1"
                max="{{ $remaining }}"
                value="{{ max(1, $remaining) }}"
                class="form-control"
                {{ $remaining <= 0 ? 'disabled' : '' }}
                required
                id="qtyInput"
                style="border: 2px solid #e5e7eb; border-left: 1px solid #e5e7eb; border-right: none; font-weight: 700; box-shadow: none;"
              >
              <span class="input-group-text" style="background: #f3f4f6; border: 2px solid #e5e7eb; border-left: 1px solid #e5e7eb; font-weight: 600;">
                / {{ $remaining }}
              </span>
            </div>
            <div class="form-text small mt-2">
              <i class="bi bi-info-circle me-1"></i>Maximum allowed is the remaining quantity
            </div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label small text-muted fw-semibold mb-2">Date</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-calendar3"></i>
              </span>
              <input name="date" type="date" class="form-control ps-5" {{ $remaining <= 0 ? 'disabled' : '' }}
                     style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;">
            </div>
          </div>

          <div class="col-12">
            <label class="form-label small text-muted fw-semibold mb-2">Reference</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                <i class="bi bi-tag"></i>
              </span>
              <input
                name="reference"
                type="text"
                class="form-control ps-5"
                placeholder="PO-{{ $item->purchase_order_id }}"
                {{ $remaining <= 0 ? 'disabled' : '' }}
                style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
              >
            </div>
          </div>

          <div class="col-12">
            <label class="form-label small text-muted fw-semibold mb-2">Notes</label>
            <div class="position-relative">
              <span class="position-absolute top-0 start-0 ms-3 mt-3 text-muted">
                <i class="bi bi-text-left"></i>
              </span>
              <textarea name="notes" rows="3" class="form-control ps-5" {{ $remaining <= 0 ? 'disabled' : '' }}
                        placeholder="Optional delivery notes or observations..."
                        style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px;"></textarea>
            </div>
          </div>

          <div class="col-12">
            <label class="form-label small text-muted fw-semibold mb-2">GRN Attachment</label>
            <div class="position-relative">
              <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;">
                <i class="bi bi-paperclip"></i>
              </span>
              <input
                name="attachment"
                type="file"
                class="form-control ps-5"
                accept="image/*,application/pdf"
                {{ $remaining <= 0 ? 'disabled' : '' }}
                style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px 12px 40px; font-weight: 500;"
              >
            </div>
            <div class="form-text small mt-2">
              <i class="bi bi-info-circle me-1"></i>Upload a photo or PDF of the delivery note (optional)
            </div>
          </div>

          <div class="col-12">
            <hr style="border-color: #f1f3f5; margin: 1rem 0;">
          </div>

          <div class="col-12 d-flex justify-content-end gap-3">
            <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px; font-weight: 500; border: 2px solid #e5e7eb;">
              Cancel
            </a>
            <button class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" {{ $remaining <= 0 ? 'disabled' : '' }}
                    style="border-radius: 10px; font-weight: 500; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
              <i class="bi bi-check-circle"></i> Receive Items
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <style>
    .form-control:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    .input-group:focus-within {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
      border-radius: 10px;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover:not(:disabled) {
      transform: translateY(-1px);
    }
  </style>

  <script>
    // Soft clamp qty to [1, max] on input
    (function () {
      const qty = document.getElementById('qtyInput');
      if (!qty) return;
      qty.addEventListener('input', () => {
        const max = Number(qty.max || 0);
        let val = Number(qty.value || 0);
        if (val > max) val = max;
        if (val < 1)   val = 1;
        qty.value = val;
      }, { passive: true });
    })();
  </script>
</x-app-layout>