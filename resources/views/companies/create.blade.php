@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create new Company') }}
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

                        <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="name">{{ __('Company Name') }}</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('Company Name') }}"
                                value="{{ old('name') }}"
                            >


                            <label for="email" class="mt-2">{{ __('Email') }}</label>
                            <input
                                type="text"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}"
                                value="{{ old('email') }}"
                            >

                            <label for="website" class="mt-2">{{ __('Website') }}</label>
                            <input
                                type="text"
                                name="website"
                                class="form-control @error('website') is-invalid @enderror"
                                placeholder="{{ __('Website') }}"
                                value="{{ old('website') }}"
                            >

                            <label for="logo" class="mt-2">{{ __('Logo (100x100 min)') }}</label>
                            <input
                                type="file"
                                name="logo"
                                class="form-control-file @error('logo') is-invalid @enderror"
                            >

                            <button class="btn btn-primary btn-block mt-5" type="submit">{{ __('Create this Company') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
