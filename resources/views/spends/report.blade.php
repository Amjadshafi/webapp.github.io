@extends('layouts.app-master')
@section('pageTitle', __('trans.Spends Report'))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <form class="form-inline" id="filterForm">
                    <div class="input-group mb-2 mr-sm-2">
                        <select class="form-control" id="project_id" name="project_id">
                            <option value="">{{ __("trans.Select Project")}}</option>
                            @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-2 mr-sm-2">
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">{{ __("trans.Select Category")}}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-2 mr-sm-2">
                        <div id="reportrange" class="pull-left form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info btn-pill mb-2" onclick="filterData()">{{ __("trans.Submit")}}</button>
                </form>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-3 offset-6 text-right">
                        <form method="POST" action="{{ route('spendReport.downloadCSV') }}">
                            @csrf
                            <input type="hidden" name="dateRange" class="reportrange">
                            <input type="hidden" name="project_id" class="project_id">
                            <input type="hidden" name="category_id" class="category_id">
                            <button type="submit" class="btn btn-info">{{ __("trans.Download CSV")}}</button>
                        </form>
                    </div>
                    <div class="col-3 text-right">
                        <form method="POST" action="{{ route('spendReport.downloadPDF') }}">
                            @csrf
                            <input type="hidden" name="dateRange" class="reportrange">
                            <input type="hidden" name="project_id" class="project_id">
                            <input type="hidden" name="category_id" class="category_id">
                            <button type="submit" class="btn btn-info">{{ __("trans.Download PDF")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __("trans.Spend")}}</th>
                    <th>{{ __("trans.Category")}}</th>
                    <th>{{ __("trans.Project")}}</th>
                    <th>{{ __("trans.Amount")}}</th>
                    <th>{{ __("trans.Image")}}</th>
                    <th>{{ __("trans.Created By")}}</th>
                </tr>
            </thead>

            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th>{{ __("trans.Total Amount")}}:</th>
                <th>
                    <div> <span id="totalAmount"></span></div>
                </th>
            </tfoot>

            <tbody id="data_body">

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img src="" alt="" width="100%" id="image" class="img-fluid">
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('.reportrange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
    $(document).ready(function() {
        filterData();
        // Gets the video src from the data-src on each button
        var $imageSrc;
        // $('.gallery img').click(function() {
        //     $imageSrc = $(this).data('bigimage');
        // });
        console.log($imageSrc);



        // when the modal is opened autoplay it  
        $('#myModal').on('shown.bs.modal', function(e) {
            // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
            $("#image").attr('src', $imageSrc);
        })


        // reset the modal image
        $('#myModal').on('hide.bs.modal', function(e) {
            // a poor man's stop video
            $("#image").attr('src', '');
        })

    });


    function modal_data(element) {
        var imageSrc = $(element).data('bigimage');
        $("#image").attr('src', imageSrc);
        $('#myModal').modal('show');
    }

    $("#project_id").on('change', function() {
        debugger;
        var project_id = $('#project_id').find(":selected").val();
        $(".project_id").val(project_id);
    });
    $("#category_id").on('change', function() {
        debugger;
        var category_id = $('#category_id').find(":selected").val();
        $(".category_id").val(category_id);
    });

    function filterData() {
        var formData = new FormData(document.getElementById('filterForm'));
        var dateRange = $("#reportrange span").text();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("dateRange", dateRange); // Ensure dateRange is correctly set
        $.ajax({
            type: "POST",
            url: "{{ route('filterData.spends') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var res = JSON.parse(data);
                $("#data_body").empty();
                $("#data_body").append(res.contect);
                $("#totalAmount").text('$' + res.totalAmount.toFixed(2));
            }
        });
    }
</script>

@endsection