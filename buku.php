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
            <h2>Buku Perpus</h2> ---
            <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <!-- isinya disini -->
          <?php
          // include('system/php-mysqli/MysqliDb.php');
          $db = new MysqliDb();

          ?>
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>ISBN</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Rak</th>
                <th>Kategori</th>
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
        <form id="formAdd" class="form-horizontal form-label-left" accept-charset="utf-8">
          <input type="hidden" name="type" id="type" value="">
          <input type="hidden" name="id_buku" id="id_buku" value="">
          <div class="form-group">
            <label class="control-label">Kode Buku</label>
            <input class="form-control" type="text" id="kodeBuku" name="kodeBuku" placeholder="Kode Buku" required>
          </div>

          <div class="form-group">
            <label class="control-label">Judul</label>
            <input class="form-control" type="text" id="judul" name="judul" placeholder="Judul" required>
          </div>

          <div class="form-group">
            <label class="control-label">Pengarang</label>
            <input class="form-control" type="text" name="pengarang" id="pengarang" placeholder="Pengarang" required>
          </div>

          <div class="form-group">
            <label class="control-label">Penerbit</label>
            <input class="form-control" id="penerbit" type="text" name="penerbit" placeholder="Penerbit" required>
          </div>

          <div class="form-group">
            <label class="control-label">ISBN</label>
            <input class="form-control" id="isbn" type="text" name="isbn" placeholder="ISBN" required="">
          </div>

          <div class="form-group">
            <label class="control-label">Tahun</label>
            <input class="form-control" id="tahun" type="text" name="tahun" placeholder="Tahun" required="">
          </div>

          <div class="form-group">
            <label class="control-label">Stok buku</label>
            <input class="form-control" id="stok" type="text" name="stok" placeholder="Stok buku" required="">
          </div>

          <div class="form-group">
            <label class="control-label"> Rak</label>
            <select class="form-control" name="rak" id="rak">
              <?php
              $raks = $db->get('rak');
              foreach ($raks as $rak) {
                echo '<option value="' . $rak['id_rak'] . '">' . $rak['nama_rak'] . '</option>';
              }
              ?>

            </select>
          </div>

          <div class="form-group">
            <label class="control-label"> Kategori</label>
            <select class="form-control" name="kategori" id="kategori">
              <?php
              $kategoris = $db->get('kategori');
              foreach ($kategoris as $kategori) {
                echo '<option value="' . $kategori['id_kategori'] . '">' . $kategori['nama_kategori'] . '</option>';
              }
              ?>

            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
        <button type="button" id="btnSubmit" class="btn btn-primary btn-round btn-sm"></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal add -->
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

    dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_buku.php"
    });

    // tgl daftar
    $('#tgl_daftar').datepicker({
      format: 'yyyy-mm-dd',

    }).on('changeDate', function(e) {
      $(this).datepicker('hide');
    });
    // tgl berakhir
    $('#tgl_berakhir').datepicker({
      format: 'yyyy-mm-dd',

    }).on('changeDate', function(e) {
      $(this).datepicker('hide');
    });

    // click modal
    $('#openmodal').click(function(event) {
      // console.log('aaa');
      // tambah type
      $('#formAdd')[0].reset();
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Buku');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');
    });
    // submit form
    $('#btnSubmit').click(function(event) {
      // event.preventDefault();
      // validasi input
      // $('#formAdd').valid();
      // kumpulkan data inputan
      dataInput = {
        type: $('#type').val(),
        id_buku: $('#id_buku').val(),
        kodeBuku: $('#kodeBuku').val(),
        judul: $('#judul').val(),
        pengarang: $('#pengarang').val(),
        penerbit: $('#penerbit').val(),
        isbn: $('#isbn').val(),
        tahun: $('#tahun').val(),
        stok: $('#stok').val(),
        rak: $('#rak').val(),
        kategori: $('#kategori').val(),
      };

      console.log(dataInput);
      $.ajax({
          url: 'proses_buku.php',
          type: 'POST',
          dataType: 'json',
          data: dataInput,
        })
        .success(function(res) {
          console.log(res);
          $.notify(res.pesan, res.type);
          $('#modalAdd').modal('hide');
          $('#formAdd')[0].reset();
          // $('#modalAdd').remove();
          dt.ajax.reload();
        });

    });

  });

  // function edit
  function editModal(id_buku) {
    if (id_buku) {
      $.ajax({
          url: 'getEditBuku.php',
          type: 'GET',
          dataType: 'json',
          data: {
            id_buku: id_buku
          },
        })
        .success(function(res) {
          console.log(res);
          // dat.nama.val(res.nama);
          $('#type').val('edit')
          $('#id_buku').val(res.id_buku),
            $('#kodeBuku').val(res.uid_buku),
            $('#judul').val(res.judul),
            $('#pengarang').val(res.pengarang),
            $('#penerbit').val(res.penerbit),
            $('#isbn').val(res.isbn),
            $('#tahun').val(res.tahun),
            $('#stok').val(res.stok),
            $('#rak').val(res.rak),
            $('#kategori').val(res.kategori),
            // show atribut modal
            $('#myModalLabel2').html('Edit Anggota');
          $('#btnSubmit').html('Edit');
          $('#modalAdd').modal('show');
        })
        .error(function(er) {
          console.log(er);
        });;

    } else {
      alert('id buku kosong');
    }
  }
  // function delete
  function deleteModal(id_buku) {
    if (id_buku) {
      var conf = confirm('Yakin ingin menghapus?');
      if (conf) {
        $.ajax({
            url: 'hapus.php',
            type: 'POST',
            dataType: 'json',
            data: {
              id: id_buku,
              type: 'buku'
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
  function cetakBarcodeBuku(id_buku) {
    if (id_buku) {
      var left = (screen.width / 2) - (800 / 2);
      var right = (screen.height / 2) - (640 / 2);

      var url = 'getBarcodeBuku.php?uid=' + id_buku;

      window.open(url, '', 'width=800, height=640, scrollbars=yes, left=' + left + ', top=' + top + '');
    } else {
      alert('UID tidak diketahui');
    }

  }
</script>