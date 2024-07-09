@extends('layouts.app-master')
@section('pageTitle',  __("trans.Project Details"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2>{{ __("trans.Show Project")}}</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-info" href="{{ route('projectsList') }}">{{ __("trans.Back")}} </a>
    </div>

    <div class="card-body">
    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Project Name")}}:</strong>
                            {{ $project->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Project Description")}}:</strong>
                            {{ $project->description }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Location")}}:</strong>
                            {{ $project->location}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Team Members")}}:</strong>
                            <ul class="row">
                                @foreach($project->users as $user)
                                <li class="col-1"><i class="mdi mdi-account">  {{$user->name}}</i></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endsection

