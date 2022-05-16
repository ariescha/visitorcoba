@extends('master')
@section('title')
Profil Petugas DC | JMDC Visitor
@endsection
<?php 
$user = Session::get('user');
if(session::has('status_petugas')){
  $is_superadmin = Session::get('status_petugas');
}else{
  $is_superadmin = 0;
}
?>
@section('content')
@include('petugas-dc.sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                        <b>JASA MARGA DATA CENTER VISITOR</b>
                    </div>
                </div>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="{{route('profil-petugas-dc')}}">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$user}}</span>
                            <small class="text-muted">Petugas Data Center</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> -->

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="form-edit-profil-petugas" action="{{route('edit-profil-petugas-dc')}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="row">
                          <input type="hidden" id="edit_id_petugas" name="edit_id_petugas" value="{{$PetugasDC['id_petugas']}}">
                          <div class="mb-3 col-md-6">
                            <label for="nama_lengkap_petugas" class="form-label">Nama Lengkap</label>
                            <input
                              class="form-control"
                              type="text"
                              id="edit_nama_lengkap_petugas"
                              name="edit_nama_lengkap_petugas"
                              value="{{$PetugasDC['nama_lengkap_petugas']}}"
                              autofocus
                              required
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="edit_instansi_petugas" class="form-label">Instansi</label>
                            <input class="form-control" type="text" name="edit_instansi_petugas" id="edit_instansi_petugas" value="{{$PetugasDC['instansi_petugas']}}" required/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="edit_nik_petugas" class="form-label">NIK</label>
                            <input class="form-control" type="text" name="edit_nik_petugas" id="edit_nik_petugas" value="{{$PetugasDC['nik_petugas']}}" required/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email_petugas" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="edit_email_petugas"
                              name="edit_email_petugas"
                              value="{{$PetugasDC['email_petugas']}}" readonly
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="nomor_hp_petugas">Nomor HP</label>
                            <div class="input-group input-group-merge">
                              <!-- <span class="input-group-text">ID (+62)</span> -->
                              <input
                                type="text"
                                id="edit_nomor_hp_petugas"
                                name="edit_nomor_hp_petugas"
                                class="form-control"
                                value="{{$PetugasDC['nomor_hp_petugas']}}"
                                maxlength="13" required
                              />
                            </div>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="edit_role_petugas">Role</label>
                            <div class="input-group input-group-merge">
                              <!-- <span class="input-group-text">ID (+62)</span> -->
                              @if($PetugasDC['nomor_hp_petugas'] == 0)
                              <input
                                type="text"
                                id="edit_role_petugas"
                                name="edit_role_petugas"
                                class="form-control"
                                value="Admin" readonly
                              />
                              @else
                              <input
                                type="text"
                                id="edit_role_petugas"
                                name="edit_role_petugas"
                                class="form-control"
                                value="Super Admin" readonly
                              />
                              @endif
                            </div>
                          </div>
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
            <!-- / Content -->
<script>
  function ShowNotifNew(text, warna) {
        var x = document.getElementById("TempatNotif");
        x.innerHTML = text;
        if (warna == null) {
          x.style.backgroundColor = "red";
        }
        else {
          x.style.backgroundColor = warna;
        }
        
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
      }

  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    ShowNotifNew(msg, 'green');
    //alert(msg);
  }
</script>
@endsection