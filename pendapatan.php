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
        <div class="x_panel" >
          <div class="x_title">
            <h2>Pendapatan Perpus</h2> ---
            <!-- <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button> -->
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
          // $db = new MysqliDb();

          ?>
          <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Telat</th>
                <th>Bayar</th>
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
      "ajax": "system/scripts/server_processing_pendapatan.php"
    });
  });
</script>