<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Панель управления</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('css/admin_css/adminlte.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">
<link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>


 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 @include  ('layouts.admin_layout.admin_header')
 @include  ('layouts.admin_layout.admin_sidebar')
 @yield  ('content')
 @include  ('layouts.admin_layout.admin_footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="{{ url('plugins/chart.js/Chart.min.js')  }}"></script>
<!-- Sparkline -->
<script src="{{ url('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Summernote -->
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/js/demo.js') }}"></script>
<!--custom admin js-->
<script src="{{ url('/js/admin_script.js') }}"></script>

<script src="{{url('plugins/datatables/jquery.dataTables.min.js') }}"></script>


<script>
  $(function () {
    $("#sections").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
     $("#categories").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
      $("#products").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
      $("#brands").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
      $("#suppliers").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
      $("#receipts").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
    
      $("#currency").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true
    });
    $("#productsTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true,

    });
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,
      'select': true,

    });
    
  });
</script>
<script src="{{ url('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    //Initialize Select2 Elements
    $('.select2').select2();

    
</script>
<!--SweetAlert Script-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    
    <script type="text/javascript">
    $(".nav-tabs a").click(function(){
     $(this).tab('show');
 });</script>
    
    
<script type="text/javascript">
        $(function() {
           $('#datetimepicker').datetimepicker(
            {

              format:'YYYY-MM-DD'
            });

          
        });
    </script>  

@stack('scripts')


</body>
</html>
