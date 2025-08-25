<style>
    :root {
        --bee-yellow: #ffcc00;
        --bee-black: #1a1a1a;
        --bee-light-gray: #e5e7eb;
        --primary-blue: #3b82f6;
        --success-green: #22c55e;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8fafc;
        margin: 0;
    }

    /* Main Content Area */
    .main-content {
        margin-top: 70px;
        padding: 0;
        min-height: calc(100vh - 70px);
        background-color: #f8fafc;
    }

    /* Data Table */
    .table-container {
        background: white;
        margin: auto;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);


    }

    .data-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .data-table thead {
        background-color: var(--primary-blue);
        text-transform: uppercase;
    }

    .data-table thead th {
        color: white;
        font-weight: 600;
        font-size: 14px;
        padding: 16px;
        text-align: left;
        border: none;
        position: relative;
    }

    .data-table thead th:first-child {
        width: 50px;
        text-align: center;
    }

    .data-table thead th.sortable {
        cursor: pointer;
        user-select: none;
    }

    .data-table thead th.sortable:hover {
        background-color: #2563eb;
    }

    .data-table thead th .sort-icon {
        margin-left: 8px;
        opacity: 0.7;
    }

    .data-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
    }

    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .data-table tbody td {
        padding: 16px;
        font-size: 14px;
        color: #374151;
        border: none;
    }

    .data-table tbody td:first-child {
        text-align: center;
    }

    .checkbox-input {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;

    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .empty-state-subtext {
        font-size: 14px;
        opacity: 0.8;
    }

    /* Pagination */
    .pagination-container {
        padding: 20px 24px;
        background: white;
        border-top: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        color: #6b7280;
    }

    .rows-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 6px 8px;
        font-size: 14px;
        background-color: white;
    }

    .page-info {
        font-size: 14px;
        color: #6b7280;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .columns-btn {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .columns-btn:hover {
        background-color: #e5e7eb;
    }

    .pagination-nav {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination-btn {
        background: none;
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #6b7280;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
    }

    .pagination-btn:hover:not(:disabled) {
        background-color: #f3f4f6;
        color: #374151;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
        }

    }

    @media (max-width: 480px) {
        .table-container {
            margin: 0 12px;
        }

        .data-table thead th,
        .data-table tbody td {
            padding: 12px 8px;
            font-size: 13px;
        }
    }
</style>



<!-- Tabs -->
<div class="tabs">
    <div class="tab-list">
        <div class="tab active" onclick="showTaxTab(event ,'rates')">Tax Rates</div>

    </div>
</div>

