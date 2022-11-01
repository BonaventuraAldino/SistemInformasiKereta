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
              <li class="breadcrumb-item"><a href="index.php?page=stasiuna">Stasiun Awal</a></li>
              <li class="breadcrumb-item active">Hapus Stasiuan Awal</li>
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
                <h3 class="card-title">Hapus <small>Stasiun Awal</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["initial_kode"])){
                $db=dbConnect();
                $initial_kode=$db->escape_string($_GET["initial_kode"]);
                if($datastasiuna=getDataStasiunAwal($initial_kode))
                {//cari data stasiun awal, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Stasiun</label>
                    <input type="text" name="initial_kode" class="form-control" value="<?php echo $datastasiuna["initial_kode"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Stasiun</label>
                    <input type="text" name="station_name" class="form-control" value="<?php echo $datastasiuna["station_name"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $datastasiuna["address"];?>" readonly>
                  </div>                  
                  <!-- select -->
                  <div class="form-group">
                    <label>kota</label>
                    <input type="text" name="city_name" class="form-control" value="<?php echo $datastasiuna["city_name"];?>" readonly>  
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="delete_stasiuna" value="Delete" class="btn btn-primary">Hapus Data</button>
                  <a href="index.php?page=stasiuna" class="btn btn-primary"> Kembali </a>
                </div>
              </form>
              <?php
                }
              else
                echo "Stasiun dengan Kode : $initial_kode tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "Kode Stasiun tidak ada. Pengeditan dibatalkan.";
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
if (isset($_POST["delete_stasiuna"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $initial_kode = $db->escape_string($_POST["initial_kode"]);

    $sql = "DELETE FROM stasiun_awal
    WHERE initial_kode='$initial_kode'";
  //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Data Berhasil!');
          document.location.href = 'index.php?page=stasiuna';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Data Gagal !');
        document.location.href = 'index.php?page=deletestasiuna';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }

  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>

