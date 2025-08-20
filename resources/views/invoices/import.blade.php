<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Import Invoices - Bee Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --bee-yellow: #ffcc00;
      --bee-black: #1a1a1a;
      --bee-light-gray: #e5e7eb;
      --primary-blue: #3b82f6;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8fafc;
      margin: 0;
    }

    /* Main Content Area */
    .main-content {
      margin-left: 280px;
      margin-top: 70px;
      padding: 0;
      min-height: calc(100vh - 70px);
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

    /* Import Content */
    .import-content {
      padding: 32px 24px;
      background: white;
      max-width: 800px;
      margin: 0 auto;
    }

    .import-title {
      font-size: 24px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 32px;
    }

    /* Download Link */
    .download-section {
      margin-bottom: 32px;
    }

    .download-link {
      color: var(--primary-blue);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .download-link:hover {
      color: #2563eb;
      text-decoration: underline;
    }

    /* File Upload Section */
    .upload-section {
      margin-bottom: 32px;
    }

    .file-type-label {
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      margin-bottom: 16px;
    }

    .upload-area {
      border: 2px dashed #d1d5db;
      border-radius: 12px;
      padding: 60px 40px;
      text-align: center;
      background-color: #f9fafb;
      transition: border-color 0.3s, background-color 0.3s;
      cursor: pointer;
      position: relative;
    }

    .upload-area:hover {
      border-color: var(--primary-blue);
      background-color: #f0f9ff;
    }

    .upload-area.dragover {
      border-color: var(--primary-blue);
      background-color: #dbeafe;
    }

    .upload-icon {
      font-size: 48px;
      color: #9ca3af;
      margin-bottom: 16px;
    }

    .upload-text {
      font-size: 16px;
      color: #6b7280;
      margin-bottom: 8px;
    }

    .upload-subtext {
      font-size: 14px;
      color: #9ca3af;
    }

    .file-input {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }

    /* Selected File Display */
    .selected-file {
      display: none;
      margin-top: 16px;
      padding: 12px 16px;
      background-color: #f0f9ff;
      border: 1px solid #bfdbfe;
      border-radius: 8px;
      font-size: 14px;
      color: #1e40af;
    }

    .selected-file.show {
      display: block;
    }

    .file-name {
      font-weight: 500;
    }

    .file-size {
      color: #6b7280;
      margin-left: 8px;
    }

    .remove-file {
      background: none;
      border: none;
      color: #dc2626;
      cursor: pointer;
      margin-left: 12px;
      font-size: 16px;
    }

    /* Help Section */
    .help-section {
      margin-top: 32px;
    }

    .help-link {
      color: var(--primary-blue);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .help-link:hover {
      color: #2563eb;
      text-decoration: underline;
    }

    /* Upload Button */
    .upload-button {
      background-color: var(--primary-blue);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      margin-top: 24px;
      display: none;
    }

    .upload-button.show {
      display: inline-block;
    }

    .upload-button:hover {
      background-color: #2563eb;
    }

    .upload-button:disabled {
      background-color: #9ca3af;
      cursor: not-allowed;
    }

    /* Progress Bar */
    .progress-container {
      display: none;
      margin-top: 16px;
    }

    .progress-container.show {
      display: block;
    }

    .progress {
      height: 8px;
      background-color: #f3f4f6;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-bar {
      height: 100%;
      background-color: var(--primary-blue);
      transition: width 0.3s ease;
    }

    .progress-text {
      font-size: 12px;
      color: #6b7280;
      margin-top: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }

      .import-content {
        padding: 24px 16px;
      }

      .upload-area {
        padding: 40px 20px;
      }

      .breadcrumb-container {
        padding: 16px;
      }
    }

    @media (max-width: 480px) {
      .import-title {
        font-size: 20px;
        margin-bottom: 24px;
      }

      .upload-area {
        padding: 30px 16px;
      }

      .upload-icon {
        font-size: 36px;
      }

      .upload-text {
        font-size: 14px;
      }
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
            <a href="./invoices.php">Invoices</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Import</li>
        </ol>
      </nav>
    </div>

    <!-- Import Content -->
    <div class="import-content">
      <h1 class="import-title">Invoice</h1>

      <!-- Download Example File -->
      <div class="download-section">
        <a href="#" class="download-link" id="downloadExample">
          <i class="bi bi-download"></i>
          Download example file
        </a>
      </div>

      <!-- File Upload Section -->
      <div class="upload-section">
        <div class="file-type-label">CSV file</div>

        <div class="upload-area" id="uploadArea">
          <input type="file" class="file-input" id="fileInput" accept=".csv" />
          <div class="upload-icon">
            <i class="bi bi-file-earmark-arrow-up"></i>
          </div>
          <div class="upload-text">Drop files or click to upload</div>
          <div class="upload-subtext">Supports CSV files only</div>
        </div>

        <!-- Selected File Display -->
        <div class="selected-file" id="selectedFile">
          <span class="file-name" id="fileName"></span>
          <span class="file-size" id="fileSize"></span>
          <button class="remove-file" id="removeFile">
            <i class="bi bi-x"></i>
          </button>
        </div>

        <!-- Upload Button -->
        <button class="upload-button" id="uploadButton">
          Upload File
        </button>

        <!-- Progress Bar -->
        <div class="progress-container" id="progressContainer">
          <div class="progress">
            <div class="progress-bar" id="progressBar" style="width: 0%"></div>
          </div>
          <div class="progress-text" id="progressText">Uploading...</div>
        </div>
      </div>

      <!-- Help Section -->
      <div class="help-section">
        <a href="#" class="help-link" id="helpLink">
          <i class="bi bi-question-circle"></i>
          How to import data
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // File upload functionality
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const selectedFile = document.getElementById('selectedFile');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFile = document.getElementById('removeFile');
    const uploadButton = document.getElementById('uploadButton');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    // Drag and drop events
    uploadArea.addEventListener('dragover', function(e) {
      e.preventDefault();
      uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
      e.preventDefault();
      uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
      e.preventDefault();
      uploadArea.classList.remove('dragover');

      const files = e.dataTransfer.files;
      if (files.length > 0) {
        handleFileSelect(files[0]);
      }
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
      if (e.target.files.length > 0) {
        handleFileSelect(e.target.files[0]);
      }
    });

    // Handle file selection
    function handleFileSelect(file) {
      // Validate file type
      if (!file.name.toLowerCase().endsWith('.csv')) {
        alert('Please select a CSV file.');
        return;
      }

      // Display selected file
      fileName.textContent = file.name;
      fileSize.textContent = `(${formatFileSize(file.size)})`;
      selectedFile.classList.add('show');
      uploadButton.classList.add('show');
    }

    // Remove file
    removeFile.addEventListener('click', function() {
      fileInput.value = '';
      selectedFile.classList.remove('show');
      uploadButton.classList.remove('show');
      progressContainer.classList.remove('show');
    });

    // Upload file
    uploadButton.addEventListener('click', function() {
      if (!fileInput.files[0]) return;

      // Show progress
      progressContainer.classList.add('show');
      uploadButton.disabled = true;

      // Simulate upload progress
      let progress = 0;
      const interval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress >= 100) {
          progress = 100;
          clearInterval(interval);

          // Upload complete
          setTimeout(() => {
            progressText.textContent = 'Upload complete!';
            uploadButton.disabled = false;

            // Reset after 2 seconds
            setTimeout(() => {
              fileInput.value = '';
              selectedFile.classList.remove('show');
              uploadButton.classList.remove('show');
              progressContainer.classList.remove('show');
              progressBar.style.width = '0%';
              progressText.textContent = 'Uploading...';
              alert('File uploaded successfully!');
            }, 2000);
          }, 500);
        }

        progressBar.style.width = progress + '%';
        progressText.textContent = `Uploading... ${Math.round(progress)}%`;
      }, 200);
    });

    // Download example file
    document.getElementById('downloadExample').addEventListener('click', function(e) {
      e.preventDefault();

      // Create sample CSV content
      const csvContent = 'Invoice Number,Client Name,Amount,Date,Due Date,Status\n' +
                        'INV-001,John Doe,1500.00,2025-01-01,2025-01-31,Draft\n' +
                        'INV-002,Jane Smith,2750.50,2025-01-02,2025-02-01,Sent\n' +
                        'INV-003,ABC Company,5000.00,2025-01-03,2025-02-02,Paid';

      // Create and download file
      const blob = new Blob([csvContent], { type: 'text/csv' });
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'invoice_example.csv';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      window.URL.revokeObjectURL(url);
    });

    // Help link
    document.getElementById('helpLink').addEventListener('click', function(e) {
      e.preventDefault();
      alert('Import Help:\n\n1. Download the example file to see the required format\n2. Prepare your CSV file with the same column structure\n3. Upload your CSV file using the upload area\n4. The system will process and import your invoices');
    });

    // Format file size
    function formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
  </script>
</body>
</html>

