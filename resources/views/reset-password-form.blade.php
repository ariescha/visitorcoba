<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  datURL::asseta-assets-pathURL::asset="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Lupa Password | JMDC Visitor</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('assets/img/logo.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{URL::asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{URL::asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <img src="{{URL::asset('assets/img/logo.png')}}" height="200" alt="View Badge User" data-app-dark-img="logo.png" data-app-light-img="logo.png"/>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">RESET PASSWORD</h4>
              @if(Session::has('alert'))
                				<div class="alert alert-danger">
                    			<div>{{Session::get('alert')}}</div>
                				</div>
            				@endif
            				<!-- @if(\Session::has('alert-success'))
                				<div class="alert alert-success">
                    			<div>{{Session::get('alert-success')}}</div>
                				</div>
            				@endif -->
              <form id="form-password" class="mb-3" action="{{route('reset-password-send')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="token" value="{{ $token }}">
      
                <div class="mb-3 ">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Masukkan email anda"
                    value="{{ $email->email }}"
                    readonly
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label for="password" class="form-label">Password Baru</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus
                    required
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                </div>
                </div>
                <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label for="konfirmasi-password" class="form-label">Konfirmasi Password Baru</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    class="form-control"
                    id="konfirmasi-password"
                    name="konfirmasi-password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    required onkeyup="validasipassword()"
                  />
                  <span class="input-group-text cursor-pointer" id="konfirmasi-password-see"><i class="bx bx-hide"></i></span>

                </div>
                <small id="alert-password"></small>
                </div>
                
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="button" onclick="validate()">Kirim</button>
                </div>
              </form>
              <a href="{{route('login')}}">
                      <span>Kembali ke halaman Log In</span>
                    </a>
              
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    

    <!-- Core JS -->
    <!-- builURL::assetd:assets/vendor/js/core.js -->
    <script src="{{URL::asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{URL::asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script type=text/javascript>
      var password_validate = 0;
    function validasipassword(){
      console.log('tes');
      var password_baru = document.getElementById("password").value;
      var password_konfirmasi = document.getElementById("konfirmasi-password").value;
      if(password_baru !== password_konfirmasi){
        document.getElementById("konfirmasi-password").style = "border-color:red";
        document.getElementById("konfirmasi-password-see").style = "border-color:red";
        password_validate = 0;
      }else{
        document.getElementById("konfirmasi-password").style = "border-color:blue";
        document.getElementById("konfirmasi-password-see").style = "border-color:blue";
        document.getElementById("alert-password").innerHTML="";

        password_validate = 1;
      }
    }
    function validate(){
      if(password_validate == 0){
        document.getElementById("alert-password").innerHTML="Password tidak cocok!";
        document.getElementById("alert-password").style="color:red;";

      }
      else{
        document.getElementById("konfirmasi-password").style = "";
        document.getElementById("konfirmasi-password-see").style = "";
        document.getElementById("form-password").submit();
      }
    }
    </script>
    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
