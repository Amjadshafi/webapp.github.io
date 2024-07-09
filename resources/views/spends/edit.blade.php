@extends('layouts.app-master')
@section('pageTitle', __('trans.Edit Spend'))
@section('content')
<div class="card ml-7 mr-7">
  <div class="card-header">
    
  </div>
  <div class="card-body ml-7 mr-7">
  <form action="{{ route('spendUpdate', $spend->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label class="input-label" for="description">{{ __("trans.Description")}}:</label>
      <textarea class="form-control" id="description" name="description" rows="3" placeholder="{{ __('trans.Enter Project Description')}}" required>{{ $spend->description }}</textarea>
    </div>
    <div class="form-group">
      <label class="input-label" for="description">{{ __("trans.Description")}}Spends:</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ $spend->title }}" placeholder="{{ __('trans.Enter spends')}}" required>
    </div>
    <div class="form-group">
      <label class="input-label" for="project">{{ __("trans.Project")}}:</label>
      <select class="form-control" id="project_id" name="project_id">
        <option value="">{{ __("trans.Select the Project")}}</option>
        @foreach($projects as $project)
        <option value="{{ $project->id }}" {{ $project->id == $spend->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label class="input-label" for="category">{{ __("trans.Category")}}:</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">{{ __("trans.Select the Category")}}</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $spend->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label class="input-label" for="amount">{{ __("trans.Amount")}}:</label>
      <input type="number" id="totalAmount" name="totalAmount" value="{{ $spend->totalAmount }}" class="form-control form-control-lg" step="0.01" placeholder="{{ __('trans.Enter the amount')}}" required>
      <small class="form-text text-muted">{{ __("trans.Enter the amount in numerical format")}}.</small>
    </div>
    <div class="form-group">
      <label class="input-label" for="image">{{ __("trans.Image")}}:</label>
      <input type="file" id="image" name="image" accept="image/*, .pdf" class="form-control-file">
      <small class="form-text text-muted">{{ __("trans.Choose images")}}</small>
    </div>
    <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
    <button type="submit" class="btn btn-info">{{ __("trans.Update")}}</button>
  </form>
</div>
</div>
@endsection