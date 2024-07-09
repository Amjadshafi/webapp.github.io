@extends('layouts.app-master')
@section('pageTitle', __('trans.Add New Spends'))
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
    <form action="{{route('createSpend')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label class="input-label" for="description">{{ __("trans.Description")}}:</label>
        <textarea class="form-control" id="description" name="description" value="description" rows="3" placeholder="{{ __('trans.Enter Project Description')}}" required></textarea>
      </div>
      <div class="form-group">
        <label class="input-label" for="description">{{ __("trans.Spends Title")}}:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('trans.Enter spends Title')}}" required>
      </div>
      <div class="form-group">
        <label class="input-label" for="project">{{ __("trans.Project")}}:</label>
        <select class="form-control" id="project_id" name="project_id">
          <option value="">{{ __("trans.Select the Project")}}</option>
          @foreach($projects as $project) 
          <option value="{{ $project->id }}">{{ $project->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label class="input-label" for="category">{{ __("trans.Category")}}:</label>
        <select class="form-control" id="category_id" name="category_id">
          <option value="">{{ __("trans.Select the Category")}}</option>
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->title}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label class="input-label" for="amount">{{ __("trans.Amount")}}:</label>
        <input type="number" id="totalAmount" name="totalAmount" class="form-control form-control-lg" step="0.01" placeholder="{{ __('trans.Enter the amount')}}" required>
        <small class="form-text text-muted">{{ __("trans.Enter the amount in numerical format")}}.</small>
      </div>
      <div class="form-group">
        <label class="input-label" for="image">{{ __("trans.Image")}}:</label>
        <input type="file" id="image" name="image" accept="image/*, .pdf" class="form-control-file">
        <small class="form-text text-muted">{{ __("trans.Choose images")}}.</small>
      </div>
      <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
      <button type="submit" class="btn btn-info">{{ __("trans.Submit")}}</button>
    </form>
  </div>
  @endsection