<?php
  // Load ﬁle koneksi.php
  include "db.php";
    $connect = mysqli_connect('localhost', 'root', '', 'ae_center');

    $id = $_POST['idTransaksi'];
    $pengiriman = $_POST['kode_pengiriman'];
    $status = $_POST['status_pengiriman'];
    $datenow = Date('Y-m-d h:i:sa');


    $query =  "UPDATE tabel_transaksi SET kode_pengiriman='$pengiriman', status_pengiriman='$status', tgl_pengiriman='$datenow' WHERE idTransaksi='$id' ";

    $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo '
      <script>
      alert("Pengiriman pesanan berhasil diproses...");
      window.location = "../admin.php";
      </script>
    ';
    }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='../admin.php'>Kembali Ke Laman Admin</a>";
    }

?>