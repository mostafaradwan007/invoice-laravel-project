{{-- This file is located at resources/views/vendors/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Vendors-Edit')

@section('content')
    @vite(['resources/css/vendors.css'])
    <!-- Breadcrumb -->
<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            {{-- Home Link --}}
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a>
            </li>

            {{-- Loop through the breadcrumbs array --}}
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
            <h1 class="form-title">Edit Vendor: {{ $vendor->name }}</h1>

            {{-- The form now points to the update route for this specific vendor --}}
            <form id="editVendorForm" action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- This tells Laravel it's an UPDATE operation --}}

                <!-- Vendor Name (Required) -->
                <div class="form-group">
                    <label class="form-label required" for="name">Vendor Name</label>
                    {{-- The value is pre-filled with the vendor's current name --}}
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $vendor->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Website and Phone Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="website">Website</label>
                        <input type="url" class="form-control" id="website" name="website"
                            placeholder="https://example.com" value="{{ old('website', $vendor->website) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', $vendor->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ID and VAT Number Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="id_number">ID Number</label>
                        <input type="text" class="form-control @error('id-number') is-invalid @enderror"
                            id="id_number" name="id_number" value="{{ old('id_number', $vendor->id_number) }}">
                        @error('id-number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="vat_number">VAT Number</label>
                        <input type="text" class="form-control " id="vat_number" name="vat_number"
                            value="{{ old('vat_number', $vendor->vat_number) }}">
                    </div>
                </div>

                <!-- Primary Contact Section -->
                <hr class="my-4">
                <h5>Primary Contact</h5>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="contact_name">Contact Name</label>
                        <input type="text" class="form-control @error('contact-name') is-invalid @enderror"
                            id="contact_name" name="contact_name"
                            value="{{ old('contact_name', $vendor->contact_name) }}">
                        @error('contact-name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="contact_email">Contact Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                            id="contact_email" name="contact_email"
                            value="{{ old('contact_email', $vendor->contact_email) }}">
                        @error('contact_email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address Section -->
                <hr class="my-4">
                <h5>Address</h5>
                <div class="form-group">
                    <label class="form-label" for="street">Street</label>
                    <input type="text" class="form-control" id="street" name="street"
                        value="{{ old('street', $vendor->street) }}">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="city">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            name="city" value="{{ old('city', $vendor->city) }}">
                        @error('city')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="state">State / Province</label>
                        <input type="text" class="form-control" id="state" name="state"
                            value="{{ old('state', $vendor->state) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                            value="{{ old('postal_code', $vendor->postal_code) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="country">Country</label>
                        <select class="form-control" id="country" name="country"></select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('vendors.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Update Vendor</button>
                </div>
            </form>
        </div>
    </div>
@endsection
