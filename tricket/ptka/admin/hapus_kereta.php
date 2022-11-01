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
              <li class="breadcrumb-item"><a href="index.php?page=kereta">Kereta</a></li>
              <li class="breadcrumb-item active">Hapus Data Kereta</li>
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
                <h3 class="card-title">Hapus <small>Data Kereta</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["train_kode"])){
                $db=dbConnect();
                $train_kode=$db->escape_string($_GET["train_kode"]);
                if($datakereta=getDataKereta($train_kode))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Kereta</label>
                    <input type="text" name="train_kode" class="form-control" value="<?php echo $datakereta["train_kode"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Kereta</label>
                    <input type="text" class="form-control" name="train_name" value="<?php echo $datakereta["train_name"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jumlah Gerbong</label>
                    <input type="text" class="form-control" name="carriages_number" value="<?php echo $datakereta["carriages_number"];?>" readonly>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="delete_train" value="Delete" class="btn btn-danger"> Hapus </button>
                  <a href="index.php?page=kereta" class="btn btn-primary"> Kembali </a>
                </div>
              </form>
              <?php
                }
                else
                echo "Kereta dengan Kode : $train_kode tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "Kode Kereta tidak ada. Pengeditan dibatalkan.";
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
if (isset($_POST["delete_train"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $train_kode = $db->escape_string($_POST["train_kode"]);

    $sql = "DELETE FROM kereta WHERE train_kode='$train_kode'";
    //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Data Berhasil!');
          document.location.href = 'index.php?page=kereta';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Data Gagal !');
        document.location.href = 'index.php?page=kereta';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }
  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>

