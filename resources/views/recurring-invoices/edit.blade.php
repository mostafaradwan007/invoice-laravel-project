<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Invoice - Bee Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --bee-yellow: #ffcc00;
      --bee-black: #1a1a1a;
      --bee-light-gray: #e5e7eb;
      --primary-blue: #3b82f6;
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

    /* Tab Navigation */
    .tab-navigation {
      background: white;
      border-bottom: 1px solid var(--bee-light-gray);
      padding: 0 24px;
    }

    .nav-tabs {
      border-bottom: none;
    }

    .nav-tabs .nav-link {
      border: none;
      color: #6b7280;
      padding: 16px 20px;
      font-size: 14px;
      font-weight: 500;
      border-bottom: 2px solid transparent;
    }

    .nav-tabs .nav-link.active {
      color: var(--primary-blue);
      background: none;
      border-bottom: 2px solid var(--primary-blue);
    }

    .nav-tabs .nav-link:hover {
      color: var(--primary-blue);
      border-color: transparent;
    }

    /* Form Content */
    .form-content {
      padding: 32px 24px;
      background: white;
    }

    .form-section {
      margin-bottom: 32px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 20px;
    }

    /* Form Fields */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      margin-bottom: 6px;
    }

    .form-control {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 10px 12px;
      font-size: 14px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-select {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 10px 12px;
      font-size: 14px;
      background-color: white;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 8px center;
      background-repeat: no-repeat;
      background-size: 16px;
      padding-right: 40px;
      appearance: none;
    }

    .form-select:focus {
      outline: none;
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Client Section */
    .client-section {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 24px;
      margin-bottom: 32px;
    }

    .client-dropdown {
      position: relative;
    }

    .client-dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      max-height: 200px;
      overflow-y: auto;
    }

    .client-dropdown-item {
      padding: 12px;
      cursor: pointer;
      border-bottom: 1px solid #f3f4f6;
    }

    .client-dropdown-item:hover {
      background-color: #f9fafb;
    }

    .new-client-btn {
      color: var(--primary-blue);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
    }

    .no-records {
      color: #6b7280;
      font-style: italic;
      padding: 12px;
    }

    /* Invoice Details Grid */
    .invoice-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 32px;
    }

    .invoice-details-left {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .invoice-details-right {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    /* Date Input with Calendar Icon */
    .date-input-group {
      position: relative;
    }

    .date-input-group .form-control {
      padding-right: 40px;
    }

    .date-input-group .calendar-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
      pointer-events: none;
    }

    /* Products/Tasks Section */
    .products-section {
      margin-bottom: 32px;
    }

    .products-tabs {
      margin-bottom: 20px;
    }

    .products-tabs .nav-tabs {
      border-bottom: 1px solid #e5e7eb;
    }

    .products-tabs .nav-link {
      padding: 8px 16px;
      font-size: 14px;
      color: var(--primary-blue);
      border: none;
      border-bottom: 2px solid transparent;
    }

    .products-tabs .nav-link.active {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--primary-blue);
      background: none;
    }

    /* Products Table */
    .products-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .products-table thead {
      background-color: var(--primary-blue);
    }

    .products-table thead th {
      color: white;
      font-weight: 600;
      font-size: 14px;
      padding: 12px;
      text-align: left;
      border: none;
    }

    .products-table tbody td {
      padding: 12px;
      border-bottom: 1px solid #f3f4f6;
      font-size: 14px;
    }

    .add-item-btn {
      background: none;
      border: none;
      color: var(--primary-blue);
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px;
      cursor: pointer;
    }

    .add-item-btn:hover {
      background-color: #f9fafb;
    }

    /* Notes and Summary Section */
    .bottom-section {
      display: grid;
      grid-template-columns: 1fr 300px;
      gap: 32px;
    }

    .notes-section {
      background: #f9fafb;
      border-radius: 8px;
      padding: 20px;
    }

    .notes-tabs {
      margin-bottom: 16px;
    }

    .notes-tabs .nav-tabs {
      border-bottom: 1px solid #e5e7eb;
    }

    .notes-tabs .nav-link {
      padding: 6px 12px;
      font-size: 13px;
      color: var(--primary-blue);
      border: none;
      border-bottom: 2px solid transparent;
    }

    .notes-tabs .nav-link.active {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--primary-blue);
      background: none;
    }

    /* Summary Section */
    .summary-section {
      background: #f9fafb;
      border-radius: 8px;
      padding: 20px;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      font-size: 14px;
    }

    .summary-row.total {
      font-weight: 600;
      font-size: 16px;
      border-top: 1px solid #e5e7eb;
      padding-top: 12px;
      margin-top: 8px;
    }

    .summary-label {
      color: #374151;
    }

    .summary-value {
      color: #1f2937;
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }

      .client-section {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .invoice-details {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .invoice-details-left,
      .invoice-details-right {
        grid-template-columns: 1fr;
      }

      .bottom-section {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .form-content {
        padding: 20px 16px;
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
          <li class="breadcrumb-item">
            <a href="./invoices.php">Recurring Invoices</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">New Recurring Invoice</li>
        </ol>
      </nav>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
      <ul class="nav nav-tabs" id="invoiceTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab">
            Create
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
            Documents
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            Settings
          </button>
        </li>
      </ul>
    </div>

<!-- Form Content -->
<!-- Form Content -->
    <div class="form-content">
      <div class="tab-content" id="invoiceTabsContent">
        <div class="tab-pane fade show active" id="create" role="tabpanel">
          <form action="{{ route('recurring-invoices.update', $invoice->id) }}" method="POST" id="editInvoiceForm">
            @csrf
            @method('PUT')
            <!-- Client Section -->
            <div class="client-section">
              <div class="form-group">
                <label class="form-label" for="client">Client</label>
                <div class="client-dropdown">
                  <select class="form-control" name="client_id" required>
                    <option value="">Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                          {{ $client->name }}
                        </option>
                    @endforeach
                  </select>
                  <div class="client-dropdown-menu" style="display: none;">
                    <div class="client-dropdown-item">
                      <a href="./client-create.php" class="new-client-btn">New Client</a>
                    </div>
                    <div class="no-records">No records found</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Invoice Details -->
            <div class="invoice-details">
              <div class="invoice-details-left">
                <div class="form-group">
                  <label class="form-label" for="invoice_date">Invoice Date</label>
                  <div class="date-input-group">
                    <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                           value="{{ $invoice->invoice_date }}" required>
                    <i class="bi bi-calendar calendar-icon"></i>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="due_date">Due Date</label>
                  <div class="date-input-group">
                    <input type="date" class="form-control" id="due_date" name="due_date"
                           value="{{ $invoice->due_date }}">
                    <i class="bi bi-calendar calendar-icon"></i>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="partial_deposit">Partial/Deposit</label>
                  <input type="number" class="form-control" id="partial_deposit" name="partial_deposit"
                         min="0" step="0.01" value="{{ $invoice->partial_deposit ?? 0 }}">
                </div>

                <div class="form-group">
                  <label class="form-label" for="subtotal">Subtotal</label>
                  <input type="number" class="form-control" id="subtotal" name="subtotal"
                         min="0" step="0.01" value="{{ $invoice->subtotal ?? 0 }}" >
                </div>

                <div class="form-group">
                  <label class="form-label" for="total">Total</label>
                  <input type="number" class="form-control" id="total" name="total"
                         min="0" step="0.01" value="{{ $invoice->total ?? 0 }}" >
                </div>
              </div>

              <div class="invoice-details-right">
                <div class="form-group">
                  <label class="form-label" for="invoice_number">Invoice #</label>
                  <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                         value="{{ $invoice->invoice_number }}" required>
                </div>

                <div class="form-group">
                  <label class="form-label" for="po_number">PO #</label>
                  <input type="text" class="form-control" id="po_number" name="po_number"
                         value="{{ $invoice->po_number }}">
                </div>

                <div class="form-group">
                  <label class="form-label" for="discount">Discount</label>
                  <div style="display: flex; gap: 8px;">
                    <input type="number" class="form-control" id="discount" name="discount"
                           min="0" step="0.01" value="{{ $invoice->discount ?? 0 }}">
                    <select class="form-select" name="discount_type" style="width: auto;">
                      <option value="amount" {{ ($invoice->discount_type ?? 'amount') == 'amount' ? 'selected' : '' }}>Amount</option>
                      <option value="percent" {{ ($invoice->discount_type ?? 'amount') == 'percent' ? 'selected' : '' }}>Percent</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="paid_to_date">Paid to Date</label>
                  <input type="number" class="form-control" id="paid_to_date" name="paid_to_date"
                         min="0" step="0.01" value="{{ $invoice->paid_to_date ?? 0 }}">
                </div>

                <div class="form-group">
                  <label class="form-label" for="balance_due">Balance Due</label>
                  <input type="number" class="form-control" id="balance_due" name="balance_due"
                         min="0" step="0.01" value="{{ $invoice->balance_due ?? 0 }}" >
                </div>
              </div>
            </div>

            <!-- Notes and Terms Section -->
            <div class="notes-section" style="margin-top: 20px;">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="public_notes">Public Notes</label>
                    <textarea class="form-control" id="public_notes" name="public_notes" rows="3"
                              placeholder="Notes visible to client">{{ $invoice->public_notes }}</textarea>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="terms">Terms</label>
                    <textarea class="form-control" id="terms" name="terms" rows="3"
                              placeholder="Payment terms and conditions">{{ $invoice->terms }}</textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="private_notes">Private Notes</label>
                    <textarea class="form-control" id="private_notes" name="private_notes" rows="3"
                              placeholder="Internal notes (not visible to client)">{{ $invoice->private_notes }}</textarea>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="footer">Footer</label>
                    <textarea class="form-control" id="footer" name="footer" rows="3"
                              placeholder="Invoice footer text">{{ $invoice->footer }}</textarea>
                  </div>
                </div>
              </div>
            </div>

            <div style="margin-top: 20px; text-align: right;">
              <a href="{{ route('recurring-invoices.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Cancel
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Update
              </button>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="documents" role="tabpanel">
          <p>Documents content will go here</p>
        </div>

        <div class="tab-pane fade" id="settings" role="tabpanel">
          <p>Settings content will go here</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Add item functionality
    document.querySelectorAll('.add-item-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        // Add new row logic here
        console.log('Adding new item/task');
      });
    });

    // Client dropdown functionality
    document.getElementById('client').addEventListener('click', function() {
      const dropdown = this.parentElement.querySelector('.client-dropdown-menu');
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.querySelector('.client-dropdown-menu');
      const select = document.getElementById('client');
      if (!select.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });

    // Form submission
    document.getElementById('newInvoiceForm').addEventListener('submit', function(event) {
      event.preventDefault();
      console.log('Invoice form submitted');
      // Add form submission logic here
    });
  </script>
</body>
</html>

