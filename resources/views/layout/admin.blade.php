<!DOCTYPE html>
<html lang="en">

<head>
@include('layout.inc_header');
<style>
  .error{
color: red;
}
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layout.header');

  <!-- ======= Sidebar ======= -->
@include('layout.sidebar');
  <!-- End Sidebar-->

  <main id="main" class="main">
  
   @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="{{ asset('assets/js/jquery-3.5.0.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>   
   <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets//js/dataTables.bootstrap.min.js') }}"></script>
  @stack('custom-scripts')
</body>
</html>