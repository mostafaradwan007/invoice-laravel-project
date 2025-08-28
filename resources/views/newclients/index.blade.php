@extends('layouts.app')

@section('title', 'Clients - Bee Company')

@section('content')
    <h1>Clients</h1>
    <ul>
        @foreach($clients as $client)
            <li>{{ $client->name }} - {{ $client->email ?? '-' }} - {{ $client->phone ?? '-' }}</li>
        @endforeach
    </ul>
@endsection
