@extends('master')
@section('title')
Approval Check In | JMDC Visitor
@endsection
@section('content')
<?php 
$user = Session::get('user');
?>
@include('petugas-dc.sidebar')

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
                            <span class="fw-semibold d-block">{{$user}}</span>
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
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Approval Check In Visitor</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Lakukan validasi data visitor sebelum menerima atau menolak check in visitor.</h6>
                  <div class="table-responsive text-nowrap">
                    <br>
                    <table class="table table-hover" style="background-color:white" >
                      <thead>
                        <tr style="text-align:center">
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>Keperluan Visit</th>
                          <th>Barang yang dibawa</th>
                          <th>No HP</th>
                          <th>Waktu Pengajuan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>Maintenance Data</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td>08129128313</td>
                          <td><span class="badge bg-label-info me-1">17:00 WIB</span></td>
                          <td>
                            <button class="btn rounded-pill btn-sm btn-success">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger">Reject</button>
                          </td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>Maintenance Data</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td>08129128313</td>
                          <td><span class="badge bg-label-info me-1">17:00 WIB</span></td>
                          <td>
                            <button class="btn rounded-pill btn-sm btn-success">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger">Reject</button>
                          </td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>Maintenance Data</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td>08129128313</td>
                          <td><span class="badge bg-label-info me-1">17:00 WIB</span></td>
                          <td>
                            <button class="btn rounded-pill btn-sm btn-success">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger">Reject</button>
                          </td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>Maintenance Data</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td>08129128313</td>
                          <td><span class="badge bg-label-info me-1">17:00 WIB</span></td>
                          <td>
                            <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-check-in">Approve</button>
                            <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-check-in">Reject</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              
                </div>
              
            </div>
           <!-- Modal Approve-->
            <div class="modal fade" id="modal-approve-check-in" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Form Approval Check In</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-company">Nomor Visitor Tag</label>
                              <div class="col-sm-8">
                              <input type="number" 
                                    id="nomor_visitor_tag"
                                    name="nomor_visitor_tag"
                                    class="form-control"
                                  >
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Nama Visitor</label>
                              <div class="col-sm-8">
                              <input type="text" 
                                    id="nama_visitor"
                                    name="nama_visitor"
                                    class="form-control"
                                    disabled
                                  >
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Foto Bukti Visitor</label>
                              <div class="col-sm-8">
                                <input class="form-control" type="file" id="formFile" accept="image/*" />
                              </div>
                            </div>
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
            </div>
            <!-- Modal Reject-->
            <div class="modal fade" id="modal-reject-check-in" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Apakah anda yakin ingin menreject?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                        <div class="modal-body">
                            
                            <label>Jelaskan alasan anda menolak check in!</label>
                            <textarea class="form-control"></textarea>
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-success"  data-bs-dismiss="modal">
                                    Submit
                                </button>
                                <button class="btn btn-danger"  data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            <br>
            <div class="card" style="background-color:#bdf7c3">
              <div class="card-body">
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Data Check In Visitor</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Tabel di bawah memuat data visitor yang sedang berada di data center.</h6>
                  <div class="table-responsive text-nowrap">
                    <br> 
                    <table class="table table-hover" style="background-color:white" >
                      <thead>
                        <tr style="text-align:center">
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>Tanggal Kunjungan</th>
                          <th>Keperluan Visit</th>
                          <th>Barang yang dibawa</th>
                          <th>Waktu Check In</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                          <td><button class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal"
                          data-bs-target="#modal-check-out">Check Out</button></td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                          <td><button class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal"
                          data-bs-target="#modal-check-out">Check Out</button></td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                          <td><button class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal"
                          data-bs-target="#modal-check-out">Check Out</button></td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                          <td><button class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal"
                          data-bs-target="#modal-check-out">Check Out</button></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Modal Check Out-->
            <div class="modal fade" id="modal-check-out" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Apakah anda yakin ingin men check out si blabla?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                            <div class="modal-footer">
                                
                                <button class="btn btn-danger"  data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button class="btn btn-success"  data-bs-dismiss="modal">
                                    Ya, Saya Yakin
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
            
              
            <br>
            <div class="card" style="background-color:#f7f2bd">
              <div class="card-body">
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Check In History</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Tabel di bawah memuat data kunjungan visitor yang telah tersimpan.</h6>
                  <div class="table-responsive text-nowrap">
                    <br>
                    <table class="table table-hover" style="background-color:white" >
                      <thead >
                        <tr style="text-align:center">
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>Tanggal Kunjungan</th>
                          <th>Keperluan Visit</th>
                          <th>Barang yang dibawa</th>
                          <th>Waktu Check In</th>
                          <th>Waktu Check Out</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td><span class="badge bg-label-warning me-1">20:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td><span class="badge bg-label-warning me-1">20:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td><span class="badge bg-label-warning me-1">20:00 WIB</span></td>
                          <td>Approved by PIC 1</td>
                        </tr>
                        <tr style="text-align:center">
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                          <td>Zhody</td>
                          <td>19 April 2021</td>
                          <td>Maintenance</td>
                          <td>Laptop, Tas, Ipad</td>
                          <td><span class="badge bg-label-primary me-1">17:00 WIB</span></td>
                          <td><span class="badge bg-label-warning me-1">20:00 WIB</span></td>
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