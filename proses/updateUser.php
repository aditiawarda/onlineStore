<?php
  // Load ﬁle koneksi.php
  include "db.php";
    $connect = mysqli_connect('localhost', 'root', '', 'ae_center');

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $telpon = $_POST['telpon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $pw = $_POST['pw'];


    $query =  "UPDATE tabel_user SET namaUser='$nama', telpon='$telpon', email='$email', alamat='$alamat', password='$pw' WHERE idUser='$id' ";

    $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo '
      <script>
      alert("Data berhasil di update..");
      window.location = "../pembelian.php";
      </script>
    ';
    }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='../pembelian.php'>Kembali Ke Laman Pembelian</a>";
    }

?>