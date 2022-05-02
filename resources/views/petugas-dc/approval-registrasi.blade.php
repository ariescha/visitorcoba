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
              <a href="{{route('manajemen-petugas')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Manajemen Petugas DC</div>
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
                  
                  <!-- Hoverable Table rows -->
            <div class="card" style="background-color:#bdd1f7">
              <div class="card-body">
                <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Approval Registrasi Visitor</b></h5>
                <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Lakukan validasi data visitor sebelum menerima atau menolak registrasi.</h6>
                  <div class="table-responsive text-nowrap">
                    <br>
                    <table class="table table-hover" id="NewVisitor" style="background-color:white" >
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
                        <?php $count = 1; ?>
                        
                        @foreach($VisitorNew as $vn)
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $count }}</strong></td>
                          <td>{{ $vn->nama_lengkap_visitor }}</td>
                          <td>{{ $vn->nik_visitor }}</td>
                          <td>{{ $vn->asal_instansi_visitor }}</td>
                          <td>{{ $vn->email_visitor }}</td>
                          <td>{{ $vn->nomor_hp_visitor }}</td>
                          <td><a href="{{route('DownloadKtp',['filename'=> $vn->foto_ktp_visitor])}}">Unduh</a></td>
                          <!-- <td>{{ $vn->foto_ktp_visitor }}</td> -->
                          <td>
                          <button class="btn rounded-pill btn-sm btn-success" data-bs-toggle="modal"
                          data-bs-target="#modal-approve-registrasi" onclick="loadModalApprove('{{$vn->nama_lengkap_visitor}}','{{ $vn->nik_visitor }}')">Approve</button>
                          <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-reject-registrasi" onclick="loadModalReject('{{$vn->nama_lengkap_visitor}}','{{ $vn->nik_visitor }}')">Reject</button>
                          </td>
                        </tr>
                        <?php $count++; ?>
                        @endforeach
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
                        <div class="modal-body" id="ModalApproveRegister"></div>
                            <div class="modal-footer">
                              <form id="approval-register" action="{{route('approve-registrasi')}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                 <input type="hidden" id="NikVisitorApprove" type = "text" name="NikVisitor">
                                <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Ya, saya yakin
                                </button>
                              </form>
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
                            <h5 class="modal-title" id="ModalRejectRegister"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="approval-register" action="{{route('reject-registrasi')}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{csrf_field()}}
                            <input type="hidden" id="NikVisitorReject" type = "text" name="NikVisitor">    
                            <label>Jelaskan alasan anda menolak registrasi!</label>
                            <textarea id="AlasanReject" name="AlasanReject" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal File Nda-->
            <div class="modal fade" id="modal-FileNda" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalFileNda"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="FormNdaUpload">
                            <form id="approval-register" action="{{route('upload-nda')}}" method="post" enctype="multipart/form-data">
                              {{csrf_field()}}
                              <input type="hidden" id="NikVisitorNda" type = "text" name="NikVisitor"> 
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label for="tanggal_mulai" class="form-label">Tanggal Mulai NDA</label>
                                  <input type="date" class="form-control" id="tanggal_mulai_nda" name="tanggal_mulai_nda" required/>
                                </div>
                                <div class="col-sm-6">
                                  <label for="tanggal_akhir_nda" class="form-label">Tanggal Berakhir NDA</label>
                                  <input type="date" class="form-control" id="tanggal_akhir_nda" name="tanggal_akhir_nda" required/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label for="file_nda" class="form-label">FILE NDA</label>
                                  <input class="form-control" type="file" id="file_nda_input" name="file_nda" accept="pdf,image/*" required  />
                                </div>
                                <div class="col-sm-6">
                                  <br>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                              </div>
                            </form>
                            </div>
                            <br>
                            <div>
                                <table id="fileNdaTable" class="table table-hover" style="background-color:white" >
                                  <thead>
                                    <tr>
                                      <th>Tanggal Mulai</th>
                                      <th>Tanggal Berakhir</th>
                                      <th>File</th>
                                    </tr>
                                  </thead>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
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
                    <table id="Visitor" class="table table-hover" style="background-color:white" >
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>NIK</th>
                          <th>Instansi</th>
                          <th>Email</th>
                          <th>No HP</th>
                          <th>Foto KTP</th>
                          <th>Status NDA</th>
                          <th>File NDA</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php $count = 1; ?>
                        
                        @foreach($visitor as $v)
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $count }}</strong></td>
                          <td>{{ $v->nama_lengkap_visitor }}</td>
                          <td>{{ $v->nik_visitor }}</td>
                          <td>{{ $v->asal_instansi_visitor }}</td>
                          <td>{{ $v->email_visitor }}</td>
                          <td>{{ $v->nomor_hp_visitor }}</td>
                          <td><a href="{{route('DownloadKtp',['filename'=> $vn->foto_ktp_visitor])}}">Unduh</a></td>
                          <td>{{ $v->status_nda }}</td>
                          <td> @if ($v->status_nda_visitor == 1)
                          <button class="btn rounded-pill btn-sm btn-info" data-bs-toggle="modal"
                          data-bs-target="#modal-FileNda" onclick="loadModalFileNda('{{$v->nama_lengkap_visitor}}','{{ $v->nik_visitor }}','{{ $v->status_nda_visitor }}')">{{ $v->text_nda }}</button>
                          @else
                          <button class="btn rounded-pill btn-sm btn-danger" data-bs-toggle="modal"
                          data-bs-target="#modal-FileNda" onclick="loadModalFileNda('{{$v->nama_lengkap_visitor}}','{{ $v->nik_visitor }}','{{ $v->status_nda_visitor }}')">{{ $v->text_nda }}</button>
                          @endif </td>
                          <!-- <td>{{ $v->text_nda }}</td> -->
                          <td>{{ $v->keterangan }}</td>
                        </tr>
                        <?php $count++; ?>
                        @endforeach
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
            <!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script type="text/javascript">
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

    $(document).ready( function () {
      $('#NewVisitor').DataTable();
      $('#Visitor').DataTable();
    } );
      
    function loadModalApprove(nama,nik) {
        $('#ModalApproveRegister').html('Apakah anda yakin mengapprove registrasi si ' + nama + '?');
        $('#NikVisitorApprove').val(nik);
    }
    
    function loadModalReject(nama,nik) {
        $('#ModalRejectRegister').text('Apakah anda yakin ingin mereject registrasi si ' + nama + '?');
        $('#NikVisitorReject').val(nik);
        $('#AlasanReject').val('');
    }

    function loadModalFileNda(nama,nik, statusNda) {
      $.ajax({
        url: '/get-nda',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'nik_visitor' : nik
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#fileNdaTable').dataTable( {
              "destroy": true,
              "aaData": data,
              "columns": [
                  { "data": "tanggal_mulai_nda" },
                  { "data": "tanggal_akhir_nda" },
                  { "data": `file_nda` }
                  //
                  //{ "data": "file_nda" }
              ],
              "columnDefs": [ {
                "targets": 2,
                "data": "file_nda",
                "render": function ( data, type, row, meta ) {
                  return '<a href="/downloadNda/'+data+'">'+data+'</a'
                  //return '<a href="{{route('DownloadNda',['filename'=> '+data+'])}}">'+data+'</a'
                  //return `<a href="'+data+'">Download</a>`;
                }
              } ]
          });
        }
      });

      var tempText = ''
      if (statusNda == 1) {
        tempText = 'File';
        $('#FormNdaUpload').hide();
        
      }
      else if (statusNda == 2) {
        tempText = 'Perbarui';
        $('#FormNdaUpload').show();
      }
      else {
        tempText = 'Upload';
        $('#FormNdaUpload').show();
      }
      $('#NikVisitorNda').val(nik);
      $('#ModalFileNda').text(tempText + ' NDA ' + nama);
      $("#file_nda_input").val('');
      $('#tanggal_akhir_nda').val('');
      $('#tanggal_mulai_nda').val('');
    }

      
    </script>
@endsection
