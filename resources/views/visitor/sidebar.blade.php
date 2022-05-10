
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
              <li class="menu-item active" id="dashboard-visitor">
                <a href="{{route('dashboard-visitor')}}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-fingerprint"></i>
                  <div data-i18n="Analytics">Dashboard Check In</div>
                </a>
              </li>
              <li class="menu-item" id="profil-visitor">
                <a href="{{route('profil-visitor')}}" class="menu-link">
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
              if(currentRoute == 'dashboard-visitor'){
                document.getElementById('dashboard-visitor').classList.add('active');
                document.getElementById('profil-visitor').classList.remove('active');
                
              }else{
                document.getElementById('dashboard-visitor').classList.remove('active');
                document.getElementById('profil-visitor').classList.add('active');
              }
          });
          </script>