<?php>
<x-app-layout>
  <style>
    /* ===== Reorder Report Page Styles ===== */
    .reorder-report-page {
      padding: 0;
    }

    /* ===== Page Header ===== */
    .page-header {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
      border-radius: 24px;
      padding: 36px 44px;
      margin-bottom: 32px;
      position: relative;
      overflow: hidden;
    }

    .page-header::before {
      content: '';
      position: absolute;
      top: -60%;
      right: -15%;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: 5%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .page-header-content {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
    }

    .page-title-section {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .page-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(245, 158, 11, 0.4);
    }

    .page-icon i {
      font-size: 28px;
      color: white;
    }

    .page-title {
      color: white;
      font-size: 2.25rem;
      font-weight: 800;
      margin: 0 0 6px 0;
      letter-spacing: -0.5px;
    }

    .page-subtitle {
      color: #94a3b8;
      font-size: 1rem;
      margin: 0;
      font-weight: 500;
    }

    /* ===== Header Actions ===== */
    .header-actions {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: rgba(255, 255, 255, 0.25);
      color: white;
      transform: translateY(-2px);
    }

    .btn-export {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
    }

    .btn-export:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.45);
      color: white;
    }

    .btn-export i {
      font-size: 18px;
    }

    .btn-pdf {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.35);
    }

    .btn-pdf:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(239, 68, 68, 0.45);
      color: white;
    }

    .btn-pdf i {
      font-size: 18px;
    }

    .btn-email {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
      cursor: pointer;
    }

    .btn-email:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.45);
      color: white;
    }

    .btn-email i {
      font-size: 18px;
    }

    /* ===== Alert Styles ===== */
    .alert-custom {
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      border: none;
    }

    .alert-success-custom {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border: 1px solid #6ee7b7;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
    }

    .alert-error-custom {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      border: 1px solid #fecaca;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
    }

    .alert-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .alert-icon.success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .alert-icon.error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .alert-icon i {
      color: white;
      font-size: 22px;
    }

    .alert-content {
      flex: 1;
      font-size: 15px;
      font-weight: 500;
    }

    .alert-content.success { color: #065f46; }
    .alert-content.error { color: #991b1b; }

    .alert-close {
      background: rgba(0, 0, 0, 0.05);
      border: none;
      border-radius: 10px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .alert-close:hover {
      background: rgba(0, 0, 0, 0.1);
    }

    .alert-close i {
      font-size: 18px;
    }

    .alert-close.success { color: #065f46; }
    .alert-close.error { color: #991b1b; }

    /* ===== Summary Cards ===== */
    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 28px;
    }

    .summary-card {
      background: white;
      border-radius: 16px;
      padding: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .summary-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .summary-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
    }

    .summary-card.critical::before {
      background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
    }

    .summary-card.warning::before {
      background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
    }

    .summary-card.info::before {
      background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
    }

    .summary-card.success::before {
      background: linear-gradient(180deg, #10b981 0%, #059669 100%);
    }

    .summary-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .summary-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .summary-icon.critical {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .summary-icon.critical i {
      color: #dc2626;
    }

    .summary-icon.warning {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .summary-icon.warning i {
      color: #d97706;
    }

    .summary-icon.info {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }

    .summary-icon.info i {
      color: #2563eb;
    }

    .summary-icon.success {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .summary-icon.success i {
      color: #059669;
    }

    .summary-icon i {
      font-size: 22px;
    }

    .summary-value {
      font-size: 32px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1;
      margin-bottom: 4px;
    }

    .summary-label {
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
    }

    .summary-sub {
      font-size: 13px;
      color: #94a3b8;
      margin-top: 8px;
    }

    .summary-sub span {
      font-weight: 700;
      color: #475569;
    }

    /* ===== Search Card ===== */
    .search-card {
      background: white;
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 24px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }

    .search-form {
      display: flex;
      gap: 16px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .search-group {
      flex: 1;
      min-width: 280px;
    }

    .search-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #475569;
      margin-bottom: 8px;
    }

    .search-input-wrapper {
      position: relative;
    }

    .search-input-wrapper i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 18px;
    }

    .search-input {
      width: 100%;
      padding: 14px 16px 14px 48px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      color: #0f172a;
      transition: all 0.3s ease;
      background: #f8fafc;
    }

    .search-input:focus {
      outline: none;
      border-color: #6366f1;
      background: white;
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .search-input::placeholder {
      color: #94a3b8;
    }

    .btn-search {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 24px;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(15, 23, 42, 0.3);
    }

    .btn-clear {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 20px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      color: #64748b;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-clear:hover {
      border-color: #cbd5e1;
      color: #475569;
      background: #f8fafc;
    }

    /* ===== Data Card ===== */
    .data-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }

    .data-card:hover {
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .data-table-wrapper {
      overflow-x: auto;
    }

    /* ===== Table ===== */
    .data-table {
      width: 100%;
      border-collapse: collapse;
    }

    .data-table thead {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .data-table thead th {
      padding: 16px 20px;
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      text-align: left;
      white-space: nowrap;
    }

    .data-table thead th.text-center {
      text-align: center;
    }

    .data-table thead th.text-end {
      text-align: right;
    }

    .data-table tbody tr {
      transition: all 0.2s ease;
      border-bottom: 1px solid #f1f5f9;
    }

    .data-table tbody tr:hover {
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.02) 0%, rgba(239, 68, 68, 0.02) 100%);
    }

    .data-table tbody tr:last-child {
      border-bottom: none;
    }

    .data-table tbody tr.critical-row {
      background: linear-gradient(90deg, rgba(239, 68, 68, 0.04) 0%, transparent 100%);
    }

    .data-table tbody tr.critical-row:hover {
      background: linear-gradient(90deg, rgba(239, 68, 68, 0.08) 0%, transparent 100%);
    }

    .data-table tbody td {
      padding: 16px 20px;
      font-size: 14px;
      color: #334155;
      vertical-align: middle;
    }

    .data-table tbody td.text-center {
      text-align: center;
    }

    .data-table tbody td.text-end {
      text-align: right;
    }

    /* ===== SKU Cell ===== */
    .sku-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sku-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sku-icon.critical {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .sku-icon.critical i {
      color: #dc2626;
    }

    .sku-icon.warning {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .sku-icon.warning i {
      color: #d97706;
    }

    .sku-icon.normal {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .sku-icon.normal i {
      color: #059669;
    }

    .sku-icon i {
      font-size: 18px;
    }

    .sku-badge {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-weight: 700;
      color: #0f172a;
      font-size: 13px;
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      padding: 6px 12px;
      border-radius: 8px;
      letter-spacing: 0.5px;
    }

    /* ===== Product Cell ===== */
    .product-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .product-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }

    .product-icon i {
      color: white;
      font-size: 18px;
    }

    .product-info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .product-name {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
      max-width: 250px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .product-sku {
      font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
      font-size: 12px;
      color: #64748b;
    }

    /* ===== Warehouse Cell ===== */
    .warehouse-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .warehouse-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 10px rgba(20, 184, 166, 0.3);
    }

    .warehouse-icon i {
      color: white;
      font-size: 16px;
    }

    .warehouse-code {
      font-weight: 600;
      color: #0f172a;
      font-size: 14px;
    }

    /* ===== Stock Badge ===== */
    .stock-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
    }

    .stock-badge.critical {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .stock-badge.low {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .stock-badge.good {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .stock-badge i {
      font-size: 14px;
    }

    /* ===== Reorder Point ===== */
    .reorder-point {
      font-weight: 600;
      color: #64748b;
      font-size: 14px;
    }

    /* ===== Shortage Badge ===== */
    .shortage-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 700;
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .shortage-badge i {
      font-size: 14px;
    }

    /* ===== Action Button ===== */
    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(99, 102, 241, 0.3);
    }

    .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .btn-action i {
      font-size: 14px;
    }

    /* ===== Empty State ===== */
    .empty-state {
      padding: 80px 24px;
      text-align: center;
    }

    .empty-state-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      border-radius: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .empty-state-icon i {
      font-size: 44px;
      color: #059669;
    }

    .empty-state-title {
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .empty-state-text {
      color: #64748b;
      font-size: 15px;
      margin-bottom: 0;
    }

    /* ===== Table Footer ===== */
    .table-footer {
      padding: 20px 24px;
      border-top: 1px solid #f1f5f9;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .record-count {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #64748b;
    }

    .record-count span {
      font-weight: 700;
      color: #0f172a;
    }

    /* ===== Pagination ===== */
    .pagination {
      display: flex;
      gap: 6px;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .pagination .page-item .page-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 40px;
      padding: 0 14px;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      color: #64748b;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .pagination .page-item .page-link:hover {
      background: #f8fafc;
      border-color: #6366f1;
      color: #6366f1;
    }

    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      border-color: transparent;
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .pagination .page-item.disabled .page-link {
      background: #f8fafc;
      border-color: #e2e8f0;
      color: #cbd5e1;
      cursor: not-allowed;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1200px) {
      .summary-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .page-header {
        padding: 28px;
      }

      .page-title {
        font-size: 1.75rem;
      }

      .page-header-content {
        flex-direction: column;
        align-items: flex-start;
      }

      .page-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }

      .header-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-export,
      .btn-pdf,
      .btn-email {
        width: 100%;
        justify-content: center;
      }

      .summary-grid {
        grid-template-columns: 1fr;
      }

      .search-form {
        flex-direction: column;
      }

      .search-group {
        width: 100%;
        min-width: unset;
      }

      .btn-search,
      .btn-clear {
        width: 100%;
        justify-content: center;
      }

      .data-table-wrapper {
        overflow-x: auto;
      }

      .data-table {
        min-width: 800px;
      }

      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>

  @php
    $rows = $rows ?? collect();
    $q = $q ?? '';
    
    // Calculate stats
    $totalItems = method_exists($rows, 'total') ? $rows->total() : $rows->count();
    $criticalCount = $rows->filter(function($r) {
      return (int)$r->on_hand <= ((int)$r->reorder_point * 0.5);
    })->count();
    $warningCount = $rows->filter(function($r) {
      return (int)$r->on_hand > ((int)$r->reorder_point * 0.5) && (int)$r->on_hand < (int)$r->reorder_point;
    })->count();
    $totalShortage = $rows->sum(function($r) {
      return max(0, (int)$r->reorder_point - (int)$r->on_hand);
    });
  @endphp

  <div class="reorder-report-page">
    {{-- Page Header --}}
    <div class="page-header">
      <div class="page-header-content">
        <div class="page-title-section">
          <div class="page-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <div>
            <h1 class="page-title">Reorder Report</h1>
            <p class="page-subtitle">Items below minimum stock threshold requiring attention</p>
          </div>
        </div>
        <div class="header-actions">
          <form method="POST" action="{{ route('reports.email.lowstock') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn-email">
              <i class="bi bi-envelope"></i>
              Email Report
            </button>
          </form>
          <a href="{{ route('reports.export', 'reorder') }}?q={{ $q }}" class="btn-export">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Export CSV
          </a>
          <a href="{{ route('reports.export.pdf', 'reorder') }}" class="btn-pdf" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i>
            Download PDF
          </a>
        </div>
      </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
      <div class="alert-custom alert-success-custom">
        <div class="alert-icon success">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content success">{{ session('success') }}</div>
        <button type="button" class="alert-close success" onclick="this.parentElement.remove()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    @endif

    {{-- Summary Cards --}}
    <div class="summary-grid">
      {{-- Total Items --}}
      <div class="summary-card critical">
        <div class="summary-card-header">
          <div class="summary-icon critical">
            <i class="bi bi-exclamation-circle-fill"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalItems) }}</div>
        <div class="summary-label">Items Below Reorder</div>
        <div class="summary-sub">
          Needs <span>immediate attention</span>
        </div>
      </div>

      {{-- Critical Items --}}
      <div class="summary-card warning">
        <div class="summary-card-header">
          <div class="summary-icon warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($criticalCount) }}</div>
        <div class="summary-label">Critical Level</div>
        <div class="summary-sub">
          Stock at <span>≤50%</span> of reorder point
        </div>
      </div>

      {{-- Warning Items --}}
      <div class="summary-card info">
        <div class="summary-card-header">
          <div class="summary-icon info">
            <i class="bi bi-clock-history"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($warningCount) }}</div>
        <div class="summary-label">Low Stock Warning</div>
        <div class="summary-sub">
          Stock <span>below threshold</span>
        </div>
      </div>

      {{-- Total Shortage --}}
      <div class="summary-card success">
        <div class="summary-card-header">
          <div class="summary-icon success">
            <i class="bi bi-arrow-repeat"></i>
          </div>
        </div>
        <div class="summary-value">{{ number_format($totalShortage) }}</div>
        <div class="summary-label">Total Units Needed</div>
        <div class="summary-sub">
          To reach <span>reorder points</span>
        </div>
      </div>
    </div>

    {{-- Search Card --}}
    <div class="search-card">
      <form method="GET" class="search-form">
        <div class="search-group">
          <label class="search-label">Search Products</label>
          <div class="search-input-wrapper">
            <i class="bi bi-search"></i>
            <input 
              type="text" 
              name="q" 
              class="search-input" 
              value="{{ $q }}" 
              placeholder="Search by SKU or product name..."
            >
          </div>
        </div>
        <button type="submit" class="btn-search">
          <i class="bi bi-funnel"></i>
          Filter
        </button>
        @if($q)
          <a href="{{ route('reports.reorder') }}" class="btn-clear">
            <i class="bi bi-x-lg"></i>
            Clear
          </a>
        @endif
      </form>
    </div>

    {{-- Data Table --}}
    <div class="data-card">
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Status</th>
              <th>SKU</th>
              <th>Product</th>
              <th>Warehouse</th>
              <th class="text-end">On Hand</th>
              <th class="text-end">Reorder Point</th>
              <th class="text-end">Shortage</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rows as $r)
              @php
                $onHand = (int)$r->on_hand;
                $reorderPoint = (int)$r->reorder_point;
                $isCritical = $onHand <= ($reorderPoint * 0.5);
                $isBelow = $onHand < $reorderPoint;
                $shortage = max(0, $reorderPoint - $onHand);
                $statusClass = $isCritical ? 'critical' : ($isBelow ? 'warning' : 'normal');
                $statusIcon = $isCritical ? 'bi-exclamation-diamond-fill' : ($isBelow ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill');
                $stockClass = $isCritical ? 'critical' : ($isBelow ? 'low' : 'good');
              @endphp
              <tr class="{{ $isCritical ? 'critical-row' : '' }}">
                {{-- Status Icon --}}
                <td>
                  <div class="sku-icon {{ $statusClass }}">
                    <i class="bi {{ $statusIcon }}"></i>
                  </div>
                </td>

                {{-- SKU --}}
                <td>
                  <span class="sku-badge">{{ $r->sku }}</span>
                </td>

                {{-- Product --}}
                <td>
                  <div class="product-cell">
                    <div class="product-icon">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <span class="product-name" title="{{ $r->name }}">{{ $r->name }}</span>
                  </div>
                </td>

                {{-- Warehouse --}}
                <td>
                  <div class="warehouse-cell">
                    <div class="warehouse-icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <span class="warehouse-code">{{ $r->wh ?? '—' }}</span>
                  </div>
                </td>

                {{-- On Hand --}}
                <td class="text-end">
                  <span class="stock-badge {{ $stockClass }}">
                    <i class="bi {{ $isCritical ? 'bi-exclamation-circle-fill' : ($isBelow ? 'bi-dash-circle' : 'bi-check-circle') }}"></i>
                    {{ number_format($onHand) }}
                  </span>
                </td>

                {{-- Reorder Point --}}
                <td class="text-end">
                  <span class="reorder-point">{{ number_format($reorderPoint) }}</span>
                </td>

                {{-- Shortage --}}
                <td class="text-end">
                  @if($shortage > 0)
                    <span class="shortage-badge">
                      <i class="bi bi-arrow-down"></i>
                      {{ number_format($shortage) }}
                    </span>
                  @else
                    <span style="color: #10b981; font-weight: 600;">—</span>
                  @endif
                </td>

                {{-- Action --}}
                <td class="text-end">
                  <a 
                    href="{{ route('movements.create', [
                      'product_id' => $r->product_id ?? null,
                      'type' => 'IN',
                      'reference' => 'REPLEN',
                      'return' => url()->current(),
                    ]) }}" 
                    class="btn-action"
                  >
                    <i class="bi bi-plus-circle"></i>
                    Restock
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4 class="empty-state-title">All Stock Levels Healthy</h4>
                    <p class="empty-state-text">No items are currently below their reorder points. Great job maintaining inventory!</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Table Footer --}}
      @if($rows->count() > 0)
        <div class="table-footer">
          <div class="record-count">
            Showing <span>{{ $rows->count() }}</span> items
            @if(method_exists($rows, 'total'))
              of <span>{{ $rows->total() }}</span> total
            @endif
          </div>
          @if(method_exists($rows, 'links'))
            {{ $rows->links() }}
          @endif
        </div>
      @endif
    </div>
  </div>
</x-app-layout>