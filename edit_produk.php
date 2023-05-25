<?php 
include "koneksi_db.php";
session_start();
    if($_SESSION['status_login']!=true){
        header('location: login.php');
        // echo '<script>window.location="login.php"</script>'; /* sama aja */
    }   
    $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0) {
      echo '<script>window.location="data_produk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Produk</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
</head>
<body>
    <!-- navbar Start -->
  <?php include "navbar.php"; ?>
    <!-- navbar Start -->
    <!-- Content Start -->
  <div class="section">
    <div class="container">
      <h3>Tambah Data Produk</h3>
      <div class="box_produk">
        <form action="" method="POST" enctype="multipart/form-data">
          <select name="kategori" id="" class="input_control" require>
            <option value="">--Pilih Kategori--</option>
            <?php 
              $kategori = mysqli_query($conn,"SELECT * FROM category ORDER BY id_category DESC");
              while ($r = mysqli_fetch_array($kategori)) {              
            ?>
            <option value="<?php echo $r['id_category'] ?>" <?php echo ($r['id_category']== $p->id_category)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
            <?php } ?>
          </select>
          <input type="text" name="nama" class="input_control" placeholder="Nama Produk" value="<?php echo $p->nama_produk ?>" required>
          <input type="text" name="harga" class="input_control" placeholder="Harga" value="<?php echo $p->harga ?>" required>

          <img src="images/<?php echo $p->foto_produk ?>" style="width: 200px;">
          <input type="hidden" name="foto" value="<?php echo $p->foto_produk ?>">
          <input type="file" name="gambar" class="input_control"  >
          <textarea name="deskripsi" placeholder="Deskripsi" ><?php echo $p->deskripsi?></textarea>
          <select name="status" class="input_control">
                <option value="">--Pilih Status--</option>
                <option value="1" <?php echo ($p->produk_status == 1)? 'selected':''; ?>>Aktif</option>
                <option value="0" <?php echo ($p->produk_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
          </select>
          <input type="submit" name="submit"  value="submit" class="btn-profil">
        </form>
        <?php 
          if(isset($_POST['submit'])){

          //data inputan dari form 
          $kategori   = $_POST['kategori'];
          $nama       = $_POST['nama'];
          $harga      = $_POST['harga'];
          $deskripsi  = $_POST['deskripsi'];
          $status     = $_POST['status'];
          $foto       = $_POST['foto'];

          // data gambar yang baru
          $filename   = $_FILES['gambar']['name'];
          $tmp_name   = $_FILES['gambar']['tmp_name'];

          $type1      = explode('.', $filename);
          $type2      = $type1[1]; 
            
          $newname    = 'produk'.time().'.'.$type2;

          // menampung data format file yang diizinkan
          $tipe_diizinkan = array('jpg','jpeg','png','jfif','bmp','gif','tiff','heif','raw','psd','svg','eps','pdf','indd','ai','JPG');

          // jika admin ganti gambar
          if($filename != ''){

              // validasi format file
              if(!in_array($type2, $tipe_diizinkan)){
                //jika format array  file tidak ada di dalam tipe diizinkan
                echo '<script>alert("Format file tidak diizinkan")</script>';

              }else{
                unlink('./images/'.$foto);
                move_uploaded_file($tmp_name, './images/'.$newname);
                $namagambar = $newname;

              }

          }else{
            // jika admin tidak ganti gambar
            $namagambar = $foto;

          }
          // query update data produk
          $update = mysqli_query($conn, "UPDATE produk SET
                                  id_category   = '".$kategori."',
                                  nama_produk   = '".$nama."',
                                  harga         = '".$harga."',
                                  deskripsi     = '".$deskripsi."',
                                  foto_produk   = '".$namagambar."',
                                  produk_status = '".$status."' 
                                  WHERE id_produk = '".$p->id_produk."' ");
          
                                  if ($update) {
                                    echo "<script>alert('Update Data berhasil');location.href='data_produk.php';</script>";
                                  }else{
                                    echo 'gagal update data'.mysqli_error($conn);
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
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>