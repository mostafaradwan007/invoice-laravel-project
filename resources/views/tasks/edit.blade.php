@extends('layouts.app')

@section('title', 'Tasks-Edit')

@section('content')
    @vite(['resources/css/tasks.css', 'resources/js/app.js'])
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a>
            </li>

            @foreach ($breadcrumbs ?? [] as $crumb)
                @if (!empty($crumb['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $crumb['title'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
    </div>


    <!-- Form Container -->
    <div class="form-container">
        <div class="form-card">
            <h1 class="form-title">Edit Task{{ $task->number }}</h1>

            <form id="editTaskForm" action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="client_id">Client</label>
                        <select class="form-control" id="client_id" name="client_id">
                            <option value="">Select a client (optional)</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', $task->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="project_id">Project</label>
                        <select class="form-control" id="project_id" name="project_id">
                            <option value="">Select a project (optional)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="4" required>{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="task_date">Date</label>
                        <input type="date" class="form-control" id="task_date" name="task_date"
                            value="{{ old('task_date', $task->task_date) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration"
                            placeholder="e.g., 1:30 for 1h 30m" value="{{ old('duration', $task->duration) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="logged" {{ old('status', $task->status) == 'logged' ? 'selected' : '' }}>Logged
                        </option>
                        <option value="running" {{ old('status', $task->status) == 'running' ? 'selected' : '' }}>Running
                        </option>
                        <option value="invoiced" {{ old('status', $task->status) == 'invoiced' ? 'selected' : '' }}>
                            Invoiced</option>
                        <option value="paid" {{ old('status', $task->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                <div class="form-actions">
                    <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Update Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection
