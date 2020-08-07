@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Companies') }}</div>

                    <div class="card-body">

                        <p>
                            <a
                                href="{{ route('companies.create') }}"
                                class="btn btn-primary"
                            >{{ __('Create new company') }}</a>
                        </p>

                        @if (session('message-success'))
                            <div class="alert alert-success">{{ session('message-success') }}</div>
                        @endif

                        <table id="tblCompanies" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>{{ __('id') }}</th>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('email') }}</th>
                                <th>{{ __('logo') }}</th>
                                <th>{{ __('website') }}</th>
                                <th>{{ __('employees') }}</th>
                                <th>{{ __('options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    <a
                                        href="{{ $company->logo }}"
                                        data-lightbox="image-{{ $company->id }}"
                                        data-title="Logo"
                                    ><img src="{{ $company->logo }}" alt="" height="32" width="32"></a>
                                </td>
                                <td>{{ $company->website }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employees.index', $company->id) }}" class="btn btn-info btn-sm">
                                        <span class="fa fa-users"></span> {{ $company->employees_count }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a
                                        href="{{ route('companies.edit',$company->id) }}"
                                        class="btn btn-secondary btn-sm"
                                    ><span class="fa fa-pencil"></span></a>
                                    &nbsp;
                                    <button
                                        class="btn btn-danger btn-sm"
                                        id="btnDelete"
                                        companyid="{{ $company->id }}"
                                        route="{{ route('companies.destroy', $company->id) }}"
                                    ><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ __('id') }}</th>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('email') }}</th>
                                <th>{{ __('logo') }}</th>
                                <th>{{ __('website') }}</th>
                                <th>{{ __('employees') }}</th>
                                <th>{{ __('options') }}</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
    <script>
        $(document).ready( function () {
            $('#tblCompanies').DataTable({
                order: [[0,"DESC"]]
            });
            $('[data-toggle="tooltip"]').tooltip();
        } );

        $(document).on('click','[id^=btnDelete]',function(){
            let companyid = $(this).attr('companyid');
            let route = $(this).attr('route');
            let conf = confirm('{{ __('Do you want to delete company') }}, '+companyid+'?');

            if (conf) {
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    success: function(data) {
                        // data returned is JSON object
                        if (data.status) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    },
                    error : function (xhr, status, error) {
                        alert('Error: '+error);
                    }
                });
            }
        });
    </script>
@endsection
