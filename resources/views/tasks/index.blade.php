@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    @vite(['resources/css/tasks.css', 'resources/js/app.js'])
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
                        {{-- Optional: Link to a parent page (like the main TAsks list) --}}
                        <a href="{{ $parentUrl }}">{{ $parentTitle }}</a>
                    </li>
                @endif

                {{-- The title of the current page --}}
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'tasks' }}</li>
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
                    <li><button type="submit" form="bulk-delete-form" class="dropdown-item" onclick="return confirm('Are you sure you want to delete the selected tasks?')">Delete Selected</button></li>
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
            <button class="kanban-btn" type="button">Kanban</button>
            <input type="text" class="filter-input" placeholder="Filter">
            <a href="{{ route('tasks.import') }}" class="import-btn"><i class="bi bi-download"></i> Import</a>
            <a href="{{ route('tasks.create') }}" class="new-task-btn">New Task</a>
        </div>
    </div>

    <!-- Data Table Form -->
    <form action="{{ route('tasks.destroy.multiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkbox-input" id="select-all"></th>
                        <th>STATUS</th>
                        <th>NUMBER</th>
                        <th>CLIENT</th>
                        <th>DESCRIPTION</th>
                        <th>DURATION</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td><input type="checkbox" class="checkbox-input row-checkbox" name="task_ids[]" value="{{ $task->id }}"></td>
                            <td><span class="status-badge status-{{$task->status}}">{{ $task->status }}</span></td>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->client->name ?? 'N/A' }}</td>
                            <td>{{ Str::limit($task->description, 50) }}</td>
                            <td>{{ $task->duration }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state-text">No tasks found.</div>
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
                    Page {{ $tasks->currentPage() }} of {{ $tasks->lastPage() }}
                </div>

                <div class="pagination-controls">


                    @php
                        $q = request()->except('page'); // نحافظ على باقي الباراميترات
                        $firstUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => 1]));
                        $prevUrl = $tasks->onFirstPage()
                            ? null
                            : request()->fullUrlWithQuery(array_merge($q, ['page' => $tasks->currentPage() - 1]));
                        $nextUrl = $tasks->hasMorePages()
                            ? request()->fullUrlWithQuery(array_merge($q, ['page' => $tasks->currentPage() + 1]))
                            : null;
                        $lastUrl = request()->fullUrlWithQuery(array_merge($q, ['page' => $tasks->lastPage()]));
                    @endphp

                    <div class="pagination-nav">
                        <a href="{{ $tasks->onFirstPage() ? '#' : $firstUrl }}"
                            class="pagination-btn {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>

                        <a href="{{ $prevUrl ?? '#' }}"
                            class="pagination-btn {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ $nextUrl ?? '#' }}"
                            class="pagination-btn {{ !$tasks->hasMorePages() ? 'disabled' : '' }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ $tasks->hasMorePages() ? $lastUrl : '#' }}"
                            class="pagination-btn {{ !$tasks->hasMorePages() ? 'disabled' : '' }}">
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

            // تغيير عدد الصفوف
            if (rowsSelect) {
                rowsSelect.addEventListener("change", function() {
                    const perPage = this.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set("per_page", perPage);
                    url.searchParams.delete("page"); // نرجع للصفحة الأولى
                    window.location.href = url.toString();
                });
            }

            // التنقل بين الصفحات
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
