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
              <h3 style="font-family: Candara; color:white"><strong>Kamu bisa update datamu disini</strong></h3>
            </tr>
          </thead>
          <tbody>

          <?php
            $tampilUser=mysqli_query($conn,"SELECT * FROM tabel_user WHERE idUser='$_SESSION[idUser]'");
            $user=mysqli_fetch_array($tampilUser);
            $tampilTransaksi = mysqli_query($conn, "SELECT * FROM tabel_transaksi WHERE idUser='$_SESSION[idUser]'");
            $transaksi=mysqli_fetch_array($tampilTransaksi);
            $kodeTransaksi=$transaksi['idTransaksi'];
          ?>

            <form action="proses/updateUser.php" method="post" role="form" style="padding-top: 10px">
              <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?=$user['namaUser']?>" required>
                <input type="hidden" name="id" value="<?=$user['idUser']?>">
              </div>
              <div class="form-group">
                <label for="noTelp">Nomor Telepon :</label>
                <input type="telp" class="form-control" id="noTelp" name="telpon" value="<?=$user['telpon']?>" required>
              </div>
              <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=$user['email']?>" required>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat :</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?=$user['alamat']?>" required>
              </div>
              <div class="form-group">
                <label for="pw">Password : <i>(Kosongkan apabila tidak akan diganti)</i></label>
                <input type="text" class="form-control" id="pw" name="pw">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <br><br><a href="pembelian.php" class="btn btn-danger"> &nbsp;Batal &nbsp;</a>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php include('component/footer.php'); ?>

<script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="asset/js/script.js"></script>
</body>
</html>