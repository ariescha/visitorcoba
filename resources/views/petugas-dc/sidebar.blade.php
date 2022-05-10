
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <img src="assets/img/logo-landscape.png" height="70" alt="View Badge User" data-app-dark-img="logo.png" data-app-light-img="logo.png"/>
           
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            
            <li class="menu-item" id="approval-check-in">
              <a href="{{route('approval-check-in')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-fingerprint"></i>
                <div data-i18n="Analytics">Approval Check In</div>
              </a>
            </li>
            
            <li class="menu-item" id="approval-registrasi">
              <a href="{{route('approval-registrasi')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-edit"></i>
                <div data-i18n="Analytics">Approval Registrasi</div>
              </a>
            </li>
            @if($is_superadmin == 1)
            <li class="menu-item" id="manajemen-petugas">
              <a href="{{route('manajemen-petugas')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Manajemen Petugas DC</div>
              </a>
            </li>
            @endif
            <li class="menu-item" id="profil-petugas-dc">
              <a href="{{route('profil-petugas-dc')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profil</div>
              </a>
            </li>
            
          </ul>
        </aside>
        <!-- / Menu -->

        <script type="text/javascript">
          var currentRoute='{{Route::current()->getName()}}';
          $( document ).ready(function() {
              if(currentRoute == 'approval-check-in'){
                document.getElementById('approval-check-in').classList.add('active');
                document.getElementById('approval-registrasi').classList.remove('active');
                document.getElementById('manajemen-petugas').classList.remove('active');
                document.getElementById('profil-petugas-dc').classList.remove('active');
              }else if (currentRoute == 'approval-registrasi'){
                document.getElementById('approval-check-in').classList.remove('active');
                document.getElementById('approval-registrasi').classList.add('active');
                document.getElementById('manajemen-petugas').classList.remove('active');
                document.getElementById('profil-petugas-dc').classList.remove('active');
              } else if(currentRoute == 'manajemen-petugas'){
                document.getElementById('approval-check-in').classList.remove('active');
                document.getElementById('approval-registrasi').classList.remove('active');
                document.getElementById('manajemen-petugas').classList.add('active');
                document.getElementById('profil-petugas-dc').classList.remove('active');
              }else{
                document.getElementById('approval-check-in').classList.remove('active');
                document.getElementById('approval-registrasi').classList.remove('active');
                document.getElementById('manajemen-petugas').classList.remove('active');
                document.getElementById('profil-petugas-dc').classList.add('active');
              }
          });
        </script> 