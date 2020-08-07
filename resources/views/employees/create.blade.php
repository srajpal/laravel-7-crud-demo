@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create new Employee') }}
                        <div class="float-right">
                            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('employees.store', $company->id) }}" method="post">
                            @csrf

                            <label for="company">{{ __('Company Name') }}</label>
                            <input
                                type="text"
                                name="company"
                                class="form-control"
                                value="{{ $company->name }}"
                                readonly
                            >

                            <label for="first_name" class="mt-2">{{ __('First Name') }}</label>
                            <input
                                type="text"
                                name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                placeholder="{{ __('First Name') }}"
                                value="{{ old('first_name') }}"
                            >


                            <label for="last_name" class="mt-2">{{ __('Last Name') }}</label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                placeholder="{{ __('Last Name') }}"
                                value="{{ old('last_name') }}"
                            >

                            <label for="email" class="mt-2">{{ __('Email') }}</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}"
                                value="{{ old('email') }}"
                            >

                            <label for="phone" class="mt-2">{{ __('Phone') }}</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="{{ __('Phone') }}"
                                value="{{ old('phone') }}"
                            >

                            <button class="btn btn-primary btn-block mt-5" type="submit">{{ __('Create this Employee') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
