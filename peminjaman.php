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
            <h2>Peminjaman buku</h2>

            <div class="clearfix"></div>
          </div>
          <!-- isinya disini -->
          <!-- <div class="row">
            <div class="col-md-7">
              <h4>Masukan barcode Anggota dan Buku</h4>
              <form class="form-inline">
                <div class="form-group">
                  <input type="text" id="uid_ang" class="form-control" placeholder="ID Anggota">
                  <input type="hidden" id="anggota_id" name="anggota_id">
                </div>
                <div class="form-group">
                  <input type="text" id="uid_buku" class="form-control" disabled="disabled" placeholder="Kode Buku">
                  <input type="hidden" id="buku_id" name="buku_id">
                </div>
                <button id="btnSimpanPeminjaman" type="button" class="btn btn-primary btn-sm">Submit</button>
              </form>
            </div>
            <div class="col-md-5">
              <p id="nama_ang"></p>
              <p id="nama_buku"></p>
            </div>
          </div> -->

          <!-- tabel -->
          <div class="row">
            <div class="col-md-12">
              <h2>Daftar Peminjaman buku</h2>
              <button type="button" id="openmodal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
              </button>

              <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Id Anggota</th> -->
                    <th>Nama</th>
                    <th>Judul buku</th>
                    <th>Tgl pinjam</th>
                    <th>Tgl kembali</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

              </table>
            </div>
          </div>
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
        <form id="formAdd" method="POST" action="postDataPeminjaman.php" class="form-horizontal form-label-left" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="type" id="type" value="">
          <input type="hidden" name="id_peminjaman" id="id_peminjaman" value="">

          <div class="form-group">
            <label class="control-label">Id Anggota</label>
            <input class="form-control" type="text" id="uid_ang" name="uid_ang" placeholder="Id Anggota" required>
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Nama" required>
          </div>

          <div class="form-group">
            <label class="control-label">Kelas</label>
            <input class="form-control" type="text" id="kelas_anggota" name="kelas_anggota" placeholder="Kelas" required>
          </div>
          <div class="form-group">
            <label class="control-label">Id Buku</label>

            <input class="form-control hidden" type="text" id="inptIdAnggota" name="inptIdAnggota" placeholder="Input Id Anggota">

            <input class="form-control" type="text" id="uid_buku" name="uid_buku" placeholder="Id Buku" required readonly>
            <button type="button" name="btnPinjam" id="btnPinjam" class="btn btn-success" style="margin-top: 10px;">
              Pinjam
            </button>

          </div>

          <div id="listBuku">

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


<!-- modal Detail -->
<div class="modal fade modal-wide" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel1"></h4>
      </div>
      <div class="modal-body">
        <form id="formAdd" method="POST" action="proses_anggota.php" class="form-horizontal form-label-left" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="type" id="type" value="">
          <input type="hidden" name="id_peminjaman" id="id_peminjaman" value="">

          <div class="form-group">
            <label class="control-label">Id Anggota</label>
            <input class="form-control" type="text" id="detail_uid_ang" name="uid_ang" placeholder="Id Anggota" required readonly>
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" id="detail_nama_anggota" name="nama_anggota" placeholder="Nama" required readonly>
          </div>

          <div class="form-group">
            <label class="control-label">Kelas</label>
            <input class="form-control" type="text" id="detail_kelas_anggota" name="kelas_anggota" placeholder="Kelas" required readonly>
          </div>


          <label class="control-label">List Buku</label>
          <ul id="listBukuDetail" class="inline">

          </ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger " id="btnCloseDetail">Kembali</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal add -->


