@extends('layouts.app-master')
@section('pageTitle', __('trans.Edit Category'))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Edit Category")}}</h2>
        <form action="{{ route('categoryUpdate', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{ __("trans.Category Name")}}</label>
                <input type="text" name="title" class="form-control" value="{{ $category->title }}" required>
            </div>
            <button type="submit" class="btn btn-info">{{ __("trans.Update")}}</button>
        </form>
    </div>
</div>
@endsection
