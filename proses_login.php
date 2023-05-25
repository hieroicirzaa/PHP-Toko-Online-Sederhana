<?php 
      if(isset($_POST['submit'])){
          session_start();
          include 'koneksi_db.php';

          $user = mysqli_real_escape_string($conn, $_POST['user']) ;
          $pass = mysqli_real_escape_string($conn, $_POST['pass']) ;

          $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
          if(mysqli_num_rows($cek) > 0){
              $d = mysqli_fetch_object($cek);
              $_SESSION['status_login'] = true;
              $_SESSION['a_global'] = $d;
              $_SESSION['id'] = $d->id_admin;

              echo '<script>window.location="dashboard.php"</script>';
          }else{
             echo '<script>alert("Username atau password Anda salah!");location.href="login.php";</script>';
          }
      }
    ?>