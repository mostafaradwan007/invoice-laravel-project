@extends('layouts.app')

@section('title', 'Payments')

@section('content')
 
{{-- Breadcrumb --}}
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./index.php"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Payment</li>
        </ol>
      </nav>
    </div>

    {{-- Page Controls --}}
    <div class="page-controls">
      <div class="left-controls">
        <div class="actions-dropdown">
          <button class="actions-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actions <i class="bi bi-chevron-down"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Selected</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Delete Selected</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i>Send Selected</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Export Selected</a></li>
          </ul>
        </div>
      </div>

      <div class="right-controls">
        <input type="text" class="filter-input" placeholder="Filter">

        <button class="import-btn" type="button" onclick="window.location.href='{{ route('payments.import') }}'">
          <i class="bi bi-download"></i> Import
        </button>

        <button class="new-Payment-btn" type="button" onclick="window.location.href='{{ route('payments.create') }}'">
          Add Payment
        </button>
      </div>
    </div>

    {{-- Data Table --}}
    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th><input type="checkbox" class="checkbox-input" id="selectAll"></th>
            <th>STATUS</th>
            <th>NUMBER</th>
            <th>CLIENT</th>
            <th>AMOUNT</th>
            <th>Payment NUMBER</th>
            <th style="text-align: right;"><i class="bi bi-calendar"></i> DATE</th>
            <th>TYPE</th>
            <th>TRANSACTION REFERENCE</th>
          </tr>
        </thead>
        <tbody>
  @forelse($payments as $payment)
    <tr>
      <td><input type="checkbox" class="checkbox-input"></td>
      <td><span class="status-badge {{ strtolower($payment->status) }}">{{ strtoupper($payment->status) }}</span></td>
      <td>{{ $payment->payment_number }}</td>
      <td>{{ $payment->client_name }}</td>
      <td>{{ number_format($payment->amount, 2) }}</td>
      <td>{{ $payment->payment_number }}</td>
      <td style="text-align:right;">{{ $payment->payment_date }}</td>
      <td>{{ $payment->payment_type }}</td>
      <td>{{ $payment->transaction_reference }}</td>
    </tr>
  @empty
    <tr>
      <td colspan="9"><div class="empty-state-text">No records found</div></td>
    </tr>
  @endforelse
