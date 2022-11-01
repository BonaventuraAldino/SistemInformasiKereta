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
              <li class="breadcrumb-item"><a href="index.php?page=jadwal">Jadwal</a></li>
              <li class="breadcrumb-item active">Hapus Data Jadwal</li>
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
                <h3 class="card-title">Hapus <small>Data Jadwal</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["id_schedule"])){
                $db=dbConnect();
                $id_schedule=$db->escape_string($_GET["id_schedule"]);
                if($datajadwal=getDataSchedulea($id_schedule))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Jadwal</label>
                    <input type="text" class="form-control" name="id_schedule" value="<?php echo $datajadwal["id_schedule"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Hari Keberangkatan</label>
                    <input type="text" class="form-control" name="hari" value="<?php echo $datajadwal["hari"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Waktu Berangkat</label>
                    <input type="text" class="form-control" name="departure_time" value="<?php echo $datajadwal["departure_time"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Waktu Tiba</label>
                    <input type="text" class="form-control" name="arrival_time" value="<?php echo $datajadwal["arrival_time"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Stasiun Awal</label>
                    <input type="text" class="form-control" name="initial_kode" value="<?php echo $datajadwal["initial_kode"];?>" readonly>
                  </div>                  
                  <!-- select -->
                  <div class="form-group">
                    <label>Stasiun Tujuan</label>
                    <input type="text" class="form-control" name="final_kode" value="<?php echo $datajadwal["final_kode"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Kereta</label>
                    <input type="text" class="form-control" name="train_kode" value="<?php echo $datajadwal["train_kode"];?>" readonly>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="delete_jadwal" value="Delete" class="btn btn-danger">Hapus</button>
                  <a href="index.php?page=jadwal" class="btn btn-primary"> Kembali </a>
                </div>
              </form>
              <?php
                }
                else
                echo "Jadwal dengan Kode : $id_schedule tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "Kode Jadwal tidak ada. Pengeditan dibatalkan.";
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
if (isset($_POST["delete_jadwal"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $id_schedule = $db->escape_string($_POST["id_schedule"]);

    $sql = "DELETE FROM jadwal WHERE id_schedule='$id_schedule'";
    //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Data Berhasil!');
          document.location.href = 'index.php?page=jadwal';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Data Gagal !');
        document.location.href = 'index.php?page=deletejadwal';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }

  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>
