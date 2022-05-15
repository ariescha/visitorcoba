@extends('master')
@section('title')
Manajemen Petugas Data Center | JMDC Visitor
@endsection
@section('content')
<?php 
$user = Session::get('user');
if(session::has('status_petugas')){
  $is_superadmin = Session::get('status_petugas');
}
else{
  $is_superadmin = 0;
}
?>
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
                      <a class="dropdown-item" href="{{route('profil-visitor')}}">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$user}}</span>
                            <small class="text-muted">Super Admin</small>
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
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                

                  <!-- Hoverable Table rows -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><b >Manajemen Petugas Data Center</b></h5>
                    <div class="row">
                            <div class="col-sm-10">Anda dapat mengelola data petugas DC melalui tabel berikut.</div>
                            <div class="col-sm-2 pull-right">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                          data-bs-target="#modal-add-petugas">ADD PETUGAS</button>
                            </div>
                        
                    </div>
                    
                    <!-- <h5 >Manajemen Petugas Data Center</h5>
                    <div class="col-sm-1 float-end">
                        <button type="button" class="btn btn-info ">+ Tambah</button>
                    </div> -->
                </div>
              
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>NPP</th>
                      <th>Email</th>
                      <th>No HP</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                      @foreach($PetugasDC as $p => $v)
                    <tr style="text-align:center"> 
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$p+1}}</strong></td>
                      <td>{{$v->nama_lengkap_petugas}}</td>
                      <td>{{$v->npp_petugas}}</td>
                      <td>{{$v->email_petugas}}</td>
                      <td>{{$v->nomor_hp_petugas}}</td>
                      <td>
                          @if($v->status_petugas == 0)
                            Tidak Aktif
                          @else
                            Aktif
                          @endif
                      </td>
                      <td><button type="button" class="btn btn-warning" onclick="edit({{$v}})">Edit</td>
                      
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
                </div>
              </div>
            </div>
            
           <!-- Modal Add Petugas-->
           <div class="modal fade" id="modal-add-petugas" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Tambah Petugas Data Center</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="form-add-petugas" class="mb-3" action="{{route('add-petugas')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="mb-4">
                                    <label for="no_hp_petugas" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap_petugas" name="nama_lengkap_petugas" placeholder="Masukkan nama lengkap petugas" required/>
                                </div>
                                <div class="mb-4">
                                    <label for="npp_petugas" class="form-label">NPP</label>
                                    <input type="text" class="form-control" id="npp_petugas" name="npp_petugas" placeholder="Masukkan NPP Petugas" required />
                                </div>
                                <div class="mb-4">
                                    <label for="email_petugas" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email_petugas" name="email_petugas" placeholder="Masukkan email petugas" required/>
                                </div>
                                <div class="mb-4 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password_petugas" required>Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input
                                        type="password"
                                        id="password_petugas"
                                        class="form-control"
                                        name="password_petugas"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required
                                        />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="no_hp_petugas" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="no_hp_petugas" name="no_hp_petugas" required placeholder="Masukkan nomor HP petugas" maxlength="13"/>
                                </div>
                                <div class="mb-4">
                                    <label for="status_petugas" class="form-label">Status</label>
                                    <select name="status_petugas" id="status_petugas" class="form-control" required>
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                    Cancel
                                </button> -->
                                <button class="btn btn-success"   type="submit">
                                    TAMBAH
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Petugas -->
            <div class="modal fade" id="modal-edit-petugas" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Edit Petugas Data Center</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="form-add-petugas" class="mb-3" action="{{route('edit-petugas')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-body">
                                    <input type="hidden" class="form-control" id="edit_id_petugas" name="edit_id_petugas"  />
                              
                                <div class="mb-4">
                                    <label for="edit_nama_lengkap_petugas" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="edit_nama_lengkap_petugas" name="edit_nama_lengkap_petugas" required />
                                </div>
                                <div class="mb-4">
                                    <label for="edit_npp_petugas" class="form-label">NPP</label>
                                    <input type="text" class="form-control" id="edit_npp_petugas" name="edit_npp_petugas" required />
                                </div>
                                <div class="mb-4">
                                    <label for="edit_email_petugas" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email_petugas" name="edit_email_petugas" readonly />
                                </div>
                                <div class="mb-4 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="edit_password_petugas" required>Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input
                                        type="password"
                                        id="edit_password_petugas"
                                        class="form-control"
                                        name="edit_password_petugas"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" readonly
                                        />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="edit_no_hp_petugas" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="edit_no_hp_petugas" name="edit_no_hp_petugas" maxlength="13" required/>
                                </div>
                                <div class="mb-4">
                                    <label for="edit_status_petugas" class="form-label">Status</label>
                                    <select name="edit_status_petugas" id="edit_status_petugas" class="form-control" required>
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="1" id="status_aktif">Aktif</option>
                                        <option value="0" id="status_tidak_aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                    Cancel
                                </button> -->
                                <button class="btn btn-success"  type="submit">
                                    SIMPAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
               function edit(data){
                $('#edit_id_petugas').val(data.id_petugas);
                $('#edit_nama_lengkap_petugas').val(data.nama_lengkap_petugas);
                $('#edit_npp_petugas').val(data.npp_petugas);
                $('#edit_no_hp_petugas').val(data.nomor_hp_petugas);
                $('#edit_email_petugas').val(data.email_petugas);
                $('#edit_password_petugas').val(data.password_petugas);
                if(data.status_petugas == '1'){
                    document.getElementById('status_aktif').selected = true;
                    document.getElementById('status_tidak_aktif').selected = false;
                }else{
                    document.getElementById('status_aktif').selected = false;
                    document.getElementById('status_tidak_aktif').selected = true;
                }

                $('#modal-edit-petugas').modal('show');
               }
            </script>
@endsection