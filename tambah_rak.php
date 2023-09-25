<?php include 'layout/header.php'; ?>
<?php 
  include('system/fungsi.php');
  include('system/php-mysqli/MysqliDb.php');

  $db = new MysqliDb();

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
                    <h2>Tambah Rak</h2> 
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <div class="col-md-5">
                    <form action="proses_rak.php" method="post" accept-charset="utf-8">
                    <input type="hidden" name="type" value="new">
                    <div class="form-group">
                      <label class="control-label">Nama Rak</label>
                      <input class="form-control" type="text" name="nama_rak" placeholder="Nama kategori">
                    </div>
                    <input type="submit" name="" value="Simpan" class="btn btn-primary btn-xs">
                    <a class="btn btn-info btn-xs" href="rak.php" title="">Cancel</a>
                    </form>
                    </div>
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include 'layout/footer.php' ?>