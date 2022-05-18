@extends('master')
@section('title')
Profil Visitor | JMDC Visitor
@endsection
@section('content')
<?php 
$user = Session::get('user');
?>

        @include('visitor.sidebar')

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
                      <a class="dropdown-item" href="{{route('profil-visitor')}}">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$user}}</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('logout')}}">
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
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <!-- <img
                          src="assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        /> -->
                        <!-- <div class="button-wrapper"> -->
                          <!-- <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label> -->
                          <!-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button> -->

                          <!-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> -->
                        <!-- </div> -->
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAuthentication" class="mb-4" action="{{route('update-profil-visitor')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="namaLengkapVisitor" class="form-label">Nama Lengkap</label>
                            <input
                              class="form-control"
                              type="text"
                              id="namaLengkapVisitor"
                              name="namaLengkapVisitor"
                              value='{{$DataVisitor->nama_lengkap_visitor}}'
                              autofocus required 
                              oninvalid="this.setCustomValidity('Silahkan isi nama!')" oninput="this.setCustomValidity('')"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="nikVisitor" class="form-label">NIK</label>
                            <input 
                              class="form-control" 
                              type="text" 
                              name="nikVisitor" 
                              id="nikVisitor" 
                              value='{{$DataVisitor->nik_visitor}}'
                              required
                              oninvalid="this.setCustomValidity('Silahkan isi NIK!')" oninput="this.setCustomValidity('')"
                              />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="asalInstansiVisitor" class="form-label">Asal Instansi</label>
                            <input
                              class="form-control"
                              type="text"
                              id="asalInstansiVisitor"
                              name="asalInstansiVisitor"
                              value='{{$DataVisitor->asal_instansi_visitor}}'
                              required
                              oninvalid="this.setCustomValidity('Silahkan isi asal instansi!')" oninput="this.setCustomValidity('')"
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="emailVisitor" class="form-label">Email</label>
                            <input
                              class="form-control"
                              type="text"
                              id="emailVisitor"
                              name="emailVisitor"
                              value='{{$DataVisitor->email_visitor}}'
                              readonly 
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="nomorHpVisitor">Nomor HP</label>
                            <div class="input-group input-group-merge">
                              <!-- <span class="input-group-text">ID (+62)</span> -->
                              <input
                                type="text"
                                id="nomorHpVisitor"
                                name="nomorHpVisitor"
                                class="form-control"
                                value='{{$DataVisitor->nomor_hp_visitor}}'
                                maxlength="13" required
                                oninvalid="this.setCustomValidity('Silahkan isi nomor HP!')" oninput="this.setCustomValidity('')"
                              />
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
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      ShowNotifNew(msg, 'green');
      //alert(msg);
    }
  </script>
@endsection