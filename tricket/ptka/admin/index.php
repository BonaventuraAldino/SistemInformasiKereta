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
      include 'ptka/index.php';
      break;
      case 'admin':
      include 'admin.php';
      break;
      case 'account':
      include 'account.php';
      break;
      case 'detailaccount':
      include 'detail_account.php';
      break;
      case 'addaccount':
      include 'tambah_account.php';
      break;
      case 'updateaccount':
      include 'edit_account.php';
      break;
      case 'deleteaccount':
      include 'hapus_account.php';
      break;
      case 'kereta':
      include 'kereta.php';
      break;
      case 'detailkereta':
      include 'detail_kereta.php';
      break;
      case 'addkereta':
      include 'tambah_kereta.php';
      break;
      case 'updatekereta':
      include 'edit_kereta.php';
      break;
      case 'hapuskereta':
      include 'hapus_kereta.php';
      break;
      case 'pemesanan':
      include 'pemesanan.php';
      break;
      case 'detailpemesanan':
      include 'detail_pemesanan.php';
      break;
      case 'updatepemesanan':
      include 'edit_pemesanan.php';
      break;
      case 'deletepemesanan':
      include 'hapus_pemesanan.php';
      break;
      case 'addpemesanan':
      include 'tambah_pemesanan.php';
      break;
      case 'stasiuna':
      include 'stasiun_awal.php';
      break;
      case 'detailstasiuna':
      include 'detail_stasiuna.php';
      break;
      case 'addstasiuna':
      include 'tambah_stasiuna.php';
      break;
      case 'editstasiuna':
      include 'edit_stasiuna.php';
      break;
      case 'hapusstasiuna':
      include 'hapus_stasiuna.php';
      break;
      case 'stasiunb':
      include 'stasiun_akhir.php';
      break;
      case 'detailstasiunb':
      include 'detail_stasiunb.php';
      break;
      case 'addstasiunb':
      include 'tambah_stasiunb.php';
      break;
      case 'editstasiunb':
      include 'edit_stasiunb.php';
      break;
      case 'deletestasiunb':
      include 'hapus_stasiunb.php';
      break;
      case 'jadwal':
      include 'jadwal.php';
      break;
      case 'detailjadwal':
      include 'detail_jadwal.php';
      break;
      case 'addjadwal':
      include 'tambah_jadwal.php';
      break;
      case 'updatejadwal':
      include 'edit_jadwal.php';
      break;
      case 'deletejadwal':
      include 'hapus_jadwal.php';
      break;
      case 'logout':
      include 'ptka/logout.php';
      break;
      default:
      include 'index.php?page=admin';
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