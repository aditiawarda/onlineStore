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
  <link rel="icon" type="image/gif/png" href="asset/img/Title.png">
</head>
<body>

<?php include('component/nav.php'); ?>
<div class="container-fluid" id="isi" >
  

  <div class="row">
    <div class="col-xs-10 col-xs-offset-1" id="produk-laris">
    <ul class="nav navbar-nav navbar-right">
    <li><div class="input-group" style="width:0vw; margin-right: 46vw; ">
    <img src="asset/img/pet.png" width="200" height="60">
    </div></li>
        <li><a data-toggle="pill" href="#smartphone" >Smartphone</a></li>
        <li><a data-toggle="pill" href="#televisi">Televisi</a></li>
        <li><a data-toggle="pill" href="#laptop">Laptop</a></li>
      </ul>
    </div>
  </div>
  
  <!-- Laman Produk-->
  
  <div class="container" id="produk">
    <div class="tab-content">

      <!-- smartphone -->
      <div id="smartphone" class="tab-pane fade in active">
      <ul>
      <?php 
        require("config/db.php");
        
        $querySmartphone = "SELECT * FROM tabel_produk WHERE kategori='smartphone'";
        $query_smartphone = mysqli_query($conn,$querySmartphone);

        while($arraySmartphone = mysqli_fetch_array($query_smartphone)){
          echo '
            <li>
              <a href="#'.$arraySmartphone['idProduk'].'">
                <img src="admin/proses/'.$arraySmartphone['path'].'" alt="'.$arraySmartphone['nama'].'">
                <span></span>
              </a>
              <div class="overlay" id="'.$arraySmartphone['idProduk'].'">
                <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
                <img src="admin/proses/'.$arraySmartphone['path'].'">
                <div class="keterangan">
                  <div class="container">
                    <h4><strong>'.$arraySmartphone['nama'].'</strong></h4>
                    <p align=justify>'.$arraySmartphone['keterangan'].'</p>
                    <h5><font color="green">Rp. '.number_format($arraySmartphone['harga'], 0, ".", ".").',-</font></h5>
                    <p>Garansi  &nbsp;: '.$arraySmartphone['garansi'].'<br>
                    Tersedia : '.$arraySmartphone['stock'].' Unit <br><br>
                    <b>Jumlah &nbsp;&nbsp;:</b></p>
                    <div class="form-group">
                    <form action="proses/beli.php" method="post">
                      <input type="hidden" name="idProduk" value="'.$arraySmartphone['idProduk'].'">
                      <input type="hidden" name="harga" value="'.$arraySmartphone['harga'].'">
                      <input type="number" class="form-control" name="jumlah" value="1" min="1" max="'.$arraySmartphone['stock'].'" style="width:90px">
                    </div>
                      ';

              if(isset($_SESSION['idUser'])){
                if($arraySmartphone['stock'] > 0){
                  echo '
                    <p align="right">
                      <input type="hidden" name="idUser" value="'.$_SESSION['idUser'].'">
                      <button type="submit" class="btn btn-info" style="margin-top:-25px">Masukkan ke Troli</button>
                    <p align="right">
                    </form>
                  ';
                }else{
                  echo '
                    <p align="right">
                      <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                    </p>
                  ';
                }
              }else{
                echo '
                  <p align="right">
                    <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                  </p>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
        }
        ?>
      <div class="clear"></div>
    </ul>

    </div>
    <!-- end of smartphone -->

    <!-- televisi -->
      <div id="televisi" class="tab-pane fade">
     <ul>
      <?php 
        require("config/db.php");
        
        $queryTelevisi = "SELECT * FROM tabel_produk WHERE kategori='televisi'";
        $query_televisi = mysqli_query($conn,$queryTelevisi);

        while($arrayTelevisi = mysqli_fetch_array($query_televisi)){
          echo '
            <li>
            <a href="#'.$arrayTelevisi['idProduk'].'">
              <img src="admin/proses/'.$arrayTelevisi['path'].'" alt="'.$arrayTelevisi['nama'].'">
              <span></span>
            </a>
            <div class="overlay" id="'.$arrayTelevisi['idProduk'].'">
              <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
              <img src="admin/proses/'.$arrayTelevisi['path'].'">
              <div class="keterangan">
                <div class="container">
                  <h4><strong>'.$arrayTelevisi['nama'].'</strong></h4>
                  <p>'.$arrayTelevisi['keterangan'].'</p>
                  <h5><font color="green">Rp. '.number_format($arrayTelevisi['harga'], 0, ".", ".").',-</font></h5>
                  <p>Garansi  &nbsp;: '.$arrayTelevisi['garansi'].'<br>
                    Tersedia : '.$arrayTelevisi['stock'].' Unit <br><br>
                    <b>Jumlah &nbsp;&nbsp;:</b></p>
                    <div class="form-group">
                    <form action="proses/beli.php" method="post">
                      <input type="hidden" name="idProduk" value="'.$arrayTelevisi['idProduk'].'">
                      <input type="hidden" name="harga" value="'.$arrayTelevisi['harga'].'">
                      <input type="number" class="form-control" name="jumlah" value="1" min="1" max="'.$arrayTelevisi['stock'].'" style="width:90px">
                    </div>
                      ';

              if(isset($_SESSION['idUser'])){
                if($arrayTelevisi['stock'] > 0){
                  echo '
                    <p align="right">
                      <input type="hidden" name="idUser" value="'.$_SESSION['idUser'].'">
                      <button type="submit" class="btn btn-info" style="margin-top:-25px">Masuk ke Troli</button>
                    </p>
                    </form>
                  ';
                }else{
                  echo '
                    <p align="right">
                      <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                    </p>
                  ';
                }
              }else{
                echo '
                  <p align="right">
                    <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                  </p>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
        }
       ?>
        <div class="clear"></div>
   </ul>
    </div>
    <!-- end of televisi -->

    <!-- laptop -->
      <div id="laptop" class="tab-pane fade">
       <ul>
      <?php 
        require("config/db.php");
        
        $queryLaptop = "SELECT * FROM tabel_produk WHERE kategori='laptop'";
        $query_laptop = mysqli_query($conn,$queryLaptop);

        while($arrayLaptop = mysqli_fetch_array($query_laptop)){
          echo '
            <li>
            <a href="#'.$arrayLaptop['idProduk'].'">
              <img src="admin/proses/'.$arrayLaptop['path'].'" alt="'.$arrayLaptop['nama'].'">
              <span></span>
            </a>
            <div class="overlay" id="'.$arrayLaptop['idProduk'].'">
              <a href="#" class="close"><i class="glyphicon glyphicon-remove"></i></a>
              <img src="admin/proses/'.$arrayLaptop['path'].'">
              <div class="keterangan">
                <div class="container">
                  <h4><strong>'.$arrayLaptop['nama'].'</strong></h4>
                  <p>'.$arrayLaptop['keterangan'].'</p>
                  <h5><font color="green">Rp. '.number_format($arrayLaptop['harga'], 0, ".", ".").',-</font></h5>
                  <p>Garansi  &nbsp;: '.$arrayLaptop['garansi'].'<br>
                    Tersedia : '.$arrayLaptop['stock'].' Unit <br><br>
                    <b>Jumlah &nbsp;&nbsp;:</b></p>
                    <div class="form-group">
                    <form action="proses/beli.php" method="post">
                      <input type="hidden" name="idProduk" value="'.$arrayLaptop['idProduk'].'">
                      <input type="hidden" name="harga" value="'.$arrayLaptop['harga'].'">
                      <input type="number" class="form-control" name="jumlah" value="1" min="1" max="'.$arrayLaptop['stock'].'" style="width:90px">
                    </div>
                      ';

              if(isset($_SESSION['idUser'])){
                if($arrayLaptop['stock'] > 0){
                  echo '
                    <p align="right">
                      <input type="hidden" name="idUser" value="'.$_SESSION['idUser'].'">
                      <button type="submit" class="btn btn-info" style="margin-top:-25px">Masuk ke Troli</button>
                    </p>
                    </form>
                ';
                }else{
                  echo '
                    <p align="right">
                      <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                    </p>
                  ';
                }
              }else{
                echo '
                  <p align="right">
                    <button type="button" class="btn btn-info disabled" style="margin-top:-25px">Masuk ke Troli</button>
                  </p>
                ';
              }
              echo '
            </div>
          </div>
        </div>
      </li>  
          ';
        }
       ?>
        <div class="clear"></div>
   </ul>

    </div>
    <!-- end of laptop -->

    
    </div>
    
  </div>
  <!-- kontent end of produkumum -->
</div>



<?php include('component/footer.php'); ?>


<script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="asset/js/script.js"></script>
</body>
</html>