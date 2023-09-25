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

                        <h2>Anggota Perpus</h2> ---
                        <!-- <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button> -->
                        <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button>

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
                                <th>Nama</th>
                                <th>Keperluan</th>
                                <th>Instansi</th>
                                <th>Tanggal Kedatangan</th>
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
                <form id="formAdd" method="POST" action="proses_daftar_tamu.php" class="form-horizontal form-label-left" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="hidden" name="type" id="type" value="">
                    <input type="hidden" name="id_tamu" id="id_tamu" value="">

                    <div class="form-group">
                        <label class="control-label">Nama Tamu</label>
                        <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Tamu" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Instansi</label>
                        <input class="form-control" type="text" id="instansi" name="instansi" placeholder="Instansi" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Keperluan</label>
                        <input class="form-control" type="text" name="keperluan" id="keperluan" placeholder="Keperluan" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tanggal Kedatangan</label>
                        <input class="form-control" type="date" id="tgl_kedatangan" name="tgl_kedatangan" placeholder="Kelas" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm"></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /modal add -->
<!-- /page content -->
<?php include 'layout/footer.php' ?>


<script type="text/javascript">
    function formatDateAkhir() {
        // Tanggal awal
        var tanggalAwal = new Date($('#tgl_daftar').val()); // Gantilah dengan tanggal awal yang sesuai

        // Jumlah hari yang akan ditambahkan
        var jumlahHari = 90; // Gantilah dengan jumlah hari yang Anda inginkan

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
            "ajax": "system/scripts/server_processing_tamu.php"
        });

        // click modal
        $('#openmodal').click(function(event) {

            // tambah type
            $('#formAdd')[0].reset();
            $('#type').val('new');
            $('#myModalLabel2').html('Tambah Anggota');
            $('#btnSubmit').html('Simpan');
            $('#modalAdd').modal('show');
        });
    });

    // function edit
    function editModal(id_tamu) {
        console.log("Id Tamu Edit =", id_tamu);
        if (id_tamu) {
            $.ajax({
                    url: 'getEditTamu.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id_tamu: id_tamu
                    },
                })
                .success(function(res) {

                    console.log("Get Data Daftar Tamu = ",res);
                    $('#type').val('edit');
                    
                    $('#id_tamu').val(res.id_tamu);
                    $('#nama').val(res.nama);
                    $('#instansi').val(res.instansi);
                    $('#keperluan').val(res.keperluan);
                    $('#tgl_kedatangan').val(res.tgl_kedatangan);
                    
                    // show atribut modal
                    $('#myModalLabel2').html('Edit Daftar Tamu');
                    $('#btnSubmit').html('Edit');
                    $('#modalAdd').modal('show');
                })
                .error(function(er) {
                    console.log(er);
                });;

        } else {
            alert('id anggota kosong');
        }
    }
    // function delete
    function deleteModal(id_tamu) {
        // console.log("Id Tamu = ",id_tamu);
        if (id_tamu) {
            var conf = confirm('Yakin ingin menghapus?');
            if (conf) {
                $.ajax({
                        url: 'hapus_tamu.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id_tamu,
                            type: 'tamu'
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
    function cetakKartuTamu(id_tamu) {
        if (id_tamu) {
            var left = (screen.width / 2) - (800 / 2);
            var right = (screen.height / 2) - (640 / 2);

            var url = 'getKartuTamu.php?id_tamu=' + id_tamu;

            window.open(url, '', 'width=800, height=640, scrollbars=yes, left=' + left + ', top=' + top + '');
        } else {
            alert('UID tidak diketahui');
        }

    }
</script>