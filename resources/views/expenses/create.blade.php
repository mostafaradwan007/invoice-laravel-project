@extends('layouts.app')

@section('title', 'Expenses')

@section('content')

    @vite(['resources/css/expenses.css'])
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
    
    <div class="form-container">
        <div class="form-card">
            <h1 class="form-title">New Expense</h1>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" value="{{ old('amount') }}" required min="0" step="0.01" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="expense_date">Date</label>
                        <input type="date" class="form-control" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="vendor_id">Vendor</label>
                        <select class="form-control" name="vendor_id">
                            <option value="">Select a vendor (optional)</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="client_id">Client</label>
                        <select class="form-control" name="client_id">
                            <option value="">Select a client (for billable expenses)</option>
                             @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="category">Category</label>
                    <select class="form-control" name="category" required>
                        <option value="">Select a category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="public_notes">Public Notes</label>
                    <textarea class="form-control" name="public_notes" rows="3" placeholder="Visible on invoices...">{{ old('public_notes') }}</textarea>
                </div>
                <div class="form-actions">
                    <a href="{{ route('expenses.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Expense</button>
                </div>
            </form>
        </div>
    </div>


@endsection