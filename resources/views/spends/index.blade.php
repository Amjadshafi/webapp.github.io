@extends('layouts.app-master')
@section('pageTitle', __('trans.Spends'))
@section('content')
<div class="card ml-1 mr-1">
  <div class="card-header">
    @auth
    @role(['Super Admin','Admin'])
    <a href="{{ route('createSpendForm') }}" class="btn btn-info btn-sm float-right">{{ __("trans.Add New")}}</a>
    @endrole
    @endauth
  </div>
  <div class="card-body">
    <table id="data-table" class="table display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Spend")}}</th>
          <th>{{ __("trans.Category")}}</th>
          <th>{{ __("trans.Project")}}</th>
          <th>{{ __("trans.Amount")}}</th>
          <th>{{ __("trans.Created By")}}</th>
          <th>{{ __("trans.Operation")}}</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Spend")}}</th>
          <th>{{ __("trans.Category")}}</th>
          <th>{{ __("trans.Project")}}</th>
          <th>{{ __("trans.Amount")}}</th>
          <th>{{ __("trans.Created By")}}</th>
          <th>{{ __("trans.Operation")}}</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach($spends as $key => $spend)
        <tr>
          <td>{{++$key}}</td>
          <td>{{$spend->title}}</td>
          <td>{{$spend->category->title}}</td>
          <td>{{$spend->project->name}}</td>
          <td>$<?= round($spend->totalAmount, 2); ?></td>
          <td>{{$spend->user->name}}</td>
          <td>
            <div class="btn-group" role="group" aria-label="User Actions">
              <a href="{{ route('spendDetails', $spend->id) }}" title="Show"><i class="mdi mdi-eye-outline"></i></a>
              @auth
              @role(['Super Admin','Admin'])
              <a href="{{ route('spendUpdateForm', $spend->id) }}" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>
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