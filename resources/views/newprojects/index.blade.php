@extends('layouts.app')

@section('title', 'Projects - Bee Company')

@section('content')
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
        margin-left: 0px;
        margin-top: 0px;
        padding: 0;
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

    .status-dropdown {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
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

    .new-Project-btn {
        background-color: var(--primary-blue);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
    }

    .new-Project-btn:hover {
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

    .data-table thead th.date-column {
        text-align: right;
        padding-right: 24px;
    }

    .data-table thead th.date-column i {
        font-size: 14px;
        margin-right: 6px;
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

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .status-badge.draft {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .status-badge.active {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .status-badge.completed {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-badge.archived {
        background-color: #fee2e2;
        color: #dc2626;
    }

    /* Empty State */
    .empty-state-text {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
        font-size: 16px;
        font-weight: 500;
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

<div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Projects</li>
            </ol>
        </nav>
    </div>

    <!-- Page Controls -->
    <div class="page-controls">
        <div class="left-controls">
            <!-- Actions Dropdown (static UI) -->
            <div class="actions-dropdown dropdown">
                <button class="actions-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Actions <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Selected</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Delete Selected</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i>Send Selected</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Export Selected</a></li>
                </ul>
            </div>

            <!-- Status Filter Buttons (visual only) -->
            <button class="status-filter active" type="button">Active <i class="bi bi-x"></i></button>
            <button class="status-filter" type="button"><i class="bi bi-x"></i></button>

            <!-- Status Dropdown (visual only) -->
            <div class="dropdown">
                <button class="status-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Status <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Statuses</a></li>
                    <li><a class="dropdown-item" href="#">Draft</a></li>
                    <li><a class="dropdown-item" href="#">Sent</a></li>
                    <li><a class="dropdown-item" href="#">Paid</a></li>
                    <li><a class="dropdown-item" href="#">Overdue</a></li>
                </ul>
            </div>

            <!-- Sort Dropdown (visual only) -->
            <div class="dropdown">
                <button class="status-filter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Date Newest</a></li>
                    <li><a class="dropdown-item" href="#">Date Oldest</a></li>
                    <li><a class="dropdown-item" href="#">Amount High-Low</a></li>
                    <li><a class="dropdown-item" href="#">Amount Low-High</a></li>
                </ul>
            </div>
        </div>

        <div class="right-controls">
            <!-- Filter Input  -->
            <form method="GET" action="{{ route('newprojects.index') }}">
                <input type="text" name="filter" class="filter-input" placeholder="Filter"
                    value="{{ request('filter') }}">
            </form>

            <!-- New Project Button -->
            <button class="new-Project-btn" type="button" onclick="window.location.href='{{ route('newprojects.create') }}'">
                New Project
            </button>
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkbox-input" id="selectAll"></th>
                    <th class="sortable">NAME</th>
                    <th class="sortable">TASK RATE</th>
                    <th class="sortable date-column" style="text-align:right;"><i class="bi bi-calendar"></i> DUE DATE</th>
                    <th class="sortable">PUBLIC NOTES</th>
                    <th class="sortable">PRIVATE NOTES</th>
                    <th class="sortable">BUDGETED HOURS</th>
                    <th class="sortable">STATE</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td><input type="checkbox" class="checkbox-input" value="{{ $project->id }}"></td>
                    <td>{{ $project->name }}</td>
                    <td>
                        @if(!is_null($project->task_rate))
                        {{ number_format((float)$project->task_rate, 2) }}
                        @else
                        -
                        @endif
                    </td>
                    <td style="text-align:right;">{{ $project->due_date ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($project->public_notes ?? '-', 80) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($project->private_notes ?? '-', 80) }}</td>
                    <td>
                        @if(!is_null($project->budgeted_hours))
                        {{ rtrim(rtrim(number_format((float)$project->budgeted_hours, 2, '.', ''), '0'), '.') }}
                        @else
                        -
                        @endif
                    </td>
                    @php $state = strtolower($project->state ?? ''); @endphp
                    <td>
                        <span class="status-badge {{ in_array($state, ['active','completed','archived','draft']) ? $state : 'draft' }}">
                            {{ $project->state ?? 'Draft' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state-text">No records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-info">
                <select class="rows-select" disabled>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>rows</span>
            </div>

            <div class="page-info">
                Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}
            </div>

            <div class="pagination-controls">
                <button class="columns-btn" type="button">Columns</button>

                <div class="pagination-nav">
                    <a class="pagination-btn {{ $projects->onFirstPage() ? 'disabled' : '' }}"
                        href="{{ $projects->url(1) }}"><i class="bi bi-chevron-double-left"></i></a>
                    <a class="pagination-btn {{ $projects->onFirstPage() ? 'disabled' : '' }}"
                        href="{{ $projects->previousPageUrl() ?? '#' }}"><i class="bi bi-chevron-left"></i></a>
                    <a class="pagination-btn {{ $projects->hasMorePages() ? '' : 'disabled' }}"
                        href="{{ $projects->nextPageUrl() ?? '#' }}"><i class="bi bi-chevron-right"></i></a>
                    <a class="pagination-btn {{ $projects->hasMorePages() ? '' : 'disabled' }}"
                        href="{{ $projects->url($projects->lastPage()) }}"><i class="bi bi-chevron-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Select all checkbox functionality
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                document.querySelectorAll('tbody .checkbox-input').forEach(cb => cb.checked = this.checked);
            });
        }

        // Optional: headers click demo
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                console.log('Sorting by:', this.textContent.trim());
            });
        });
    });
</script>
@endsection