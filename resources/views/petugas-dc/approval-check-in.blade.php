@extends('master')
@section('title')
Approval Check In | JMDC Visitor
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
                    <table id="NewApprovalCheckin" class="table table-hover" style="background-color:white" >
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalApprove()"></button>
                        </div>
                        <div class="modal-body">
                        <form id="approval-checkin" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" id="id_approval_checkin" type = "number" name="id_approval_checkin"><br/>
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
                                    readonly
                                  >
                              </div>
                            </div>
                            <div class="row mb-3">
                              <div id="my_camera"></div>
                              <div id="my_result"></div>   
                            </div>
                            </br>
                            <input type="button" id="take_snapshot" value="Ambil Gambar" onclick="takeSnapshot()">
                            <input type="button" id="reset_snapshot" value="Reset Gambar" onclick="resetSnapshot()" disabled>
                            <input type="hidden" id="gambar_visitor" name="gambar_visitor">
                            <!-- <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Foto Bukti Visitor</label>
                              <div class="col-sm-8">
                                <input class="form-control" type="file" id="formFile" name="foto_visitor" accept="image/*" />
                              </div>
                            </div> -->
                        </div>
                            <div class="modal-footer">
                                
                                <button type="button" onclick="closeModalApprove()" class="btn btn-danger"  data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" onclick="ApproveCheckin()" class="btn btn-success">
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
                            <h5 class="modal-title" id="modalToggleLabel">Apakah anda yakin ingin reject?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="rejection-checkin" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" id="id_rejection_checkin" type = "number" name="id_rejection_checkin"><br/>
                            <label>Jelaskan alasan anda menolak check in!</label>
                            <textarea class="form-control" id="alasan_reject" name="alasan_reject"></textarea>
                        </div>
                            <div class="modal-footer">
                                <button type="button" onclick="RejectCheckin()" class="btn btn-success">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
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
                    <table id="ApprovalCheckin" class="table table-hover" style="background-color:white" >
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
                            <h5 class="modal-title" id="modalToggleLabel">Apakah Anda Ingin Check Out <b id="variable_nama"></b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         
                        </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">
                                    Batal
                                </button>
                              <form id="check-out-petugas" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" id="id_data_checkin" name="id_data_checkin" type="number">
                                
                                <button type="button" onclick="CheckoutPetugas()" class="btn btn-success">
                                    Ya, Saya Yakin
                                </button>                                
                              </form> 
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
                    <table id="ApprovalCheckinHistory" class="table table-hover" style="background-color:white" >
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
  
  $(document).ready( function () {
      // $('#NewVisitor').DataTable();
      //$('#NewApprovalCheckin').DataTable();
      // LoadNewRegistrasiVisitor(false);
      // LoadRegistrasiVisitor(false);
      LoadNewApprovalCheckin(false);
      LoadApprovalCheckin(false);
      LoadApprovalCheckinHistory();

    } );

  function takeSnapshot(){
    var raw_image;
    Webcam.snap( 
      function(data_uri) {
		    document.getElementById('my_result').innerHTML =  '<img src="' + data_uri + '"/>';
        // raw_image = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
        raw_image = data_uri;
      }); 
      document.getElementById('my_camera').style.display = "none";
      document.getElementById('my_result').style.display = "block";
      document.getElementById('reset_snapshot').disabled = false;
      document.getElementById('take_snapshot').disabled = true;
      
      console.log(raw_image);
      document.getElementById('gambar_visitor').value = raw_image;
  }

  function resetSnapshot(){
    document.getElementById('my_camera').style.display = "block";
    document.getElementById('my_result').style.display = "none";
    document.getElementById('reset_snapshot').disabled = true;
    document.getElementById('take_snapshot').disabled = false;
    document.getElementById('gambar_visitor').value = "";
  }

  function approve(id,nama_visitor){
    console.log(nama_visitor);
    $('#nama_visitor').val(nama_visitor);
    $('#id_approval_checkin').val(id);
    $('#nomor_visitor_tag').val('');
    Webcam.reset();
    resetSnapshot();
    Webcam.set({
      width: 300,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
      });
      Webcam.attach( '#my_camera' );
  }

  function closeModalApprove(){
    Webcam.reset();
  }

  function reject(id){
    console.log(id)
    $('#id_rejection_checkin').val(id);
  }

  function checkout(id,nama_visitor){
    console.log(id)
    $('#id_data_checkin').val(id);
    document.getElementById('variable_nama').innerHTML=nama_visitor;
  }

  function LoadNewApprovalCheckin(showAlert, type) {
      $('#loader').show();
      console.log('LoadNewApprovalCheckin');
      $.ajax({
        url: '/LoadNewApprovalCheckin',
        type: 'GET',
        dataType: 'json',
        error: function(e) {
          console.log(e);
        },
        success: function(data) {
          console.log(data.data);
          $('#NewApprovalCheckin').dataTable( {
              "destroy": true,
              "aaData": data.data,
              "columns": [
                  { "data": null,"orderable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}},
                  { "data": "nama_lengkap_visitor" },
                  { "data": "keperluan_visit" },
                  { "data": "barang_bawaan" },
                  { "data": "nomor_hp_visitor" },
                  { "data": "created_at" },
                  { "data": "id_checkin" }
              ],
              "columnDefs": [ {
                "targets": 6,
                "data": "foto_ktp_visitor",
                "render": function ( data, type, row, meta ) {
                  return '<button id="click-approve" class="btn rounded-pill btn-sm btn-success" onclick="approve(`'+row.id_checkin+'`,`'+row.nama_lengkap_visitor+'`)" data-bs-toggle="modal" data-bs-target="#modal-approve-check-in">Approve</button><button id="click-reject" class="btn rounded-pill btn-sm btn-danger" onclick="reject(`'+row.id_checkin+'`)" data-bs-toggle="modal" data-bs-target="#modal-reject-check-in">Reject</button>'
                }
              }             ]
          });
          
          $('#loader').hide();
          if (showAlert) {
            if (type == 'Approve') {
              ShowNotif(type +' Berhasil!', 'green');
            }
            else {
              ShowNotif(type +' Berhasil!', 'red');
            }
            //alert(type +' Berhasil');
          }
        }
      });
    }

    function LoadApprovalCheckin(showAlert, type) {
      $('#loader').show();
      console.log('LoadApprovalCheckin');
      $.ajax({
        url: '/LoadApprovalCheckin',
        type: 'GET',
        dataType: 'json',
        error: function(e) {
          console.log(e);
        },
        success: function(data) {
          console.log(data.data);
          $('#ApprovalCheckin').dataTable( {
              "destroy": true,
              "aaData": data.data,
              "columns": [
                  { "data": null,"orderable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}},
                  { "data": "nama_lengkap_visitor" },
                  { "data": "tanggal_checkin" },
                  { "data": "keperluan_visit" },
                  { "data": "barang_bawaan" },
                  { "data": "approval_timestamp" },
                  { "data": "nama_lengkap_petugas" },
                  { "data": "status_nda_visitor" }
              ],
              "columnDefs": [ {
                "targets": 7,
                "data": "status_nda_visitor",
                "render": function ( data, type, row, meta ) {
                  var cssClass = 'info'
                  if (data == 1) {
                    return '<button id="click-checkout" class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal" onclick="checkout(`'+row.id_checkin+'`,`'+row.nama_lengkap_visitor+'`)" data-bs-target="#modal-check-out">Check Out</button>'
                  }
                  else {
                    return '<button class="btn rounded-pill btn-sm btn-danger" disabled>Check Out</button>'
                  }

                  //return '<button id="click-approve" class="btn rounded-pill btn-sm btn-success" onclick="approve(`'+row.id_checkin+'`,`'+row.nama_lengkap_visitor+'`)" data-bs-toggle="modal" data-bs-target="#modal-approve-check-in">Approve</button><button id="click-reject" class="btn rounded-pill btn-sm btn-danger" onclick="reject(`'+row.id_checkin+'`)" data-bs-toggle="modal" data-bs-target="#modal-reject-check-in">Reject</button>'
                }
              }]
          });
          
          $('#loader').hide();
          if (showAlert) {
            if (type == 'CheckOut') {
              ShowNotif(type +' Berhasil!', 'green');
            }
            else {
              ShowNotif(type +' Berhasil!', 'green');
            }
            //alert(type +' Berhasil');
          }
        }
      });
    }

    function LoadApprovalCheckinHistory() {
      $('#loader').show();
      console.log('LoadApprovalCheckinHistory');
      $.ajax({
        url: '/LoadApprovalCheckinHistory',
        type: 'GET',
        dataType: 'json',
        error: function(e) {
          console.log(e);
        },
        success: function(data) {
          console.log(data.data);
          $('#ApprovalCheckinHistory').dataTable( {
              "destroy": true,
              "aaData": data.data,
              "columns": [
                  { "data": null,"orderable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}},
                  { "data": "nama_lengkap_visitor" },
                  { "data": "tanggal_checkin" },
                  { "data": "keperluan_visit" },
                  { "data": "barang_bawaan" },
                  { "data": "checkin_time" },
                  { "data": "checkout_time" },
                  { "data": "keterangan" }
              ]
          });
          
          $('#loader').hide();
        }
      });
    }

    function CheckoutPetugas() {
      $('#modal-check-out').modal('hide');
      $('#loader').show();
      console.log('CheckoutPetugas');
      var id_checkin = $('#id_data_checkin').val();
      console.log(id_checkin);
      $.ajax({  
        url:'/CheckoutPetugas',  
        method:"POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:$('#check-out-petugas').serialize(),
        dataType:'json',
        error: function(e) {
          console.log(e);
          console.log('CheckoutPetugas Error');
        },
        success:function(data)  
        {
          console.log(data);
          if (data.status) {
            LoadApprovalCheckin(true, 'CheckOut');
            LoadApprovalCheckinHistory();
            console.log('CheckoutPetugas Sukses');
            $('#loader').hide();
          }
          else {
            $('#loader').hide();
            ShowNotif(data.data, 'red');
          }
        }  
      });
    }
    
    function ApproveCheckin() {
      $('#loader').show();
      console.log('ApproveCheckin');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      var file64 = '';
      file64 = document.getElementById('gambar_visitor').value;

      if (file64 == '') {
        ShowNotif('Ambil foto terlebih dahulu!', 'red');
        $('#loader').hide();
        return;
      }
      $('#modal-approve-check-in').modal('hide');
      closeModalApprove();

      //var files = $('#formFile')[0].files;
      var id_checkin = $('#id_approval_checkin').val();
      var nama_visitor = $('#nama_visitor').val();
      var nomor_visitor_tag = $('#nomor_visitor_tag').val();
      //console.log(files[0]);
      var formData = new FormData();
      formData.append('_token',CSRF_TOKEN);
      //formData.append('file',files[0]);
      formData.append('id_approval_checkin',id_checkin);
      formData.append('nama_visitor',nama_visitor);
      formData.append('gambar_visitor',file64);
      formData.append('nomor_visitor_tag',nomor_visitor_tag);
      $.ajax({  
        url:'/approve-check-in',  
        method:"POST",
        // headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        //data:$('#approval-checkin').serialize(),
        data: formData,
        contentType: false,
        processData: false,
        datatype:'json',
        error: function(e) {

          console.log('ApproveCheckin Error');
        },
        success:function(data)  
        {
          if (data.status) {
            $('#loader').hide();
            LoadNewApprovalCheckin(true, 'Approve');
            LoadApprovalCheckin();
            console.log('ApproveCheckin Sukses');
          }
        }  
      });
    }

    function RejectCheckin() {
      $('#modal-reject-check-in').modal('hide');
      $('#loader').show();
      console.log('RejectCheckin');
      $.ajax({  
        url:'/reject-check-in',  
        method:"POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:$('#rejection-checkin').serialize(),
        type:'json',
        error: function(e) {

          console.log('RejectCheckin Error');
        },
        success:function(data)  
        {
          if (data.status) {
            $('#loader').hide();
            LoadNewApprovalCheckin(true, 'Reject');
            LoadApprovalCheckin();
            console.log('RejectCheckin Sukses');
          }
        }  
      });
    }

</script>
@endsection