<!-- /page content -->
<?php include 'layout/footer.php' ?>
<script type="text/javascript">
  var listOrder = [];


  function detailModal(e) {
    console.log("Id Anggota Detail =", e);
    $('#myModalLabel1').html('Detail Pinjaman');
    $('#modalDetail').modal('show');

    $.ajax({
        url: 'proses_detail_listOrderBuku.php',
        type: 'POST',
        dataType: 'json',
        data: {
          idAnggota: e
        },
      })
      .success(function(res) {
        
        // console.log(res.row);

        $('#detail_uid_ang').val(res.row.uid);
        $('#detail_nama_anggota').val(res.row.nama);
        $('#detail_kelas_anggota').val(res.row.kelas);

        var data = res.allList;
        var dataRow = res.row;

        var listContainer = document.getElementById('listBukuDetail');
        // listContainer.addClass('inline');

        $idSendList = [];
        $id_buku=[];
        for (var i = 0; i < data.length; i++) {
          var idData = data[i].id;
            var obj = { isi: idData }; 
            $idSendList.push(obj); 

          $id_buku.push(data[i].id_buku);
        }
          if ($id_buku.length > 0) {
            $.ajax({
                url: 'getDataPeminjaman.php',
                type: 'GET',
                dataType: 'json',
                data: {
                  id_buku: $id_buku,
                  idSendList: $idSendList,
                  type: "detailListBuku"
                },
              })
              .success(function(res) {
              
                for ($i = 0; $i < res.idSendList.length; $i++) {
                  
                  var listItem = document.createElement("li");
                  var buttonList = document.createElement("button");
                  
                  buttonList.textContent = " Hapus";
                  buttonList.setAttribute("onclick", 'hapusListData('+res.idSendList[$i].isi+')');
                  buttonList.setAttribute("id", "btnHapusList" + res.idSendList[$i].isi);
                  buttonList.setAttribute("value", res.idSendList[$i].isi);
                  buttonList.setAttribute("type", "button");
                  
                  listItem.setAttribute("id", "list" + res.idSendList[$i].isi);
                  
                  listItem.textContent = " Judul Buku : " + res.isiCariBuku[$i].judul + "    ";
                  
                  listItem.appendChild(buttonList);

                  listContainer.appendChild(listItem); // Menambahkan elemen <li> ke dalam <ul>
                }

              });
          }

   
        $('#btnCloseDetail').on('click', function() {
          // console.log("CLose detail");
          var listContainer = document.getElementById('listBukuDetail');

          // Hapus semua elemen di dalam container
          while (listContainer.firstChild) {
            listContainer.removeChild(listContainer.firstChild);
          }
          $('#modalDetail').modal('hide');
        })

        
       

      }).error(function(er) {
        var hj = $.parseJSON(er.responseText);
        // alert(hj.message);
        $.notify(hj.message, hj.type);
        return false;
      });
  }
  
  function hapusListData(id_list){
          console.log("Id List Hapus = ", id_list);

          $.ajax({
            url: 'getDataPeminjaman.php',
            type: 'GET',
            dataType: 'json',
            data: { 
              id_list: id_list,
              type: "hapusListOrderBuku"
            },
          })
          .success(function(res) {
            var listContainer = document.getElementById('listBukuDetail');
            var listItem = document.getElementById('list' + res.id_list);

            var btnSelect = $('#btnHapusList' + res.id_list).val();
            console.log(listItem);
            // alert(res.pesan);

            if(res.pesan == "Data Berhasil Dihapus"){
                alert(res.pesan);
                listContainer.removeChild(listItem);
            }else{
              alert(res.pesan);
            }



          });
          
        }
  $(document).ready(function() {

    dt = $('#tabelku').DataTable({
      'prosessing': true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_daftarpeminjaman.php"
    });


    // keyup uid anggota
    $('#uid_ang').keyup(function(event) {
      /* Act on the event */
      uid_ang = $('#uid_ang').val();
      $.getJSON('getDataPeminjaman.php', {
        uid_ang: uid_ang,
        type: 'anggota'
      }, function(json, textStatus) {
        /*optional stuff to do after success */

        $("#nama_anggota").val(json.nama);
        $("#kelas_anggota").val(json.kelas);
        $("#inptIdAnggota").val(json.uid);

        $("#uid_buku").attr("readonly", false);


      });

    });
    // onclick uid buku
    $('#btnPinjam').on('click', function(event) {
      // Old Syntax
      uid_buku = $('#uid_buku').val();
      inptIdAnggota = $('#inptIdAnggota').val();
      $.getJSON('getDataPeminjaman.php', {
        uid_buku: uid_buku,
        inptIdAnggota: inptIdAnggota,
        type: 'buku'
      }, function(json, textStatus) {
        console.log(json);
        /*optional stuff to do after success */
        // return false;
        if (!json.pesan) {
          // f
          console.log('json : ', json);

          $order = {
            judul: json.judul,
            stok: json.stok
          };

          // console.log(listOrder.length);
          listOrder.push($order);

          // Mengurai data objek dan menampilkannya dalam daftar HTML
          var daftarData = document.getElementById("listBuku");

          if (listOrder.length < 1) {
            console.log("Kosong")
          }

          Object.keys(listOrder).forEach(function(key) {
            var listItem = document.createElement("p");

            listItem.classList.add("item" + key);

            listItem.textContent = "Judul: " + listOrder[key].judul + " Stok: " + listOrder[key].stok + "  ";

            daftarData.appendChild(listItem);

          });
          // f

        } else {
          alert(json.pesan)
        }

      });

      // console.log("List Order Buku = ", listOrder);
    });

    // click modal
    $('#openmodal').click(function(event) {
      $('#gambarAktif').addClass('hidden')
      $("#nama_anggota").attr("readonly", true);
      $("#kelas_anggota").attr("readonly", true);


      // tambah type
      $('#formAdd')[0].reset();
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Peminjam');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');
    });

  });
</script>