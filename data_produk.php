<?php 
session_start();
include "koneksi_db.php";
    if($_SESSION['status_login']!=true){
        header('location: login.php');
        // echo '<script>window.location="login.php"</script>'; /* sama aja */
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>
<body>
    <!-- navbar Start -->
  <?php include "navbar.php"; ?>
    <!-- navbar Start -->
    <!-- Content Start -->
  <div class="section">
    <div class="container">
      <h3>Produk</h3>
      <div class="box">
        <p><a href="tambah_produk.php">Tambah Data</a></p>
        <table border="1" cellspacing="0" class="table">
          <thead style="text-align: center;">
            <tr>
              <th style="width: 60px;">No</th>
              <th>Kategori</th>
              <th>Nama Produk</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Foto Produk</th>
              <th>Produk Status</th>
              <th>Tanggal Pembuatan</th>
              <th style="width: 170px;">aksi</th>
            </tr>
          </thead>
          <tbody style="text-align: center;">
            <?php 
              $no = 1 ;
              $produk = mysqli_query($conn,"SELECT * FROM produk LEFT JOIN category USING (id_category) ORDER BY id_produk DESC");
              if(mysqli_num_rows($produk) > 0){              
              while($row = mysqli_fetch_array($produk)){
            ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $row['category_name'] ?></td>
              <td><?php echo $row['nama_produk'] ?></td>
              <td><?php echo $row['deskripsi'] ?></td>
              <td>Rp. <?php echo number_format($row['harga'])  ?></td>
              <td><a href="images/<?php echo $row['foto_produk'] ?>" target="_blank"> <img src="images/<?php echo $row['foto_produk'] ?>" style="width: 50px ;" > </a></td>
              <td><?php echo ($row['produk_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
              <td><?php echo $row['tanggal_pembuatan'] ?></td>
              <td>
                <a href="edit_produk.php?id= <?php echo $row['id_produk'] ?> "><b style="color: #FECD70 ;">Edit</b></a> || <a href="
                proses_hapus.php?idp= <?php echo $row['id_produk'] ?>" onclick="return confirm('yakin ingin hapus ?')"><b style="color: #D2001A;">Hapus</b></a>
              </td>
            </tr>
            <?php }}else{ ?>
                  <tr>
                    <td colspan="9">Tidak ada Data</td>
                  </tr>
            <?php } ?>
          </tbody>
        </table>
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