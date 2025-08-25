<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Settings</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        .page-container {
            margin-left: 280px;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }

        .settings-container {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        .settings-sidebar {
            width: 280px;
            background-color: #f1f5f9;
            padding: 24px 0;
            border-right: 1px solid #e2e8f0;
        }

        .settings-sidebar-section {
            margin-bottom: 32px;
        }

        .settings-sidebar-title {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 24px 12px;
        }

        .settings-sidebar-menu {
            list-style: none;
        }

        .settings-sidebar-item {
            padding: 8px 24px;
            cursor: pointer;
            transition: background-color 0.2s;
            border-radius: 0;
        }

        .settings-sidebar-item:hover {
            background-color: #e2e8f0;
        }

        .settings-sidebar-item.active {
            background-color: #cbd5e1;
            color: #1e293b;
            font-weight: 500;
        }

        .settings-sidebar-item a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .pro-badge {
            background-color: #3b82f6;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 8px;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            padding: 24px 32px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 32px;
            font-size: 14px;
            color: #64748b;
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

        .form-content {
            background: white;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 24px;
        }

        .watermark {
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: #9ca3af;
            font-size: 14px;
            pointer-events: none;
            opacity: 0.7;
        }

        /* Content area for dynamic loading */
        #dynamic-content {
            min-height: 400px;
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            color: #64748b;
        }


        .tabs {
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 32px;
        }

        .tab-list {
            display: flex;
            gap: 32px;
        }

        .tab {
            padding: 12px 0;
            font-weight: 500;
            color: black;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            text-transform: capitalize;
        }

        .tab.active {
            color: #af8c00ff;
            border-bottom-color: yellow;
            text-transform: uppercase;

        }

        .tab:hover {
            color: #1e293b;
        }

        .form-content {
            background: white;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 24px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-top: 10px;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-row label {
            width: 200px;
            margin: 0;
            font-size: 14px;
        }

        .form-row select,
        .form-row input,
        .form-row textarea {
            flex: 1;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 400px;
            color: black;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

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
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .form-group input[type="file"] {
            display: block;
            width: 100%;
            padding: 12px;
            border: 2px dashed #ccc;
            border-radius: 6px;
            background-color: #fafafa;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="file"]:hover {
            border-color: #2196F3;
        }

        .form-group input[type="reset"] {
            margin-top: 10px;
            padding: 6px 12px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-group input[type="reset"]:hover {
            background-color: #e0e0e0;
        }

        /* Toggle Switch */

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;

        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
            width: 52px;

        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #ffcc00;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            min-width: 300px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    @include('layouts.sidebar')

    <div class="page-container">
        <div class="settings-container">
            <!-- Settings Sidebar -->
            <div class="settings-sidebar">
                <div class="settings-sidebar-section">
                    <div class="settings-sidebar-title">Basic Settings</div>
                    <ul class="settings-sidebar-menu">
                        <li class="settings-sidebar-item active" onclick="loadPage('company-details')">
                            <a href="{{ route('companydetails.index') }}" onclick="event.preventDefault()">Company
                                Details</a>
                        </li>

                        <li class="settings-sidebar-item" onclick="loadPage('user-details')">
                            <a href="{{ route('userdetails.index') }}" onclick="event.preventDefault()">User Details</a>
                        </li>

                        <li class="settings-sidebar-item" onclick="loadPage('payment-settings')">
                            <a href="{{ route('payment.index') }}" onclick="event.preventDefault()">Payment Settings</a>
                        </li>
                        <li class="settings-sidebar-item" onclick="loadPage('tax-settings')">
                            <a href="{{ route('tax.index') }}" onclick="event.preventDefault()">Tax Settings</a>
                        </li>
                        <li class="settings-sidebar-item" onclick="loadPage('product-settings')">
                            <a href="{{ route('productsettings.index') }}" onclick="event.preventDefault()">Product
                                Settings</a>
                        </li>
                        <li class="settings-sidebar-item" onclick="loadPage('task-settings')">
                            <a href="{{ route('task.index') }}" onclick="event.preventDefault()">Task Settings</a>
                        </li>
                        <li class="settings-sidebar-item" onclick="loadPage('expense-settings')">
                            <a href="{{ route('expense.index') }}" onclick="event.preventDefault()">Expense Settings</a>
                        </li>
                        <li class="settings-sidebar-item" onclick="loadPage('account-management')">
                            <a href="#" onclick="event.preventDefault()">Account
                                Management</a>
                        </li>


                    </ul>
                </div>


            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Breadcrumb -->
                <div class="breadcrumb-container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href=".#"><i class="bi bi-house-door"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('settings.index') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page" id="current-page">
                                Company Details
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- Dynamic Content Area -->
                <div id="dynamic-content">
                    <div class="loading"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Watermark -->
    <div class="watermark">Activate Windows</div>

    <script>
        // Page mapping for cleaner URLs and titles
        const pageConfig = {
            'company-details': {
                file: '/settings/company-details',
                title: 'Company Details',
                breadcrumb: 'Company Details'
            },
            'user-details': {
                file: '/settings/user-details',
                title: 'User Details',
                breadcrumb: 'User Details'
            },

            'payment-settings': {
                file: '/settings/payment-settings',
                title: 'Payment Settings',
                breadcrumb: 'Payment Settings'
            },
            'tax-settings': {
                file: '/settings/tax-settings',
                title: 'Tax Settings',
                breadcrumb: 'Tax Settings'
            },
            'product-settings': {
                file: '/settings/products-settings',
                title: 'Product Settings',
                breadcrumb: 'Product Settings'
            },
            'task-settings': {
                file: '/settings/task-settings',
                title: 'Task Settings',
                breadcrumb: 'Task Settings'
            },
            'expense-settings': {
                file: '/settings/expense-settings',
                title: 'Expense Settings',
                breadcrumb: 'Expense Settings'
            },
            'account-management': {
                file: '/settings/account-managment',
                title: 'Expense Settings',
                breadcrumb: 'Expense Settings'
            },



        };


        // Function to load different pages dynamically
        async function loadPage(pageKey) {
            const config = pageConfig[pageKey];
            if (!config) {
                console.error('Page configuration not found for:', pageKey);
                return;
            }

            // Update URL and history
            window.history.pushState({
                page: pageKey
            }, config.title, config.file);

            // Update breadcrumb
            document.getElementById('current-page').textContent = config.breadcrumb;

            // Update sidebar active state
            const allItems = document.querySelectorAll('.settings-sidebar-item');
            allItems.forEach(item => item.classList.remove('active'));
            if (event?.target) event.target.closest('.settings-sidebar-item')?.classList.add('active');

            // Show loading state
            const contentArea = document.getElementById('dynamic-content');
            contentArea.innerHTML = '<div class="loading">Loading...</div>';

            try {
                const response = await fetch(config.file);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const html = await response.text();
                contentArea.innerHTML = html;

                // Execute any scripts in the loaded content
                const scripts = contentArea.querySelectorAll('script');
                scripts.forEach(script => {
                    const newScript = document.createElement('script');
                    newScript.textContent = script.textContent;
                    document.body.appendChild(newScript);
                    document.body.removeChild(newScript);
                });
            } catch (error) {
                console.error('Error loading page:', error);
                contentArea.innerHTML = `
                <div class="form-content">
                    <h2 class="form-title">${config.title}</h2>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        This page is under development. Content will be available soon.
                    </div>
                </div>
            `;
            }
        }

        // Handle back/forward browser buttons
        window.addEventListener('popstate', function(event) {
            if (event.state?.page) {
                loadPage(event.state.page);
            }
        });

        // On page load, load the current page based on URL
        document.addEventListener('DOMContentLoaded', function() {
            const path = window.location.pathname;
            const pageKey = Object.keys(pageConfig).find(key => path.includes(pageConfig[key].file));
            if (pageKey) {
                loadPage(pageKey);
            }
        });
    </script>

</body>

</html>
