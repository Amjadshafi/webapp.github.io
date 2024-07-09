@extends('layouts.app-master')
@section('pageTitle', __("trans.UpdateProject"))
@section('content')
<div class="card ml-12 mr-12">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __("trans.Update Project Information")}}</h2>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body ml-12 mr-12">
        <form method="post" action="{{ route('projectUpdate', $project->id) }}">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="name">{{ __("trans.Name")}}:</label>
                <input type="text" id="name" name="name" value="{{ $project->name }}" class="form-control" placeholder="{{ __('trans.Enter name')}}">
            </div>

            <div class="form-group">
                <label for="description">{{ __("trans.Description")}}:</label>
                <input type="text" id="email" name="description" value="{{ $project->description }}" class="form-control" placeholder="{{ __('trans.Enter description')}}">
            </div>

            <div class="form-group">
                <label for="location">{{ __("trans.Location")}}:</label>
                <input type="location" id="location" name="location" value="{{ $project->location }}" class="form-control" placeholder="{{ __('trans.Enter Location')}}">
            </div>
            <div class="form-group col-12">
                <label class="input-label" for="users">{{ __("trans.Team Members")}}</label>
                <select name="members[]" id="sel-03" class="select2-original" multiple>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __("trans.Update")}}</button>
                <a class="btn btn-info" href="{{ route('projectsList') }}">{{ __("trans.Back")}} </a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('.select2-original').select2({
    	placeholder: "{{ __('trans.Update Team Members')}}",
      width: "100%"
    });
</script>
@endsection