<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Bee Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
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

    /* Main Content Area */
    .main-content {
      margin-left: 280px;
      margin-top: 70px;
      padding: 0;
      min-height: calc(100vh - 70px);
      background-color: #f8fafc;
    }

    /* Breadcrumb */
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

    .breadcrumb-item {
      display: flex;
      align-items: center;
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

    /* Page Controls */
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

    /* Action Buttons */
    .actions-dropdown {
      position: relative;
    }

    .actions-btn {
      background-color: #60a5fa;
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

    .actions-btn:hover {
      background-color: #3b82f6;
    }

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

    .filter-input::placeholder {
      color: #9ca3af;
    }

    .import-btn {
      background-color: var(--success-green);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .import-btn:hover {
      background-color: #16a34a;
    }

    .new-product-btn {
      background-color: var(--primary-blue);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
    }

    .new-product-btn:hover {
      background-color: #2563eb;
    }

    /* Data Table */
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

    .data-table thead th:first-child {
      width: 50px;
      text-align: center;
    }

    .data-table thead th.sortable {
      cursor: pointer;
      user-select: none;
    }

    .data-table thead th.sortable:hover {
      background-color: #2563eb;
    }

    .data-table thead th .sort-icon {
      margin-left: 8px;
      opacity: 0.7;
    }

    .data-table tbody tr {
      border-bottom: 1px solid #f3f4f6;
    }

    .data-table tbody tr:hover {
      background-color: #f9fafb;
    }

    .data-table tbody td {
      padding: 16px;
      font-size: 14px;
      color: #374151;
      border: none;
    }

    .data-table tbody td:first-child {
      text-align: center;
    }

    .checkbox-input {
      width: 16px;
      height: 16px;
      cursor: pointer;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 48px;
      margin-bottom: 16px;
      opacity: 0.5;
    }

    .empty-state-text {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .empty-state-subtext {
      font-size: 14px;
      opacity: 0.8;
    }

    /* Pagination */
    .pagination-container {
      padding: 20px 24px;
      background: white;
      border-top: 1px solid #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
    }

    .pagination-info {
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
      font-size: 14px;
      background-color: white;
    }

    .page-info {
      font-size: 14px;
      color: #6b7280;
    }

    .pagination-controls {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .columns-btn {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }

    .columns-btn:hover {
      background-color: #e5e7eb;
    }

    .pagination-nav {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .pagination-btn {
      background: none;
      border: 1px solid #d1d5db;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      color: #6b7280;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
    }

    .pagination-btn:hover:not(:disabled) {
      background-color: #f3f4f6;
      color: #374151;
    }

    .pagination-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }

      .page-controls {
        flex-direction: column;
        align-items: stretch;
      }

      .left-controls,
      .right-controls {
        justify-content: center;
      }

      .filter-input {
        width: 100%;
      }

      .pagination-container {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
      }

      .pagination-controls {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .table-container {
        margin: 0 12px;
      }

      .breadcrumb-container,
      .page-controls {
        padding-left: 12px;
        padding-right: 12px;
      }

      .data-table thead th,
      .data-table tbody td {
        padding: 12px 8px;
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <!-- Include your header and sidebar here -->
    {{-- الهيدر --}}
    @include('layouts.navbar')

    {{-- السايدبار --}}
    @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./index.php"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    </div>

    <!-- Page Controls -->
    <div class="page-controls">
      <div class="left-controls">
        <!-- Actions Dropdown -->
        <div class="actions-dropdown">
          <button class="actions-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
            <i class="bi bi-chevron-down"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Selected</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Delete Selected</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Export Selected</a></li>
          </ul>
        </div>

        <!-- Status Filter -->
        <button class="status-filter active" type="button">
          Active
          <i class="bi bi-x"></i>
        </button>

        <!-- Additional Filter -->
        <button class="status-filter" type="button">
          <i class="bi bi-x"></i>
        </button>

        <!-- Sort Dropdown -->
        <div class="dropdown">
          <button class="status-filter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-chevron-down"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Name A-Z</a></li>
            <li><a class="dropdown-item" href="#">Name Z-A</a></li>
            <li><a class="dropdown-item" href="#">Price Low-High</a></li>
            <li><a class="dropdown-item" href="#">Price High-Low</a></li>
          </ul>
        </div>
      </div>

      <div class="right-controls">
        <!-- Filter Input -->
        <input type="text" class="filter-input" placeholder="Filter">

        <!-- Import Button -->
        <button class="import-btn" type="button" onclick="window.location.href='./products-import'">
          <i class="bi bi-download"></i>
          Import
        </button>

        <!-- New Product Button -->
        <button class="new-product-btn" type="button" onclick="window.location.href='./product-create'">
          New Product
        </button>
      </div>
    </div>
<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this client?
      </div>
      <div class="modal-footer">
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Data Table -->
    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>
              <input type="checkbox" class="checkbox-input" id="selectAll">
            </th>
            <th class="sortable">
              PRODUCT
              <i class="bi bi-arrow-up-down sort-icon"></i>
            </th>
            <th class="sortable">
              NOTES
              <i class="bi bi-arrow-up-down sort-icon"></i>
            </th>
            <th class="sortable">
              budgeted_hours
              <i class="bi bi-arrow-up-down sort-icon"></i>
            </th>
            <th class="sortable">
              client_id
              <i class="bi bi-arrow-up-down sort-icon"></i>
            </th>
            <th>Actions</th>
          </tr>
        </thead>
<tbody>
  @forelse($products as $product)
    <tr>
      <td><input type="checkbox" class="checkbox-input"></td>
      <td>{{ $product->name }}</td>
      <td>{{ $product->public_notes }}</td>
      <td>{{ number_format($product->budgeted_hours, 2) }}</td>
      <td>{{ $product->client_id }}</td>
      <td>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>

<button type="button"
        class="btn btn-sm btn-danger"
        onclick="confirmDelete({{ $product->id }})">
  Delete
</button>


</td>
    </tr>
  @empty
    <tr>
      <td colspan="5">
        <div class="empty-state">
          <div class="empty-state-icon">
            <i class="bi bi-box"></i>
          </div>
          <div class="empty-state-text">No records found</div>
          <div class="empty-state-subtext">Start by creating your first product</div>
        </div>
      </td>
    </tr>
  @endforelse
</tbody>

      </table>

      <!-- Pagination -->
      <div class="pagination-container">
        <div class="pagination-info">
          <select class="rows-select">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span>rows</span>
        </div>

        <div class="page-info">
          Page 1 of 1.0
        </div>

        <div class="pagination-controls">
          <button class="columns-btn" type="button">
            Columns
          </button>

          <div class="pagination-nav">
            <button class="pagination-btn" disabled>
              <i class="bi bi-chevron-double-left"></i>
            </button>
            <button class="pagination-btn" disabled>
              <i class="bi bi-chevron-left"></i>
            </button>
            <button class="pagination-btn" disabled>
              <i class="bi bi-chevron-right"></i>
            </button>
            <button class="pagination-btn" disabled>
              <i class="bi bi-chevron-double-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Select all checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function() {
      const checkboxes = document.querySelectorAll('tbody .checkbox-input');
      checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
      });
    });

    // Table sorting functionality
    document.querySelectorAll('.sortable').forEach(header => {
      header.addEventListener('click', function() {
        // Add sorting logic here
        console.log('Sorting by:', this.textContent.trim());
      });
    });

    // Filter input functionality
    document.querySelector('.filter-input').addEventListener('input', function() {
      // Add filtering logic here
      console.log('Filtering by:', this.value);
    });

    // Rows per page change
    document.querySelector('.rows-select').addEventListener('change', function() {
      // Add pagination logic here
      console.log('Rows per page:', this.value);
    });
  </script>
  <script>
  function confirmDelete(productId) {
    const form = document.getElementById('deleteForm');
    form.action = `/products/${productId}`;
    const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();
  }
</script>

</body>
</html>

