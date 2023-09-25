<?php include 'layout/header.php'; ?>

<?php
include('system/fungsi.php');

$make = new Core();
$make->check_session('admin');
?>
<?php include 'layout/menu.php' ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <h2>Data Akun</h2> ---
            <!-- <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button> -->
          </div>
          <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button>

          <div class="clearfix"></div>
          <!-- isinya disini -->
          <?php
          // include('system/php-mysqli/MysqliDb.php');
          $db = new MysqliDb();

          ?>
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>


          </table>
          <!-- <div id="content"></div> -->
          <!-- /isi -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal add -->
<div class="modal fade modal-wide" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2"></h4>
      </div>
      <div class="modal-body">
        <form id="formAdd" method="POST" action="proses_admin.php" class="form-horizontal form-label-left" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="type" id="type" value="">
          <input type="hidden" name="idAdmin" id="idAdmin" value="">
 
          <div class="border" id="gambarAktif"> 
            <label>Gambar Aktif</label>
            <img src="" alt="" id="inGambar" style="width: 400px !important;">
            <input type="text" name="gambarLama" id="gambarLama" class="hidden">
          </div>

          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile02">Gambar</label>
            <input type="file" class="form-control" id="file" name="fileGambar" id="fileGambar">
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
          </div>

          <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
          </div>

          <input class="form-control hidden" type="text" id="passwordLama" name="passwordLama" placeholder="Password">

          <div class="form-group" id="inptPassord">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
          </div>
          
          <div class="form-group" id="btnGantiPass">
            <button class="btn btn-primary" type="button" id="prosesGanti">Ganti Password</button>  
            <button class="btn btn-danger hidden" type="button" id="btnCancelPassword">Cancel</button>  
          </div>

          <div class="form-group">
            <label class="control-label">Status Aktif</label>
            <select class="form-control" name="status" id="status" selected>
              <option value="superAdmin">Super Admin</option>
              <option value="admin">Admin</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="btnSubmit" class="btn btn-primary btn-round btn-sm"></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal add -->
<!-- /page content -->
<?php include 'layout/footer.php' ?>


<script type="text/javascript">
  
  $(document).ready(function() {

    dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_admin.php"
    });

    // click modal
    $('#openmodal').click(function(event) {
      $('#gambarAktif').addClass('hidden')
      // tambah type
      $('#formAdd')[0].reset();
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Akun Admin');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');

      // ===== 
      $('#btnGantiPass').addClass('hidden');

    }); 
  });

  // function edit
  function editModal(id_admin) {
    console.log("Id Admin = ", id_admin);
    if (id_admin) {
      $.ajax({
          url: 'getEditAdmin.php',
          type: 'GET', 
          dataType: 'json',
          data: {
            id_admin: id_admin
          },
        })
        .success(function(res) {

          $('#inptPassord').addClass('hidden');
          $('#btnGantiPass').removeClass('hidden');
          
          
          // Data yang akan diambil
          console.log("Data Hasil Json = ", res);

          $('#gambarAktif').removeClass('hidden')
          // Formating

          $('#type').val('edit');
          $('#inGambar').prop('src', 'assets/FtAdmin/' + res.gambar)

          $('#idAdmin').val(res.id_admin);
          $('#nama').val(res.nama);
          $('#username').val(res.username);
          $('#passwordLama').val(res.password);
          $('#gambarLama').val(res.gambar);

          $("#status option:selected").text(res.status);
          
          // show atribut modal
          $('#myModalLabel2').html('Edit Data Akun');
          $('#btnSubmit').html('Edit');
          $('#modalAdd').modal('show');

          $('#prosesGanti').on('click', function() {
            $('#inptPassord').removeClass('hidden');
            $('#btnCancelPassword').removeClass('hidden');
            
            $('#prosesGanti').addClass('disabled');
          });

          $('#btnCancelPassword').on('click', function() {
            $('#inptPassord').addClass('hidden');
            $('#btnCancelPassword').addClass('hidden');
            
            $('#prosesGanti').removeClass('disabled');
          });
          
        })
        .error(function(er) {
          console.log(er);
        });;

    } else {
      alert('id anggota kosong');
    }
  }
  // function delete
  function deleteModal(id_admin) {
    if (id_admin) {
      var conf = confirm('Yakin ingin menghapus?');
      if (conf) {
        $.ajax({
            url: 'hapus.php',
            type: 'POST',
            dataType: 'json',
            data: {
              id: id_admin,
              type: 'akun'
            },
          })
          .success(function(response) {
            console.log(response);
            $.notify(response, 'success');
            dt.ajax.reload();
          });
      }
    } else {
      alert('Gagal hapus');
    }
  }
  // cetka kartu
  function cetakKartu(id_ang) {
    if (id_ang) {
      var left = (screen.width / 2) - (800 / 2);
      var right = (screen.height / 2) - (640 / 2);

      var url = 'getKartuAnggota.php?uid=' + id_ang;

      window.open(url, '', 'width=800, height=640, scrollbars=yes, left=' + left + ', top=' + top + '');
    } else {
      alert('UID tidak diketahui');
    }

  }
</script>