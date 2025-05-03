<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Aarogya Bharat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <!-- jsGrid -->
    <link rel="stylesheet" href="{{asset('admin/plugins/jsgrid/jsgrid.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/jsgrid/jsgrid-theme.min.css')}}">

   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  
 
   <!-- Toaster -->
   <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
       <!-- FontAwesome CSS -->
       <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Your other CSS files -->

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css')}}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
 @include('admin.layout.header')
  <!-- /.navbar -->
  @include('admin.layout.sidebar')
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
 @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<script src="{{ asset('admin/plugins/jsgrid/demos/db.js')}}"></script>
<script src="{{ asset('admin/plugins/jsgrid/jsgrid.min.js')}}"></script>

<!-- jQuery Mapael -->
<script src="{{ asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>



<!-- DataTables  & Plugins -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@if(!Route::is('admin.blogs.create2') && !Route::is('admin.blogs.edit2'))
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endif
<!-- jquery-validation -->
<script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- Toastr -->
<script src="{{asset('admin/plugins/toastr/toastr.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>

<!-- cheditor -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('admin/js/demo.js') }}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('admin/js/pages/dashboard2.js') }}"></script> -->
 @include('admin.layout.mainscript')
</body>
</html>
