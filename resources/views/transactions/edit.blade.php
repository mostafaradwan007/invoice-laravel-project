  @include('layouts.navbar')

  @include('layouts.sidebar')

  @section('content')
      <div class="main-content">
          <div class="breadcrumb-container">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                          <a href="{{ route('transactions.index') }}"><i class="bi bi-house-door"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transactions</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit Transaction</li>
                  </ol>
              </nav>
          </div>

          <div class="form-content">
              <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                  @csrf
                  @method('PUT') <!-- Important for update -->

                  <div class="form-section">
                      <h3 class="section-title">Edit Transaction</h3>

                      <div class="form-row">
                          <label class="form-label" for="type">Type</label>
                          <select class="form-select" name="type" id="type" required>
                              <option value="">-- Select Type --</option>
                              <option value="Deposit" {{ $transaction->deposit ? 'selected' : '' }}>Deposit</option>
                              <option value="Withdrawal" {{ $transaction->withdrawal ? 'selected' : '' }}>Withdrawal
                              </option>
                          </select>
                      </div>

                      <div class="form-row">
                          <label class="form-label" for="date">Date</label>
                          <input type="date" name="date" class="form-control" value="{{ $transaction->date }}"
                              required />
                      </div>

                      <div class="form-row">
                          <label class="form-label" for="amount">Amount</label>
                          <input type="number" class="form-control" name="amount"
                              value="{{ $transaction->deposit ?? $transaction->withdrawal }}" required>
                      </div>

                      <div class="form-row">
                          <label for="bank_account" class="form-label">Bank Account</label>
                          <input type="text" name="bank_account" value="{{ $transaction->bank_account }}">
                      </div>

                      <div class="form-row">
                          <label class="form-label" for="description">Description</label>
                          <textarea name="description" value="{{ $transaction->description }}"></textarea>
                      </div>

                      <div class="form-actions">
                          <a href="{{ route('transactions.index') }}" class="btn-cancel">Cancel</a>
                          <button type="submit" class="btn-save">Update Transaction</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  @endsection



  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>New Transaction - Bee Company</title>

      <!--for main and top header and breadcrumb-->


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

          /* Top Header Bar */
          .page-header {
              background: white;
              border-bottom: 1px solid var(--bee-light-gray);
              padding: 16px 24px;
              display: flex;
              align-items: center;
              justify-content: space-between;
          }

          .page-title-section {
              display: flex;
              align-items: center;
              gap: 16px;
          }

          .page-title {
              font-size: 18px;
              font-weight: 600;
              color: #1f2937;
              margin: 0;
          }

          .add-icon {
              background-color: #f3f4f6;
              border: none;
              width: 32px;
              height: 32px;
              border-radius: 6px;
              display: flex;
              align-items: center;
              justify-content: center;
              color: #6b7280;
              font-size: 16px;
          }

          .search-section {
              display: flex;
              align-items: center;
              gap: 12px;
          }

          .search-input {
              border: 1px solid #d1d5db;
              border-radius: 6px;
              padding: 8px 12px;
              font-size: 14px;
              width: 300px;
          }

          .search-input::placeholder {
              color: #9ca3af;
          }

          .ctrl-k-badge {
              background-color: #f3f4f6;
              border: 1px solid #d1d5db;
              border-radius: 4px;
              padding: 4px 8px;
              font-size: 12px;
              color: #6b7280;
          }

          .header-actions {
              display: flex;
              align-items: center;
              gap: 12px;
          }

          .unlock-pro-btn {
              background-color: var(--primary-blue);
              color: white;
              border: none;
              padding: 8px 16px;
              border-radius: 6px;
              font-size: 14px;
              font-weight: 500;
          }

          .save-btn {
              background-color: var(--primary-blue);
              color: white;
              border: none;
              padding: 8px 16px;
              border-radius: 6px;
              font-size: 14px;
              font-weight: 500;
          }

          .notification-btn {
              background: none;
              border: none;
              font-size: 18px;
              color: #6b7280;
              padding: 8px;
          }

          /* Breadcrumb */
          .breadcrumb-container {
              padding: 16px 24px;
              background: white;
              border-bottom: 1px solid var(--bee-light-gray);
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

          .breadcrumb-item+.breadcrumb-item::before {
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
          }

          /* Form Content */
          .form-content {
              padding: 32px 24px;
              width: 1000px;

              margin-left: auto;
              margin-right: auto;

          }


          .form-section {
              background: white;
              border-radius: 8px;
              padding: 24px;
              box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);

          }

          .section-title {
              font-size: 24px;
              font-weight: 600;
              color: #1f2937;
              margin-bottom: 20px;
          }



          .form-label {
              display: block;
              font-size: 30px;
              font-weight: 500;
              color: #374151;
              margin-bottom: 6px;
          }

          .form-control {
              width: 100%;
              border: 1px solid #d1d5db;
              border-radius: 6px;
              padding: 10px 12px;
              font-size: 16px;
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

          .form-row {
              display: flex;
              align-items: center;
              margin-top: 10px;
              gap: 10px;
              padding-bottom: 20px;
              /* spacing between label and select */
          }

          .form-row label {
              width: 200px;
              /* fixed width */
              margin: 0;
              font-size: 16px;
          }

          .form-row select,
          .form-row input {
              flex: 1;
              padding: 6px;
              border: 1px solid #ccc;
              border-radius: 5px;
              color: grey;

          }

          textarea {
              width: 100%;
              padding: 6px;
              margin-top: 4px;
              border: 1px solid #ccc;
              border-radius: 5px;
              box-sizing: border-box;
          }

          textarea {
              height: 60px;
              resize: vertical;
          }


          /*start buttons */
          .button-row {
              display: flex;
              justify-content: space-between;
              margin-top: 20px;

          }

          .button-row button {
              width: 30%;
              color: black;
              background-color: #ffcc00;
              border: none;
              padding: 10px 20px;
              border-radius: 6px;
              font-size: 14px;
              cursor: pointer;
              margin-top: 20px;
              margin-right: 10px;
          }

          .button-row button:hover {
              background-color: black;
              color: white;
          }

          /*end buttons */


          /* start close button */
          .close {
              position: absolute;
              top: 15px;
              right: 20px;
              font-size: 28px;
              cursor: pointer;
              color: #666;
          }


          .close:hover {
              color: #000;
          }

          .modal.hidden {
              display: none;
          }

          .modal {
              position: fixed;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background: rgba(0, 0, 0, 0.5);
              display: inline-flex;
              justify-content: center;
              align-items: center;
              z-index: 1000;
          }

          .modal-content {
              background: white;
              padding: 30px;
              width: 90%;
              max-width: 500px;
              max-height: 90%;
              overflow-y: auto;
              border-radius: 10px;
              position: relative;
          }

          .modal-content1 {
              background: white;
              padding: 30px;
              width: 97%;
              max-width: 1200px;
              max-height: 98%;
              overflow-y: auto;
              border-radius: 10px;
              position: relative;
          }



          .modal h3 {
              margin-top: 0;
              margin-bottom: 20px;
              color: #1f2937;
          }

          .modal label {
              display: block;
              margin-bottom: 5px;
              margin-top: 15px;
              font-weight: 500;
              color: #374151;
          }

          .modal input {
              width: 100%;
              padding: 10px;
              border: 1px solid #d1d5db;
              border-radius: 6px;
              font-size: 14px;
              box-sizing: border-box;
          }

          /* Form Actions */
          .form-actions {
              margin-top: 40px;
              padding-top: 24px;
              border-top: 1px solid #e5e7eb;
              display: flex;
              justify-content: flex-end;
              gap: 12px;
          }

          .btn-cancel {
              background-color: #f3f4f6;
              color: #374151;
              border: 1px solid #d1d5db;
              padding: 10px 20px;
              border-radius: 8px;
              font-size: 14px;
              font-weight: 500;
              cursor: pointer;
              text-decoration: none;
              display: inline-flex;
              align-items: center;
          }

          .btn-cancel:hover {
              background-color: #e5e7eb;
              color: #374151;
              text-decoration: none;
          }

          .btn-save {
              background-color: var(--primary-blue);
              color: white;
              border: none;
              padding: 10px 20px;
              border-radius: 8px;
              font-size: 14px;
              font-weight: 500;
              cursor: pointer;
          }

          .btn-save:hover {
              background-color: #ffcc00;
              ;
          }



          /* Responsive */
          @media (max-width: 768px) {
              .main-content {
                  margin-left: 0;
              }

              .form-row {
                  grid-template-columns: 1fr;
                  gap: 24px;
              }

              .page-header {
                  flex-direction: column;
                  gap: 16px;
                  align-items: stretch;
              }

              .search-input {
                  width: 100%;
              }
          }
      </style>
  </head>

  <body>
      <!-- Include your header and sidebar here -->
      @include('layouts.navbar')

      @include('layouts.sidebar')




      <?php $pageTitle = 'New Transaction'; ?>

      <!-- Main Content -->
      <div class="main-content">

          <!-- Breadcrumb -->
          <div class="breadcrumb-container">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                          <a href="./index.php"><i class="bi bi-house-door"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transactions</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit Transactions</li>
                  </ol>
              </nav>
          </div>


          <!-- Form Content -->
          <div class="form-content">
              <div class="tab-content" id="transactionsTabsContent">
                  <div class="tab-pane fade show active" id="create" role="tabpanel">
                      <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <!-- transactions Details -->
                          <div class="form-section">
                              <h3 class="section-title">Edit Transactions</h3>


                              <div class="form-row">
                                  <label class="form-label" for="type">Type</label>
                                  <select class="form-select" class="form-control" name="type" id="type"
                                      required>
                                      <option value="">-- Select Type --</option>
                                      <option value="Deposit" {{ $transaction->deposit ? 'selected' : '' }}>Deposit
                                      </option>
                                      <option value="Withdrawal" {{ $transaction->withdrawal ? 'selected' : '' }}>
                                          Withdrawal</option>
                                  </select>
                              </div>
                              <div class="form-row">
                                  <label class="form-label" for="date">Date</label>
                                  <input type="date" name="date" class="form-control"
                                      value="{{ $transaction->date }}" required />
                              </div>


                              <div class="form-row">
                                  <label class="form-label" for="amount">Amount</label>
                                  <input type="number" class="form-control" id="amount" name="amount"
                                      value="{{ $transaction->amount }}" required>
                              </div>


                              <div class="form-row">
                                  <label for="bank_account" class="form-label">Bank Account</label>
                                  <input type="text" name="bank_account" id="bank_account"
                                      value="{{ $transaction->bank_account }}" />
                              </div>


                              <div class="form-row">
                                  <label class="form-label" for="description">Description</label>
                                  <textarea name="description" id="description" value="{{ $transaction->description }}"></textarea>
                              </div>
                              <div class="form-actions">
                                  <a href="{{ route('transactions.index') }}" class="btn-cancel">Cancel</a>
                                  <button type="submit" class="btn-save">Save Transaction</button>
                              </div>


                          </div>

                      </form>
                  </div>
              </div>
          </div>



      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
          // Form submission
          document.getElementById('newClientForm').addEventListener('submit', function(e) {
              e.preventDefault();
              // Add form submission logic here
              console.log('Form submitted');
          });

          // Add contact functionality
          document.querySelector('.add-contact-link').addEventListener('click', function(e) {
              e.preventDefault();
              // Add logic to add new contact fields
              console.log('Add contact clicked');
          });

          // Copy billing to shipping address
          function copyBillingToShipping() {
              const billingFields = [
                  'billing_street', 'apt_suite', 'city',
                  'state_province', 'postal_code', 'country'
              ];
              const shippingFields = [
                  'shipping_street', 'shipping_apt_suite', 'shipping_city',
                  'shipping_state_province', 'shipping_postal_code', 'shipping_country'
              ];

              billingFields.forEach((field, index) => {
                  const billingValue = document.getElementById(field).value;
                  document.getElementById(shippingFields[index]).value = billingValue;
              });
          }
      </script>
      <script>
          const bankselect = document.getElementById("bankselect");
          const bankModal = document.getElementById("bankModal");

          const moreFieldsModal = document.getElementById("moreFieldsModal");

          bankSelect.addEventListener("change", function() {
              if (bankSelect.value === "new") {
                  bankModal.classList.remove("hidden");
                  bankModal.style.display = "flex";
              }
          });

          function closebankModal() {
              bankModal.classList.add("hidden");
              bankModal.style.display = "none";
              bankselect.value = "";
          }


          function savebank() {
              const name = document.getElementById("bankName").value;


              if (name === "") {
                  alert("Please enter a name.");
                  return;
              }

              const option = document.createElement("option");
              option.value = name.toLowerCase().replace(/\s+/g, '-');
              option.textContent = name;
              bankSelect.insertBefore(option, bankSelect.lastElementChild); // Add before "New bank"
              bankSelect.value = option.value;

              closeModal();

              // Clear form fields
              document.getElementById("bankName").value = "";

          }

          function closeMoreFields() {
              moreFieldsModal.classList.add("hidden");
              moreFieldsModal.style.display = "none";
          }
          window.addEventListener('click', function(event) {
              if (event.target === bankModal) {
                  closebankModal();
              }
              if (event.target === moreFieldsModal) {
                  closeMoreFields();
              }
          });
      </script>
  </body>

  </html>