</tbody>

      </table>

      {{-- Pagination --}}
      <div class="pagination-container">
                <div class="pagination-info">
                    <select id="rowsSelect" class="rows-select">
                        <option value="10" {{ request('per_page') == 10? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span>rows</span>
                </div>

                <div class="page-info">
                    Page {{ $payments->currentPage() }} of {{ $payments->lastPage() }}
                </div>

                <div class="pagination-controls">


                    @php
                        $q = request()->except('page'); // نحافظ على باقي الباراميترات
                        $firstUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => 1]));
                        $prevUrl = $payments->onFirstPage()
                            ? null
                            : request()->fullUrlWithQuery(array_merge($q, ['page' => $payments->currentPage() - 1]));
                        $nextUrl = $payments->hasMorePages()
                            ? request()->fullUrlWithQuery(array_merge($q, ['page' => $payments->currentPage() + 1]))
                            : null;
                        $lastUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => $payments->lastPage()]));
                    @endphp

                    <div class="pagination-nav">
                        <a href="{{ $payments->onFirstPage() ? '#' : $firstUrl }}"
                            class="pagination-btn {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>

                        <a href="{{ $prevUrl ?? '#' }}"
                            class="pagination-btn {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ $nextUrl ?? '#' }}"
                            class="pagination-btn {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ $payments->hasMorePages() ? $lastUrl : '#' }}"
                            class="pagination-btn {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    </div>

  <style>
    :root {
      --bee-yellow: #ffcc00;
      --bee-black: #1a1a1a;
      --bee-light-gray: #e5e7eb;
      --primary-blue: #3b82f6;
      --success-green: #22c55e;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8fafc;
      margin: 0;
    }

    .main-content {
      margin-left: 0px;
      margin-top: 0px;
      padding: 0;
      background-color: #f8fafc;
    }

    .breadcrumb-container {
      padding: 16px 24px;
      background: #f8fafc;
    }

    .breadcrumb {
      background: none;
      padding: 0;
      margin: 0;
      font-size: 14px;
    }

    .breadcrumb-item + .breadcrumb-item::before {
      content: ">";
      color: #6b7280;
      margin: 0 8px;
    }

    .breadcrumb-item a {
      color: #6b7280;
      text-decoration: none;
    }

    .breadcrumb-item.active {
      color: #1f2937;
      font-weight: 500;
    }

    .page-controls {
      padding: 0 24px 24px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }

    .left-controls {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .right-controls {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .actions-btn, .import-btn, .new-Payment-btn {
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .actions-btn { background-color: #60a5fa; }
    .actions-btn:hover { background-color: #3b82f6; }
    .import-btn { background-color: var(--success-green); }
    .import-btn:hover { background-color: #16a34a; }
    .new-Payment-btn { background-color: var(--primary-blue); }
    .new-Payment-btn:hover { background-color: #2563eb; }

    .status-filter {
      background-color: #e5e7eb;
      color: #374151;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .status-filter.active {
      background-color: #dbeafe;
      color: #1d4ed8;
    }

    .filter-input {
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 14px;
      width: 200px;
      background-color: white;
    }

    .filter-input::placeholder { color: #9ca3af; }

    .table-container {
      background: white;
      margin: 0 24px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .data-table {
      width: 100%;
      margin: 0;
      border-collapse: collapse;
    }

    .data-table thead {
      background-color: var(--primary-blue);
    }

    .data-table thead th {
      color: white;
      font-weight: 600;
      font-size: 14px;
      padding: 16px;
      text-align: left;
      border: none;
      position: relative;
    }

    .data-table thead th:first-child { width: 50px; text-align: center; }

    .data-table tbody tr { border-bottom: 1px solid #f3f4f6; }
    .data-table tbody tr:hover { background-color: #f9fafb; }
    .data-table tbody td { padding: 16px; font-size: 14px; color: #374151; border: none; }
    .data-table tbody td:first-child { text-align: center; }

    .checkbox-input { width: 16px; height: 16px; cursor: pointer; }

    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
    }

    .status-badge.draft { background-color: #f3f4f6; color: #6b7280; }
    .status-badge.sent { background-color: #dbeafe; color: #1d4ed8; }
    .status-badge.paid { background-color: #dcfce7; color: #166534; }
    .status-badge.overdue { background-color: #fee2e2; color: #dc2626; }

    .empty-state-text { text-align: center; padding: 60px 20px; color: #6b7280; font-size: 16px; font-weight: 500; }

    .    /* Pagination */
    .pagination-container {
      padding: 20px 24px;
      background: white;
      border-top: 1px solid #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .pagination-info, .page-info, .pagination-controls {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 14px;
      color: #6b7280;
    }

    .rows-select {
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 6px 8px;
    }

    .columns-btn, .pagination-btn {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }
    
    .pagination-nav { display: flex; gap: 4px; }
    .pagination-btn:disabled { opacity: 0.5; cursor: not-allowed; }


    .pagination-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
  padding: 12px 16px;
  border-top: 1px solid #ddd;
  background-color: #fafafa;
  font-size: 14px;
  flex-wrap: wrap;
  gap: 12px;
}

.pagination-btn.disabled {
  pointer-events: none;
  opacity: 0.5;
}


    @media (max-width: 768px) { .main-content { margin-left: 0; } }
    @media (max-width: 480px) { .table-container { margin: 0 12px; } }
  </style>

  <script>
    document.getElementById('selectAll').addEventListener('change', function() {
      document.querySelectorAll('tbody .checkbox-input').forEach(cb => cb.checked = this.checked);
    });
  </script>

@endsection
