<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bee-yellow: #ffcc00;
            --bee-black: #1a1a1a;
            --bee-dark-gray: #333;
            --bee-light: #fff8e1;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            background-color: var(--bee-black);
            padding: 20px 16px;
            overflow-y: auto;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            color: var(--bee-yellow);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s, color 0.3s;
        }


        .sidebar-item.active {
            background-color: var(--bee-yellow);
            color: var(--bee-black);
        }

        .sidebar-item i {
            width: 24px;
            margin-right: 14px;
            font-size: 18px;
        }

        .sidebar-item .plus-icon {
            margin-left: auto;
            font-size: 14px;
            opacity: 0.8;
        }

        .sidebar-bottom-icons {
            position: sticky;
            bottom: 0;
            background-color: var(--bee-black);
            padding: 16px 0;
            border-top: 1px solid #444;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: auto;
        }

        .sidebar-bottom-icons a {
            color: var(--bee-yellow);
            font-size: 20px;
            text-decoration: none;
        }

        .sidebar-bottom-icons a:hover {
            color: var(--bee-light);
        }

        .company-dropdown-container {
            padding-bottom: 16px;
            border-bottom: 1px solid #444;
            margin-bottom: 20px;
        }

        .company-dropdown-toggle {
            display: flex;
            align-items: center;
            background-color: var(--bee-black);
            color: var(--bee-yellow);
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            justify-content: space-between;
            transition: background-color 0.3s ease;
        }

        .company-dropdown-toggle:hover {
            background-color: #2a2a2a;
            color: var(--bee-light);
        }

        .company-dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            background-color: #fffbe6;
            font-size: 14px;
        }

        .company-dropdown-menu .dropdown-item {
            padding: 12px 16px;
            transition: background-color 0.2s;
            color: #222;
        }

        .company-dropdown-menu .dropdown-item:hover {
            background-color: #fff1a8;
        }

        .company-dropdown-menu .small {
            font-size: 12px;
            color: #555;
        }

        .company-dropdown-menu .fw-medium {
            font-weight: 600;
        }

        .company-dropdown-menu .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

        }


        .sidebar-item.active {
            background-color: var(--bee-yellow);
            color: var(--bee-black);
        }

        /* Info Popup Styling */
        .info-popup {
            position: fixed;
            bottom: 80px;
            left: 20px;
            width: 280px;
            background-color: lightgray;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 20px;
            z-index: 1050;
            opacity: 0;
            transform: translateY(20px);
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .info-popup.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        body.info-popup {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .info-popup .popup-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .info-popup .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--text-primary), #e6b800);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: var(--bg-primary);
            font-size: 24px;
            font-weight: bold;
        }

        .info-popup .user-name {
            font-weight: 600;
            font-size: 16px;
            color: var(--form-text);
            margin-bottom: 5px;
            color: black;
        }

        .info-popup .user-email {
            font-size: 14px;
            color: var(--form-placeholder);
            margin-bottom: 15px;
            color: black;
        }

        .info-popup .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-popup .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--form-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--form-text);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .info-popup .social-links a:hover {
            background-color: #ffcc00;
            color: var(--bg-primary);
            transform: translateY(-2px);
        }

        .info-popup .popup-footer {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid var(--form-border);
        }

        .info-popup .popup-footer small {
            color: var(--form-placeholder);
            font-size: 12px;
        }

        .info-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: var(--form-placeholder);
            font-size: 18px;
            cursor: pointer;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .info-popup .close-btn:hover {
            background-color: var(--form-border);
            color: var(--form-text);
        }

        /* Tooltip styling */
        .tooltip-custom {
            position: relative;
        }

        .tooltip-custom::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            margin-bottom: 5px;
            z-index: 1000;
        }

        .tooltip-custom::before {
            content: '';
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: rgba(0, 0, 0, 0.8);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .tooltip-custom:hover::after,
        .tooltip-custom:hover::before {
            opacity: 1;
            visibility: visible;
        }
    </style>

</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="company-dropdown-container">
            <div class="dropdown">
                <a href="#" class="company-dropdown-toggle" id="companyDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span>Bee Company</span>
                    <i class="bi bi-chevron-expand ms-auto"></i>
                </a>
                <ul class="dropdown-menu company-dropdown-menu" aria-labelledby="companyDropdown">
                    @auth
                        <li class="px-3 py-2 border-bottom">
                            <div class="small">Signed in as</div>
                            <div class="fw-medium text-truncate">{{ auth()->user()->email }}</div>
                        </li>
                        <li class="px-3 py-2 border-bottom">
                            <div class="small">Company</div>
                            <div class="d-flex align-items-center">
                                <a href="{{ url('/') }}" class="dropdown-item d-flex align-items-center">
                                  <i class="bi bi-envelope me-2"></i>
                                  <span class="fw-medium">Bee Company</span>
                                  <i class="bi bi-check ms-auto text-success"></i>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                                <i class="bi bi-person-circle me-2"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-2"></i>
                                Register
                            </a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="sidebar-item">
            <i class="bi bi-house-door-fill"></i>
            Dashboard
        </a>
        <a href="{{ route('clients.index') }}" class="sidebar-item">
            <i class="bi bi-people"></i>
            Clients
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('products.index') }}" class="sidebar-item">
            <i class="bi bi-bag"></i>
            Products
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('invoices.index') }}" class="sidebar-item">
            <i class="bi bi-file-earmark-text"></i>
            Invoices
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('recurring-invoices.index') }}" class="sidebar-item">
            <i class="bi bi-arrow-repeat"></i>
            Recurring Invoices
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{route('payments.index')}}" class="sidebar-item">
            <i class="bi bi-credit-card"></i>
            Payments
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{route('quotes.index')}}" class="sidebar-item">
            <i class="bi bi-file-text"></i>
            Quotes
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{route('credits.index')}}" class="sidebar-item">
            <i class="bi bi-journal-text"></i>
            Credits
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('newprojects.index') }}" class="sidebar-item">
            <i class="bi bi-briefcase"></i>
            Projects
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('tasks.index') }}" class="sidebar-item">
            <i class="bi bi-check2-square"></i>
            Tasks
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('vendors.index') }}" class="sidebar-item">
            <i class="bi bi-building"></i>
            Vendors
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('expenses.index') }}" class="sidebar-item">
            <i class="bi bi-wallet2"></i>
            Expenses
            <i class="bi bi-plus plus-icon"></i>
        </a>
        <a href="{{ route('recurring_expense.index') }}" class="sidebar-item">
            <i class="bi bi-arrow-repeat"></i>
            Recurring Expenses
            <i class="bi bi-plus plus-icon"></i>
        </a>'
        <a href="{{ route('transactions.index') }}" class="sidebar-item">
            <i class="bi bi-arrow-down-up"></i>
            Transactions
            <i class="bi bi-plus plus-icon"></i>
        </a>

        <a href="{{ route('settings.index') }}" class="sidebar-item">
            <i class="bi bi-gear"></i>
            Settings
        </a>

        <div class="sidebar-bottom-icons">
            <a href="#"><i class="bi bi-envelope"></i></a>
            <a href="#"><i class="bi bi-chat-dots"></i></a>
            <a href="#"><i class="bi bi-question-circle"></i></a>
            <a href="#" class="tooltip-custom" data-tooltip="Info" id="infoIcon">
                <i class="bi bi-info-circle"></i>
            </a>
            <a href="#"><i class="bi bi-moon"></i></a>
            <a href="#"><i class="bi bi-box-arrow-in-right"></i></a>
        </div>
    </nav>


    <!-- Info Popup -->
    <div class="info-popup" id="infoPopup">
        <button class="close-btn" id="closePopup">
            <i class="bi bi-x"></i>
        </button>

        <div class="popup-header">
            <div class="user-avatar">
                MR
            </div>
            <div class="user-name">..</div>
            <div class="user-email">@gmail.com</div>
        </div>

        <div class="social-links">
            <a href="https://www.facebook.com/" target="_blank" class="tooltip-custom" data-tooltip="Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.twitter.com/" target="_blank" class="tooltip-custom" data-tooltip="Twitter">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/" target="_blank" class="tooltip-custom" data-tooltip="LinkedIn">
                <i class="bi bi-linkedin"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="tooltip-custom" data-tooltip="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.github.com/" target="_blank" class="tooltip-custom" data-tooltip="GitHub">
                <i class="bi bi-github"></i>
            </a>
        </div>

        <div class="popup-footer">
            <small>Bee Company Dashboard v2.1</small>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            const infoIcon = document.getElementById('infoIcon');
            const infoPopup = document.getElementById('infoPopup');
            const closePopup = document.getElementById('closePopup');

            // أولاً: فعل العنصر المحفوظ من قبل
            const lastActiveText = localStorage.getItem('activeSidebarText');
            if (lastActiveText) {
                const lastActiveItem = Array.from(sidebarItems).find(item =>
                    item.textContent.trim() === lastActiveText
                );
                if (lastActiveItem) {
                    lastActiveItem.classList.add('active');
                }
            }
            // Info popup functionality
            infoIcon.addEventListener('click', function(e) {
                e.preventDefault();
                infoPopup.classList.toggle('show');
            });

            // Close popup when clicking close button
            closePopup.addEventListener('click', function(e) {
                e.preventDefault();
                infoPopup.classList.remove('show');
            });

            // Close popup when clicking outside
            document.addEventListener('click', function(e) {
                if (!infoPopup.contains(e.target) && !infoIcon.contains(e.target)) {
                    infoPopup.classList.remove('show');
                }
            });

            // Close popup when pressing Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    infoPopup.classList.remove('show');
                }
            });



            // ثانياً: لما يضغط المستخدم على أي عنصر، خزّن النص الداخلي بدل href
            sidebarItems.forEach(item => {
                item.addEventListener('click', () => {
                    localStorage.setItem('activeSidebarText', item.textContent.trim());
                });
            });
        });
    </script>




</body>

</html>
