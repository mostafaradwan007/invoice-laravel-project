@extends('layouts.app')

@section('title', 'New Client')

@section('content')
<div class="container mt-5">
    <h2>Create Client</h2>
    <form action="{{ route('newclients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Client Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Client</button>
    </form>
</div>
@endsection
