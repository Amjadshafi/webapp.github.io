@extends('layouts.app-master')
@section('pageTitle',__("trans.Role"))
@section('content')
    <div class="bg-light p-4 rounded">        
        <div class="container mt-4">

            <h3>{{ __("trans.Assignedpermissions")}}</h3>

            <table class="table table-striped">
                <thead>
                    <th scope="col" width="20%">Name</th>
                    <th scope="col" width="1%">Guard</th> 
                </thead>

                @foreach($rolePermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">{{ __("trans.Edit")}}</a>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __("trans.Back")}}</a>
    </div>
@endsection