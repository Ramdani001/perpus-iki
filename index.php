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
            <h2>HOME PERPUSTAKAAN SMA 7 PASUNDAN</h2>

            <div class="clearfix"></div>
          </div>
          <!-- isinya disini -->
          <center>
            <img width="350" height="400" src="assets/images/SMA.jfif" alt="" title="SMA 7 PASUNDAN" class="img-responsive">
          </center>

          <!-- /isi -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php include 'layout/footer.php' ?>
