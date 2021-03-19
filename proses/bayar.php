<?php 

  require('../config/db.php');
  $idUser = $_GET['idUser'];
  $total = $_GET['total'];
  $queryTrolly = mysqli_query($conn, "SELECT * FROM tabel_trolly WHERE idUser='$idUser'");
  $tanggal = date("Y-m-d H:i:s");

  $barang = "";
  while($data = mysqli_fetch_array($queryTrolly)){
    $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_produk WHERE idProduk='$data[idProduk]'");
    $arrayBarang = mysqli_fetch_array($queryBarang);
    $kategori = $arrayBarang['kategori'];
    $nama = $arrayBarang['nama'];
    $jumlah = $data['jumlah'];
    $jumlahBarang = $arrayBarang['stock'] - $data['jumlah'];
    $updateJumlah = mysqli_query($conn, "UPDATE tabel_produk SET stock='$jumlahBarang' WHERE idProduk='$data[idProduk]'");
    $barang = $barang . $nama.", Kategori : " .$kategori.", Jumlah : " . $jumlah. "<br>";
  }

  $queryInsert = mysqli_query($conn, "INSERT INTO tabel_transaksi (idUser, daftarBarang, tanggal, total) VALUES ('$idUser', '$barang', '$tanggal', '$total')");

  $query = mysqli_query($conn, "DELETE FROM tabel_trolly WHERE idUser='$idUser'");
  
  if($query){
    echo '
      <script>
      alert("Terima kasih telah berbelanja, untuk pembayaran silahkan Transfer ke Rekening BCA 140-0-0-165473-4 an. AEC Official Store. Pesananamu akan segera kami kirim setelah pembayaran dilakukan. Harap konfirmasi pembayaran melalui menu Konfirmasi Pembayaran. Semoga kamu nyaman dengan layanan kami...");
      window.location = "../pembelian.php";
      </script>
    ';
  }
 ?>