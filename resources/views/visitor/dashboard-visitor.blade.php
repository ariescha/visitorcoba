@extends('master')
@section('content')
<?php 
$user = Session::get('user');
$niksession = Session::get('nik_visitor');
?>
<body>

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
            <li class="menu-item active">
              <a href="{{route('dashboard-visitor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-fingerprint"></i>
                <div data-i18n="Analytics">Dashboard Check In</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('profil-visitor')}}" class="menu-link">
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
              <div class="row" id="waiting-approval-data">
                <div class="col-lg-12 mb-4 order-0">
                <div class="card"  style="display:show">
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
              <div class="row"  id="rejected-notif">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Data Registrasi Anda Ditolak ⛔</h5>
                            <p class="mb-4">
                            Data anda ditolak oleh petugas data center dengan alasan: {{$DataVisitor->rejected_alasan}}.
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
              <div class="row" id="rejected-form" >
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        
                        <div class="card-body">
                        <h5>FORM PERBAIKAN DATA</h5>
                        <form id="formAuthentication" class="mb-4" action="{{route('revisi-register')}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="mb-4">
                            <label for="namaLengkapVisitor" class="form-label">Nama Lengkap</label>
                            <input
                              type="text"
                              class="form-control"
                              id="namaLengkapVisitor"
                              name="namaLengkapVisitor"
                              placeholder="Masukkan nama lengkap anda"
                              value='{{$DataVisitor->nama_lengkap_visitor}}'
                              autofocus
                            />
                          </div>
                          <div class="mb-4">
                            <label for="nikVisitor" class="form-label">NIK</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              id="nikVisitor" 
                              name="nikVisitor" 
                              placeholder="Masukkan NIK anda" 
                              value='{{$DataVisitor->nik_visitor}}'
                            />
                          </div>
                          <div class="mb-4">
                            <label for="nomorHpVisitor" class="form-label">No HP</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              id="nomorHpVisitor" 
                              name="nomorHpVisitor" 
                              placeholder="Masukkan no HP anda" 
                              value='{{$DataVisitor->nomor_hp_visitor}}'
                              />
                          </div>
                          <div class="mb-4">
                            <label for="emailVisitor" class="form-label">Email</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              id="emailVisitor" 
                              name="emailVisitor" 
                              placeholder="Masukkan email anda" 
                              value='{{$DataVisitor->email_visitor}}'
                              readonly
                              />
                          </div>
                          <div class="mb-4">
                            <label for="asalInstansiVisitor" class="form-label">Asal Instansi</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              id="asalInstansiVisitor" 
                              name="asalInstansiVisitor" 
                              placeholder="Masukkan asal instansi anda" 
                              value= '{{$DataVisitor->asal_instansi_visitor}}'
                              />
                          </div>
                          
                          <div class="mb-3">
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
              <div class="row"  id="checked-in">
                <div class="col-lg-12 mb-4 order-0">
                  
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Anda sedang berada di Data Center! 🎉</h5>
                            <p class="mb-4">
                              Anda telah check in pada <span class="fw-bold" id="checkin_time">{{$DataCheckIn->checkin_time}}</span>{{$DataCheckIn->checkin_time}}. Perhatikan barang bawaan Anda
                              dan patuhi aturan di Data Center
                              <br>
                            </p>
                            <span id="notif-status-nda"></span><br>
                          <a href="{{route('checkout-visitor')}}" id="button-check-out" class="btn btn-sm btn-primary">Check Out</a>
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
              <div class="row" id="waiting-approval-check-in" >
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:none">
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
                  <div class="row"  id="rejected-check-in">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Pengajuan Check In Anda Ditolak ⛔</h5>
                            <p class="mb-4">
                            Pengajuan check in ditolak oleh petugas data center dengan alasan: {{$DataCheckIn->rejected_alasan}}.
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
              <div class="row"  id="form-check-in">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                        <h5 class="card-title text-primary">Check In Data Center</h5>
                          <form id="formCheckin" class="mb-3" action="{{route('checkin-post')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-name">PIC Data Center</label>
                              <div class="col-sm-8">
                                <select class="form-control" name="daftarPic" id="daftarPic">
                                  <option value="" selected>Pilih PIC</option>
                                  @foreach($dataPetugas as $p)
                                  <option value="{{ $p->id_petugas }}">{{ $p->nama_lengkap_petugas }}</option>
		                              @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="barangBawaan">Barang Yang Dibawa</label>
                              <div class="col-sm-8">
                                <textarea
                                  class="form-control"
                                  id="barangBawaan"
                                  name="barangBawaan"
                                  placeholder="Contoh : Tas, Tumblr"
                                ></textarea>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="keperluanVisit">Keperluan Visit</label>
                              <div class="col-sm-8">
                                  <textarea
                                    id="keperluanVisit"
                                    name="keperluanVisit"
                                    class="form-control"
                                    placeholder="Jelaskan keperluan anda disini.."
                                  ></textarea>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="dateCheckin">Tanggal Visit</label>
                              <div class="col-sm-8">
                                  <input type="text" 
                                    id="dateCheckin"
                                    name="dateCheckin"
                                    class="form-control"
                                    readonly
                                  >
                              </div>
                            </div>
                            
                            <div class="row justify-content-end">
                              <div class="col-sm-10">
                              </div>
                              <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary" >Check In</button>
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
                    </div>
                  </div>
              <hr class="my-5" />
          <div class="row"  id="table">
            <div class="col-lg-12 mb-4 order-0">
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
                  <?php $tempHistory=1;?>
                    @foreach($tableHistory as $p)
                    <tr style="text-align:center"> 
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$tempHistory}}</strong></td>
                      <td>{{ $p->created_at }}</td>
                      <td>{{ $p->nama_lengkap_petugas }}</td>
                      <td>{{ $p->keperluan_visit }}</td>
                      <td>{{ $p->barang_bawaan }}</td>
                      <td><span class="badge bg-label-primary me-1">{{ $p->checkin_time }}</span></td>
                      <td><span class="badge bg-label-danger me-1">{{ $p->checkout_time }}</span></td>
                      
                    </tr>
                    <?php $tempHistory++;?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
                </div>
              </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                  var status_visitor = "<?php echo $DataVisitor->status_visitor; ?>";
                  var status_checkin = "<?php echo $DataCheckIn->status_checkin; ?>";
                  var date_checkin = "<?php echo $DataCheckIn->approval_timestamp; ?>"
                  var status_nda = "<?php echo $DataVisitor->status_nda_visitor; ?>"
                  console.log(status_visitor);
                  console.log(status_checkin);

                  if(status_visitor == 0){
                    document.getElementById("waiting-approval-check-in").style.display = "none";
                    document.getElementById("form-check-in").style.display = "none";
                    document.getElementById("checked-in").style.display = "none";
                    document.getElementById("rejected-form").style.display = "none";
                    document.getElementById("rejected-check-in").style.display = "none";
                    document.getElementById("rejected-notif").style.display = "none";
                    document.getElementById("waiting-approval-data").style.display = "show";
                  }
                  else if(status_visitor == 1){
                    if(status_checkin == 0){
                      document.getElementById("waiting-approval-check-in").style.display = "show";
                      document.getElementById("form-check-in").style.display = "none";
                      document.getElementById("checked-in").style.display = "none";
                      document.getElementById("rejected-form").style.display = "none";
                      document.getElementById("rejected-check-in").style.display = "none";
                      document.getElementById("rejected-notif").style.display = "none";
                      document.getElementById("waiting-approval-data").style.display = "none";
                    }
                    else if(status_checkin == 1){
                      document.getElementById("waiting-approval-check-in").style.display = "none";
                      document.getElementById("form-check-in").style.display = "none";
                      document.getElementById("checked-in").style.display = "show";
                      document.getElementById("checkin_time").innerHTML = date_checkin;
                      document.getElementById("rejected-form").style.display = "none";
                      document.getElementById("rejected-check-in").style.display = "none";
                      document.getElementById("rejected-notif").style.display = "none";
                      document.getElementById("waiting-approval-data").style.display = "none";
                      console.log(status_nda);
                      if(status_nda == 0){
                        document.getElementById("notif-status-nda").innerHTML = "Anda belum bisa check out karena file NDA belum diupload. Segera hubungi Petugas Data Center!";
                        document.getElementById("button-check-out").classList.add('disabled');
                      }
                      if(status_nda == 2){
                        document.getElementById("notif-status-nda").innerHTML = "Anda belum bisa check out karena file NDA expired. Segera hubungi Petugas Data Center!";
                        document.getElementById("button-check-out").classList.add('disabled');
                      }
                      if(status_nda == 1){
                        document.getElementById("button-check-out").classList.remove('disabled');
                      }
                    }
                    else if(status_checkin == 2){ //reject
                      document.getElementById("waiting-approval-check-in").style.display = "none";
                      document.getElementById("form-check-in").style.display = "show";
                      document.getElementById("checked-in").style.display = "none";
                      document.getElementById("rejected-form").style.display = "none";
                      document.getElementById("rejected-check-in").style.display = "show";
                      document.getElementById("rejected-notif").style.display = "none";
                      document.getElementById("waiting-approval-data").style.display = "none";
                    }
                    else if(status_checkin == 3){ //checkout
                      document.getElementById("waiting-approval-check-in").style.display = "none";
                      document.getElementById("form-check-in").style.display = "show";
                      document.getElementById("checked-in").style.display = "none";
                      document.getElementById("rejected-form").style.display = "none";
                      document.getElementById("rejected-check-in").style.display = "none";
                      document.getElementById("rejected-notif").style.display = "none";
                      document.getElementById("waiting-approval-data").style.display = "none";
                    }
                    else if(status_checkin == 99){ //if datacheckin kosong, diinject dari code 99
                      document.getElementById("waiting-approval-check-in").style.display = "none";
                      document.getElementById("form-check-in").style.display = "show";
                      document.getElementById("checked-in").style.display = "none";
                      document.getElementById("rejected-form").style.display = "none";
                      document.getElementById("rejected-check-in").style.display = "none";
                      document.getElementById("rejected-notif").style.display = "none";
                      document.getElementById("waiting-approval-data").style.display = "none";
                    }

                  }else if(status_visitor == 2){ //registrasi direject
                    document.getElementById("waiting-approval-check-in").style.display = "none";
                      document.getElementById("form-check-in").style.display = "none";
                      document.getElementById("checked-in").style.display = "none";
                      document.getElementById("rejected-form").style.display = "show";
                      document.getElementById("rejected-check-in").style.display = "none";
                      document.getElementById("rejected-notif").style.display = "show";
                      document.getElementById("waiting-approval-data").style.display = "none";
                  }
                });
                n =  new Date();
                y = n.getFullYear();
                m = n.getMonth() + 1;
                d = n.getDate();
                document.getElementById("dateCheckin").value = d + "-" + m + "-" + y;
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