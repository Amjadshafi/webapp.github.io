@extends('layouts.app-master')
@section('pageTitle',__("trans.Roles"))
@section('content')

<div class="mt-2">
            @include('layouts.partials.messages')
        </div>
<div class="card ml-1 mr-1">
  <div class="card-header">
    <a href="{{ route('roles.create') }}" class="btn btn-info btn-sm float-right">{{ __("trans.Add New")}}</a>
  </div>
  <div class="card-body">
  <table id="data-table" class="table display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{ __("trans.No #")}}</th>
                <th>{{ __("trans.Name")}}</th>
                <th>{{ __("trans.Actions")}}</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
            <th>{{ __("trans.No #")}}</th>
                <th>{{ __("trans.Name")}}</th>
                <th>{{ __("trans.Actions")}}</th>
            </tr>
        </tfoot>
 
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a title="Show" href="{{ route('roles.show', $role->id) }}"><i class="mdi mdi-eye-outline"></i></a>
                        @if($role->id != 1)
                        <a title="Edit" href="{{ route('roles.edit', $role->id) }}"><i class="mdi mdi-square-edit-outline"></i></a>
                        @endif
                    </td>
                   
            @endforeach
            
        </tbody>
    </table> 
  </div>
</div>
@endsection
