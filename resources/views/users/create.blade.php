@extends('layouts.app-master')
@section('pageTitle', __('trans.Create New User'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2>{{ __("trans.Add New User")}}</h2>
        <a class="btn btn-info btn-sm float-right" href="{{ route('usersList') }}">{{ __("trans.Back")}} </a>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <style>
            /* Custom styling for form */
            .container {
                max-width: 600px;
                margin: 0 auto;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group input[type="text"],
            .form-group input[type="password"],
            .form-group input[type="phone"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .form-group strong {
                display: block;
                margin-bottom: 5px;
            }

            .btn-primary {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>

        <div class="container">
            <form action="{{ route('createUser') }}" method="POST">
                @csrf
                <div class="form-group">
                    <strong>{{ __("trans.Name")}}:</strong>
                    <input type="text" name="name" placeholder="{{ __('trans.Name')}}">
                </div>

                <div class="form-group">
                    <strong>{{ __("trans.Email")}}:</strong>
                    <input type="text" name="email" placeholder="{{ __('trans.Email')}}">
                </div>

                <div class="form-group">
                    <strong>{{ __("trans.Phone No.")}}:</strong>
                    <input type="phone" name="phone_no" placeholder="{{ __('trans.Phone No.')}}">
                </div>

                <div class="form-group">
                    <label class="input-label" for="category">{{ __("trans.Role")}}:</label>
                    <select class="form-control" id="role_name" name="role_name" require>
                        <option value="">{{ __("trans.Select the Role")}}</option>
                        @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <strong>{{ __("trans.User Name")}}:</strong>
                    <input type="text" name="username" placeholder="{{ __('trans.User Name')}}">
                </div>

                <div class="form-group">
                    <strong>{{ __("trans.Password")}}:</strong>
                    <input type="password" name="password" placeholder="{{ __('trans.Password')}}">
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-info">{{ __("trans.Submit")}}</button>
                </div>
            </form>
        </div>
        @endsection