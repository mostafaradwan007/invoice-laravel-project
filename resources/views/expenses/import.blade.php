@extends('layouts.app')

@section('title', 'expenses-Import')

@section('content')
    @vite(['resources/css/expenses.css', 'resources/js/app.js'])
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
            <h1 class="form-title">Import expenses</h1>
            <form id="importForm" action="{{-- route('expenses.import.handle') --}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="file-upload-container">
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="upload-icon"><i class="bi bi-upload"></i></div>
                            <div class="upload-text">Drop CSV file here or click to upload</div>
                            <input type="file" class="file-input" id="csvFile" name="csvFile" accept=".csv" required>
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
                        <ul>
                            <li>Description (required)</li>
                            <li>expense Date (optional, format YYYY-MM-DD)</li>
                            <li>Duration (optional, format H:MM)</li>
                            <li>Client Name (optional)</li>
                        </ul>
                        <a href="#" class="download-template-btn" id="downloadTemplate">Download sample template</a>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('expenses.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="import-btn" id="importBtn">Start Import</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('csvFile');
        const selectedFile = document.getElementById('selectedFile');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const importBtn = document.getElementById('importBtn');

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });
        fileUploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
        });
        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) handleFileSelection(e.dataTransfer.files[0]);
        });
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) handleFileSelection(e.target.files[0]);
        });
        removeFileBtn.addEventListener('click', resetFileSelection);

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

        function resetFileSelection() {
            fileInput.value = '';
            selectedFile.classList.remove('show');
            fileUploadArea.style.display = 'block';
            importBtn.classList.remove('active');
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ✅ Corrected template to match handleImport()
        document.getElementById('downloadTemplate').addEventListener('click', function(e) {
            e.preventDefault();
            const csvContent = 'Description,expense Date,Duration,Client Name\n' +
                'Design homepage,2025-08-01,3h,Office Supplies Inc.\n' +
                'Marketing campaign,2025-08-05,5h,Marketing Solutions';

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'expenses-import-template.csv';
            a.click();
            window.URL.revokeObjectURL(url);
        });
    });
</script>


@endsection
