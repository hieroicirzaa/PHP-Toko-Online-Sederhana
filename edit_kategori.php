<?php 
include "koneksi_db.php";
session_start();
    if($_SESSION['status_login']!=true){
        header('location: login.php');
        // echo '<script>window.location="login.php"</script>'; /* sama aja */
    }   

    $kategori = mysqli_query($conn, "SELECT * FROM category WHERE id_category = '".$_GET['id']."'");
    if(mysqli_num_rows($kategori)==0){
        echo'<script>window.location="data_kategori.php"</script>';
    };
    $k  = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Kategori</title>
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
      <h3>Edit Data Kategori</h3>
      <div class="box">
        <form action="" method="POST">
          <input type="text" name="nama" id="" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->category_name ?>" required>
          <input type="submit" name="submit" id="" value="submit" class="btn-profil">
        </form>
        <?php 
          if(isset($_POST['submit'])){

            $nama = ucwords($_POST['nama']) ;

            $update = mysqli_query($conn, "UPDATE category SET 
                              category_name = '".$nama."'
                              WHERE id_category = '".$k->id_category."'");

            if($update){
              echo "<script>alert('Edit data ketegori berhasil');location.href='data_kategori.php';</script>";
            }else{
              echo 'gagal menambah data'.mysqli_error($conn);
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