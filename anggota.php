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

            <h2>Anggota Perpus</h2> <br>
            <!-- <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button> -->
            
            <div class="clearfix"></div>
          </div>
          <div class="" style="">
            <button class="btn btn-info " type=button id="openmodal">Tambah</button>
            <button class="btn btn-success " type=button id="importData" onclick="importExcel()">Import Data Excel</button>
          </div>
          <!-- isinya disini -->
          <?php
          // include('system/php-mysqli/MysqliDb.php');
          $db = new MysqliDb();

          ?>
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID Anggota</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>No Telepon</th>
                <th>Tgl daftar</th>
                <th>Tgl berakhir</th>
                <th>Aktif / Tdk</th>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2"></h4>
      </div>
      <div class="modal-body">
        <form id="formAdd" method="POST" action="proses_anggota.php" class="form-horizontal form-label-left" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="type" id="type" value="">
          <input type="hidden" name="idAnggota" id="idAnggota" value="">

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
            <label class="control-label">Id Anggota</label>
            <input class="form-control" type="text" id="id_ang" name="id_ang" placeholder="Id Anggota" required>
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
          </div>

          <div class="form-group">
            <label class="control-label">Kelas</label>
            <input class="form-control" type="text" id="kelas" name="kelas" placeholder="Kelas" required>
          </div>

          <div class="form-group">
            <label class="control-label">Tempat</label>
            <input class="form-control" type="text" name="tempatLahir" id="tempatLahir" placeholder="tempatLahir" required>
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Lahir</label>
            <input class="form-control" type="date" name="ttl" id="ttl" placeholder="Tanggal Lahir" required>
          </div>

          <div class="form-group">
            <label class="control-label">No Telepon</label>
            <input class="form-control" type="text" name="no_telepon" id="no_telepon" placeholder="No Telepon" required>
          </div>

          <div class="form-group">
            <label class="control-label">Tgl daftar</label>
            <input onchange="formatDateAkhir()" class="form-control" type="date" id="tgl_daftar" name="tgl_daftar" placeholder="Tgl daftar" required>
          </div>

          <div class="form-group">
            <label class="control-label">Tgl Berakhir</label>
            <input class="form-control" type="date" id="tgl_berakhir" name="tgl_berakhir" placeholder="Tgl berakhir" required="">
          </div>

          <div class="form-group">
            <label class="control-label">Status Aktif</label>
            <select class="form-control" name="status_aktif" id="status_aktif">
              <option value="1">Aktif</option>
              <option value="0">Tdk Aktif</option>
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


<!-- modal add -->
<div class="modal fade modal-wide" id="modalImport" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="labelImport"></h4>
      </div>
      <div class="modal-body">
        <form id="formAdd" method="POST" action="proses_import_excel.php" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="formFile" class="form-label">Default file input example</label>
          <input class="form-control" type="file" id="fileExcel" name="fileExcel">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="btnSubmit" class="btn btn-primary btn-round btn-sm">Import</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- /page content -->
<?php include 'layout/footer.php' ?>


<script type="text/javascript">
  function formatDateAkhir() {
    // Tanggal awal
    var tanggalAwal = new Date($('#tgl_daftar').val()); // Gantilah dengan tanggal awal yang sesuai

    // Jumlah hari yang akan ditambahkan
    var jumlahHari = 365; // Gantilah dengan jumlah hari yang Anda inginkan

    // Menambahkan jumlah hari ke tanggal awal
    tanggalAwal.setDate(tanggalAwal.getDate() + jumlahHari);

    // Format tanggal hasil
    var tahun = tanggalAwal.getFullYear();
    var bulan = String(tanggalAwal.getMonth() + 1).padStart(2, '0'); // Tambahkan 1 karena bulan dimulai dari 0
    var hari = String(tanggalAwal.getDate()).padStart(2, '0');

    // Hasil
    var tanggalHasil = tahun + '-' + bulan + '-' + hari;
    $('#tgl_berakhir').val(tanggalHasil)
    // console.log(tanggalHasil);
  }
  $(document).ready(function() {

    dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_anggota.php"
    });

    // click modal
    $('#openmodal').click(function(event) {
      $('#gambarAktif').addClass('hidden')
      // tambah type
      $('#formAdd')[0].reset();
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Anggota');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');
    });
  });

  // function edit
  function editModal(id_ang) {
    if (id_ang) {
      $.ajax({
          url: 'getEditAnggota.php',
          type: 'GET',
          dataType: 'json',
          data: {
            id_ang: id_ang
          },
        })
        .success(function(res) {

          // Data yang akan diambil
          var data = res.ttl;

          // Pisahkan data berdasarkan koma (,)
          var parts = data.split(',');

          // Ambil kata pertama (indeks 0) dan hilangkan spasi di awal dan akhir jika ada
          var kota = parts[0].trim();
          var tanggal = parts[1].trim();

          // Formating
          var bagianTanggal = tanggal.split(' ');

          var day = bagianTanggal[0];
          var month = bagianTanggal[1];
          var year = bagianTanggal[2];

          // Objek untuk memetakan nama bulan ke angka bulan
          var namaBulan = {
            "Januari": "01",
            "Februari": "02",
            "Maret": "03",
            "April": "04",
            "Mei": "05",
            "Juni": "06",
            "Juli": "07",
            "Agustus": "08",
            "September": "09",
            "Oktober": "10",
            "November": "11",
            "Desember": "12"
          };

          // Mengonversi nama bulan menjadi angka bulan
          month = namaBulan[month];

          // Menggabungkan day, month, dan year dalam format "month day year"
          var tanggalOutput = year + '-' + month + '-' + day;
          $('#gambarAktif').removeClass('hidden')
          // Formating

          $('#type').val('edit');
          // $('#inGambar').val(res.gambar);
          $('#inGambar').prop('src', 'assets/FtProfil/' + res.gambar)

          $('#idAnggota').val(res.id_anggota);
          $('#gambarLama').val(res.gambar);
          $('#id_ang').val(res.uid);
          $('#nama').val(res.nama);
          $('#no_telepon').val(res.no_telepon);
          $('#kelas').val(res.kelas);
          $('#tempatLahir').val(kota);
          $('#ttl').val(tanggalOutput);
          $('#tgl_daftar').val(res.tgl_daftar);
          $('#tgl_berakhir').val(res.tgl_berakhir);
          $('#status_aktif').val(res.status_aktif);
          // show atribut modal
          $('#myModalLabel2').html('Edit Anggota');
          $('#btnSubmit').html('Edit');
          $('#modalAdd').modal('show');
        })
        .error(function(er) {
          console.log(er);
        });

    } else {
      alert('id anggota kosong');
    }
  }
  // function delete
  function deleteModal(id_ang) {
    if (id_ang) {
      var conf = confirm('Yakin ingin menghapus?');
      if (conf) {
        $.ajax({
            url: 'hapus.php',
            type: 'POST',
            dataType: 'json',
            data: {
              id: id_ang,
              type: 'anggota'
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
 
<script>
  function importExcel(){
    console.log("Import Data Dari Excel");
    $('#modalImport').modal("show");
    $('#labelImport').html('Import Data Excel');
  }
</script>