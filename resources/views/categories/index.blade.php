@extends('layouts.app-master')
@section('pageTitle', __('trans.Categories Details'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <h2>{{ __("trans.Categories")}}</h2>
        @auth
        @role(['Super Admin','Admin'])
        <a class="btn btn-info btn-sm float-right" href="{{ route('createCategoryForm') }}">{{ __("trans.Create New Category")}}</a>
        @endrole
        @endauth
    </div>
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("trans.Category Name")}}</th>
                    <th>{{ __("trans.Created By")}}</th>
                    <th>{{ __("trans.Operation")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Category Actions">
                            <a href="{{ route('categoryDetails', $category->id) }}" title="Show"><i class="mdi mdi-eye-outline"></i></a>
                            @auth
                            @role(['Super Admin','Admin'])
                            <a href="{{ route('categoryUpdateForm', $category->id) }}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
                            @endrole
                            @endauth
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection