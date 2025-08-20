<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Import Products - Bee Company</title>
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

    /* Top Header Bar */
    .page-header {
      background: white;
      border-bottom: 1px solid var(--bee-light-gray);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .left-header-section {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .import-btn-header {
      background-color: #f3f4f6;
      border: 1px solid #d1d5db;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      color: #374151;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .add-btn-header {
      background-color: #f3f4f6;
      border: 1px solid #d1d5db;
      width: 32px;
      height: 32px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6b7280;
      font-size: 16px;
    }

    .search-section {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .search-input {
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 8px 12px;
      font-size: 14px;
      width: 300px;
    }

    .search-input::placeholder {
      color: #9ca3af;
    }

    .ctrl-k-badge {
      background-color: #f3f4f6;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      padding: 4px 8px;
      font-size: 12px;
      color: #6b7280;
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .notification-btn {
      background: none;
      border: none;
      font-size: 18px;
      color: #6b7280;
      padding: 8px;
    }

    .unlock-pro-btn {
      background-color: var(--primary-blue);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
    }

    /* Breadcrumb */
    .breadcrumb-container {
      padding: 16px 24px;
      background: white;
      border-bottom: 1px solid var(--bee-light-gray);
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
    }

    /* Import Content */
    .import-content {
      padding: 32px 24px;
    }

    .import-section {
      max-width: 800px;
      margin: 0 auto;
    }

    .section-title {
      font-size: 24px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 8px;
    }

    .section-subtitle {
      font-size: 16px;
      color: #6b7280;
      margin-bottom: 32px;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-label {
      display: block;
      font-size: 16px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 12px;
    }

    /* File Upload Area */
    .file-upload-container {
      position: relative;
    }

    .file-upload-area {
      border: 2px dashed #d1d5db;
      border-radius: 12px;
      padding: 60px 40px;
      text-align: center;
      background-color: white;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .file-upload-area:hover {
      border-color: var(--primary-blue);
      background-color: #f8fafc;
    }

    .file-upload-area.dragover {
      border-color: var(--primary-blue);
      background-color: #eff6ff;
      border-style: solid;
    }

    .upload-icon {
      width: 64px;
      height: 64px;
      background-color: #f3f4f6;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      font-size: 24px;
      color: #6b7280;
    }

    .upload-text {
      font-size: 16px;
      color: #374151;
      font-weight: 500;
    }

    .upload-subtext {
      font-size: 14px;
      color: #6b7280;
      margin-top: 4px;
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
      background-color: white;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 16px;
      margin-top: 16px;
      align-items: center;
      gap: 12px;
    }

    .selected-file.show {
      display: flex;
    }

    .file-icon {
      width: 40px;
      height: 40px;
      background-color: #22c55e;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 18px;
    }

    .file-info {
      flex: 1;
    }

    .file-name {
      font-weight: 500;
      color: #374151;
      font-size: 14px;
    }

    .file-size {
      color: #6b7280;
      font-size: 12px;
    }

    .remove-file-btn {
      background: none;
      border: none;
      color: #dc2626;
      font-size: 18px;
      cursor: pointer;
      padding: 4px;
    }

    /* Action Buttons */
    .import-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      margin-top: 32px;
      padding-top: 20px;
      border-top: 1px solid var(--bee-light-gray);
    }

    .cancel-btn {
      background: none;
      border: 1px solid #d1d5db;
      color: #374151;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
    }

    .cancel-btn:hover {
      background-color: #f9fafb;
    }

    .import-btn {
      background-color: var(--primary-blue);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      opacity: 0.5;
      pointer-events: none;
    }

    .import-btn.active {
      opacity: 1;
      pointer-events: auto;
    }

    .import-btn.active:hover {
      background-color: #2563eb;
    }

    /* Loading State */
    .loading-overlay {
      display: none;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 12px;
    }

    .loading-overlay.show {
      display: flex;
    }

    .spinner {
      width: 32px;
      height: 32px;
      border: 3px solid #e5e7eb;
      border-top: 3px solid var(--primary-blue);
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Help Text */
    .help-text {
      background-color: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 8px;
      padding: 16px;
      margin-top: 24px;
    }

    .help-title {
      font-weight: 600;
      color: #1e40af;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .help-content {
      color: #1e40af;
      font-size: 14px;
      line-height: 1.5;
    }

    .help-content ul {
      margin: 8px 0 0 0;
      padding-left: 20px;
    }

    .help-content li {
      margin-bottom: 4px;
    }

    .download-template-btn {
      color: var(--primary-blue);
      text-decoration: none;
      font-weight: 500;
    }

    .download-template-btn:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }

      .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
      }

      .search-input {
        width: 100%;
      }

      .import-content {
        padding: 16px;
      }

      .file-upload-area {
        padding: 40px 20px;
      }

      .import-actions {
        justify-content: stretch;
      }

      .import-actions button {
        flex: 1;
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
    <!-- Page Header -->

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./index.php"><i class="bi bi-house-door"></i></a>
          </li>
          <li class="breadcrumb-item"><a href="./products.php">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">Import</li>
        </ol>
      </nav>
    </div>

    <!-- Import Content -->
    <div class="import-content">
      <div class="import-section">
        <h1 class="section-title">Product</h1>

        <form id="importForm" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label" for="csvFile">CSV file</label>

            <div class="file-upload-container">
              <div class="file-upload-area" id="fileUploadArea">
                <div class="upload-icon">
                  <i class="bi bi-image"></i>
                </div>
                <div class="upload-text">Drop files or click to upload</div>
                <input type="file" class="file-input" id="csvFile" name="csvFile" accept=".csv" required>
              </div>

              <div class="loading-overlay" id="loadingOverlay">
                <div class="spinner"></div>
                <div>Processing file...</div>
              </div>

              <div class="selected-file" id="selectedFile">
                <div class="file-icon">
                  <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="file-info">
                  <div class="file-name" id="fileName"></div>
                  <div class="file-size" id="fileSize"></div>
                </div>
                <button type="button" class="remove-file-btn" id="removeFileBtn">
                  <i class="bi bi-x"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="help-text">
            <div class="help-title">Import Guidelines:</div>
            <div class="help-content">
              Please ensure your CSV file includes the following columns:
              <ul>
                <li>Product Name (required)</li>
                <li>Description/Notes (optional)</li>
                <li>Price (required)</li>
                <li>Default Quantity (optional, defaults to 1)</li>
                <li>SKU/Product Code (optional)</li>
                <li>Category (optional)</li>
              </ul>
              <a href="#" class="download-template-btn" id="downloadTemplate">Download sample template</a>
            </div>
          </div>

          <div class="import-actions">
            <button type="button" class="cancel-btn" onclick="window.location.href='./products.php'">
              Cancel
            </button>
            <button type="submit" class="import-btn" id="importBtn">
              Import Products
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fileUploadArea = document.getElementById('fileUploadArea');
      const fileInput = document.getElementById('csvFile');
      const selectedFile = document.getElementById('selectedFile');
      const fileName = document.getElementById('fileName');
      const fileSize = document.getElementById('fileSize');
      const removeFileBtn = document.getElementById('removeFileBtn');
      const importBtn = document.getElementById('importBtn');
      const loadingOverlay = document.getElementById('loadingOverlay');
      const importForm = document.getElementById('importForm');

      // Drag and drop functionality
      fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
      });

      fileUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
      });

      fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
          handleFileSelection(files[0]);
        }
      });

      // File input change
      fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
          handleFileSelection(e.target.files[0]);
        }
      });

      // Remove file button
      removeFileBtn.addEventListener('click', function() {
        resetFileSelection();
      });

      // Handle file selection
      function handleFileSelection(file) {
        // Validate file type
        if (!file.name.toLowerCase().endsWith('.csv')) {
          alert('Please select a CSV file.');
          return;
        }

        // Display selected file
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        selectedFile.classList.add('show');
        fileUploadArea.style.display = 'none';
        importBtn.classList.add('active');
      }

      // Reset file selection
      function resetFileSelection() {
        fileInput.value = '';
        selectedFile.classList.remove('show');
        fileUploadArea.style.display = 'block';
        importBtn.classList.remove('active');
      }

      // Format file size
      function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
      }

      // Form submission
      importForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!fileInput.files.length) {
          alert('Please select a CSV file to import.');
          return;
        }

        // Show loading overlay
        loadingOverlay.classList.add('show');
        importBtn.disabled = true;

        // Simulate file processing (replace with actual upload logic)
        setTimeout(function() {
          // Here you would typically send the file to your PHP backend
          const formData = new FormData();
          formData.append('csvFile', fileInput.files[0]);

          // Example fetch request (uncomment and modify as needed)
          /*
          fetch('process-product-import.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            loadingOverlay.classList.remove('show');
            importBtn.disabled = false;

            if (data.success) {
              alert('Products imported successfully!');
              window.location.href = './products.php';
            } else {
              alert('Import failed: ' + data.message);
            }
          })
          .catch(error => {
            loadingOverlay.classList.remove('show');
            importBtn.disabled = false;
            alert('An error occurred during import.');
          });
          */

          // For demo purposes, just show success after 2 seconds
          loadingOverlay.classList.remove('show');
          importBtn.disabled = false;
          alert('Import completed successfully! (Demo)');
          // window.location.href = './products.php';
        }, 2000);
      });

      // Download template functionality
      document.getElementById('downloadTemplate').addEventListener('click', function(e) {
        e.preventDefault();

        // Create sample CSV content for products
        const csvContent = 'Product Name,Description,Price,Default Quantity,SKU,Category\n' +
                          'Premium Web Hosting,Monthly web hosting service,29.99,1,WH-001,Hosting\n' +
                          'SSL Certificate,Annual SSL certificate,89.99,1,SSL-001,Security\n' +
                          'Domain Registration,.com domain registration,12.99,1,DOM-001,Domains';

        // Create and download file
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'product-import-template.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
      });
    });
  </script>
</body>
</html>
