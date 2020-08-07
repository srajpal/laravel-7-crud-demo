@extends('layouts.email')

@section('content')

    <h1>{{ __('New Company Created') }}</h1>
    <h4>{{ __('Company') }}: {{ $company->name }}</h4>
    <h4>{{ __('Created by') }}: {{ $user->email }}</h4>
    <h4>{{ __('Created at') }}: {{ date("m/d/Y H:i:s") }}</h4>

    <h4>{{ __('IP') }}: {{ $_SERVER['REMOTE_ADDR'] ?? 'NO_IP' }}</h4>
    <h4>{{ __('User Agent') }}: {{ $_SERVER['HTTP_USER_AGENT'] ?? 'NO_UA' }}</h4>

@endsection
