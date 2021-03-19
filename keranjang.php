<?php 
  require('config/db.php');
  session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>AEC Store</title>
  <link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/main.css">
  <link rel="stylesheet" type="text/css" href="asset/css/keranjang.css">
  <link rel="icon" type="image/gif/png" href="asset/img/Title.png">
</head>
<body>

<?php include('component/nav2.php'); ?>

<div class="container-fluid" id="total-keranjang" >
  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      <div class="table-responsive">          
        <table class="table">
          <thead>
            <tr>
              <h3 style="font-family: Candara; color:white"><strong>Troli Kamu Sekarang</strong></h3>
            </tr>
          </thead>
          <tbody>

          <?php 
            $queryKeranjang = mysqli_query($conn, "SELECT * FROM tabel_trolly WHERE idUser='$_SESSION[idUser]' ");
            $jumlah = mysqli_num_rows($queryKeranjang);

            if($jumlah > 0){
              $queryTrolly = "SELECT * FROM tabel_trolly WHERE idUser='$_SESSION[idUser]'";
              $query_trolly = mysqli_query($conn, $queryTrolly);
              while($arrayTrolly = mysqli_fetch_array($query_trolly)){
                $queryProduk = mysqli_query($conn, "SELECT * FROM tabel_produk WHERE idProduk='$arrayTrolly[idProduk]'");
                $arrayProduk = mysqli_fetch_array($queryProduk);

                echo '
                  <tr>
                    <td rowspan="2" ><img src="admin/proses/'.$arrayProduk['path'].'"></td>
                    <td colspan="2">
                      <h4><strong>'.$arrayProduk['nama'].'</strong></h4>
                      <h5><i>by AEC Official Store</i></h5>

                      <p align="justify" style="margin-left:-0.1vw">'.$arrayProduk['keterangan'].'</p>
                      <p align="justify" style="margin-left:-0.1vw">____________________________________________________________________________</p>


                     

                         <table style="height: 56px; border-color: #FFFFFF; border-width: 1px;">
                            <tr style="height: 56px; border-color: #FFFFFF; border-width: 1px;">
                              <td align="left">
                                <font size="3">Harga &nbsp;&nbsp;&nbsp;&nbsp: </font>
                              </td>
                              <td align="left">
                                <font size="3">Rp. '.number_format($arrayProduk['harga'], 0, ".", ".").',-</font>
                              </td>
                              <td>
                              <form action="proses/updateTrolly.php" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="harga" value="'.$arrayProduk['harga'].'">
                                        <input type="hidden" name="idTrolly" value="'.$arrayTrolly['idTrolly'].'">
                              </td>
                              <td>
                                
                                         <font size="3">Jumlah &nbsp;&nbsp;&nbsp;: </font>
                              </td>
                              <td>

                                        <input type="number" class="form-control" value="'.$arrayTrolly['jumlah'].'" name="jumlah" min="1" max="'.$arrayProduk['stock'].'" style="width:90px">
                                        </div>
                              </td>
                              <td align="right">
                                <button type="submit" class="btn btn-primary">Checkout</button>
                              </form> 
                              </td>
                            </tr>
                          </table>
                          
                                                                 
                                    
                                
                      </td>
                      </tr>
                      <tr>
                      <td>
                      <font size="3">Garansi &nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;'.$arrayProduk['garansi'].'</font><br>
                      <font size="3">Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:  &nbsp;&nbsp;&nbsp;&nbsp;<b>Rp. '.number_format($arrayTrolly['harga'], 0, ".", ".").',-</font>
                    </td>
                    <td align=right >
                      <a href="proses/batalBeli.php?idTrolly='.$arrayTrolly['idTrolly'].'" class="btn btn-danger">Batal Beli</a>
                    </td>
                  </tr>
                ';
              }
          ?>
            <tr>
              <td colspan="3"><i>Diskon 20% minimal belanja Rp. 5.000.000,-</i></td>
            </tr>
            <tr id="total-bayar">
              <?php 
                $queryTotalBayar = mysqli_query($conn, "SELECT SUM(harga) FROM tabel_trolly WHERE idUser='$_SESSION[idUser]'");
                $arrayTotal = mysqli_fetch_array($queryTotalBayar);

                if ($arrayTotal[0]>=5000000){
                  $diskon = $arrayTotal[0] - 20/100* $arrayTotal[0];
                  $showdiskon = 20/100* $arrayTotal[0];
                  echo'
                    <td><h4><strong>Pembelian</strong></h4></td><td colspan=2><h4><strong>: Rp. '.number_format($arrayTotal[0], 0, ".", ".").',-</strong></h4></td>
                  </tr>
                  <tr>
                    <td><h4><strong>Diskon (20%)</strong></h4></td><td colspan=2><h4><strong>: Rp. '.number_format($showdiskon, 0, ".", ".").',-</strong></h4></td>
                  </tr>
                  <tr style="background-color: #eee8aa;">
                    <td><h4><strong>Total Pembayaran</strong></h4></td><td colspan=2><h4><strong>: Rp. '.number_format($diskon, 0, ".", ".").',-</strong></h4></td>';
                }
                else{
                  echo '
                    <td><h4><strong>Pembelian</strong></h4></td><td colspan=2><h4><strong>: Rp. '.number_format($arrayTotal[0], 0, ".", ".").',-</strong></h4></td>
                     </tr>
                  <tr>
                    <td><h4><strong>Diskon</strong></h4></td><td colspan=2><h4><strong>: Rp. 0,-</strong></h4></td>
                  </tr>
                  <tr style="background-color: #eee8aa;">
                    <td><h4><strong>Total Pembayaran</strong></h4></td><td colspan=2><h4><strong>: Rp. '.number_format($arrayTotal[0], 0, ".", ".").',-</strong></h4></td>';
                }
              ?>
            </tr>
            <tr>
            </tr>
            <?php
              $belumAda = 0;
              }
              else{
                $belumAda = 1;
                echo '
                <center>
                <img src="asset/img/trolikosong.png">
                  <h4>
                      <p>Troli kamu masih kosong, Yuk! belanja dan dapatkan penawaran menarik</p>
                    <h4><br>
                    <a href="home.php" class="btn btn-success">Belanja Sekarang</a></center>';
              }
            ?>           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php
  if($belumAda==0){
    echo '
    <div class="container" id="beli">
      <a href="proses/bayar.php?idUser='.$_SESSION['idUser'].'&&total='.$arrayTotal[0].'"><button type="button" class="btn btn-success"><strong>Beli Sekarang</strong></button></a>
      <a href="home.php"><button type="button" class="btn btn-primary" style="margin-left:42vw"><strong>Kembali Berbelanja</strong></button></a>
    </div>';
  }
?>

<?php include('component/footer.php'); ?>

<script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="asset/js/script.js"></script>
</body>
</html>