<!-- Form Content -->
<div class="form-content">

    <!-- Tax Rates Tab Content -->
    <div id="tax-rates-tab" class="tab-content active">
        <h4>Tax Rates Management</h4>

        <div class="tax-rates-header">
            <button type="button" class="btn-add-tax" onclick="addNewTaxRate()">
                <i class="bi bi-plus-circle"></i> Add New Tax Rate
            </button>
        </div>


        <form action="{{ route('tax.updateSettings') }}" method="POST">
            @csrf

            <div class="tax-rates-list">
                <div class="form-row">
                    <label for="invoicetaxrates">Invoice Tax Rates</label>
                    <select class="form-select" id="invoicetaxrates" name="invoicetaxrates">
                        <option
                            value="Disabled"{{ old( 'invoicetaxrates', optional($settings)->invoicetaxrates) == 'Disabled' ? 'selected' : '' }}>
                            Disabled</option>
                        <option
                            value="1 tax rate"{{ old('invoicetaxrates', optional($settings)->invoicetaxrates) == '1 tax rate' ? 'selected' : '' }}>
                            1 tax rate</option>
                        <option
                            value="2 tax rates"{{ old('invoicetaxrates', optional($settings)->invoicetaxrates) == '2 tax rates' ? 'selected' : '' }}>
                            2 tax rates</option>
                        <option
                            value="3 tax rates"{{ old('invoicetaxrates', optional($settings)->invoicetaxrates) == '3 tax rates' ? 'selected' : '' }}>
                            3 tax rates</option>
                    </select>
                </div>

                <div class="form-row">
                    <label for="lineitemtaxrates">Line Item Tax Rates</label>
                    <select class="form-select" id="lineitemtaxrate" name="lineitemtaxrate">
                        <option
                            value="Disabled"{{ old('lineitemtaxrate', optional($settings)->lineitemtaxrate) == 'Disabled' ? 'selected' : '' }}>
                            Disabled</option>
                        <option
                            value="1 tax rate"{{ old('lineitemtaxrate', optional($settings)->lineitemtaxrate) == '1 tax rate' ? 'selected' : '' }}>
                            1 tax rate</option>
                        <option
                            value="2 tax rates"{{ old('lineitemtaxrate', optional($settings)->lineitemtaxrate) == '2 tax rates' ? 'selected' : '' }}>
                            2 tax rates</option>
                        <option
                            value="3 tax rates"{{ old('lineitemtaxrate', optional($settings)->lineitemtaxrate) == '3 tax rates' ? 'selected' : '' }}>
                            3 tax rates</option>
                    </select>
                </div>

                <div class="form-row">
                    <label for="expensetaxrates">Expense Tax Rates</label>
                    <select class="form-select" id="expensetaxrates" name="expensetaxrates">
                        <option
                            value="Disabled"{{ old('expensetaxrates', optional($settings)->expensetaxrates) == 'Disabled' ? 'selected' : '' }}>
                            Disabled</option>
                        <option
                            value="1 tax rate"{{ old('expensetaxrates', optional($settings)->expensetaxrates) == '1 tax rate' ? 'selected' : '' }}>
                            1 tax rate</option>
                        <option
                            value="2 tax rates"{{ old('expensetaxrates', optional($settings)->expensetaxrates) == '2 tax rates' ? 'selected' : '' }}>
                            2 tax rates</option>
                        <option
                            value="3 tax rates"{{ old('expensetaxrates', optional($settings)->expensetaxrates) == '3 tax rates' ? 'selected' : '' }}>
                            3 tax rates</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Inclusive Taxes</label>
                    <label class="switch">
                        <input type="hidden" name="inclusive_taxes" id="calculationToggle" value="No">
                        <input type="checkbox" name="inclusive_taxes" value="Yes"
                            {{ isset($settings) && $settings->inclusive_taxes === 'Yes' ? 'checked' : '' }}>

                        <span class="slider round"></span>
                    </label>
                    <div class="right-column">
                        <div class="calculation-display" id="calculationDisplay">
                            Exclusive: 100 + 10% = 100 + 10
                        </div>
                    </div>
                </div>


            </div>

            <div class="form-actions">
                <button type="button" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-save">Save Tax Settings</button>
            </div>
        </form>

        <form id="taxRateForm" action="{{ route('tax.store') }}" method="POST">
            @csrf
            <div id="tax-rate-form" class="tax-form-section" style="display: none;">

                <h5>Add New Tax Rate</h5>


                <div class="form-row">
                    <label for="tax-name">Name</label>
                    <input type="text" id="tax-name" name="name" required>
                </div>
                <div class="form-row">
                    <label for="tax-percentage">Tax Percentage</label>
                    <input type="number" id="tax-percentage" name="tax_percentage" step="0.01" min="0"
                        max="100" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="cancelTaxForm()">Cancel</button>
                    <button type="submit" class="btn-save">Save Tax Rate</button>
                </div>
            </div>
        </form>


        <hR>

        <!-- Confirm Delete Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this data?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Data Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>

                        <th>
                            <input type="checkbox" class="checkbox-input" id="selectAll">
                        </th>
                        <th class="sortable">
                            Tax name
                            <i class="bi bi-arrow-up-down sort-icon"></i>
                        </th>

                        <th class="sortable">
                            Tax Rate(%)
                            <i class="bi bi-arrow-up-down sort-icon"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($taxes as $tax)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $tax->name }}</td>
                            <td>{{ $tax->tax_percentage }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $tax->id }})">
    Delete
