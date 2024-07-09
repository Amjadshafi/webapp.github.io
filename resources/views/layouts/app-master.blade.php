<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('pageTitle')</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('theme/plugins/material/css/materialdesignicons.min.css') }}" />

  <link rel="stylesheet" href="{{ asset('theme/plugins/simplebar/simplebar.css') }}" />

  <!-- PLUGINS CSS STYLE -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/nprogress/nprogress.css') }}" />

  <link rel="stylesheet" href="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" />

  <link rel="stylesheet" href="{{ asset('theme/plugins/daterangepicker/daterangepicker.css') }}" />
  <link href="{{ asset('theme/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />



  <link href="{{ asset('theme/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />

  <!-- MONO CSS -->
  <link rel="stylesheet" id="main-css-href" href="{{ asset('theme/css/style.css') }}" />

  <!-- Custom Styling -->
  <link rel="stylesheet" id="main-css-href" href="{{ asset('theme/css/custom.css') }}" />


  <!-- FAVICON -->
  <!-- <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}" /> -->

  <script src="{{ asset('theme/plugins/nprogress/nprogress.js') }}"></script>
  @yield("custom_css")

</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <script>
    NProgress.configure({
      showSpinner: false
    });
    NProgress.start();
  </script>

  <!-- ====================================
    ——— WRAPPER
    ===================================== -->
  <div class="wrapper">
    <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
    @include('layouts.partials.side_navbar')



    <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
    <div class="page-wrapper">

      <!-- Header -->
      @include('layouts.partials.header')
      @include('layouts.partials.messages')

      <!-- @include('layouts.partials.messages') -->
      <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
      <div class="content-wrapper">
        @yield('content')

      </div>

      <!-- Footer -->
      <footer class="footer mt-auto">
        <div class="copyright bg-white">

        </div>
      </footer>

    </div>
  </div>
  <script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('theme/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>

  <script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('theme/plugins/simplebar/simplebar.min.js') }}"></script>



  <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
  <script src="{{ asset('theme/plugins/apexcharts/apexcharts.js') }}"></script>

  <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
  <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
  <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
  <script src="{{ asset('theme/plugins/daterangepicker/moment.min.js') }}"></script>
  <!-- <script src=""></script> -->
  <script src="{{ asset('theme/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- <script src=""></script> -->
  <script>
    $("#logout").on('click', function() {
      $("#logoutForm").submit();
    });

    // jQuery(document).ready(function() {
    //   jQuery('input[name="dateRange"]').daterangepicker({
    //   autoUpdateInput: false,
    //   singleDatePicker: true,
    //   locale: {
    //     cancelLabel: 'Clear'
    //   }
    // });
    //   jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
    //     jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
    //   });
    //   jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
    //     jQuery(this).val('');
    //   });
    // });
  </script>

  <script src="{{ asset('theme/plugins/toaster/toastr.min.js') }}"></script>

  <script src="{{ asset('theme/js/mono.js') }}"></script>
  <script src="{{ asset('theme/js/chart.js') }}"></script>
  <script src="{{ asset('theme/js/map.js') }}"></script>
  <script src="{{ asset('theme/js/custom.js') }}"></script>

  <script type="text/javascript" src="https://select2.github.io/select2/select2-3.5.1/select2.js"></script>
  <link rel="stylesheet" type="text/css" href="https://select2.github.io/select2/select2-3.5.1/select2.css">

  <!-- Include Date Range Picker -->
  <script src="{{ asset('theme/js/moment.min.js') }}"></script>
  <script src="{{ asset('theme/js/daterangepicker.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  @yield('scripts')
</body>

</html>