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

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
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
                            <a class="dropdown-item" href="{{ route('profil-petugas-dc') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="assets/img/avatars/1.png" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ $user }}</span>
                                        <small class="text-muted">Petugas DC</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
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
                        <div class="card-header" style="background-color:#bdd1f7">
                            <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Approval Check In Visitor</b></h5>
                            <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Lakukan validasi data visitor
                                sebelum menerima atau menolak check in visitor.</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table id="NewApprovalCheckin" class="table table-hover" style="background-color:white; width:100%">
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
                                    <tbody class="table-border-bottom-0"></tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal Approve-->
                <div class="modal fade" id="modal-approve-check-in" aria-labelledby="modalToggleLabel" tabindex="-1"
                    style="display: none" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalToggleLabel">Form Approval Check In</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="approval-checkin" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="id_approval_checkin" type="number"
                                        name="id_approval_checkin">
                                    <input type="hidden" id="email_visitor_approve" name="email_visitor">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" for="basic-default-company">Nomor Visitor
                                            Tag</label>
                                        <div class="col-sm-8">
                                            <input type="number" id="nomor_visitor_tag" name="nomor_visitor_tag"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" for="basic-default-email">Nama
                                            Visitor</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nama_visitor" name="nama_visitor"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" for="basic-default-email">Ambil Gambar</label>
                                        <div class="col-sm-8">
                                            <input type="file" id="foto_user" accept="image/*" />
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="basic-default-email">Foto Bukti Visitor</label>
                              <div class="col-sm-8">
                                <input class="form-control" type="file" id="formFile" name="foto_visitor" accept="image/*" />
                              </div>
                            </div> -->
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">
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
            <div class="modal fade" id="modal-reject-check-in" aria-labelledby="modalToggleLabel" tabindex="-1"
                style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Apakah anda yakin ingin reject?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="rejection-checkin" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <input type="hidden" id="id_rejection_checkin" type="number"
                                    name="id_rejection_checkin"><br />
                                <label>Jelaskan alasan anda menolak check in!</label>
                                <textarea class="form-control" id="alasan_reject" name="alasan_reject" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="RejectCheckin()" class="btn btn-success">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-header" style="background-color:#bdf7c3">
                            <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Data Check In Visitor</b></h5>
                            <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Tabel di bawah memuat data visitor
                                yang
                                sedang berada di data center.</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table id="ApprovalCheckin" class="table table-hover" style="background-color:white;width:100%">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Kunjungan</th>
                                            <th>No Tag</th>
                                            <th>Keperluan Visit</th>
                                            <th>Barang yang dibawa</th>
                                            <th>Waktu Check In</th>
                                            <th>Keterangan</th>
                                            <th>Foto</th>
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
                    <div class="modal fade" id="modal-check-out" aria-labelledby="modalToggleLabel" tabindex="-1"
                        style="display: none" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalToggleLabel">Apakah Anda Ingin Check Out <b
                                            id="variable_nama"></b></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <form id="check-out-petugas" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="id_data_checkin" name="id_data_checkin" type="number">

                                        <button type="button" onclick="CheckoutPetugas()" class="btn btn-success">
                                            Ya, Saya Yakin
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card" >
                        <div class="card-header"  style="background-color:#f7f2bd">
                            <h5 class="card-title"><b style="color:rgb(62, 61, 61)">Check In History</b></h5>
                            <h6 class="card-subtitle" style="color:rgb(52, 51, 51)">Tabel di bawah memuat data kunjungan
                                visitor yang telah tersimpan.</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table id="ApprovalCheckinHistory" class="table table-hover" style="background-color:white;width:100%">
                                    <thead>
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
        $(document).ready(function () {
            // $('#NewVisitor').DataTable();
            //$('#NewApprovalCheckin').DataTable();
            // LoadNewRegistrasiVisitor(false);
            // LoadRegistrasiVisitor(false);
            LoadNewApprovalCheckin(false);
            LoadApprovalCheckin(false);
            LoadApprovalCheckinHistory();

        });

        function approve(id, nama_visitor, email) {
            console.log(nama_visitor);
            $('#nama_visitor').val(nama_visitor);
            $('#email_visitor_approve').val(email);
            console.log($('#email_visitor_approve').val());
            $('#id_approval_checkin').val(id);
            $('#nomor_visitor_tag').val('');
            $("#foto_user").val(null);
        }

        function reject(id) {
            console.log(id)
            $('#id_rejection_checkin').val(id);
        }

        function checkout(id, nama_visitor) {
            console.log(id)
            $('#id_data_checkin').val(id);
            document.getElementById('variable_nama').innerHTML = nama_visitor;
        }

        function LoadNewApprovalCheckin(showAlert, type) {
            $('#loader').show();
            console.log('LoadNewApprovalCheckin');
            $.ajax({
                url: "{{url('/LoadNewApprovalCheckin')}}",
                type: 'GET',
                dataType: 'json',
                error: function (e) {
                    console.log(e);
                    $('#loader').hide();
                    ShowNotif('LoadNewApprovalCheckin Gagal!', 'red');
                },
                success: function (data) {
                    console.log(data.data);
                    $('#NewApprovalCheckin').dataTable({
                        "destroy": true,
                        "scrollX": true,
                        "aaData": data.data,
                        "columns": [{
                                "data": null,
                                "orderable": false,
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                "data": "nama_lengkap_visitor"
                            },
                            {
                                "data": "keperluan_visit"
                            },
                            {
                                "data": "barang_bawaan"
                            },
                            {
                                "data": "nomor_hp_visitor"
                            },
                            {
                                "data": "checkin_time"
                            },
                            {
                                "data": "id_checkin"
                            }
                        ],
                        "columnDefs": [{
                            "targets": 6,
                            "data": "id_checkin",
                            "render": function (data, type, row, meta) {
                                return '<button id="click-approve" class="btn rounded-pill btn-sm btn-success" onclick="approve(`' +
                                    row.id_checkin + '`,`' + row
                                    .nama_lengkap_visitor + '`,`' + row.email_visitor +'`)" data-bs-toggle="modal" data-bs-target="#modal-approve-check-in">Approve</button><button id="click-reject" class="btn rounded-pill btn-sm btn-danger" onclick="reject(`' +
                                    row.id_checkin +
                                    '`)" data-bs-toggle="modal" data-bs-target="#modal-reject-check-in">Reject</button>'
                            }
                        }]
                    });

                    $('#loader').hide();
                    if (showAlert) {
                        if (type == 'Approve') {
                            ShowNotif(type + ' Berhasil!', 'green');
                        } else {
                            ShowNotif(type + ' Berhasil!', 'red');
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
                url: "{{url('/LoadApprovalCheckin')}}",
                type: 'GET',
                dataType: 'json',
                error: function (e) {
                    console.log(e);
                    $('#loader').hide();
                    ShowNotif('LoadApprovalCheckin Gagal!', 'red');
                },
                success: function (data) {
                    console.log(data.data);
                    $('#ApprovalCheckin').dataTable({
                        "destroy": true,
                        "scrollX": true,
                        "aaData": data.data,
                        "columns": [{
                                "data": null,
                                "orderable": false,
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                "data": "nama_lengkap_visitor"
                            },
                            {
                                "data": "checkin_time"
                            },
                            {
                                "data": "nomor_tag_visitor"
                            },
                            {
                                "data": "keperluan_visit"
                            },
                            {
                                "data": "barang_bawaan"
                            },
                            {
                                "data": "approval_timestamp"
                            },
                            {
                                "data": "nama_lengkap_petugas"
                            },
                            {
                                "data": "foto_visitor"
                            },
                            {
                                "data": "status_nda_visitor"
                            }
                        ],
                        "columnDefs": [
                        {
                            "targets": 8,
                            "data": "foto_visitor",
                            "render": function ( data, type, row, meta ) {
                            return '<button class="btn rounded-pill btn-sm btn-info" onclick="DownloadFoto(`'+row.foto_visitor+'`)">Unduh</button>'
                            }
                        },
                        {
                            "targets": 9,
                            "data": "status_nda_visitor",
                            "render": function (data, type, row, meta) {
                                var cssClass = 'info'
                                if (data == 1) {
                                    return '<button id="click-checkout" class="btn rounded-pill btn-sm btn-warning" data-bs-toggle="modal" onclick="checkout(`' +
                                        row.id_checkin + '`,`' + row
                                        .nama_lengkap_visitor +
                                        '`)" data-bs-target="#modal-check-out">Check Out</button>'
                                } else {
                                    return '<button class="btn rounded-pill btn-sm btn-danger" disabled>Check Out</button>'
                                }

                                //return '<button id="click-approve" class="btn rounded-pill btn-sm btn-success" onclick="approve(`'+row.id_checkin+'`,`'+row.nama_lengkap_visitor+'`)" data-bs-toggle="modal" data-bs-target="#modal-approve-check-in">Approve</button><button id="click-reject" class="btn rounded-pill btn-sm btn-danger" onclick="reject(`'+row.id_checkin+'`)" data-bs-toggle="modal" data-bs-target="#modal-reject-check-in">Reject</button>'
                            }
                        }]
                    });

                    $('#loader').hide();
                    if (showAlert) {
                        if (type == 'CheckOut') {
                            ShowNotif(type + ' Berhasil!', 'green');
                        } else {
                            ShowNotif(type + ' Berhasil!', 'green');
                        }
                        //alert(type +' Berhasil');
                    }
                }
            });
        }

        function ApproveCheckin() {
            
            console.log('ApproveCheckin');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var nomor_visitor_tag = '';
            nomor_visitor_tag = $('#nomor_visitor_tag').val();

            //var file64 = '';
            //file64 = document.getElementById('gambar_visitor').value;
            var file_foto = '';
            file_foto = $('#foto_user')[0].files[0];
            
            if (nomor_visitor_tag == '') {
                ShowNotif('Isi nomor visitor tag terlebih dahulu!', 'red');
                return;
            }

            if (file_foto == '') {
                ShowNotif('Ambil foto terlebih dahulu!', 'red');
                return;
            }

            $('#loader').show();
            $('#modal-approve-check-in').modal('hide');
            
            //$('#file')[0].files[0]
            
            var id_checkin = $('#id_approval_checkin').val();
            var nama_visitor = $('#nama_visitor').val();
            var email_visitor = $('#email_visitor_approve').val();
            
            //console.log(files[0]);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('foto_user',file_foto);
            formData.append('id_approval_checkin', id_checkin);
            formData.append('nama_visitor', nama_visitor);
            //formData.append('gambar_visitor', file64);
            formData.append('nomor_visitor_tag', nomor_visitor_tag);
            formData.append('email_visitor', email_visitor);
            
            $.ajax({
                url: "{{url('/approve-check-in')}}",
                method: "POST",
                // headers: {
                //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                //data:$('#approval-checkin').serialize(),
                data: formData,
                contentType: false,
                processData: false,
                datatype: 'json',
                error: function (e) {

                    console.log('ApproveCheckin Error');
                    $('#loader').hide();
                    ShowNotif('Approve Checkin Gagal!', 'red');
                },
                success: function (data) {
                    if (data.status) {
                        $('#loader').hide();
                        LoadNewApprovalCheckin(true, 'Approve');
                        LoadApprovalCheckin();
                        console.log('ApproveCheckin Sukses');
                    }
                }
            });
        }
            

    function LoadApprovalCheckinHistory() {
      $('#loader').show();
      console.log('LoadApprovalCheckinHistory');
      $.ajax({
        url: "{{url('/LoadApprovalCheckinHistory')}}",
        type: 'GET',
        dataType: 'json',
        error: function(e) {
          console.log(e);
          $('#loader').hide();
          ShowNotif('LoadApprovalCheckinHistory Gagal', 'red');
        },
        success: function(data) {
          console.log(data.data);
          $('#ApprovalCheckinHistory').dataTable( {
              "destroy": true,
              "aaData": data.data,
              "scrollX":true,

              "columns": [
                  { "data": null,"orderable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}},
                  { "data": "nama_lengkap_visitor" },
                  { "data": "checkin_time" },
                  { "data": "keperluan_visit" },
                  { "data": "barang_bawaan" },
                  { "data": "approval_timestamp" },
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
        url:"{{url('/CheckoutPetugas')}}",  
        method:"POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:$('#check-out-petugas').serialize(),
        dataType:'json',
        error: function(e) {
          console.log(e);
          console.log('CheckoutPetugas Error');
          $('#loader').hide();
          ShowNotif('CheckoutPetugas Gagal!', 'red');
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
    
    function RejectCheckin() {
      if ($('#alasan_reject').val() == '') {
        ShowNotif('Silahkan isi Alasan!', 'red');
        return;
      }
      $('#modal-reject-check-in').modal('hide');
      $('#loader').show();
      console.log('RejectCheckin');
      $.ajax({  
        url:"{{url('/reject-check-in')}}",  
        method:"POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:$('#rejection-checkin').serialize(),
        type:'json',
        error: function(e) {

          console.log('RejectCheckin Error');
          $('#loader').hide();
          ShowNotif('RejectCheckin Gagal!', 'red');
        },
        success:function(data)  
        {
          if (data.status) {
            $('#loader').hide();
            LoadNewApprovalCheckin(true, 'Reject');
            LoadApprovalCheckin();
            LoadApprovalCheckinHistory();
            console.log('RejectCheckin Sukses');
          }
        }  
      });
    }

    function DownloadFoto(filename) {
      $('#loader').show();
      $.ajax({
        url: "{{url('/downloadfoto/')}}"+'/'+filename, //'/downloadfoto/'+filename,
        type: 'GET',
        data: {},
        //dataType: 'json',
        xhrFields: {
                responseType: 'blob'
            },
        error: function(e) {
          console.log('Error');
          console.log(e);
          $('#loader').hide();
          ShowNotif('DownloadFoto Gagal!', 'red');
        },
        success: function(data) {
          console.log(data);
          $('#loader').hide();
          if (data instanceof Blob) {
            var blob = new Blob([data]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;
            link.click();
          }
          else {
            console.log('kosong');
            ShowNotif('File tidak ditemukan!', 'red');
            //alert('File tidak ditemukan!');
          }
         
        }
      });
    }

</script>
@endsection
