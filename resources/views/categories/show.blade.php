@extends('layouts.app-master')
@section('pageTitle', __('trans.Categories Details'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2> {{ __("trans.Show Category")}}</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-info" href="{{ route('categoriesList') }}"> {{ __("trans.Back")}}</a>
    </div>

    <div class="card-body">
    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __("trans.Category Name")}}:</strong>
                            {{ $category->title }}
                        </div>
                    </div>
                </div>
                @endsection
