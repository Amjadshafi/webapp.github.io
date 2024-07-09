@extends('layouts.app-master')
@section('pageTitle', __('trans.Users'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2>{{ __("trans.All Users Details")}}</h2>
        @auth
        @role(['Super Admin','Admin'])
        <a class="btn btn-info btn-sm float-right" href="{{ route('createUserForm') }}">{{ __("trans.Create New User")}}</a>
        @endrole
        @endauth
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("trans.Name")}}</th>
                    <th>{{ __("trans.Email")}}</th>
                    <th>{{ __("trans.Phone No.")}}</th>
                    <th>{{ __("trans.Username")}}</th>
                    <th>{{ __("trans.Status")}}</th>
                    <th>{{ __("trans.Operation")}}</th>
                    <th>{{ __("trans.Status")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_no }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->active ? __('trans.Active') : __('trans.Inactive') }}</td>
                    <td>
                        
                        <div class="btn-group" role="group" aria-label="User Actions">
                            <a href="{{ route('userDetails', ['user' => $user->id]) }}" title="Show"><i class="mdi mdi-eye-outline"></i></a>
                            <a href="{{ route('userUpdateForm' ,['user' => $user->id]) }}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('usersList', ['user' => $user->id]) }}" method="get">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-ms {{ $user->active ? 'btn-success' : 'btn-success' }}">
                                {{ $user->active ? __('trans.Deactivate') : __('trans.Activate') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection