@extends('layouts.app')

@section('title', 'Clients')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="bi bi-house-door"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </nav>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="left-actions">
                <div class="dropdown">
                    <button class="actions-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Actions
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Bulk Edit</a></li>
                        <li><a class="dropdown-item" href="#">Export</a></li>
                        <li><a class="dropdown-item" href="#">Delete Selected</a></li>
                    </ul>
                </div>

                <div class="filter-badge">
                    Active
                    <button class="close-btn" type="button">×</button>
                </div>
            </div>

            <div class="right-actions">
                <button class="filter-btn" type="button">
                    Filter
                </button>
                <button class="import-btn" type="button" onclick="window.location.href='./client-import'">
                    <i class="bi bi-download"></i>
                    Import
                </button>
                <button class="new-client-btn" type="button">
                    <a style="text-decoration: none;color: inherit;" href="./client-create" class="bi bi-plus">New
                        Client</a>
                </button>
            </div>
        </div>

        <!-- Confirm Delete Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
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


        <!-- Clients Table -->
        <div class="clients-table-container">
            <table class="clients-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="table-checkbox" id="selectAll">
                        </th>
                        <th class="sortable">Name</th>
                        <th class="sortable">Contact Email</th>
                        <th class="sortable">ID Number</th>
                        <th class="sortable">Balance</th>
                        <th class="sortable">Paid to Date</th>
                        <th class="sortable">Date Created</th>
                        <th class="sortable">Last Login</th>
                        <th class="sortable">Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->id_number }}</td>
                            <td>{{ $client->balance }}</td>
                            <td>{{ $client->paid_to_date }}</td>
                            <td>{{ $client->created_at->format('Y-m-d') }}</td>
                            <td>{{ $client->last_login }}</td>
                            <td>{{ $client->website }}</td>
                            <td>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-info">Edit</a>

                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete({{ $client->id }})">
                                    Delete
                                </button>


                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-left">
                    <select class="rows-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>rows</span>
                </div>

                <div class="pagination-center">
                    Page 1 of 1.0
                </div>

                <div class="pagination-right">
                    <button class="columns-btn" type="button">Columns</button>
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
@endsection

@section('scripts')
    <style>
        /* Specific styles for clients page if needed, otherwise remove */
        /* Main Content Area */
        .main-content {
            padding: 24px;
            min-height: calc(100vh - 70px);
        }

        /* Breadcrumb */
        .breadcrumb-container {
            margin-bottom: 24px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">\";
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

        /* Action Bar */
        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 16px;
        }

        .left-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .right-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .actions-dropdown {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        .filter-badge {
            background-color: var(--bee-light-gray);
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 12px;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-badge .close-btn {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 14px;
            cursor: pointer;
            padding: 0;
            margin-left: 4px;
        }

        .filter-btn {
            background: none;
            border: 1px solid #d1d5db;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .filter-btn:hover {
            background-color: #f9fafb;
        }

        .import-btn {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .new-client-btn {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        /* Table Styles */
        .clients-table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .clients-table {
            width: 100%;
            margin: 0;
        }

        .clients-table thead {
            background-color: #3b82f6;
        }

        .clients-table thead th {
            color: white;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 12px;
            border: none;
            position: relative;
        }

        .clients-table thead th:first-child {
            width: 40px;
            text-align: center;
        }

        .clients-table thead th.sortable {
            cursor: pointer;
            user-select: none;
        }

        .clients-table thead th.sortable:hover {
            background-color: #2563eb;
        }

        .clients-table thead th.sortable::after {
            content: "\2195";
            /* Up-down arrow */
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.7;
            font-size: 10px;
        }

        .clients-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        .clients-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .clients-table tbody td {
            padding: 16px 12px;
            font-size: 14px;
            color: #374151;
            vertical-align: middle;
        }

        .clients-table tbody td:first-child {
            text-align: center;
        }

        .table-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--bee-yellow);
        }

        .no-records {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
            font-size: 16px;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: white;
            border-top: 1px solid #f3f4f6;
        }

        .pagination-left {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
        }

        .rows-select {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 14px;
        }

        .pagination-center {
            flex: 1;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        .pagination-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .columns-btn {
            background: none;
            border: 1px solid #d1d5db;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .pagination-btn {
            background: none;
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            border-radius: 4px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .pagination-btn:hover {
            background-color: #f9fafb;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .clients-table-container {
                overflow-x: auto;
            }

            .pagination-container {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
    <script>
        function confirmDelete(clientId) {
            const form = document.getElementById('deleteForm');
            form.action = `/clients/${clientId}`;
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        }
    </script>


@endsection
