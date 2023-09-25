<?php 

include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$buku_id = $_GET['buku_id'];
$anggota_id = $_GET['anggota_id'];


$db->join('anggota ang', 'tr.anggota_id=ang.id_anggota', 'LEFT');
$db->join('buku bk', 'tr.buku_id=bk.id_buku', 'LEFT');

$db->where('tr.buku_id', $buku_id);
$db->where('tr.anggota_id', $anggota_id);
$db->where('tr.status_kembali', '0');
$data = $db->get('transaksi tr', null, 'tr.*, ang.nama, bk.judul');

// var_dump($data);
// die();

// print_r($data);
if (!empty($data)) {
  echo '<h2>Data Peminjaman buku</h2>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Judul</th>
      <th>Tgl pinjam</th>
      <th>Tgl Kembali</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>'.$data[0]['nama'].'</td>
      <td>'.$data[0]['judul'].'</td>
      <td>'.$data[0]['tgl_pinjam'].'</td>
      <td>'.$data[0]['tgl_kembali'].'</td>
      <td><button class="btn btn-info btn-xs" type="button" onclick="aksiPengembalian('.$data[0]['id_transaksi'].', \'denda\')">Cek denda</button>
      <button class="btn btn-primary btn-xs" type="button" onclick="aksiPengembalian('.$data[0]['id_transaksi'].',\'kembalikan\')">Kembalikan</button>
      </td>
    </tr>
  </tbody>
</table>';
} else {
  echo "Data tidak ada";
}


?>