@extends('layouts.app-master')
@section('pageTitle', __('trans.Spend Details'))
@section('content')
<div class="card ml-7 mr-7">
  <div class="card-header">
    <h5>{{ __("trans.Spend Details")}}</h5>
  </div>
  <div class="card-body ml-7 mr-7">
    <h6>{{ __("trans.Title")}}: {{ $spend->title }}</h6>
    <p>{{ __("trans.Description")}}: {{ $spend->project->description }}</p>
    <p>{{ __("trans.Category")}}: {{ $spend->category->title }}</p>
    <p>{{ __("trans.Project")}}: {{ $spend->project->name }}</p>
    <p>{{ __("trans.Amount")}}: ${{ round($spend->totalAmount, 2) }}</p>
    <p>{{ __("trans.Created By")}}: {{ $spend->user->name }}</p>
    @if($spend->image)
    <p>{{ __("trans.Image")}}:</p>
    <img src="{{ asset('uploads/' . $spend->image) }}" alt="Spend Image" width="200">
    @endif
    <a href="{{ route('spendsList') }}" class="btn btn-secondary">{{ __("trans.Back")}}</a>
  </div>
</div>
@endsection
