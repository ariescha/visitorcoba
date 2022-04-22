@extends('master')
@section('title')
Approval Registrasi | JMDC Visitor
@endsection
@section('content')
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
            <li class="menu-item">
              <a href="{{route('approval-check-in')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-fingerprint"></i>
                <div data-i18n="Analytics">Approval Check In</div>
              </a>
            </li>
            <li class="menu-item active">
              <a href="{{route('approval-registrasi')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-edit"></i>
                <div data-i18n="Analytics">Approval Registrasi</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('profil-petugas-dc')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profil</div>
              </a>
            </li>

            
          </ul>
        </aside>
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
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <b>JASA MARGA DATA CENTER VISITOR</b>
                </div>
              </div>
              <!-- /Search -->

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
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Petugas DC</small>
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
                  <div class="card" id="checked-in" style="display:none">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Anda sedang berada di Data Center! 🎉</h5>
                          <p class="mb-4">
                            Anda telah check in pada <span class="fw-bold">19 April 2022, 07:54:12 WIB</span>. Perhatikan barang bawaan Anda
                            dan patuhi aturan di Data Center
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-primary" onclick="checkout()">Check Out</a>
                        </div>
                      </div>
                      <div class="col-sm-2 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/Server-status-pana.png"
                            height="200"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/Server-status-pana.png"
                            data-app-light-img="illustrations/Server-status-pana.png"
                          />
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <div class="card" id="waiting-approval" style="display:none">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Menunggu Approval Check In</h5>
                          <p class="mb-4">
                            Anda telah mengajukan permohonan Check In di Jasa Marga Data Center. <br>
                            Silahkan hubungi  <span class="fw-bold">PIC Data Center</span> untuk meminta approval.
                          </p>

                        </div>
                      </div>
                      <div class="col-sm-2 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/Time-management-rafiki.png"
                            height="200"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/Time-management-rafiki.png"
                            data-app-light-img="illustrations/Time-management-rafiki.png"
                          />
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <!-- Hoverable Table rows -->
            <div class="card" style="background-color:#bdd1f7">
              <div class="card-body">
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Approval Registrasi Visitor</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Lakukan validasi data visitor sebelum menerima atau menolak registrasi.</h6>
                  <div class="table-responsive text-nowrap">
                    <br>
                    <table class="table table-hover" style="background-color:white" >
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>NIK</th>
                          <th>Instansi</th>
                          <th>Email</th>
                          <th>No HP</th>
                          <th>Foto KTP</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>32716371381891</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>09891381983</td>
                          <td>Foto KTP Zhody</td>
                          <td>
                          <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-registrasi">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-registrasi">Reject</button>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>32716371381891</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>09891381983</td>
                          <td>Foto KTP Zhody</td>
                          <td>
                          <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-registrasi">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-registrasi">Reject</button>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>32716371381891</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>09891381983</td>
                          <td>Foto KTP Zhody</td>
                          <td>
                          <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-registrasi">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-registrasi">Reject</button>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>32716371381891</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>09891381983</td>
                          <td>Foto KTP Zhody</td>
                          <td>
                            <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-registrasi">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-registrasi">Reject</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              
                </div>
              
            </div>
            
           <!-- Modal Approve-->
           <div class="modal fade" id="modal-approve-registrasi" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Form Approval Registrasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda yakin mengapprove registrasi si blablabla?</div>
                        
                            <div class="modal-footer">
                               
                                <button class="btn btn-danger"  data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button class="btn btn-success"  data-bs-dismiss="modal">
                                    Ya, saya yakin
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Reject-->
            <div class="modal fade" id="modal-reject-registrasi" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Apakah anda yakin ingin menreject registrasi?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                        <div class="modal-body">
                            
                            <label>Jelaskan alasan anda menolak registrasi!</label>
                            <textarea class="form-control"></textarea>
                        </div>
                            <div class="modal-footer">
                                
                                <button class="btn btn-danger"  data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button class="btn btn-success"  data-bs-dismiss="modal">
                                    Submit
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            <br>
            <div class="card" style="background-color:#f7f2bd">
              <div class="card-body">
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Data Visitor Terdaftar</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Tabel di bawah memuat data visitor yang telah tersimpan.</h6>
                  <div class="table-responsive text-nowrap">
                    <br>
                    <table class="table table-hover" style="background-color:white" >
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>NIK</th>
                          <th>Instansi</th>
                          <th>Email</th>
                          <th>No HP</th>
                          <th>Foto KTP</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>82329482424</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>0839232324</td>
                          <td>Foto KTP</td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>82329482424</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>0839232324</td>
                          <td>Foto KTP</td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>82329482424</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>0839232324</td>
                          <td>Foto KTP</td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>82329482424</td>
                          <td>PT Jasa Marga</td>
                          <td>Zhody@jasamarga.co.id</td>
                          <td>0839232324</td>
                          <td>Foto KTP</td>
                          <td>Approved by PIC 1</td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              
                </div>
              
            </div>
            <!--/ Hoverable Table rows -->
                </div>
                  
              </div>
            </div>
            
            <!-- / Content -->
    
@endsection
<script type="text/javascript">
      n =  new Date();
      y = n.getFullYear();
      m = n.getMonth() + 1;
      d = n.getDate();
      document.getElementById("date").value = d + "-" + m + "-" + y;

      function checkin(){
        $("#waiting-approval").show();
        $("#form-check-in").hide();
      }
      function checkout(){
        $("#checked-in").hide();
        $("#form-check-in").show();
      }
    </script>