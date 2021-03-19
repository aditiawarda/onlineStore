<?php
  // Load ﬁle koneksi.php
  include "db.php";
    $connect = mysqli_connect('localhost', 'root', '', 'ae_center');

    $id = $_POST['idTransaksi'];
    $pengiriman = $_POST['status_pengiriman'];
    $penilaian = $_POST['penilaian'];
    $datenow = Date('Y-m-d h:i:sa');
    $penerimaan = $_POST['status_penerimaan'];
    $catatan = $_POST['catatan'];


    $query =  "UPDATE tabel_transaksi SET penilaian='$penilaian', tgl_penerimaan='$datenow', status_penerimaan='$penerimaan', status_pengiriman='$pengiriman', catatan='$catatan' WHERE idTransaksi='$id' ";

    $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo '
      <script>
      alert("Konfirmasi penerimaan pesanan berhasil...");
      window.location = "../pembelian.php";
      </script>
    ';
    }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='../pembelian.php'>Kembali Ke Laman Pembelian</a>";
    }

?>