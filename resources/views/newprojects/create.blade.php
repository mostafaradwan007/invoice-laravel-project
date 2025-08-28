@extends('layouts.app')

@section('title', 'Create Project - Bee Company')

@section('content')
<style>
  body {
    background-color: #f8f9fa;
  }

  .main-content {
    margin-left: 40px;
    margin-top: 0px;
    padding: 20px 30px;
    min-height: calc(100vh - 70px);
    background-color: #f8fafc;
  }

  @media (max-width: 992px) {
    .main-content {
      margin-left: 0;
      padding: 15px 15px;
    }
  }

  /* Breadcrumb */
  .breadcrumb-container {
    margin-bottom: 25px;
    background-color: #f8fafc;
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
    margin:
      0 8px;
  }

  .breadcrumb-item a {
    color: #6b7280;
    text-decoration: none;
  }

  .breadcrumb-item.active {
    color: #1f2937;
    font-weight: 500;
  }

  .breadcrumb i {
    font-size: 16px;
  }

  /* Form */
  .form-container {
    background: #fff;
    padding: 20px 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    max-width: 800px;
    width: 100%;
    margin-top: 10px;
  }
</style>

<div class="main-content">
  <!-- Breadcrumb -->
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('newprojects.index') }}">Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Project</li>
      </ol>
    </nav>
  </div>

  <!-- Form Container -->
  <div class="d-flex justify-content-center">
    <div class="form-container">
      <h4 class="mb-4">New Project</h4>

      <form action="{{ route('newprojects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">Project Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" placeholder="Enter project name" required>
        </div>

        {{-- Client Select --}}
        <div class="mb-3">
          <label class="form-label">Client <span class="text-danger">*</span></label>
          <select name="client_id" class="form-select" id="clientSelect" required>
            <option selected disabled value="">Select client</option>
            @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
            <option value="new">+ Add New Client</option>
          </select>
        </div>



        <div class="mb-3">
          <label class="form-label">Due Date</label>
          <input type="date" name="due_date" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Budgeted Hours</label>
          <input type="number" step="0.01" name="budgeted_hours" class="form-control" placeholder="Enter hours">
        </div>

        <div class="mb-3">
          <label class="form-label">Task Rate</label>
          <input type="number" step="0.01" name="task_rate" class="form-control" placeholder="Enter task rate">
        </div>

        <div class="mb-3">
          <label class="form-label">Public Notes</label>
          <textarea name="public_notes" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Private Notes</label>
          <textarea name="private_notes" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Project</button>
        <a href="{{ route('newprojects.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>

<script>
  
  document.getElementById('clientSelect').addEventListener('change', function() {
    if (this.value === 'new') {
      window.location.href = "{{ route('client.create') }}";
    }
  });
</script>
@endsection