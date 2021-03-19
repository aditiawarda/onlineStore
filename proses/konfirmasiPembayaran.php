<?php
  // Load ﬁle koneksi.php
  include "db.php";
    $connect = mysqli_connect('localhost', 'root', '', 'ae_center');

    $id = $_POST['idTransaksi'];
    $status = $_POST['status_pembayaran'];
    $pengiriman = $_POST['pengiriman'];
    $datenow = Date('Y-m-d h:i:sa');

    // Ambil Data yang Dikirim dari Form
    $nama_file = md5(($_FILES['bukti_pembayaran']['name']).$datenow);
    $ukuran_file = $_FILES['bukti_pembayaran']['size'];
    $tipe_file = $_FILES['bukti_pembayaran']['type'];
    $tmp_file = $_FILES['bukti_pembayaran']['tmp_name'];
    // Set path folder tempat menyimpan gambarnya
    $path = "images/".$nama_file;
    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe ﬁle yang diupload adalah JPG / JPEG / PNG
    // Jika tipe ﬁle yang diupload JPG / JPEG / PNG, lakukan :
    if($ukuran_file <= 1000000){ // Cek apakah ukuran ﬁle yang diupload kurang dari sama dengan 1MB
    // Jika ukuran ﬁle kurang dari sama dengan 1MB, lakukan :
    // Proses upload
    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Jika gambar berhasil diupload, Lakukan : 
    // Proses simpan ke Database

    $query =  "UPDATE tabel_transaksi SET bukti_pembayaran='$nama_file', tgl_pembayaran='$datenow', status_pembayaran='$status', status_pengiriman='$pengiriman' WHERE idTransaksi='$id' ";

    $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo '
      <script>
      alert("Konfirmasi Pembayaran berhasil diproses, Pesanan kamu akan segera kami kirim...");
      window.location = "../pembelian.php";
      </script>
    ';
    }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='../pembelian.php'>Kembali Ke Form</a>";
    }
    }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='../pembelian.php'>Kembali Ke Form</a>";
    }
    }else{
    // Jika ukuran ﬁle lebih dari 1MB, lakukan :
    echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
    echo "<br><a href='../pembelian.php'>Kembali Ke Form</a>";
    }
    }else{
    // Jika tipe ﬁle yang diupload bukan JPG / JPEG / PNG, lakukan :
    echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    echo "<br><a href='../pembelian.php'>Kembali Ke Form</a>";
    }

?>





<!-- <?php 
  //require('../config/db.php');

  //$UploadDir = 'image/';

  //if(isset($_POST['upload'])){
    //$conn = mysqli_connect('localhost', 'root', '', 'ae_center');

    //$id = $_POST['idTransaksi'];
    //$status = $_POST['status_pembayaran'];

    //$datenow = Date('Y-m-d h:i:sa');
    //$filename = md5(($_FILES['bukti_pembayaran']['name']).$datenow);
    //$tmpName = $_FILES['bukti_pembayaran']['tmp_name'];
    //$fileSize = $_FILES['bukti_pembayaran']['size'];
    //$fileType = $_FILES['bukti_pembayaran']['type'];
    //$filePath = $UploadDir . $filename.'.png';
    //$result = move_uploaded_file($tmpName, $filePath);

   

    //$query = mysqli_query($conn, "UPDATE tabel_transaksi SET bukti_pembayaran='$filename', tgl_pembayaran='$datenow', status_pembayaran='$status', path='$filePath', size='$fileSize' WHERE idTransaksi='$id' ");

    //$query = mysqli_query($conn, "INSERT INTO tabel_transaksi (bukti_pembayaran, tgl_pembayaran, status_pembayaran, path, size) VALUES ('$filename', '$datenow', '$status', '$filePath', '$fileSize') WHERE idTransaksi='$id'");

    //if (!get_magic_quotes_gpc()) {
      //$filename = addslashes($filename);
      //$filePath = addslashes($filePath);
    //}

    //if($query){
      //echo '
           //<script>
             //alert("Produk ditambahkan");
             //window.location = "../pembelian.php"
           //</script>
         //';
    //}else{
      //echo '
     //<script>
       //  alert("Format Gambar Tidak Di Dukung (Format Harus .JPG, .JPEG, .PNG, dan .GIF)");
         //window.location="../pembelian.php"
       //</script>
     //';
    //}
    //mysqli_close($conn);
  //}
//?>
   -->















