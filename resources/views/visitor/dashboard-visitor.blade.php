@extends('master')
@section('content')
<?php 
$user = Session::get('user');
?>
<body>
<div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl sticky-top align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="navbar-nav-right d-flex align-items-center buy-now" id="navbar-collapse">
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
                      <a class="dropdown-item" href="">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$user}}</span>
                
                            <small class="text-muted">Visitor</small>
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
                <div class="card" id="checked-in" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Menunggu Approval Data ⌛</h5>
                            <p class="mb-4">
                              Data anda sedang diperiksa oleh petugas data center.
                            </p>
                            <p class="mb-4">
                              Mohon hubungi petugas data center 
                              jika data anda belum diapprove setelah 2x24jam sejak registrasi.
                            </p>
                          <!-- <a href="javascript:;" class="btn btn-sm btn-primary" onclick="checkout()">Check Out</a> -->
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
                  </div>
                  </div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" id="checked-in" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Data Registrasi Anda Ditolak ⛔</h5>
                            <p class="mb-4">
                            Data anda ditolak oleh petugas data center dengan alasan nama tidak sesuai dengan KTP.
                            </p>
                            <p class="mb-4">
                            Mohon perbaiki data anda sesuai dengan alasan penolakan melalui form di bawah ini!
                            </p>
                          <!-- <a href="javascript:;" class="btn btn-sm btn-primary" onclick="checkout()">Check Out</a> -->
                        </div>
                      </div>
                      
                      <div class="col-sm-2 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/sorry.png"
                            height="200"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/sorry.png"
                            data-app-light-img="illustrations/sorry.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" id="waiting-approval" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        
                        <div class="card-body">
                        <h5>FORM PERBAIKAN DATA</h5>
                        <form id="formAuthentication" class="mb-4" action="{{route('register-post')}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="mb-4">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control"
                              id="nama_lengkap"
                              name="nama_lengkap"
                              placeholder="Masukkan nama lengkap anda"
                              autofocus
                            />
                          </div>
                          <div class="mb-4">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK anda" />
                          </div>
                          <div class="mb-4">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan no HP anda" />
                          </div>
                          <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email anda" />
                          </div>
                          <div class="mb-4">
                            <label for="asal_instansi" class="form-label">Asal Instansi</label>
                            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Masukkan asal instansi anda" />
                          </div>
                          
                          <div class="mb-4">
                              <label for="foto_ktp" class="form-label">Foto KTP</label>
                              <input class="form-control" type="file" id="foto_ktp" name="foto_ktp" accept="image/*" /> 
                          </div>
                          <button class="btn btn-primary d-grid w-100" type="submit">Kirim</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div></div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
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
                          <img src="assets/img/illustrations/Time-management-rafiki.png" height="200" alt="View Badge User"
                            data-app-dark-img="illustrations/Time-management-rafiki.png" data-app-light-img="illustrations/Time-management-rafiki.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
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
                  </div>
                  </div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
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
                          <img src="assets/img/illustrations/Time-management-rafiki.png" height="200" alt="View Badge User"
                            data-app-dark-img="illustrations/Time-management-rafiki.png" data-app-light-img="illustrations/Time-management-rafiki.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" id="form-check-in" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Check In Data Center</h5>
                          <form>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-name">PIC Data Center</label>
                              <div class="col-sm-8">
                                <select class="form-control">
                                  <option value="" selected>Pilih PIC</option>
                                  <option value="Dekaton">Dekaton</option>
                                  <option value="Dennis">Dennis</option>
                                  <option value="Yusron">Yusron</option>
                                  <option value="Dekaton">Dekaton</option>
                                  <option value="Dekaton">Dekaton</option>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-company">Barang Yang Dibawa</label>
                              <div class="col-sm-8">
                                <textarea
                                  class="form-control"
                                  id="basic-default-company"
                                  placeholder="Contoh : Tas, Tumblr"
                                ></textarea>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Keperluan Visit</label>
                              <div class="col-sm-8">
                                  <textarea
                                    id="basic-default-email"
                                    class="form-control"
                                    placeholder="Jelaskan keperluan anda disini.."
                                  ></textarea>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Tanggal Visit</label>
                              <div class="col-sm-8">
                                  <input type="text" 
                                    id="date"
                                    name="date"
                                    class="form-control"
                                    disabled
                                  >
                              </div>
                            </div>
                            
                            <div class="row justify-content-end">
                              <div class="col-sm-10">
                              </div>
                              <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" onclick="checkin()">Check In</button>
                              </div>
                            </div>
                          </form>
                          

                        </div>
                      </div>
                      <div class="col-sm-2 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/Curious-amico.png"
                            height="300"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/Curious-amico.png"
                            data-app-light-img="illustrations/Curious-amico.png"
                          />
                        </div>
                      </div>
                      
                    </div>
                  </div>
              <hr class="my-5" />

                  <!-- Hoverable Table rows -->
            <div class="card">
              <h5 class="card-header">Check In History</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Tanggal Kedatangan</th>
                      <th>PIC Data Center</th>
                      <th>Keperluan Visit</th>
                      <th>Barang Yang Dibawa</th>
                      <th>Waktu Check In</th>
                      <th>Waktu Check Out</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr style="text-align:center"> 
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                      <td>19-04-2022</td>
                      <td>Yusron</td>
                      <td>Maintenance Data</td>
                      <td>Laptop, Tas, Ipad</td>
                      <td><span class="badge bg-label-primary me-1">13:00 WIB</span></td>
                      <td><span class="badge bg-label-danger me-1">17:00 WIB</span></td>
                      
                    </tr>
                    <tr style="text-align:center">
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>2</strong></td>
                      <td>19-04-2022</td>
                      <td>Yusron</td>
                      <td>Maintenance Data</td>
                      <td>Laptop, Tas, Ipad</td>
                      <td><span class="badge bg-label-primary me-1">13:00 WIB</span></td>
                      <td><span class="badge bg-label-danger me-1">17:00 WIB</span></td>
                    </tr>
                    <tr style="text-align:center">
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>3</strong></td>
                      <td>19-04-2022</td>
                      <td>Yusron</td>
                      <td>Maintenance Data</td>
                      <td>Laptop, Tas, Ipad</td>
                      <td><span class="badge bg-label-primary me-1">13:00 WIB</span></td>
                      <td><span class="badge bg-label-danger me-1">17:00 WIB</span></td>
                      
                    </tr>
                    <tr style="text-align:center">
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>4</strong></td>
                      <td>19-04-2022</td>
                      <td>Yusron</td>
                      <td>Maintenance Data</td>
                      <td>Laptop, Tas, Ipad</td>
                      <td><span class="badge bg-label-primary me-1">13:00 WIB</span></td>
                      <td><span class="badge bg-label-danger me-1">17:00 WIB</span></td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
                </div>
              </div>
            </div>
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
@endsection