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

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
  
      <?php
      	$tampilUser=mysqli_query($conn,"SELECT * FROM tabel_user WHERE idUser='$_SESSION[idUser]'");
        $user=mysqli_fetch_array($tampilUser);
        $tampilTransaksi = mysqli_query($conn, "SELECT * FROM tabel_transaksi WHERE idUser='$_SESSION[idUser]'");
        $transaksi=mysqli_fetch_array($tampilTransaksi);
        $kodeTransaksi=$transaksi['idTransaksi'];
      ?>
 

      <h3>Hi, <b><?=$user['namaUser']?></b> cek pembelianmu sekarang...</h3>
      <h5><i>Disini kamu bisa melakukan update profil, konfirmasi pembayaran, cek pengiriman serta konfirmasi penerimaan pesanan.</i></h5>
      <font size="2"><b>Data kamu</b></font>
      <table>
	      <tr>
	      	<td>&nbsp;&nbsp;&nbsp;</td>
	      	<td style="width:5vw"><font size="2">Email </font></td><td style="width:2vw"> : </td><td style="width:7vw"> <?=$user['email']?></td>
	      </tr>
	      <tr>
	      <td>&nbsp;&nbsp;&nbsp;</td>
	      	<td style="width:5vw"><font size="2">No. Hp. </font></td><td style="width:2vw"> : </td><td style="width:7vw"> <?=$user['telpon']?></td>
	      </tr>
	      <tr>
	      <td>&nbsp;&nbsp;&nbsp;</td>
	      	<td style="width:5vw"><font size="2">Alamat </font></td><td style="width:2vw"> : </td><td style="width:7vw"> <?=$user['alamat']?></td>
	      </tr>
      </table>
      <a href="dataUser.php">
         <img style="width:5.3vw; height:4.5vh;" src="asset/img/ed.png">
      </a>
      
      <hr>
      <!-- userLog -->
      <div class="col-xs-5 col-xs-offset-3" style="margin-left: 1vw;">
        <button class="btn btn-warning" id="btn-bayar" ><b>Konfirmasi Pembayaran</b></button>
        <div class="container" id="bayar">
           <div class="tab-content">
           <p align="justify" style="width:449px">Sebelum melakukan Konfirmasi Pembayaran pastikan kamu telah melakukan pembayaran dengan transfer ke rekening BCA 140-0-0-165473-4 an. AEC Official Store, setelah melakukan pembayaran upload bukti pembayaran dengan memasukkan Id Transaksi dan Foto Struk Pembayaran.</p>
            <form action="proses/konfirmasiPembayaran.php" method="post" role="form" style="padding-top: 10px" class="tab-pane fade in active" enctype="multipart/form-data">
                <div class="form-group">
	               	<label for="idTransaksi">ID Transaksi :</label>
               	 	<select id="idTransaksi" class="form-control" style="width:462px" name="idTransaksi">
               	 	<option value="">Pilih ID Transaksi</option>
		 				<?php 
			                $id = $_SESSION['idUser'];
			                $con = mysqli_connect('localhost', 'root', '', 'ae_center');
			                $queryORD = mysqli_query($con, "SELECT * FROM tabel_transaksi WHERE idUser='$id'");
			                while($arrayORD= mysqli_fetch_array($queryORD)){
				                if($arrayORD['status_pembayaran']=='Belum Lunas'){
				                 	echo'
										<option value='.$arrayORD['idTransaksi'].'>ODR'.$arrayORD['idTransaksi'].'</option>
	                 				';
	                 			}
                			}
            			?>		
					</select>
				</div>
             	<div class="form-group">
                	<label for="bukti_pembayaran">Bukti Pembayaran :</label>
                  	<input type="file" class="form-control" id="bukti_pembayaran" style="width:462px" name="bukti_pembayaran">
                  	<input type="hidden" name="status_pembayaran" value="Lunas">
                  	<input type="hidden" name="pengiriman" value="Segera Diproses">
                </div>
              <button type="submit" name="upload" class="btn btn-primary">Konfirmasi</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-xs-1 col-xs-offset-1" style="margin-left: 7vw;">

        <button class="btn btn-warning" id="btn-terima"><b>Konfirmasi Penerimaan</b></button>
        <div class="container" id="terima">
           <div class="tab-content">
              <form action="proses/konfirmasiPenerimaan.php" method="post" role="form" style="padding-top: 10px" class="tab-pane fade in active">
 				 <div class="form-group">
	               	<label for="idTransaksi">ID Transaksi :</label>
               	 	<select id="idTransaksi" class="form-control" style="width:462px" name="idTransaksi">
               	 	<option value="">Pilih ID Transaksi</option>
		 				<?php 
			                $id = $_SESSION['idUser'];
			                $con = mysqli_connect('localhost', 'root', '', 'ae_center');
			                $queryORD = mysqli_query($con, "SELECT * FROM tabel_transaksi WHERE idUser='$id'");
			                while($arrayORD= mysqli_fetch_array($queryORD)){
				                if($arrayORD['status_pengiriman']=='Sedang Dikirim'){
				                 	echo'
										<option value='.$arrayORD['idTransaksi'].'>ODR'.$arrayORD['idTransaksi'].'</option>
	                 				';
	                 			}
                			}
            			?>		
					</select>
				</div>
              <div class="form-group">
                <label for="penilaian">Penilaian :</label>
                <table>
                	<tr class="text-center">
               			<td style="width:9vw">
                			Sangat Puas
                			<input type="radio"  class="form-control" name="penilaian" value="Sangat Puas">
                		</td>
                		<td style="width:9vw">
                			Puas
                			<input type="radio"  class="form-control" name="penilaian" value="Puas">
                		</td>
                		<td style="width:9vw">
                			Kurang Puas
                			<input type="radio"  class="form-control" name="penilaian" value="Kurang Puas">
                		</td>
                 		<td style="width:9vw">
                			Tidak Puas
                			<input type="radio"  class="form-control" name="penilaian" value="Tidak Puas">
                		</td>
                	</tr>
                </table>
              </div>
              <div class="form-group">
                	<label for="catatan">Catatan :</label>
                  	<input type="text" class="form-control" id="catatan" style="width:462px" name="catatan">
                  	<input type="hidden" name="status_penerimaan" value="Sudah Diterima">
                  	<input type="hidden" name="status_pengiriman" value="Sudah Sampai">
                </div>
              <button type="submit" class="btn btn-primary">Konfirmasi</button>
            </form>
          </div>
        </div>
      </div>
   </div>
 <!-- end of navbar -->

    <div class="container" id="produk">
      <hr>
      <div class="tab-content">
        <center>
          <table style="margin-left: 0.5vw;">
            <tr>
              <td class="text-center"><img style="width:21vw; height:14.3vh; padding-top:0px;" src="asset/img/ip1.png"></td>
              <td class="text-center"><img style="width:21vw; height:14.3vh; padding-top:0px;" src="asset/img/ip2.png"></td>
              <td class="text-center"><img style="width:21vw; height:14.3vh; padding-top:0px;" src="asset/img/ip3.png"></td>
              <td class="text-center"><img style="width:21vw; height:14.3vh; padding-top:0px;" src="asset/img/ip4.png"></td>
            </tr>
          </table>
        </center>

        

  	         <?php 
                $idUser = $_SESSION['idUser'];
                $conn = mysqli_connect('localhost', 'root', '', 'ae_center');
                $queryPembelian = mysqli_query($conn, "SELECT * FROM tabel_transaksi WHERE idUser='$idUser'");

                $jumlah = mysqli_num_rows($queryPembelian);

                if($jumlah == 0){
                  echo '
                    <br>
                    <center>
                      <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belum Ada Transaksi</h4>
                      <p><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yuk belanja sekarang!</i></p>
                    </center>
                  ';
                }else{
                  echo'
                   <table class="table table-hover" style="margin-left: 0.5vw;">
                      <thead>
                        <tr>
                          <th colspan=2 width="5px" class="text-center">Pemesanan</th>
                          <th class="text-center">Pembayaran</th>
                          <th class="text-center">Pengiriman</th>
                          <th class="text-center">Penerimaan</th>
                        </tr>
                      </thead>
                      <tbody>
                  ';
              	
                while($arrayPembelian= mysqli_fetch_array($queryPembelian)){
			            echo '
  							        <tr>
                          <td class="text-left"" style="width:6vw">ORD'.$arrayPembelian['idTransaksi'].'</td>
                					<td class="nama-barang text-left" style="width:17vw">'.$arrayPembelian['daftarBarang'].'</td>';
  						
                          if ($arrayPembelian['total']>=5000000){
                            $diskon = $arrayPembelian['total'] - 20/100* $arrayPembelian['total'];
                            $showdiskon = 20/100* $arrayPembelian['total'];

                          	if ($arrayPembelian['status_pembayaran']=='Lunas'){

                          		echo'
                              	<td class="text-center" style="width:22vw"><font size="3" color="green"><b>'.$arrayPembelian['status_pembayaran'].'</b></font><br>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: &nbspRp.'.number_format($arrayPembelian['total'], 0, ".", ".").',-<br>Diskon (20%) : &nbsp;Rp.'.number_format($showdiskon, 0, ".", ".").',-<br>Pembayaran &nbsp;: &nbsp;<b>Rp.'.number_format($diskon, 0, ".", ".").',-</b><br>Tanggal &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:&nbsp&nbsp&nbsp&nbsp&nbsp;'.$arrayPembelian['tgl_pembayaran'].'<br>
                              		<a href=proses/images/'.$arrayPembelian['bukti_pembayaran'].' data-toggle="tooltip" data-placement="top" title="Cek Resi"><img style="width:9vw; height:5vh; padding-top:0px;" src="asset/img/bp.png"></a>
                              	</td>';
                          	}else{
	                          	echo'
	                              <td class="text-center" style="width:20vw"><font size="3" color="red"><b>'.$arrayPembelian['status_pembayaran'].'</b></font><br>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: &nbspRp.'.number_format($arrayPembelian['total'], 0, ".", ".").',-<br>Diskon (20%) : &nbsp;Rp.'.number_format($showdiskon, 0, ".", ".").',-<br>Pembayaran &nbsp;: &nbsp;<b>Rp.'.number_format($diskon, 0, ".", ".").',-</b></td>';
                          	}
                            
                          }else if ($arrayPembelian['status_pembayaran']=='Lunas'){
                            echo'
                              <td class="text-center" ><font size="3" color="green"><b>'.$arrayPembelian['status_pembayaran'].'</b></font><br>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: Rp.'.number_format($arrayPembelian['total'], 0, ".", ".").',-<br>Diskon &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;Rp.0,-<br>Pembayaran &nbsp;: <b>Rp.'.number_format($arrayPembelian['total'], 0, ".", ".").',-</b><br>Tanggal &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:&nbsp&nbsp&nbsp&nbsp&nbsp;'.$arrayPembelian['tgl_pembayaran'].'<br>
                             	  <a href=proses/images/'.$arrayPembelian['bukti_pembayaran'].' data-toggle="tooltip" data-placement="top" title="Cek Resi"><img style="width:9vw; height:5vh; padding-top:0px;" src="asset/img/bp.png"></a>
                              </td>';
                          }else{
                          	echo'
                              <td class="text-center" ><font size="3" color="red"><b>'.$arrayPembelian['status_pembayaran'].'</b></font><br>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: Rp.'.number_format($arrayPembelian['total'], 0, ".", ".").',-<br>Diskon &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;Rp.0,-<br>Pembayaran &nbsp;: <b>Rp.'.$arrayPembelian['total'].',-</b></td>';
                          }

                          if($arrayPembelian['status_pengiriman']=='Belum Diproses'){
                          	echo'
                          		<td class="text-center" style="width:20vw"><font size="3" color="red"><b>'.$arrayPembelian['status_pengiriman'].'</b></font><br>Segera lakukan pembayaran untuk pesananmu</td>
                          	';
                          }else if($arrayPembelian['status_pengiriman']=='Segera Diproses'){
                          	echo'
                          		<td class="text-center" style="width:20vw"><font size="3" color="blue"><b>'.$arrayPembelian['status_pengiriman'].'</b></font><br>Terma kasih telah melakukan pembayaran pengiriman pesananmu akan segera kami proses</td>
                          	';
                          }
                          else if ($arrayPembelian['status_pengiriman']=='Sedang Dikirim'){ 
                          	echo'
  		                  	<td class="text-center" style="width:20vw"><font size="3" color="#008b8b"><b>'.$arrayPembelian['status_pengiriman'].'</b></font><br>Pesananmu sedang dalam perjalanan menuju alamatmu di '.$user['alamat'].'<br>Kode Pengiriman : '.$arrayPembelian['kode_pengiriman'].'<br>Tanggal Pengiriman : '.$arrayPembelian['tgl_pengiriman'].'</td>';

                          }
                          else{
                          	echo'
  		                  	<td class="text-center" style="width:20vw"><font size="3" color="green"><b>'.$arrayPembelian['status_pengiriman'].'</b></font><br>Pesananmu telah sampai di '.$user['alamat'].'<br>Kode Pengiriman : '.$arrayPembelian['kode_pengiriman'].'<br>Tanggal Pengiriman : '.$arrayPembelian['tgl_pengiriman'].'</td>';

                          }
                         
                         if($arrayPembelian['status_penerimaan']=='Sudah Diterima'){
                         	echo'
  		                  		<td class="text-center" style="width:17vw"><font size="3" color="green"><b>'.$arrayPembelian['status_penerimaan'].'</b></font><br>Pesananmu telah diterima<br>Tanggal : '.$arrayPembelian['tgl_penerimaan'].'<br>Penilaian : '.$arrayPembelian['penilaian'].'</td>
  	                  		</tr>';
                         }else{
                         	echo'
	  		                  	<td class="text-center" style="width:17vw"><font size="3" color="red"><b>'.$arrayPembelian['status_penerimaan'].'</b></font><br>Harap tunggu, pesananmu sedang diproses, harap konfirmasi apabila pesanan sudah diterima</td>
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
</div>

<?php include('component/footer.php'); ?>

<script type="text/javascript" src="plugin/Javascript/jquery.min.js"></script>
<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="asset/js/script.js"></script>
</body>
</html>