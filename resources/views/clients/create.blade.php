<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Client - Bee Company</title>
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
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 32px;
      margin-bottom: 48px;
    }

    .form-section {
      background: white;
      border-radius: 8px;
      padding: 24px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 20px;
    }

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

    /* Toggle Switch */
    .toggle-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .toggle-switch {
      position: relative;
      width: 44px;
      height: 24px;
    }

    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .toggle-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #d1d5db;
      transition: 0.2s;
      border-radius: 24px;
    }

    .toggle-slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      transition: 0.2s;
      border-radius: 50%;
    }

    input:checked + .toggle-slider {
      background-color: var(--primary-blue);
    }

    input:checked + .toggle-slider:before {
      transform: translateX(20px);
    }

    /* Address Tabs */
    .address-tabs {
      margin-bottom: 20px;
    }

    .address-tabs .nav-tabs {
      border-bottom: 1px solid #e5e7eb;
    }

    .address-tabs .nav-link {
      padding: 8px 16px;
      font-size: 13px;
      color: var(--primary-blue);
      border: none;
      border-bottom: 2px solid transparent;
    }

    .address-tabs .nav-link.active {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--primary-blue);
      background: none;
    }

    /* Add Contact Link */
    .add-contact-link {
      color: var(--primary-blue);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      margin-top: 16px;
    }

    .add-contact-link:hover {
      color: #2563eb;
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
    {{-- الهيدر --}}
    @include('layouts.navbar')

    {{-- السايدبار --}}
    @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
      <div class="page-title-section">
        <h1 class="page-title">New Client</h1>
        <button class="add-icon" type="button">
          <i class="bi bi-plus"></i>
        </button>
      </div>

      <div class="search-section">
        <input type="text" class="search-input" placeholder="Find invoices, clients, and more">
        <span class="ctrl-k-badge">Ctrl+K</span>
      </div>

   <div class="header-actions">
  <button class="save-btn" onclick="document.getElementById('newClientForm').submit();">Save</button>
</div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item"><a href="#">Clients</a></li>
          <li class="breadcrumb-item active" aria-current="page">New Client</li>
        </ol>
      </nav>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
      <ul class="nav nav-tabs" id="clientTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab">
            Create
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            Settings
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
            Documents
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="locations-tab" data-bs-toggle="tab" data-bs-target="#locations" type="button" role="tab">
            Locations
          </button>
        </li>
      </ul>
    </div>

    <!-- Form Content -->
    <div class="form-content">
      <div class="tab-content" id="clientTabsContent">
        <div class="tab-pane fade show active" id="create" role="tabpanel">
          <form  action="{{ route('client.store') }}" method="POST" id="newClientForm">
            @csrf
            <div class="form-row">
              <!-- Company Details -->
              <div class="form-section">
                <h3 class="section-title">Company Details</h3>

                <div class="form-group">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                  <label class="form-label" for="number">Number</label>
                  <input type="text" class="form-control" id="number" name="number">
                </div>

                <div class="form-group">
                  <label class="form-label" for="group">Group</label>
                  <select class="form-select" id="group" name="group">
                    <option value="">Select...</option>
                    <option value="vip">VIP</option>
                    <option value="standard">Standard</option>
                    <option value="premium">Premium</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label" for="user">User</label>
                  <select class="form-select" id="user" name="user">
                    <option value="">Select...</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label" for="id_number">ID Number</label>
                  <input type="text" class="form-control" id="id_number" name="id_number">
                </div>

                <div class="form-group">
                  <label class="form-label" for="vat_number">VAT Number</label>
                  <input type="text" class="form-control" id="vat_number" name="vat_number">
                </div>

                <div class="form-group">
                  <label class="form-label" for="website">Website</label>
                  <input type="url" class="form-control" id="website" name="website">
                </div>

                <div class="form-group">
                  <label class="form-label" for="phone">Phone</label>
                  <input type="tel" class="form-control" id="phone" name="phone">
                </div>

                <div class="form-group">
                  <label class="form-label" for="routing_id">Routing ID</label>
                  <input type="text" class="form-control" id="routing_id" name="routing_id">
                </div>

                <div class="toggle-group">
                  <label class="form-label">Valid VAT Number</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="valid_vat" name="valid_vat">
                    <span class="toggle-slider"></span>
                  </label>
                </div>

                <div class="toggle-group">
                  <label class="form-label">Tax Exempt</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="tax_exempt" name="tax_exempt">
                    <span class="toggle-slider"></span>
                  </label>
                </div>

                <div class="form-group">
                  <label class="form-label" for="classification">Classification</label>
                  <select class="form-select" id="classification" name="classification">
                    <option value="">Select...</option>
                    <option value="individual">Individual</option>
                    <option value="business">Business</option>
                    <option value="non-profit">Non-Profit</option>
                  </select>
                </div>
              </div>

              <!-- Contacts -->
              <div class="form-section">
                <h3 class="section-title">Contacts</h3>

                <div class="form-group">
                  <label class="form-label" for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name">
                </div>

                <div class="form-group">
                  <label class="form-label" for="last_name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                  <label class="form-label" for="contact_phone">Phone</label>
                  <input type="tel" class="form-control" id="contact_phone" name="contact_phone">
                </div>

                <div class="toggle-group">
                  <label class="form-label">Add to Invoices</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="add_to_invoices" name="add_to_invoices" checked>
                    <span class="toggle-slider"></span>
                  </label>
                </div>

                <a href="#" class="add-contact-link">
                  <i class="bi bi-plus"></i>
                  Add contact
                </a>
              </div>
            </div>

            <!-- Address Section -->
            <div class="form-section">
              <h3 class="section-title">Address</h3>

              <div class="address-tabs">
                <ul class="nav nav-tabs" id="addressTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="billing-address-tab" data-bs-toggle="tab" data-bs-target="#billing-address" type="button" role="tab">
                      Billing Address
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="shipping-address-tab" data-bs-toggle="tab" data-bs-target="#shipping-address" type="button" role="tab">
                      Shipping Address
                    </button>
                  </li>
                </ul>
              </div>

              <div class="tab-content" id="addressTabsContent">
                <div class="tab-pane fade show active" id="billing-address" role="tabpanel">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="billing_street">Billing Street</label>
                        <input type="text" class="form-control" id="billing_street" name="billing_street">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="apt_suite">Apt/Suite</label>
                        <input type="text" class="form-control" id="apt_suite" name="apt_suite">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="state_province">State/Province</label>
                        <input type="text" class="form-control" id="state_province" name="state_province">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="country">Country</label>
                        <select class="form-select" id="country" name="country">
                          <option value="">Select...</option>
                          <option value="us">United States</option>
                          <option value="ca">Canada</option>
                          <option value="uk">United Kingdom</option>
                          <option value="de">Germany</option>
                          <option value="fr">France</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="shipping-address" role="tabpanel">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="shipping_street">Shipping Street</label>
                        <input type="text" class="form-control" id="shipping_street" name="shipping_street">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="shipping_apt_suite">Apt/Suite</label>
                        <input type="text" class="form-control" id="shipping_apt_suite" name="shipping_apt_suite">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="shipping_city">City</label>
                        <input type="text" class="form-control" id="shipping_city" name="shipping_city">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="shipping_state_province">State/Province</label>
                        <input type="text" class="form-control" id="shipping_state_province" name="shipping_state_province">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="shipping_postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="shipping_postal_code" name="shipping_postal_code">
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="shipping_country">Country</label>
                        <select class="form-select" id="shipping_country" name="shipping_country">
                          <option value="">Select...</option>
                          <option value="us">United States</option>
                          <option value="ca">Canada</option>
                          <option value="uk">United Kingdom</option>
                          <option value="de">Germany</option>
                          <option value="fr">France</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="settings" role="tabpanel">
          <div class="form-section">
            <h3 class="section-title">Client Settings</h3>
            <p class="text-muted">Settings content will go here...</p>
          </div>
        </div>

        <div class="tab-pane fade" id="documents" role="tabpanel">
          <div class="form-section">
            <h3 class="section-title">Documents</h3>
            <p class="text-muted">Documents content will go here...</p>
          </div>
        </div>

        <div class="tab-pane fade" id="locations" role="tabpanel">
          <div class="form-section">
            <h3 class="section-title">Locations</h3>
            <p class="text-muted">Locations content will go here...</p>
          </div>
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
</body>
</html>
