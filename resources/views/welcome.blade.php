<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('backend/img/logo/logo.png')}}" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">
  <div id="app">
    <div id="wrapper">
      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- TopBar -->
          @include('layouts.topbar')
          <!-- Topbar -->
  
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <router-view></router-view>
          </div>
          <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>copyright &copy; {{date('Y')}} - developed by
                <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
              </span>
            </div>
          </div>
        </footer>
        <!-- Footer -->
      </div>
    </div>
  
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  </div>

  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('backend/js/ruang-admin.min.js')}}"></script>
  <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
  @stack('scripts') 
</body>

</html>