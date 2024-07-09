@extends('layouts.app-master')
@section('pageTitle', 'Add New Category')
@section('custom_css')
<style>
    .form-group {
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 20px; /* Adjust the value as needed */
    }
</style>
@endsection
@section('content')
<div class="card ml-8 mr-8">
  <div class="form-group col-8">
    <h2 class="text-center mb-4">Category Form</h2>
    <form action="{{ route('createCategory') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="text-center mb-4">Category Name</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</div>
</div>
@endsection
