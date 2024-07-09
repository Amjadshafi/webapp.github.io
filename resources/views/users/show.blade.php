@extends('layouts.app-master')
@section('pageTitle', __('trans.User Details'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2> {{ __("trans.Show User")}}</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-info" href="{{ route('usersList') }}"> {{ __("trans.Back")}}</a>
    </div>

    <div class="card-body">
    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Name")}}:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Email")}}:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Phone No.")}}:</strong>
                            {{ $user->phone_no}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.User Name")}}:</strong>
                            {{ $user->username }}
                        </div>
                    </div>
                </div>
                @endsection

