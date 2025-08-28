@extends('layouts.app')
@section('title', 'Import Payments')

@section('scripts')
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
            margin-top: 0px;
            padding: 20px 30px;
            min-height: calc(100vh - 70px);
            background-color: #f8fafc;
        }

        /* Import Content */
        .import-content {
            padding: 32px 0;
        }

        /* Top Header Bar */
        .page-header {
            background: white;
            border-bottom: 1px solid var(--bee-light-gray);
            padding: 12px 20px;
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

        .breadcrumb-item+.breadcrumb-item::before {
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function handleFileSelection(file) {
                if (!file.name.toLowerCase().endsWith('.csv')) {
                    alert('Please select a CSV file.');
                    return;
                }
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                selectedFile.classList.add('show');
                fileUploadArea.style.display = 'none';
                importBtn.classList.add('active');
            }

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
                if (files.length > 0) handleFileSelection(files[0]);
            });
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) handleFileSelection(e.target.files[0]);
            });
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                selectedFile.classList.remove('show');
                fileUploadArea.style.display = 'block';
                importBtn.classList.remove('active');
            });

            importForm.addEventListener('submit', function() {
                loadingOverlay.classList.add('show');
            });
        });
    </script>
@endsection

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Import</li>
                </ol>
            </nav>
        </div>

        <!-- Import Content -->
        <div class="import-content">
            <div class="import-section">
                <h1 class="section-title">Payments</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="importForm" enctype="multipart/form-data" method="POST" action="{{ route('payments.import') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="csvFile">CSV file</label>

                        <div class="file-upload-container">
                            <div class="file-upload-area" id="fileUploadArea">
                                <div class="upload-icon"><i class="bi bi-image"></i></div>
                                <div class="upload-text">Drop files or click to upload</div>
                                <input type="file" class="file-input" id="csvFile" name="csvFile" accept=".csv"
                                    required>
                            </div>

                            <div class="loading-overlay" id="loadingOverlay">
                                <div class="spinner"></div>
                                <div>Processing file...</div>
                            </div>

                            <div class="selected-file" id="selectedFile">
                                <div class="file-icon"><i class="bi bi-file-earmark-text"></i></div>
                                <div class="file-info">
                                    <div class="file-name" id="fileName"></div>
                                    <div class="file-size" id="fileSize"></div>
                                </div>
                                <button type="button" class="remove-file-btn" id="removeFileBtn"><i
                                        class="bi bi-x"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="help-text">
                        <div class="help-title">Import Guidelines:</div>
                        <div class="help-content">
                            Your CSV must include columns (exact names):
                            <ul>
                                <li>PAYMENT NUMBER</li>
                                <li>CLIENT</li>
                                <li>AMOUNT</li>
                                <li>PAYMENT TYPE</li>
                                <li>INVOICE NUMBER</li>
                                <li>TRANSACTION ID</li>
                                <li>PAYMENT DATE</li>
                                <li>STATUS</li>
                            </ul>
                            <a href="{{ route('payments.template') }}" class="download-template-btn">Download sample
                                template</a>
                        </div>
                    </div>

                    <div class="import-actions">
                        <a href="{{ route('payments.index') }}" class="cancel-btn">Cancel</a>
                        <button type="submit" class="import-btn" id="importBtn">Import Payments</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


