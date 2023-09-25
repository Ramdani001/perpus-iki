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
            <h2>Pengembalian buku</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <!-- isinya disini -->
          <!-- tabel -->
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!-- <th>Id Anggota</th> -->
                  <th>Nama</th>
                  <th>Judul buku</th>
                  <th>Tgl pinjam</th>
                  <th>Tgl kembali</th>
                  <th>Status Pinjam</th>
                  <th>Aksi</th>
                </tr>
            </thead>

            </table>

          </div>

          <!-- /isi -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include 'layout/footer.php' ?>
<script type="text/javascript">
  $(document).ready(function() {

    
    // dataTable

    dt = $('#tabelku').DataTable({
      'prosessing': true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_pengembalian.php"
    });

    });
   

    // btn simpan klik
    $('#btnCariPinjaman').click(function(event) {
      // console.log('yeh');
      var dataInput = {
        // anggota_id: $('#anggota_id').val(),
        // buku_id: $('#buku_id').val(),
        anggota_id: $('#uid_ang').val(),
        buku_id: $('#uid_buku').val(),
        // tgl_pinjam: (new Date()).toISOString().substring(0,10),
      }


    });

  
  // function opencekdenda
  function aksiCekDenda(id) {
    // alert(id);
    console.log( "Id = ", id);
    var jenis = 'denda'

    $.getJSON('aksiCheckPengembalian.php', {
      id: id,
      aksi: jenis
    }, function(json, textStatus) {
      var js = json;
      if (js.berhasil == 'update_stok') {
        location.reload(true);
        
      }
      alert('Jumlah hari telat : ' + js.jml_hari_telat + ' & Total denda : Rp ' + js.total_denda);
    });
  }
  function aksiPengembalian(id) {
    // alert(id);
    console.log( "Id = ", id);
    var jenis = "kembalikan";
    if (jenis == 'kembalikan') {
      confirm('Yakin ingin mengembalikan buku?');
    }
    $.getJSON('aksiCheckPengembalian.php', {
      id: id,
      aksi: jenis
    }, function(json, textStatus) {
      var js = json;
      console.log("Send JSON =", js);
      if (js.berhasil == 'update_stok') {
        location.reload(true);
        return false;
      }
    });
  }
</script>