@extends('layouts.app')

@section('title', 'Tasks-Create')

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
            <h1 class="form-title">New Task</h1>
            
            <form id="newTaskForm" action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="client_id">Client</label>
                        <select class="form-control" id="client_id" name="client_id">
                            <option value="">Select a client (optional)</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('client.create') }}" class="new-client-btn">New Client</a>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="project_id">Project</label>
                        <select class="form-control" id="project_id" name="project_id">
                            <option value="">Select a project (optional)</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach               
                        </select>
                        <a href="{{ route('newprojects.create') }}" class="new-project-btn">New Project</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="task_date">Date</label>
                        <input type="date" class="form-control" id="task_date" name="task_date" value="{{ old('task_date', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 1:30 for 1h 30m" value="{{ old('duration') }}">
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection