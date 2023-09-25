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
                    <h2>Cetak pendapatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <h2>Cetak pendapaatan perbulan</h2>
                    <div class="row">
                      <div class="col-md-5">
                        <form action="" method="" role="form">
                        
                          <div class="form-group">
                            <label for="tgl">label</label>
                            <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Bulan">
                          </div>

                          <button id="cetakPendapatan" type="button" class="btn btn-primary">Submit</button>
                        </form>
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
  $('#cetakPendapatan').click(function(event) {
    var tgl = $('#tgl').val(); 

    var left = (screen.width/2) - (800/2);
    var top = (screen.height/2) - (640/2);

    var url = 'tampilCetakPendapatan.php?tgl='+tgl;

    window.open(url, '', 'width=800, height=640, scrollbars=yes, left='+left+', top='+top+'');
  });

  $('#tgl').datepicker({
    format: 'yyyy-mm-dd'
  })
</script>