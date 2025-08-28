@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
    @vite(['resources/css/expenses.css'])
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    {{-- Link to the main dashboard route --}}
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a>
                </li>

                @if (isset($parentUrl) && isset($parentTitle))
                    <li class="breadcrumb-item">
                        {{-- Optional: Link to a parent page (like the main expenses list) --}}
                        <a href="{{ $parentUrl }}">{{ $parentTitle }}</a>
                    </li>
                @endif

                {{-- The title of the current page --}}
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'expenses' }}</li>
            </ol>
        </nav>
    </div>

    <!-- Page Controls -->
    <div class="page-controls">
        <div class="left-controls">
            <div class="dropdown">
                <button class="actions-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">Actions</button>
                <ul class="dropdown-menu">
                    {{-- This button will submit the form --}}
                    <li><button type="submit" form="bulk-delete-form" class="dropdown-item"
                            onclick="return confirm('Are you sure you want to delete the selected expenses?')">Delete
                            Selected</button></li>
                    <li><a class="dropdown-item" href="#">Archive Selected</a></li>
                </ul>
            </div>
            <button class="status-filter active" type="button">Active <i class="bi bi-x"></i></button>
            <div class="dropdown">
                <button class="status-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">Status</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Statuses</a></li>
                    <li><a class="dropdown-item" href="#">Archived</a></li>
                    <li><a class="dropdown-item" href="#">Deleted</a></li>
                </ul>
            </div>
        </div>
        <div class="right-controls">
            <input type="text" class="filter-input" placeholder="Filter">
            {{-- Links now use the Laravel route() helper --}}
            <a href="{{ route('expenses.import') }}" class="import-btn">
                <i class="bi bi-download"></i> Import
            </a>
            <a href="{{ route('expenses.create') }}" class="new-expense-btn">
                New Expense
            </a>
        </div>
    </div>

    <form action="{{ route('expenses.destroy.multiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkbox-input" id="select-all"></th>                        
                        <th>STATUS</th>
                        <th>CATEGORY</th>
                        <th>DATE</th>
                        <th>AMOUNT</th>
                        <th>CLIENT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr>
                            <td><input type="checkbox" class="checkbox-input row-checkbox" name="expense_ids[]" value="{{ $expense->id }}"></td>
                            <td><span class="status-badge status-{{$expense->status}}">{{ $expense->status }}</span></td>
                            <td>{{ $expense->category }}</td>
                            <td>{{ $expense->expense_date }}</td>
                            <td>${{ number_format($expense->amount, 2) }}</td>
                            <td>{{ $expense->client->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state-text">No expenses found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-container">
                <div class="pagination-info">
                    <select id="rowsSelect" class="rows-select">
                        <option value="1" {{ request('per_page') == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ request('per_page') == 2 ? 'selected' : '' }}>2</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span>rows</span>
                </div>

                <div class="page-info">
                    Page {{ $expenses->currentPage() }} of {{ $expenses->lastPage() }}
                </div>

                <div class="pagination-controls">


                    @php
                        $q = request()->except('page'); // نحافظ على باقي الباراميترات
                        $firstUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => 1]));
                        $prevUrl = $expenses->onFirstPage()
                            ? null
                            : request()->fullUrlWithQuery(array_merge($q, ['page' => $expenses->currentPage() - 1]));
                        $nextUrl = $expenses->hasMorePages()
                            ? request()->fullUrlWithQuery(array_merge($q, ['page' => $expenses->currentPage() + 1]))
                            : null;
                        $lastUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => $expenses->lastPage()]));
                    @endphp

                    <div class="pagination-nav">
                        <a href="{{ $expenses->onFirstPage() ? '#' : $firstUrl }}"
                            class="pagination-btn {{ $expenses->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>

                        <a href="{{ $prevUrl ?? '#' }}"
                            class="pagination-btn {{ $expenses->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ $nextUrl ?? '#' }}"
                            class="pagination-btn {{ !$expenses->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ $expenses->hasMorePages() ? $lastUrl : '#' }}"
                            class="pagination-btn {{ !$expenses->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rowsSelect = document.getElementById("rowsSelect");
            const paginationButtons = document.querySelectorAll(".pagination-btn");

            //change rows per page
            if (rowsSelect) {
                rowsSelect.addEventListener("change", function() {
                    const perPage = this.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set("per_page", perPage);
                    url.searchParams.delete("page"); // نرجع للصفحة الأولى
                    window.location.href = url.toString();
                });
            }

            //navigate pages
            paginationButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    if (this.hasAttribute("disabled")) return;
                    const page = this.getAttribute("data-page");
                    const url = new URL(window.location.href);
                    url.searchParams.set("page", page);
                    url.searchParams.set("per_page", rowsSelect ? rowsSelect.value : 10);
                    window.location.href = url.toString();
                });
            });
        });

        document.getElementById('select-all').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    </script>

@endsection
