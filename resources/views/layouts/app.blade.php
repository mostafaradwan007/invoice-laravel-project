<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet"/>
    <style>
        :root {
            --bee-yellow: #ffcc00;
            --bee-light-gray: #e5e7eb;
            --bee-black: #1a1a1a;
            --bee-dark-gray: #333;
            --bee-light: #fff8e1;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding-left: 280px; /* To make space for the fixed sidebar */
            padding-top: 70px; /* To make space for the fixed header */
        }

        /* Main Content Area */
        .main-content {
            padding: 24px; /* Add some padding around the content */
        }

        .chart-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .dashboard-buttons {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    {{-- الهيدر --}}
    @include('layouts.navbar')

    {{-- السايدبار --}}
    @include('layouts.sidebar')

    <!-- Main Content Area -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>
</html>



