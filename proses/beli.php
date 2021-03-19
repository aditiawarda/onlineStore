<?php 
  require('../config/db.php');
  session_start();
  $idBarang = $_POST['idProduk'];
  $idUser = $_POST['idUser'];
  $jumlah = $_POST['jumlah'];
  $harga = $_POST['harga']*$_POST['jumlah'];
  
  $queryInsert = mysqli_query($conn, "INSERT INTO tabel_trolly (idUser, idProduk, jumlah, harga) VALUES ('$idUser','$idBarang','$jumlah','$harga')");

  if($queryInsert){
    header('location: ../keranjang.php');
  }



 ?>