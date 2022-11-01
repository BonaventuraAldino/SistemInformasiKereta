<?php
session_start();
  $timeout = 120; // setting timeout dalam menit
  $logout = "../../index.php"; // redirect halaman logout

  $timeout = $timeout * 60; // menit ke detik
  if(isset($_SESSION['start_session'])){
    $elapsed_time = time()-$_SESSION['start_session'];
    if($elapsed_time >= $timeout){
      session_destroy();
      echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
    }
}

$_SESSION['start_session']=time();

// Database config_ptka
include "../config.php";

$page = isset($_GET['page']) ? $_GET['page'] : null;

// Jika alamat URL == login
// Maka akan menampilkan halaman login
if ($page == "login"){
  include "../index.php";
}else {
  // Cek Login
  if($_SESSION['status']!="login"){
    header("Location:../index.php");
  } else { ?>
    <!--  Jika sudah login maka akan menampikan tempalte dan halaman sesuai alamat URL-->
    <!DOCTYPE html>
    <html>
    <?php include "layout/header.php";?>

    <body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
    <?php
    //Navbar
    include "layout/navbar.php";
    //Sidebar
    include "layout/sidebar.php";
    // Jquery
    include "layout/foot.php";
    ?>
    <!-- Content Wrapper. Contains page content -->
    <?php
    switch($page){
      case 'login':
      include '../index.php';
      break;
      case 'user':
      include 'user.php';
      break;
      case 'pemesanan':
      include 'pemesanan.php';
      break;
      case 'detailpemesanan':
      include 'detail_pemesanan.php';
      break;
      case 'addpemesanan':
      include 'tambah_pemesanan.php';
      break;
      case 'jadwal':
      include 'jadwal.php';
      break;
      case 'detailjadwal':
      include 'detail_jadwal.php';
      break;
      case 'logout':
      include '../logout.php';
      break;
      default:
      include 'index.php?page=user';
      break;
    }
    ?>
    <!-- Footer and Control Side Bar -->
    <?php
    include 'layout/footer.php';
    include 'layout/controlsidebar.php';
    ?>
    </div>
    </body>
    </html>
    <?php
    }
  }
?>