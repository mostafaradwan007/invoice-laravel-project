@extends('layouts.app')
@section('title','Create Payment')

@push('styles')
<style>
body {
    background-color: #f8f9fa;
}

.main-content {
    margin-top: 40px;
    padding: 20px 30px;
    min-height: calc(100vh - 70px);
    background-color: #f8fafc;
}

.form-container {
    margin-top: 0; 
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
    margin-top: 0px;
}
</style>
@endpush

@section('content')
<div class="main-content container-fluid">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Payment</li>
            </ol>
        </nav>
    </div>

    <!-- Form Container -->
    <div class="d-flex justify-content-center">
        <div class="form-container">
            <h4 class="mb-4">Enter Payment</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('payments.store') }}">
                @csrf

                <!-- Client -->
                <div class="mb-3">
                    <label class="form-label">Client</label>
                    <input type="text" name="client_name" class="form-control" placeholder="Client name" required>
                </div>

                <!-- Amount -->
                <div class="mb-3">
                    <label class="form-label">Amount received</label>
                    <input type="text" name="amount" class="form-control" placeholder="Leave blank unless overpaid or no invoice">
                    <small class="form-text text-muted">
                        Enter a value here if the total amount received was MORE than the invoice amount, or when recording a payment with no invoices.
                    </small>
                </div>

                <!-- Payment Date -->
                <div class="mb-3">
                    <label class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                </div>

                <!-- Payment Type -->
                <div class="mb-3">
                    <label class="form-label">Payment Type</label>
                    <select class="form-select" name="payment_type" required>
                        <option selected disabled>Select payment type</option>
                        <option>Cash</option>
                        <option>Bank Transfer</option>
                        <option>Credit Card</option>
                        <option>Cheque</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- Invoice Number -->
                <div class="mb-3">
                    <label class="form-label">Invoice Number</label>
                    <input type="text" name="invoice_number" class="form-control" placeholder="INV-1001">
                </div>

                <!-- Transaction Reference -->
                <div class="mb-3">
                    <label class="form-label">Transaction Reference</label>
                    <input type="text" name="transaction_reference" class="form-control" placeholder="TRX-123">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="paid" selected>Paid</option>
                        <option value="pending">Pending</option>
                        <option value="overdue">Overdue</option>
                        <option value="failed">Failed</option>
                        <option value="draft">Draft</option>
                        <option value="sent">Sent</option>
                    </select>
                </div>

                <!-- Private Notes -->
                <div class="mb-3">
                    <label class="form-label">Private Notes</label>
                    <textarea class="form-control" name="private_notes" rows="3"></textarea>
                </div>

                <!-- Send Email -->
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="sendEmail" name="send_email" checked>
                    <label class="form-check-label" for="sendEmail">Send Email</label>
                </div>

                <!-- Convert Currency -->
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="convertCurrency" name="convert_currency">
                    <label class="form-check-label" for="convertCurrency">Convert currency</label>
                </div>

                <button type="submit" class="btn btn-primary">Save Payment</button>
                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