</button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div class="empty-state-text">No records found</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    <select class="rows-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>rows</span>
                </div>

                <div class="page-info">
                    Page 1 of 1.0
                </div>

                <div class="pagination-controls">
                    <button class="columns-btn" type="button">
                        Columns
                    </button>

                    <div class="pagination-nav">
                        <button class="pagination-btn" disabled>
                            <i class="bi bi-chevron-double-left"></i>
                        </button>
                        <button class="pagination-btn" disabled>
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="pagination-btn" disabled>
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <button class="pagination-btn" disabled>
                            <i class="bi bi-chevron-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <style>
            .btn-add-tax,
            .btn-add-region {
                background-color: #22c55e;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 6px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 500;
            }

            .btn-add-tax:hover,
            .btn-add-region:hover {
                background-color: #16a34a;
            }

            .tax-rates-list,
            .tax-regions-list {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .tax-rate-item,
            .tax-region-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
            }

            .tax-rate-info,
            .region-info {
                flex: 1;
            }

            .tax-rate-info h5,
            .region-info h5 {
                margin: 0 0 5px 0;
                color: #374151;
                font-size: 16px;
            }

            .tax-rate-info p,
            .region-info p {
                margin: 0 0 10px 0;
                color: #6b7280;
                font-size: 14px;
            }

            .tax-rate-percentage {
                background: #4d431bff;
                color: white;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 600;
            }


            .tax-rate-actions {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .tax-form-section {
                margin-top: 30px;
                padding: 25px;
                background: #fff4c7ff;
                border: 1px solid #edd262ff;
                border-radius: 8px;
            }

            .tax-form-section h5 {
                margin: 0 0 20px 0;
                color: #000000ff;
                font-size: 18px;
            }

            .tax-form-actions {
                display: flex;
                gap: 10px;
                margin-top: 20px;
                justify-content: flex-end;
            }

            .tax-form-actions .btn-cancel {
                background-color: #f3f4f6;
                color: #374151;
                border: 1px solid #d1d5db;
                padding: 10px 20px;
                border-radius: 6px;
                text-decoration: none;
                cursor: pointer;
            }

            .tax-form-actions {
                background-color: #fff4c7ff;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 6px;
                cursor: pointer;
            }
        </style>


        <script>
            function showTaxTab(event, tabName) {
                const allTabContent = document.querySelectorAll('.tab-content');
                allTabContent.forEach(content => content.classList.remove('active'));

                const targetTab = document.getElementById('tax-' + tabName + '-tab');
                if (targetTab) {
                    targetTab.classList.add('active');
                }

                const allTabs = document.querySelectorAll('.tab');
                allTabs.forEach(tab => tab.classList.remove('active'));
                event.target.classList.add('active');
            }

            function addNewTaxRate() {
                const section = document.getElementById('tax-rate-form');
                const form = document.getElementById('taxRateForm');
                const formTitle = section.querySelector('h5');

                // reset inputs
                document.getElementById('tax-name').value = '';
                document.getElementById('tax-percentage').value = '';

                // update title and form action
                formTitle.textContent = 'Add New Tax Rate';
                form.action = "{{ route('tax.store') }}";


                // show section
                section.style.display = 'block';
                section.scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function editTaxRate(id) {
                const form = document.getElementById('tax-rate-form');
                const formTitle = form.querySelector('h5');

                if (id === 1) {
                    document.getElementById('tax-name').value = 'Sales Tax';
                    document.getElementById('tax-percentage').value = '10.0';
                }

                formTitle.textContent = 'Edit Tax Rate';
                form.style.display = 'block';
                form.scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function cancelTaxForm() {
                document.getElementById('tax-rate-form').style.display = 'none';
            }
        </script>

        <!--for toggle switch-->
        <script>
            const toggle = document.getElementById('calculationToggle');
            const display = document.getElementById('calculationDisplay');

            toggle.addEventListener('change', function() {
                if (this.checked) {
                    display.textContent = 'Inclusive: 100 + 10% = 90.91 + 9.09';
                } else {
                    display.textContent = 'Exclusive: 100 + 10% = 100 + 10';
                }
            });
        </script>

        <script>
            function confirmDelete(taxId) {
                const form = document.getElementById('deleteForm');
                form.action = `/settings/tax-settings/${taxId}`;
                const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                modal.show();
            }
        </script>
