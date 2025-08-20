<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Header With Add Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    :root {
      --bee-yellow: #ffcc00;
      --bee-light-gray: #e5e7eb;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .top-nav {
      position: fixed;
      top: 0;
      left: 280px;
      width: calc(100% - 280px);
      height: 70px;
      background-color: #fff;
      border-bottom: 1px solid var(--bee-light-gray);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      z-index: 1000;
    }

    .left-group,
    .nav-right {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .dashboard-text {
      font-weight: bold;
      font-size: 18px;
    }

    .add-btn {
      background-color: var(--bee-yellow);
      border: none;
      padding: 8px 14px;
      border-radius: 6px;
      font-weight: 600;
      color: black;
    }

    .dropdown-menu.add-menu {
      width: 600px;
      padding: 20px;
      border-radius: 8px;
    }

    .add-menu-wrapper {
      display: flex;
      gap: 24px;
    }

    .add-column {
      flex: 1;
    }

    .add-menu h6 {
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .add-menu ul {
      list-style: none;
      padding-left: 0;
    }

    .add-menu li {
      font-size: 14px;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .add-menu li:hover {
      font-weight: 600;
      color: black;
    }

    .search-container {
      flex: 1;
      max-width: 400px;
    }

    .search-input-group {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
    }

    .search-input {
      flex: 1;
      border: none;
      padding: 8px 12px;
      outline: none;
    }

    .ctrl-k-btn {
      background-color: #f3f4f6;
      border: none;
      padding: 8px 12px;
      font-size: 12px;
    }

    .notification-btn {
      background: none;
      border: none;
      font-size: 20px;
      color: #6b7280;
    }

    .unlock-pro-btn {
      background-color: var(--bee-yellow);
      border: none;
      padding: 8px 16px;
      font-weight: 600;
      border-radius: 6px;
    }
  </style>
</head>
<body>

  <nav class="top-nav">
    <div class="left-group">
      <span class="dashboard-text">Dashboard</span>

      <!-- Add Dropdown -->
      <div class="dropdown">
        <button class="add-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-plus-lg"></i> Add
        </button>
        <div class="dropdown-menu add-menu">
          <div class="add-menu-wrapper">
            <div class="add-column">
              <h6><i class="bi bi-bar-chart-line-fill text-success"></i> Income</h6>
              <ul>
                <li><i class="bi bi-plus"></i> Client</li>
                <li><i class="bi bi-plus"></i> Product</li>
                <li><i class="bi bi-plus"></i> Invoice</li>
                <li><i class="bi bi-plus"></i> Recurring Invoice</li>
                <li><i class="bi bi-plus"></i> Quote</li>
                <li><i class="bi bi-plus"></i> Credit</li>
                <li><i class="bi bi-plus"></i> Payment</li>
              </ul>
            </div>

            <div class="add-column">
              <h6><i class="bi bi-wallet2 text-danger"></i> Expense</h6>
              <ul>
                <li><i class="bi bi-plus"></i> Expense</li>
                <li><i class="bi bi-plus"></i> Purchase Order</li>
                <li><i class="bi bi-plus"></i> Vendor</li>
                <li><i class="bi bi-plus"></i> Transaction</li>
              </ul>
            </div>

            <div class="add-column">
              <h6><i class="bi bi-gear text-secondary"></i> Settings</h6>
              <ul>
                <li><i class="bi bi-plus"></i> Add Stripe</li>
                <li><i class="bi bi-plus"></i> Tax Settings</li>
                <li><i class="bi bi-plus"></i> Add Logo</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Search -->
      <div class="search-container">
        <div class="search-input-group">
          <input type="text" class="search-input" placeholder="Search...">
          <button class="ctrl-k-btn">Ctrl+K</button>
        </div>
      </div>
    </div>

    <div class="nav-right">
      <button class="notification-btn"><i class="bi bi-bell"></i></button>
      <button class="unlock-pro-btn">Unlock Pro</button>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
