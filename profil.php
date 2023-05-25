<?php 
include "koneksi_db.php";
session_start();
    if($_SESSION['status_login']!=true){
        header('location: login.php');
        // echo '<script>window.location="login.php"</script>'; /* sama aja */
    }   
$query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE id_admin = '".$_SESSION['id']."'");
$d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <!-- navbar Start -->
  <?php include "navbar.php"; ?>
    <!-- navbar Start -->
    <!-- Content Start -->
  <div class="section">
    <div class="container">
      <h3>Profil</h3>
      <div class="box">
        <form action="" method="POST">
          <input type="text" name="nama" id="" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d ->admin_name ?>" required>
          <input type="text" name="user" id="" placeholder="Username" class="input-control" value="<?php echo $d ->username ?>" required>
          <input type="text" name="hp" id="" placeholder="Nomer Handphone" class="input-control" value="<?php echo $d ->admin_telp ?>" required>
          <input type="email" name="email" id="" placeholder="Email" class="input-control" value="<?php echo $d ->admin_email ?>" required>
          <input type="text" name="alamat" id="" placeholder="Alamat" class="input-control" value="<?php echo $d ->admin_address ?>" required>
          <input type="date" name="date_lahir" id="" placeholder="Tanggal Lahir" class="input-control" value="<?php echo $d ->admin_tanggal_lahir ?>" required>
          <input type="submit" name="submit" id="" value="Ubah Profil" class="btn-profil">
        </form>
        <?php 
          if(isset($_POST['submit'])){

            $nama         = ucwords($_POST['nama']);
            $user         = $_POST['user'];
            $hp           = $_POST['hp'];
            $email        = $_POST['email'];
            $alamat       = ucwords($_POST['alamat']);
            $date_lahir   = $_POST['date_lahir'];

            $update       = mysqli_query($conn, "UPDATE tb_admin SET
                                  admin_name = '".$nama."', 
                                  username = '".$user."', 
                                  admin_telp = '".$hp."', 
                                  admin_email = '".$email."', 
                                  admin_address = '".$alamat."', 
                                  admin_tanggal_lahir = '".$date_lahir."'
                                  WHERE id_admin = '".$d->id_admin."'");
            if($update){
              echo "<script>alert('Ubah data berhasil');location.href='profil.php';</script>";
            }else{
              echo 'Gagal Update'.mysqli_error($conn);
            }

          }
        ?>
    </div>
    <h3>Ubah Password</h3>
      <div class="box">
        <form action="" method="POST">
          <input type="password" name="pass1" id="" placeholder="Password Baru" class="input-control" required>
          <input type="password" name="pass2" id="" placeholder="Konfirmasi Password Baru" class="input-control" required>
          <input type="submit" name="ubah_password" id="" value="Ubah Password" class="btn-profil">
        </form>
        <?php 
          if(isset($_POST['ubah_password'])){

            $pass1         = $_POST['pass1'];
            $pass2         = $_POST['pass2'];

            if($pass2 != $pass1){
              echo "<script>alert('Konfirmasi Password Baru tidak sesuai');location.href='profil.php';</script>";
            }else{
              $update_password       = mysqli_query($conn, "UPDATE tb_admin SET                                  
                                  password = '".MD5($pass1)."' 
                                  WHERE id_admin = '".$d->id_admin."'");
              if($update_password ){
              echo "<script>alert('Ubah Password berhasil');location.href='profil.php';</script>";
              }else{
                echo 'Gagal Update'.mysqli_error($conn);
              }
              }
            }   
            
        ?>
    </div>

    </div>
  </div>    
    <!-- Content End -->
    <!-- Footer Start -->
    <?php include "footer.php"; ?>
    <!-- Footer End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>