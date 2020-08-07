@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Employees for ').$company->name }}
                        <div class="float-right">
                            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <p>
                            <a
                                href="{{ route('employees.create', $company->id) }}"
                                class="btn btn-primary"
                            >{{ __('Create new employee') }}</a>
                        </p>

                        @if (session('message-success'))
                            <div class="alert alert-success">{{ session('message-success') }}</div>
                        @endif

                        <table id="tblEmployees" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>first name</th>
                                <th>last name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->first_name}}</td>
                                <td>{{$employee->last_name}}</td>
                                <td>
                                    @if ($employee->email)
                                        <a
                                            href=""
                                            class="btn btn-secondary btn-sm"
                                            data-toggle="tooltip"
                                            title="{{ $employee->email }}"
                                        >Send Email</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($employee->phone)
                                        <a
                                            href=""
                                            class="btn btn-secondary btn-sm"
                                            data-toggle="tooltip"
                                            title="{{ $employee->phone }}"
                                        >Send SMS</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a
                                        href="{{ route('employees.edit', [$company->id, $employee->id]) }}"
                                        class="btn btn-secondary btn-sm"
                                    ><span class="fa fa-pencil"></span></a>
                                    &nbsp;
                                    <button
                                        class="btn btn-danger btn-sm"
                                        id="btnDelete"
                                        employeeid="{{ $employee->id }}"
                                        route="{{ route('employees.destroy', [$company->id, $employee->id]) }}"
                                    ><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>first name</th>
                                <th>last name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>options</th>
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
            $('#tblEmployees').DataTable({
                order: [[0,"DESC"]]
            });
            $('[data-toggle="tooltip"]').tooltip();
        } );

        $(document).on('click','[id^=btnDelete]',function(){
            let employeeid = $(this).attr('employeeid');
            let route = $(this).attr('route');
            let conf = confirm('Do you want to delete employee, '+employeeid+'?');

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
