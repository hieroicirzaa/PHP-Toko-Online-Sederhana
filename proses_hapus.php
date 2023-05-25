<?php 

  include 'koneksi_db.php';

  if(isset($_GET['idk'])){
      $delete = mysqli_query($conn,"DELETE FROM category WHERE id_category = '".$_GET['idk']."' ");
      echo'<script>window.location="data_kategori.php"</script>';
  }

  if(isset($_GET['idp'])){
    $produk = mysqli_query($conn, "SELECT foto_produk FROM produk WHERE id_produk = '".$_GET['idp']."' ");
    $p = mysqli_fetch_object($produk);

    unlink('./images/'.$p->foto_produk);

    $delete = mysqli_query($conn,"DELETE FROM produk WHERE id_produk = '".$_GET['idp']."' ");
    echo'<script>window.location="data_produk.php"</script>';
  }
?>