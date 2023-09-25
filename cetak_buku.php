<?php include 'layout/header.php'; ?>
<?php 
  include('system/fungsi.php');

  $make = new Core();
  $make->check_session('admin');

  // include('system/php-mysqli/MysqliDb.php');
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
                    <h2>Cetak buku</h2>
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
                    <h2>Cetak buku berdasarkan</h2>
                    <form action="" method="POST" role="form">
                    
                      <div class="form-group">
                        <label for="">Pilih Kategori</label>
                        <select id="kat" name="kat" class="form-control">

                          <option value="*">Semua kategori</option>
                          <?php 
                            $k = $db->get('kategori');
                            foreach ($k as $key ) {
                              echo "<option value=".$key['id_kategori'].">".$key['nama_kategori']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    
                      
                    
                      <button id="cetakKategori" type="button" class="btn btn-primary">Submit</button>
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
<script type="text/javascript">
  $('#cetakKategori').click(function(event) {
    var kat = $('#kat').val();
    var left = (screen.width/2) - (800/2);
    var right = (screen.height/2) - (640/2);

    var url = 'tampilCetakBuku.php?kat='+kat;

    window.open(url, '', 'width=800, height=640, scrollbars=yes, left='+left+', top='+top+'');
  });
</script>