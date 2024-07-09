@extends('layouts.app-master')
@section('pageTitle', __("trans.Dashboard"))
@section('content')


<!-- <div id="toaster"></div> -->
<div class="row">
<!-- Frist box -->
  <div class="col-xl-3 col-md-6">
    <div class="card card-default">
      <div class="d-flex p-5">
        <div class="icon-md bg-secondary rounded-circle mr-3">
          <i class="mdi mdi-account-plus-outline"></i>
        </div>
        <div class="text-left">
          <span class="h2 d-block">{{$userCount}}</span>
          <p><a href="{{ route('usersList') }}">{{ __("trans.All Users")}}</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Second box -->
  <div class="col-xl-3 col-md-6">
    <div class="card card-default">
      <div class="d-flex p-5">
        <div class="icon-md bg-success rounded-circle mr-3">
          <i class="mdi mdi-table-edit"></i>
        </div>
        <div class="text-left">
          <span class="h2 d-block">
            {{$projectCount}}</span>
          <p><a href="{{ route('projectsList') }}">{{ __("trans.All Project")}}</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Third box -->
  <div class="col-xl-3 col-md-6">
    <div class="card card-default">
      <div class="d-flex p-5">
        <div class="icon-md bg-primary rounded-circle mr-3">
          <i class="mdi mdi-content-save-edit-outline"></i>
        </div>
        <div class="text-left">
          <span class="h2 d-block">{{$categoryCount}}</span>
          <p><a href="{{ route('categoriesList') }}">{{ __("trans.All Category")}}</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Fourth box -->
  <div class="col-xl-3 col-md-6">
    <div class="card card-default">
      <div class="d-flex p-5">
        <div class="icon-md bg-info rounded-circle mr-3">
          <i class="mdi mdi-bell"></i>
        </div>
        <div class="text-left">
          <span class="h2 d-block">{{$spendCount}}</span>
          <p><a href="{{ route('spendsList') }}">{{ __("trans.All Spends")}}</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection