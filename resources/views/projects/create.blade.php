@extends('layouts.app-master')
@section('pageTitle', __('trans.Add New Project'))
@section('content')
<div class="card ml-7 mr-7">
  <div class="card-header">
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
  </div>
  <div class="card-body ml-7 mr-7">
  <form action="{{route('createProject')}}" method="POST">
    @csrf
    <div class="row">
      <div class="form-group col-6">
        <label class="input-label" for="amount">{{ __("trans.Name")}}</label>
        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="{{ __('trans.Enter the project Name')}}" required>
      </div>
      <div class="form-group col-6">
        <label class="input-label" for="users">{{ __("trans.Team Members")}}</label>
        <select name="members[]" id="sel-03" class=" select2-original" multiple >
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
      </div>
    </div>
    
      <div class="form-group">
        <label class="input-label" for="amount">{{ __("trans.Location")}}</label>
        <input type="text" id="location" name="location" class="form-control form-control-lg" placeholder="{{ __('trans.Enter the project Location')}}" required>
      </div>
      <div class="form-group">
        <label class="input-label" for="amount">{{ __("trans.Description")}}</label>
        <textarea id="description" name="description" Value="description" class="form-control form-control-lg" rows="5" ></textarea>
      </div>
    
    
    <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
    <button type="submit" class="btn btn-info">{{ __("trans.Submit")}}</button>
  </form>
</div>
@endsection
@section('scripts')
<script>
    $('.select2-original').select2({
    	placeholder: "{{ __('trans.Choose Team Members')}}",
      width: "100%"
    });
</script>
@endsection
