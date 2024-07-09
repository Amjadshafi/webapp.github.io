@extends('layouts.app-master')
@section('pageTitle', __('trans.Update User'))
@section('content')
<div class="card ml-12 mr-12">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __("trans.Update User Information")}}</h2>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body ml-12 mr-12">
        <form method="post" action="{{ route('userUpdate', $user->id) }}">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">{{ __("trans.Name")}}:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" placeholder="{{ __('trans.Enter Name')}}">
            </div>

            <div class="form-group">
                <label for="email">{{ __("trans.Email")}}:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="{{ __('trans.Enter Email')}}">
            </div>

            <div class="form-group">
                <label for="phone">{{ __("trans.Phone No.")}}:</label>
                <input type="tel" id="phone" name="phone_no" class="form-control" value="{{ $user->phone_no}}" placeholder="{{ __('trans.Enter Phone No.')}}">
            </div>

            <div class="form-group">
                <label class="input-label" for="category">{{ __("trans.Role")}}:</label>
                <select class="form-control" id="role_name" name="role_name" require>
                    <option value="">{{ __("trans.Select the Role")}}</option>
                    @foreach($roles as $role)
                    <option value="{{$role->name}}" {{ (!empty($user->roles) && $user->roles[0]['id'] == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="username">{{ __("trans.User Name")}}:</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control" placeholder="{{ __('trans.Enter User Name')}}">
            </div>

            <div class="form-group">
                <label for="password">{{ __("trans.Password")}}:</label>
                <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control" placeholder="{{ __('trans.Enter Password')}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __("trans.Update")}}</button>
                <a class="btn btn-info" href="{{ route('usersList') }}"> {{ __("trans.Back")}}</a>
            </div>
        </form>
    </div>
</div>

@endsection