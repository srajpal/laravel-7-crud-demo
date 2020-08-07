@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Card Name') }}
                        <div class="float-right">
                            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>

                    <div class="card-body">



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
