<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Project - Bee Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    .main-content {
      margin-left: 280px;
      margin-top: 70px;
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

    .breadcrumb-item + .breadcrumb-item::before {
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
</head>
<body>
  <!-- Include your header and sidebar here -->
    {{-- الهيدر --}}
    @include('layouts.navbar')

    {{-- السايدبار --}}
    @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./index.php"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('products.index') }}">Projects</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Create Project</li>
        </ol>
      </nav>
    </div>

   <!-- Form Container -->
<div class="d-flex justify-content-center">
  <div class="form-container">
    <h4 class="mb-4">New Project</h4>
    <form action="{{ route('products.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Project Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" placeholder="Enter project name" required>
      </div>

      <div class="mb-3">
  <label class="form-label">Client <span class="text-danger">*</span></label>
  <select class="form-select" name="client_id" required>
    <option selected disabled>Select client</option>
    @foreach($clients as $client)
      <option value="{{ $client->id }}">{{ $client->name }}</option>
    @endforeach
  </select>
</div>


      <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" class="form-control" name="due_date">
      </div>

      <div class="mb-3">
        <label class="form-label">Budgeted Hours</label>
        <input type="number" class="form-control" name="budgeted_hours" placeholder="Enter hours">
      </div>

      <div class="mb-3">
        <label class="form-label">Task Rate</label>
        <input type="number" class="form-control" name="task_rate" placeholder="Enter task rate">
      </div>

      <div class="mb-3">
        <label class="form-label">Public Notes</label>
        <textarea class="form-control" rows="3" name="public_notes"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Private Notes</label>
        <textarea class="form-control" rows="3" name="private_notes"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Save Project</button>
    </form>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
