@extends('auth.layouts')

@section('content')
    @if ($message = Session::get('success'))
        <div id="welcome"></div>
    @endif
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
            </div>
        </div>
    </div>    
</div>
    
@endsection