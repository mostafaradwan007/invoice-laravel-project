@extends('layouts.app')

@section('title', 'Vendors-Import')
@section('content')
    @vite(['resources/css/vendors.css', 'resources/js/vendors.js'])

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-card">
            <h1 class="form-title">Import Vendors</h1>
            
            <form id="importForm" action="{{ route('vendors.import.handle') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="file-upload-container">
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="upload-icon"><i class="bi bi-upload"></i></div>
                            <div class="upload-text">Drop CSV file here or click to upload</div>
                            <div class="upload-subtext">Supported format: .csv</div>
                            <input type="file" class="file-input" id="csvFile" name="csvFile" accept=".csv" required>
                        </div>
                        
                        <div class="selected-file" id="selectedFile">
                            <div class="file-icon"><i class="bi bi-file-earmark-text"></i></div>
                            <div class="file-info">
                                <div class="file-name" id="fileName"></div>
                                <div class="file-size" id="fileSize"></div>
                            </div>
                            <button type="button" class="remove-file-btn" id="removeFileBtn"><i class="bi bi-x"></i></button>
                        </div>
                    </div>
                </div>

                <div class="help-text">
                    <div class="help-title">Import Guidelines:</div>
                    <div class="help-content">
                        Please ensure your CSV file includes columns for:
                        <ul>
                            <li>Name (required)</li>
                            <li>Contact Name (optional)</li>
                            <li>Contact Email (optional)</li>
                            <li>Phone (optional)</li>
                            <li>Website (optional)</li>
                        </ul>
                        <a href="#" class="download-template-btn" id="downloadTemplate">Download sample template</a>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('vendors.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="import-btn" id="importBtn">Start Import</button>
                </div>
            </form>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('csvFile');
    const selectedFile = document.getElementById('selectedFile');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFileBtn = document.getElementById('removeFileBtn');
    const importBtn = document.getElementById('importBtn');

    fileUploadArea.addEventListener('dragover', (e) => { e.preventDefault(); fileUploadArea.classList.add('dragover'); });
    fileUploadArea.addEventListener('dragleave', (e) => { e.preventDefault(); fileUploadArea.classList.remove('dragover'); });
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

    document.getElementById('downloadTemplate').addEventListener('click', function (e) {
        e.preventDefault();
        const csvContent = 'Name,Contact Name,Contact Email,Phone,Website\n' +
            'Office Supplies Inc.,John Doe,john@os.com,555-1234,https://os.com\n' +
            'Marketing Solutions,Jane Smith,jane@ms.com,555-5678,https://ms.com';

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'vendor-import-template.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    });
});
</script>

@endsection
