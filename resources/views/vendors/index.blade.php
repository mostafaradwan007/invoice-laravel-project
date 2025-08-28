@extends('layouts.app')

@section('title', 'Vendors')

@section('content')
    @vite(['resources/css/vendors.css', 'resources/js/app.js'])
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
                        {{-- Optional: Link to a parent page (like the main Vendors list) --}}
                        <a href="{{ $parentUrl }}">{{ $parentTitle }}</a>
                    </li>
                @endif

                {{-- The title of the current page --}}
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'vendors' }}</li>
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
                            onclick="return confirm('Are you sure you want to delete the selected vendors?')">Delete
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
            <a href="{{ route('vendors.import') }}" class="import-btn">
                <i class="bi bi-download"></i> Import
            </a>
            <a href="{{ route('vendors.create') }}" class="new-vendor-btn">
                New Vendor
            </a>
        </div>
    </div>

    <!-- Data Table -->
    <form action="{{ route('vendors.destroy.multiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkbox-input" id="select-all"></th>
                        <th>NUMBER</th>
                        <th>NAME</th>
                        <th>CITY</th>
                        <th>PHONE</th>
                        <th>DATE CREATED</th>
                        {{-- Added Actions column for Edit/Delete buttons --}}
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- This is a Blade loop to display data from your controller --}}
                    @forelse ($vendors as $vendor)
                        <tr>
                            <td><input type="checkbox" class="checkbox-input row-checkbox" name="vendor_ids[]"
                                    value="{{ $vendor->id }}"></td>
                            <td>{{ $vendor->number }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->city }}</td>
                            <td>{{ $vendor->phone }}</td>
                            <td>{{ $vendor->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('vendors.edit', $vendor->id) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state-text">No records found</div>
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
                    Page {{ $vendors->currentPage() }} of {{ $vendors->lastPage() }}
                </div>

                <div class="pagination-controls">


                    @php
                        $q = request()->except('page'); // نحافظ على باقي الباراميترات
                        $firstUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => 1]));
                        $prevUrl = $vendors->onFirstPage()
                            ? null
                            : request()->fullUrlWithQuery(array_merge($q, ['page' => $vendors->currentPage() - 1]));
                        $nextUrl = $vendors->hasMorePages()
                            ? request()->fullUrlWithQuery(array_merge($q, ['page' => $vendors->currentPage() + 1]))
                            : null;
                        $lastUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => $vendors->lastPage()]));
                    @endphp

                    <div class="pagination-nav">
                        <a href="{{ $vendors->onFirstPage() ? '#' : $firstUrl }}"
                            class="pagination-btn {{ $vendors->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>

                        <a href="{{ $prevUrl ?? '#' }}"
                            class="pagination-btn {{ $vendors->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ $nextUrl ?? '#' }}"
                            class="pagination-btn {{ !$vendors->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ $vendors->hasMorePages() ? $lastUrl : '#' }}"
                            class="pagination-btn {{ !$vendors->hasMorePages() ? 'disabled' : '' }}">
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
