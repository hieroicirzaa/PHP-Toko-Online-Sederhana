<?php
error_reporting(0);
include 'koneksi_db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE id_admin = 1");
$a = mysqli_fetch_object($kontak);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <!-- navbar Start -->
  <header>
    <div class="container">
      <h1><a href="index.php">Toko Online</a></h1>
      <ul>
        <li><a href="produk.php">produk</a></li>
        <!-- <li><a href="logout.php">Keluar</a></li> -->
      </ul>
    </div>
  </header>
  <!-- navbar Start -->
  <!-- Search Start -->
  <div class="search">
    <div class="container">
      <form action="produk.php">
        <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
        <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
        <input type="submit" name="cari" value="Cari produk">
      </form>
    </div>

  </div>
  <!-- Search End -->

  <!-- Produk Start -->
  <div class="section">
    <div class="container">
      <h3>Produk</h3>
      <div class="box_pembeli">
        <?php
        if ($_GET['search'] != '' || $_GET['kat'] != '') {
          $where = "AND nama_produk LIKE '%" . $_GET['search'] . "%' AND id_category LIKE '%" . $_GET['kat'] . "%' ";
        }
        $produk = mysqli_query($conn, "SELECT * FROM produk WHERE produk_status = 1 $where ORDER BY id_produk DESC ");
        if (mysqli_num_rows($produk) > 0) {
          while ($p = mysqli_fetch_array($produk)) {
        ?>
            <a href="detail_produk.php?id=<?php echo $p['id_produk'] ?>">
              <div class="col-4">
                <img src="../tokoonline/images/<?php echo $p['foto_produk'] ?> ">
                <p class="nama"><?php echo substr($p['nama_produk'],  0,  30)  ?></p>
                <p class="harga">Rp. <?php echo number_format($p['harga'])  ?></p>
              </div>
            </a>
          <?php }
        } else { ?>
          <p>Produk tidak ada</p>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Produk Start -->
  <!-- Footer Start -->
  <div class="footer">
    <div class="container">
      <h4>Alamat</h4>
      <p><?php echo $a->admin_address ?></p>

      <h4>Email</h4>
      <p><?php echo $a->admin_email ?></p>

      <h4>No. Hp</h4>
      <p><?php echo $a->admin_telp ?></p>
      <small>Copyright &copy; Hieroic - Toko Online</small>
    </div>
  </div>

  <!-- Footer End -->
</body>

</html>