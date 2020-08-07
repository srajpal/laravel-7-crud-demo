@extends('layouts.email')

@section('content')

    <h1>New Company Created</h1>
    <h4>Company: {{ $company->name }}</h4>
    <h4>Created by: {{ $user->email }}</h4>
    <h4>Created at: {{ date("m/d/Y H:i:s") }}</h4>

    <h4>IP: {{ $_SERVER['REMOTE_ADDR'] ?? 'NO_IP' }}</h4>
    <h4>User Agent: {{ $_SERVER['HTTP_USER_AGENT'] ?? 'NO_UA' }}</h4>

@endsection
