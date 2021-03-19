<?php 
  session_start();
  if(!isset($_SESSION['idAdmin'])){
    header('location: index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin AEC Store</title>
  <link rel="stylesheet" type="text/css" href="../plugin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
  <link rel="shortcut icon" type="image/x-icon" href="../asset/img/Title.png">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-2" id="sideLeft">
      <center>
      <br>
      <br>
      <img src="../asset/img/Brand1.png" width="150">
      <h3 style="font-style:bold; color:white;">Administrator</h3>
      </center>
      <ul class="nav nav-pills nav-stacked" id="data">
        <li class="active"><a data-toggle="tab" href="#user" style="color:white;">User</a></li>
        <li><a data-toggle="tab" href="#barang" style="color:white;">Barang</a></li>
        <li><a data-toggle="tab" href="#transaksi" style="color:white;">Transaksi</a></li>
        <li><a data-toggle="tab" href="#pemrosesan" style="color:white;">Pemeroresan</a></li>
        <li><a data-toggle="tab" href="#komen" style="color:white;">Komentar</a></li>
        <li><a data-toggle="tab" href="#admin" style="color:white;">Admin</a></li>
        <li><a href="proses/logout.php">
          <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span>Logout</button></a>
        </li>
      </ul>
    </div>

    <div class="col-xs-10">
      <div class="tab-content">

        <!-- tabel user -->
        <div id="user" class="tab-pane fade in active">
          <div class="row">
            <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel User Pelanggan</strong></h3>  
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-user text-center">ID</th>
                      <th class="nama-user ">Nama</th>
                      <th class="telp-user ">Nomor Telp</th>
                      <th class="email-user ">Email</th>
                      <th class="alamat-user ">Alamat</th>
                      <th class="hapus "></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                      $queryUser = mysqli_query($conn, "SELECT * FROM tabel_user ORDER BY idUser ASC");
                      while($arrayUser = mysqli_fetch_array($queryUser)){
                        echo '
                          <tr>
                            <td class="id-user text-center">USR'.$arrayUser['idUser'].'</td>
                            <td class="nama-user ">'.$arrayUser['namaUser'].'</td>
                            <td class="telp-user ">'.$arrayUser['telpon'].'</td>
                            <td class="email-user text-justify">'.$arrayUser['email'].'</td>
                            <td class="alamat-user text-left">'.$arrayUser['alamat'].'</td>
                            <td class="hapus"><a href="proses/hapusUser.php?idUser='.$arrayUser['idUser'].'">
                              <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                            </a></td>
                          </tr>
                        ';
                      }

                     ?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- end of table user -->

         <!-- komentar -->
        <div id="komen" class="tab-pane fade">
          <div class="row">
            <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Pesan Saran</strong></h3>  
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-user text-center">No</th>
                      <th class="nama-user ">Nama</th>
                      <th class="email-user ">Email</th>
                      <th class="alamat-user ">Pesan</th>
                      <th class="hapus "></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                      $queryKomen = mysqli_query($conn, "SELECT * FROM tabel_komentar ORDER BY idKomen ASC");
                      $jumlahKomen = mysqli_num_rows($queryKomen); 
                      if($jumlahKomen == 0){
                          echo '
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50vw">Belum Ada Komentar</td>
                            <td></td>
                          </tr>
                        ';
                      }else{
                        while($arrayKomen = mysqli_fetch_array($queryKomen)){
                          echo '
                            <tr>
                              <td class="id-user text-center">'.$arrayKomen['idKomen'].'</td>
                              <td class="nama-user ">'.$arrayKomen['nama'].'</td>
                              <td class="email-user text-justify">'.$arrayKomen['email'].'</td>
                              <td class="alamat-user text-left">'.$arrayKomen['pesan'].'</td>
                              <td class="hapus"><a href="proses/hapusKomen.php?idKomen='.$arrayKomen['idKomen'].'">
                                <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                              </a></td>
                            </tr>
                          ';
                        }
                      }
                      

                     ?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- komentar -->

        <!-- tabel barang -->
        <div id="barang" class="tab-pane fade">
          <h3 class="table-title"><strong>Tabel Barang</strong></h3>
          <button type="button" class="btn btn-success" id="tambah-data-barang" data-toggle="modal" data-target="#form-barang">Add Barang</button>

          <!-- modal form-admin -->
              <div class="modal fade" id="form-barang" role="dialog">
                <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="margin-left:150px"><strong>Tambahkan Barang</strong></h4>
                  </div>
                  <div class="modal-body">
                      <form action="proses/tambahProduk.php" method="post" role="form" enctype="multipart/form-data">
                      
                      <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto Barang</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                      </div>
                      <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga">
                      </div>
                      <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                          <option value="Smartphone">Smartphone</option>
                          <option value="Televisi">Televisi</option>
                          <option value="Laptop">Laptop</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="garansi">Garansi</label>
                        <select class="form-control" id="garansi" name="garansi">
                          <option value="1 Tahun">1 Tahun</option>
                          <option value="2 Tahun">2 Tahun</option>
                          <option value="3 Tahun">3 Tahun</option>
                          <option value="Seumur Hidup">Seumur Hidup</option>
                          <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="stock">Stock Barang</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                      </div>
                      <div class="form-group">
                        <label for="pesan">Keterangan : </label>
                        <textarea class="form-control" name="keterangan" style="resize:vertical" ></textarea>
                      </div>
                      <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                      <button type="submit" name="upload" class="btn btn-primary">Tambahkan</button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end of modal -->
             

          <div class="container">
            <h4 class="draf-kategori">Kategori : </h4>
            <ul class="nav nav-pills" style="margin-left: 15vw;">
              <li class="item-kategori active"><a data-toggle="tab" href="#tabel-semua">Semua</a></li>
              <li class="item-kategori"><a data-toggle="tab" href="#tabel-smartphone">Smartphone</a></li>
              <li class="item-kategori"><a data-toggle="tab" href="#tabel-televisi">Televisi</a></li>              
              <li class="item-kategori"><a data-toggle="tab" href="#tabel-laptop">Laptop</a></li>
            </ul>
          </div>

            <div class="tab-content">

            <div id="tabel-semua" class="tab-pane fade in active">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID</th>
                          <th class="nama-barang text-left">Nama Barang</th>
                          <th class="keterangan-barang text-left">Keterangan</th>
                          <th class="harga-barang text-right">Harga</th>
                          <th class="garansi-barang text-center">Garansi</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar text-right">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                        $query = mysqli_query($conn, "SELECT idProduk, nama, keterangan, harga, garansi, stock, path FROM tabel_produk ");
                        while($array = mysqli_fetch_array($query)){
                          echo '
                            <tr>
                              <td class="id-barang text-center">ITM'.$array['idProduk'].'</td>
                              <td class="nama-barang text-left">'.$array['nama'].'</td>
                              <td class="keterangan-barang text-justify">'.$array['keterangan'].'</td>
                              <td class="harga-barang text-right">Rp.'.number_format($array['harga'], 0, ".", ".").',-</td>
                              <td class="garansi-barang text-center">'.$array['garansi'].'</td>
                              <td class="stock-barang text-center">'.$array['stock'].' Unit</td>
                              <td class="gambar" align=right><img src="proses/'.$array['path'].'" style="width: 8vw; height: 23vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal'.$array['idProduk'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                            ';
                            echo '
                             <!-- edit barang -->
                        <div class="modal fade" id="modal'.$array['idProduk'].'" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateProduk.php" method="post" role="form">
                                <input type="hidden" name="idProduk" value="'.$array['idProduk'].'">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <div id="tabel-smartphone" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                      <thead>
                        <tr>
                          <th class="id-barang text-center">ID</th>
                          <th class="nama-barang text-left">Nama Barang</th>
                          <th class="keterangan-barang text-left">Keterangan</th>
                          <th class="harga-barang text-right">Harga</th>
                          <th class="garansi-barang text-center">Garansi</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar text-right">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                        $kategori = 'smartphone';
                        $query = mysqli_query($conn, "SELECT idProduk, nama, keterangan, harga, garansi, stock, path FROM tabel_produk WHERE kategori='$kategori' ");
                        while($array = mysqli_fetch_array($query)){
                          echo '
                            <tr>
                              <td class="id-barang text-center">ITM'.$array['idProduk'].'</td>
                              <td class="nama-barang text-left">'.$array['nama'].'</td>
                              <td class="keterangan-barang text-justify">'.$array['keterangan'].'</td>
                              <td class="harga-barang text-right">Rp.'.number_format($array['harga'], 0, ".", ".").',-</td>
                              <td class="garansi-barang text-center">'.$array['garansi'].'</td>
                              <td class="stock-barang text-center">'.$array['stock'].' Unit</td>
                              <td class="gambar" align=right><img src="proses/'.$array['path'].'" style="width: 8vw; height: 23vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal'.$array['idProduk'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                            ';
                            echo '
                             <!-- edit barang -->
                        <div class="modal fade" id="modal'.$array['idProduk'].'" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateProduk.php" method="post" role="form">
                                <input type="hidden" name="idProduk" value="'.$array['idProduk'].'">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


              <div id="tabel-televisi" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                        <thead>
                        <tr>
                          <th class="id-barang text-center">ID</th>
                          <th class="nama-barang text-left">Nama Barang</th>
                          <th class="keterangan-barang text-left">Keterangan</th>
                          <th class="harga-barang text-right">Harga</th>
                          <th class="garansi-barang text-center">Garansi</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar text-right">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                        $kategori = 'televisi';
                        $query = mysqli_query($conn, "SELECT idProduk, nama, keterangan, harga, garansi, stock, path FROM tabel_produk WHERE kategori='$kategori' ");
                        while($array = mysqli_fetch_array($query)){
                          echo '
                             <tr>
                              <td class="id-barang text-center">ITM'.$array['idProduk'].'</td>
                              <td class="nama-barang text-left">'.$array['nama'].'</td>
                              <td class="keterangan-barang text-justify">'.$array['keterangan'].'</td>
                              <td class="harga-barang text-right">Rp.'.number_format($array['harga'], 0, ".", ".").',-</td>
                              <td class="garansi-barang text-center">'.$array['garansi'].'</td>
                              <td class="stock-barang text-center">'.$array['stock'].' Unit</td>
                              <td class="gambar" align=right><img src="proses/'.$array['path'].'" style="width: 8vw; height: 23vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal'.$array['idProduk'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                            ';
                            echo '
                             <!-- edit barang -->
                        <div class="modal fade" id="modal'.$array['idProduk'].'" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateProduk.php" method="post" role="form">
                                <input type="hidden" name="idProduk" value="'.$array['idProduk'].'">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div id="tabel-laptop" class="tab-pane fade">
                <div class="row">
                  <div class="col-xs-11 col-offset-xs-1">
                    <table class="table table-condensed" style="width:80vw">
                       <thead>
                        <tr>
                          <th class="id-barang text-center">ID</th>
                          <th class="nama-barang text-left">Nama Barang</th>
                          <th class="keterangan-barang text-left">Keterangan</th>
                          <th class="harga-barang text-right">Harga</th>
                          <th class="garansi-barang text-center">Garansi</th>
                          <th class="stock-barang text-center">Stock</th>
                          <th class="gambar text-right">Gambar Barang</th>
                          <th class="hapus"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                        $kategori = 'laptop';
                        $query = mysqli_query($conn, "SELECT idProduk, nama, keterangan, harga, garansi, stock, path FROM tabel_produk WHERE kategori='$kategori' ");
                        while($array = mysqli_fetch_array($query)){
                          echo '
                             <tr>
                              <td class="id-barang text-center">ITM'.$array['idProduk'].'</td>
                              <td class="nama-barang text-left">'.$array['nama'].'</td>
                              <td class="keterangan-barang text-justify">'.$array['keterangan'].'</td>
                              <td class="harga-barang text-right">Rp.'.number_format($array['harga'], 0, ".", ".").',-</td>
                              <td class="garansi-barang text-center">'.$array['garansi'].'</td>
                              <td class="stock-barang text-center">'.$array['stock'].' Unit</td>
                              <td class="gambar" align=right><img src="proses/'.$array['path'].'" style="width: 8vw; height: 23vh"></td>
                              <td class="hapus"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal'.$array['idProduk'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>
                            </tr>
                            ';
                            echo '
                             <!-- edit barang -->
                        <div class="modal fade" id="modal'.$array['idProduk'].'" role="dialog">
                          <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 style="margin-left:150px"><strong>Edit Barang</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="proses/updateProduk.php" method="post" role="form">
                                <input type="hidden" name="idProduk" value="'.$array['idProduk'].'">
                                <div class="form-group">
                                  <label for="harga">Harga (Jangan diisi apabila Harga tetap)</label>
                                  <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                                <div class="form-group">
                                  <label for="stock">Stock Barang (Jangan diisi apabila Stock tetap)</label>
                                  <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <button type="reset" data-dismiss="modal" class="btn btn-primary">Batal</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end of modal edit barang -->
                          ';
                        }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


            </div>
          </div>

        <!-- end of tabel barang -->

        <!-- tabel transaksi -->
                
        <div id="transaksi" class="tab-pane fade">
          <div class="row">
            <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Transaksi</strong></h3>  
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-transaksi text-center">ID</th>
                      <th class="nama-user text-center">Nama</th>
                      <th class="text-left" style="width:30vw">Detail Pesanan</th>
                      <th class="id-transaksi text-right">Total</th>
                      <th class="text-right">Diskon (20%)</th>
                      <th class="text-right">Pembayaran</th>
                      <th class="alamat-user text-center">Alamat</th>
                      <th class="id-transaksi text-center">Tanggal</th>
                      <th class="hapus text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                    $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_transaksi");

                    $jumlah = mysqli_num_rows($queryBarang);
                   
                    if($jumlah == 0){
                        echo '
                          <tr>
                            <td colspan="9" style="width: 50vw" align="center">Belum Ada Transaksi</td>
                          </tr>
                        ';
                    }else{
                        while($arrayBarang = mysqli_fetch_array($queryBarang)){
                          $nama_user = $arrayBarang['idUser'];
                          $queryUser = mysqli_query($conn, "SELECT namaUser, alamat FROM tabel_user WHERE idUser='$nama_user'");
                          $arrayUser = mysqli_fetch_array($queryUser);


                          echo '
                            <tr>
                            <td class="id-transaksi text-center">ODR'.$arrayBarang['idTransaksi'].'</td>
                            <td class="nama-user text-center">'.$arrayUser['namaUser'].'</td>
                            <td class="nama-barang text-left"" style="width:30vw">'.$arrayBarang['daftarBarang'].'</td>
                            <td class="id-transaksi text-right">Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-</td>';
                            
                          if ($arrayBarang['total']>=5000000){
                              $diskon = $arrayBarang['total'] - 20/100* $arrayBarang['total'];
                              $showdiskon = 20/100* $arrayBarang['total'];
                              echo'
                              <td class="id-transaksi text-right">Rp.'.number_format($showdiskon, 0, ".", ".").',-</td>

                              <td class="id-transaksi text-right">Rp.'.number_format($diskon, 0, ".", ".").',-</td>';
                            }
                            else{
                            echo '
                              <td class="id-transaksi text-right">Rp.0,-</td>
                              <td class="id-transaksi text-right">Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-</td>
                            ';
                          }

                            echo '<td class="alamat-user text-center">'.$arrayUser['alamat'].'</td>
                            <td class="id-transaksi text-center">'.$arrayBarang['tanggal'].'</td>
                            <td class="hapus"><a href="proses/hapusTransaksi.php?idTransaksi='.$arrayBarang['idTransaksi'].'"><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></a></td>
                          </tr>

                          ';
                      }
                    }
                    

                   ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <!-- end of tabel transaksi -->


 <!-- modal form-admin -->
              <div class="modal fade" id="form-pengiriman" role="dialog">
                <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="margin-left:150px"><strong>Proses Pengiriman Barang</strong></h4>
                  </div>
                  <div class="modal-body">
                      <form action="proses/kirimPesanan.php" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="idTransaksi">ID Transaksi :</label>
                          <select id="idTransaksi" class="form-control" name="idTransaksi">
                            <option value="">Pilih ID Transaksi</option>
                              <?php 
                                  $con = mysqli_connect('localhost', 'root', '', 'ae_center');
                                  $queryORD = mysqli_query($con, "SELECT * FROM tabel_transaksi");
                                  while($arrayORD= mysqli_fetch_array($queryORD)){
                                    if($arrayORD['status_pengiriman']=='Segera Diproses'){
                                      echo'
                                <option value='.$arrayORD['idTransaksi'].'>ODR'.$arrayORD['idTransaksi'].'</option>
                                      ';
                                    }
                                  }
                              ?>    
                          </select>
                        </div>
                      <div class="form-group">
                        <label for="kode_pengiriman">Kode Pengiriman :</label>
                        <input type="text" class="form-control" name="kode_pengiriman" id="kode_pengiriman">
                        <input type="hidden" name="status_pengiriman" value="Sedang Dikirim">
                      </div>
                      <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end of modal -->


<!-- tabel pemrosesan -->
                
        <div id="pemrosesan" class="tab-pane fade">
          <div class="row">
            <div class="col-xs-11 col-offset-xs-1">
                <h3 class="table-title"><strong>Tabel Pemerosesan</strong></h3>
                <button type="button" class="btn btn-success" id="tambah-data-barang" data-toggle="modal" data-target="#form-pengiriman">Proses Pengiriman</button>  
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="id-transaksi text-center" width="2px">ID</th>
                      <th class="nama-user text-center" width="5px">Nama</th>
                      <th class="text-left" width="25px">Detail Pesanan</th>
                      <th class="text-center" width="200px">Pembayaran</th>
                      <th class="alamat-user text-center" width="10px">Pengiriman</th>
                      <th class="alamat-user text-center" width="10px">Penerimaan</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                    $queryBarang = mysqli_query($conn, "SELECT * FROM tabel_transaksi");

                    $jumlah = mysqli_num_rows($queryBarang);
                   
                    if($jumlah == 0){
                        echo '
                          <tr>
                            <td colspan="6" style="width: 50vw" align="center">Belum Ada Transaksi</td>
                          </tr>
                        ';
                    }else{
                        while($arrayBarang = mysqli_fetch_array($queryBarang)){
                          $nama_user = $arrayBarang['idUser'];
                          $queryUser = mysqli_query($conn, "SELECT namaUser, alamat FROM tabel_user WHERE idUser='$nama_user'");
                          $arrayUser = mysqli_fetch_array($queryUser);


                          echo '
                            <tr>
                            <td class="id-transaksi text-center">ODR'.$arrayBarang['idTransaksi'].'</td>
                            <td class="nama-user text-center">'.$arrayUser['namaUser'].'</td>
                            <td class="nama-barang text-left">'.$arrayBarang['daftarBarang'].'<br>Tanggal : '.$arrayBarang['tanggal'].'</td>';
                            
                          if ($arrayBarang['total']>=5000000){
                              $diskon = $arrayBarang['total'] - 20/100* $arrayBarang['total'];
                              $showdiskon = 20/100* $arrayBarang['total'];
                              if ($arrayBarang['status_pembayaran']=='Lunas'){
                                echo'
                                <td class="id-transaksi text-center"><font size="4" color="green"><b>'.$arrayBarang['status_pembayaran'].'</b></font><br>Total : Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-<br>Diskon (20%) : Rp.'.number_format($showdiskon, 0, ".", ".").',-<br>Pembayaran : <b>Rp.'.number_format($diskon, 0, ".", ".").',-</b><br>Tanggal : '.$arrayBarang['tgl_pembayaran'].'<br>
                                  <a href=../proses/images/'.$arrayBarang['bukti_pembayaran'].'><img style="width:9vw; height:5vh; padding-top:0px;" src="../asset/img/bp.png"></a>
                                </td>';
                              }else{
                                echo'
                                <td class="id-transaksi text-center"><font size="4" color="red"><b>'.$arrayBarang['status_pembayaran'].'</b></font><br>Total : Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-<br>Diskon (20%) : Rp.'.number_format($showdiskon, 0, ".", ".").',-<br>Pembayaran : <b>Rp.'.number_format($diskon, 0, ".", ".").',-</b>
                                </td>';
                              }
                              
                          }
                          else if ($arrayBarang['status_pembayaran']=='Lunas'){
                            echo '
                              <td class="id-transaksi text-center"><font size="4" color="green"><b>'.$arrayBarang['status_pembayaran'].'</b></font><br>Total : Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-<br>Diskon : Rp.0,-<br>Pembayaran : <b>Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-</b><br>Tanggal : '.$arrayBarang['tgl_pembayaran'].'<br>
                                  <a href=../proses/images/'.$arrayBarang['bukti_pembayaran'].'><img style="width:9vw; height:5vh; padding-top:0px;" src="../asset/img/bp.png"></a>
                                </td>
                            ';
                          }else{
                            echo '
                              <td class="id-transaksi text-center"><font size="4" color="red"><b>'.$arrayBarang['status_pembayaran'].'</b></font><br>Total : Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-<br>Diskon : Rp.0,-<br>Pembayaran : <b>Rp.'.number_format($arrayBarang['total'], 0, ".", ".").',-</b>
                              </td>
                            ';

                          }
                          if($arrayBarang['status_pengiriman']=='Belum Diproses'){
                            echo '
                              <td class="text-center"><font size="4" color="red"><b>'.$arrayBarang['status_pengiriman'].'</b></font><br>User belum melakukan konfirmasi pembayaran, pesanan dapat dikirim apabila konfirmasi pembayaran telah diterima</td>
                            ';

                          }
                          else if ($arrayBarang['status_pengiriman']=='Segera Diproses'){
                            echo '
                              <td class="alamat-user text-center"><font size="4" color="blue"><b>'.$arrayBarang['status_pengiriman'].'</b></font><br>User telah melakukan konfirmasi pembayaran harap cek dan segera lakukan proses pengiriman ke '.$arrayUser['alamat'].'</td>
                            ';
                          }else if ($arrayBarang['status_pengiriman']=='Sedang Dikirim'){
                            echo '
                              <td class="alamat-user text-center"><font size="4" color="#008b8b"><b>'.$arrayBarang['status_pengiriman'].'</b></font><br>Pesanan sedang dalam perjalanan menuju '.$arrayUser['alamat'].'<br>Kode Pengiriman : '.$arrayBarang['kode_pengiriman'].'<br>Tanggal Pengiriman : '.$arrayBarang['tgl_pengiriman'].'</td>
                            ';
                          }else{
                            echo '
                              <td class="alamat-user text-center"><font size="4" color="green"><b>'.$arrayBarang['status_pengiriman'].'</b></font><br>Pesanan sudah sampai di '.$arrayUser['alamat'].'<br>Kode Pengiriman : '.$arrayBarang['kode_pengiriman'].'<br>Tanggal Pengiriman : '.$arrayBarang['tgl_pengiriman'].'</td>
                            ';
                          }
                          if($arrayBarang['status_penerimaan']=='Sudah Diterima'){
                            echo '
                              <td class="alamat-user text-center"><font size="4" color="green"><b>'.$arrayBarang['status_penerimaan'].'</b></font><br>Tanggal : '.$arrayBarang['tgl_penerimaan'].'<br>Penilaian : '.$arrayBarang['penilaian'].'<br><br><b><i>Catatan : '.$arrayBarang['catatan'].'</i></b></td>
                              </tr>
                            ';
                          }else{
                            echo '
                              <td class="alamat-user text-center"><font size="4" color="red"><b>'.$arrayBarang['status_penerimaan'].'</b></font><br>Pesanan belum diterima pastikan user telah melakukan konfirmasi pembayaran serta diproses pengirimannya</td>
                              </tr>
                            ';
                          }
                        }
                      }
                   ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <!-- end of tabel transaksi -->

      
        <div id="admin" class="tab-pane fade">
          <div class="row">
            <div class="col-xs-11 col-offset-xs-1">
              <h3 class="table-title"><strong>Tabel Admin</strong></h3>   
              <button type="button" class="btn btn-success" id="tambah-data-admin" data-toggle="modal" data-target="#form-admin">Add Admin</button>

              <!-- modal form-admin -->
              <div class="modal fade" id="form-admin" role="dialog">
                <div class="modal-content" style="width:40vw;margin-top:10vh; margin-left:30vw">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="margin-left:150px"><strong>Tambahkan Admin</strong></h4>
                  </div>
                  <div class="modal-body">
                    <form action="proses/tambahAdmin.php" method="post" role="form">
                      <div class="form-group">
                        <label for="id-admin">ID Admin</label>
                        <input type="text" class="form-control" id="id-admin" name="idadmin">
                      </div>
                      <div class="form-group">
                        <label for="nama-admin">Nama</label>
                        <input type="text" class="form-control" id="nama-admin" name="namaadmin">
                      </div>
                      <div class="form-group">
                        <label for="email-admin">Email</label>
                        <input type="email" class="form-control" id="email-admin" name="emailadmin">
                      </div>
                      <div class="form-group">
                        <label for="password-admin">Password</label>
                        <input type="password" class="form-control" id="password-admin" name="password">
                      </div>
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end of modal -->

              <table class="table table-hover" id="tabel-admin">
                <thead>
                  <tr>
                    <th class="id-transaksi text-center">ID Admin</th>
                    <th class="nama-user text-center">Nama</th>
                    <th class="email-user text-center">Email</th>
                    <th class="hapus text-center"></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                  $queryAdmin = mysqli_query($conn, "SELECT * FROM tabel_admin");
                  while($arrayAdmin = mysqli_fetch_array($queryAdmin)){
                    echo '
                      <tr>
                        <td class="id-transaksi text-center">ADM'.$arrayAdmin['idAdmin'].'</td>
                        <td class="nama-user text-center">'.$arrayAdmin['namaAdmin'].'</td>
                        <td class="email-user text-center">'.$arrayAdmin['email'].'</td>
                        <td class="hapus">
                          <a href="proses/hapusAdmin.php?idAdmin='.$arrayAdmin['idAdmin'].'">
                              <button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                          </a>
                          </td>
                      </tr> 
                    ';
                  }
                 ?>

                  
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>


  </div>
  <div class="box-up" onclick="topFunction()" id="myBtn">
    <div class="btn" >
      <span><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <!-- <span><i class="glyphicon glyphicon-chevron-up"></i></span> -->
  </div>

</div>
<script type="text/javascript" src="../plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="../plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
}

</script>
</body>
</html>