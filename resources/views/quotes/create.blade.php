@extends('layouts.app')

@section('title', 'New Quote - Bee Company')

@section('content')
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
    margin-top: 0px;
    padding: 20px 30px;
    min-height: calc(100vh - 70px);
    background-color: #f8fafc;}

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
      margin-top: 0px;
    }

    .form-section {
      margin-bottom: 32px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 20px;
      margin-top: 0px;
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

    /* Quote Details Grid */
    .Quote-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 32px;
    }

    .Quote-details-left {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .Quote-details-right {
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
      
      .Quote-details {
        grid-template-columns: 1fr;
        gap: 20px;
      }
      
      .Quote-details-left,
      .Quote-details-right {
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

<div class="main-content">
  <!-- Breadcrumb -->
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('quotes.index') }}">Quotes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">New Quote</li>
      </ol>
    </nav>
  </div>

  <div class="tab-navigation">
    <ul class="nav nav-tabs" id="QuoteTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab">Create</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">Documents</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">Settings</button>
      </li>
    </ul>
  </div>

  <div class="form-content">
    <div class="tab-content" id="QuoteTabsContent">
      <div class="tab-pane fade show active" id="create" role="tabpanel">
        <form action="{{ route('quotes.store') }}" method="POST" id="newQuoteForm">
          @csrf

          <!-- Client Section -->
          <div class="client-section">
            <div class="form-group">
              <label class="form-label" for="client_id">Client</label>
              <select class="form-select" id="client_id" name="client_id" required>
                <option value="">Select client...</option>
                @foreach($clients as $client)
                  <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
              </select>
              <a href="{{ route('client.create') }}" class="new-client-btn">New Client</a>
            </div>
          </div>

          <!-- Quote Details -->
          <div class="Quote-details">
            <div class="Quote-details-left">
              <div class="form-group">
                <label class="form-label" for="quote_date">Quote Date</label>
                <input type="date" class="form-control" id="quote_date" name="quote_date" value="{{ old('quote_date', date('Y-m-d')) }}" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="due_date">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date">
              </div>
              <div class="form-group">
                <label class="form-label" for="partial_deposit">Partial/Deposit</label>
                <input type="number" class="form-control" id="partial_deposit" name="partial_deposit" min="0" step="0.01">
              </div>
            </div>

            <div class="Quote-details-right">
              <div class="form-group">
                <label class="form-label" for="quote_number">Quote #</label>
                <input type="text" class="form-control" id="quote_number" name="quote_number" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="po_number">PO #</label>
                <input type="text" class="form-control" id="po_number" name="po_number">
              </div>
              <div class="form-group">
                <label class="form-label" for="discount">Discount</label>
                <div style="display:flex; gap:8px;">
                  <input type="number" class="form-control" id="discount" name="discount" min="0" step="0.01">
                  <select class="form-select" name="discount_type" id="discount-type" style="width:auto;">
                    <option value="amount">Amount</option>
                    <option value="percent">Percent</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Products/Tasks Section -->
          <div class="products-section">
            <div class="products-tabs">
              <ul class="nav nav-tabs" id="productsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">Products</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab">Tasks</button>
                </li>
              </ul>
            </div>

            <div class="tab-content" id="productsTabsContent">
              <!-- Products Table -->
              <div class="tab-pane fade show active" id="products" role="tabpanel">
                <table class="products-table" id="products-table">
                  <thead>
                    <tr>
                      <th>ITEM</th>
                      <th>DESCRIPTION</th>
                      <th>UNIT COST</th>
                      <th>QUANTITY</th>
                      <th>LINE TOTAL</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody id="products-body"></tbody>
                </table>
                <button type="button" class="add-item-btn" id="add-product-btn">
                  <i class="bi bi-plus"></i> Add Product
                </button>
              </div>

              <!-- Tasks Table -->
              <div class="tab-pane fade" id="tasks" role="tabpanel">
                <table class="products-table" id="tasks-table">
                  <thead>
                    <tr>
                      <th>TASK</th>
                      <th>DESCRIPTION</th>
                      <th>RATE</th>
                      <th>HOURS</th>
                      <th>LINE TOTAL</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody id="tasks-body"></tbody>
                </table>
                <button type="button" class="add-item-btn" id="add-task-btn">
                  <i class="bi bi-plus"></i> Add Task
                </button>
              </div>
            </div>
          </div>

          <!-- Notes and Summary -->
          <div class="bottom-section">
            <div class="notes-section">
              <ul class="nav nav-tabs" id="notesTabs" role="tablist">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#public-notes" type="button">Public Notes</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#private-notes" type="button">Private Notes</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#terms" type="button">Terms</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#footer" type="button">Footer</button>
                </li>
              </ul>

              <div class="tab-content mt-3">
                <div class="tab-pane fade show active" id="public-notes">
                  <textarea class="form-control" name="public_notes" rows="4"></textarea>
                </div>
                <div class="tab-pane fade" id="private-notes">
                  <textarea class="form-control" name="private_notes" rows="4"></textarea>
                </div>
                <div class="tab-pane fade" id="terms">
                  <textarea class="form-control" name="terms" rows="4"></textarea>
                </div>
                <div class="tab-pane fade" id="footer">
                  <textarea class="form-control" name="footer" rows="4"></textarea>
                </div>
              </div>
            </div>

            <div class="summary-section">
              <div class="summary-row"><span class="summary-label">Subtotal</span> <span class="summary-value">$ 0.00</span></div>
              <div class="summary-row total"><span class="summary-label">Total</span> <span class="summary-value">$ 0.00</span></div>
              <div class="summary-row"><span class="summary-label">Paid to Date</span> <span class="summary-value">$ 0.00</span></div>
              <div class="summary-row"><span class="summary-label">Balance Due</span> <span class="summary-value">$ 0.00</span></div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mt-3">Save Quote</button>
        </form>
      </div>

      <div class="tab-pane fade" id="documents" role="tabpanel"><p>Documents content will go here</p></div>
      <div class="tab-pane fade" id="settings" role="tabpanel"><p>Settings content will go here</p></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function formatCurrency(value) {
  return '$ ' + parseFloat(value || 0).toFixed(2);
}

function recalcSummary() {
  let subtotal = 0;
  document.querySelectorAll('#products-body tr.data-row, #tasks-body tr.data-row').forEach(row => {
    const qty = parseFloat(row.querySelector('.quantity')?.value || row.querySelector('.hours')?.value || 0);
    const cost = parseFloat(row.querySelector('.unit-cost')?.value || row.querySelector('.rate')?.value || 0);
    row.querySelector('.line-total').textContent = (qty*cost).toFixed(2);
    subtotal += qty*cost;
  });

  const discountVal = parseFloat(document.getElementById('discount').value) || 0;
  const discountType = document.getElementById('discount-type').value || 'amount';
  let total = subtotal;
  if(discountType==='percent') total = subtotal - subtotal*discountVal/100;
  else total -= discountVal;

  const paid = parseFloat(document.getElementById('partial_deposit').value) || 0;
  const balance = total - paid;

  document.querySelector('.summary-row:nth-child(1) .summary-value').textContent = formatCurrency(subtotal);
  document.querySelector('.summary-row.total .summary-value').textContent = formatCurrency(total);
  document.querySelector('.summary-row:nth-child(3) .summary-value').textContent = formatCurrency(paid);
  document.querySelector('.summary-row:nth-child(4) .summary-value').textContent = formatCurrency(balance);
}

function createRow(type='product'){
  const tableBody = document.getElementById(type==='product'?'products-body':'tasks-body');
  const tr = document.createElement('tr'); tr.classList.add('data-row');

  if(type==='product'){
    tr.innerHTML = `<td><input type="text" name="products_name[]" class="form-control item-name" required></td>
                    <td><input type="text" name="products_description[]" class="form-control item-desc"></td>
                    <td><input type="number" name="products_unit_cost[]" class="form-control unit-cost" min="0" step="0.01" required></td>
                    <td><input type="number" name="products_quantity[]" class="form-control quantity" min="0" step="1" required></td>
                    <td class="line-total">0.00</td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">×</button></td>`;
  }else{
    tr.innerHTML = `<td><input type="text" name="tasks[name][]" class="form-control task-name" required></td>
                    <td><input type="text" name="tasks[description][]" class="form-control task-desc"></td>
                    <td><input type="number" name="tasks[rate][]" class="form-control rate" min="0" step="0.01" required></td>
                    <td><input type="number" name="tasks[hours][]" class="form-control hours" min="0" step="0.01" required></td>
                    <td class="line-total">0.00</td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">×</button></td>`;
  }

  tableBody.appendChild(tr);

  tr.querySelectorAll('input').forEach(input=>{ input.addEventListener('input', recalcSummary); });
  tr.querySelector('.remove-row').addEventListener('click',()=>{tr.remove(); recalcSummary();});
}

document.getElementById('add-product-btn').addEventListener('click',()=>createRow('product'));
document.getElementById('add-task-btn').addEventListener('click',()=>createRow('task'));
document.getElementById('discount').addEventListener('input', recalcSummary);
document.getElementById('discount-type').addEventListener('change', recalcSummary);
document.getElementById('partial_deposit').addEventListener('input', recalcSummary);

// Initialize first row
createRow('product');
</script>

@endsection
