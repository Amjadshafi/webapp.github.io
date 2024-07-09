@extends('layouts.app-master')
@section('pageTitle', __("trans.Project Details"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
    @auth
    @role(['Super Admin','Admin'])
        <h2>{{ __("trans.All Project Details")}}</h2>
        <a class="btn btn-info btn-sm float-right" href="{{ route('createProjectForm') }}">{{ __("trans.Create New Project")}}</a>
    @endrole
    @endauth
    </div>
    @if ($message = Session::get('success'))
        <div id="created"></div>
    @endif
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("trans.Project Name")}}</th>
                    <th>{{ __("trans.Project Description")}}</th>
                    <th>{{ __("trans.Location")}}</th>
                    <th>{{ __("trans.Operation")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $key => $project)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->location}}</td>
                    <td>
                            <a href="{{ route('projectDetails', ['project' => $project->id]) }}" title="Show"><i class="mdi mdi-eye-outline"></i></a>
                            @auth
                            @role(['Super Admin','Admin'])
                            <a href="{{ route('projectUpdateForm' ,['project' => $project->id]) }}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                            @endrole
                            @endauth
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection