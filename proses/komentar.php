<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'ae_center');

  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $pesan = $_POST['pesan'];
  $query = mysqli_query($conn, " INSERT INTO tabel_komentar (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')");
  
  if($query){
    echo '
      <script>
        alert("Pesan berhasil terkirim");
        window.location = "../home.php"
      </script>
    ';
  }else{
    echo '
      <script>
        alert("Pesan tidak terkirim, harap coba kembali");
        window.location = "../home.php"
      </script>
    ';
  }
 ?>