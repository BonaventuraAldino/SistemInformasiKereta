<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=pemesanan">Pemesanan</a></li>
              <li class="breadcrumb-item active">Hapus Data Pemesanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Hapus <small>Data Pemesanan</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["order_number"])){
                $db=dbConnect();
                $order_number=$db->escape_string($_GET["order_number"]);
                if($datapemesanan=getDataPemesanan($order_number))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nomor Pesanan</label>
                    <input type="text" name="order_number" class="form-control" value="<?php echo $datapemesanan["order_number"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemesanan</label>
                    <input type="text" name="order_date" class="form-control" value="<?php echo $datapemesanan["order_date"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['nama'];?>" readonly>
                    <input type="hidden" class="form-control" name="id_account" value="<?php echo $datapemesanan["id_account"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jadwal Keberangkatan</label>
                    <input type="text" class="form-control" value="<?php echo $datapemesanan["harih"];?>, <?php echo $datapemesanan["waktu_berangkat"];?>" readonly>
                    <input type="hidden" class="form-control" name="id_schedule" value="<?php echo $datapemesanan["id_schedule"];?>" readonly>
                  </div>
                  <input type="hidden" name="harga" class="form-control" value="<?php echo $datapemesanan["harga"];?>" readonly>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="delete_pemesanan" value="Delete" class="btn btn-danger">Hapus Pemesanan</button>
                  <a href="index.php?page=pemesanan" class="btn btn-primary"> Kembali </a>
                </div>
              </form>
              <?php
                }
                else
                echo "Pemesanan dengan Kode : $order_number tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "Kode Pemesanan tidak ada. Pengeditan dibatalkan.";
              ?>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
</body>
<?php 
if (isset($_POST["delete_pemesanan"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $order_number = $db->escape_string($_POST["order_number"]);

    $sql = "DELETE FROM pemesanan WHERE order_number='$order_number'";
    //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Pemesanan Berhasil!');
          document.location.href = 'index.php?page=pemesanan';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Pemesanan Gagal !');
        document.location.href = 'index.php?page=deletepemesanan';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }
  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>

