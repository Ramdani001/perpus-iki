<?php include 'layout/header.php'; ?>
<?php 
  include('system/fungsi.php');
  include('system/php-mysqli/MysqliDb.php');

  $make = new Core();
  $make->check_session('admin');

  $db = new MysqliDb();
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
                    <h2>Denda</h2> --- 
                    <?php 
                    $db->get('denda');
                    if ($db->count > 0) {
                      # code...
                    }else{
                      echo '<a class="btn btn-primary btn-xs" href="tambah_denda.php" title="">Tambah</a>';
                    }

                    ?>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                  <table class="table table-striped table bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      $dendas = $db->get('denda');
                      foreach ($dendas as $denda) { ?>

                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $denda['nominal'] ?></td>
                        <td>
                          <a class="btn btn-primary btn-xs" href="edit_denda.php?id=<?= $denda['id_denda'] ?>" title="Edit">Edit</a> | 
                          <a onclick="return confirm('Apakah ingin menghapus?')" class="btn btn-danger btn-xs" href="hapus_master.php?id=<?= $denda['id_denda'] ?>&type=denda" title="Hapus">Hapus</a>
                        </td>
                      </tr>

                      <?php $no++;  }
                      ?>
                    </tbody>
                  </table>
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include 'layout/footer.php' ?>