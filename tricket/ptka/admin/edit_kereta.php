<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Kereta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=kereta">Kereta</a></li>
              <li class="breadcrumb-item active">Edit Data Kereta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ubah <small>Data Kereta</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["train_kode"])){
                $db=dbConnect();
                $train_kode=$db->escape_string($_GET["train_kode"]);
                if($datakereta=getDataKereta($train_kode)){// cari data kereta, kalau ada simpan di $data
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Kereta</label>
                    <input input type="text" class="form-control" name="train_kode" value="<?php echo $datakereta["train_kode"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Kereta</label>
                    <input type="text" class="form-control" name="train_name" value="<?php echo $datakereta["train_name"];?>">
                  </div>
                  <div class="form-group">
                    <label>Jumlah Gerbong</label>
                    <input type="text" class="form-control" name="carriages_number" value="<?php echo $datakereta["carriages_number"];?>">
                  </div>                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_kereta" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=kereta" class="btn btn-danger">Keluar</a>
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
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php
if(isset($_POST["update_kereta"])){
  $db=dbConnect();
  if($db->connect_errno==0){
    // Bersihkan data
        $train_kode       = $db->escape_string($_POST["train_kode"]);
        $train_name       = $db->escape_string($_POST["train_name"]);
        $carriages_number = $db->escape_string($_POST["carriages_number"]);
    // Susun query update
    $sql="UPDATE kereta SET 
        train_kode='$train_kode', train_name='$train_name', carriages_number='$carriages_number' WHERE train_kode='$train_kode'";

    // Eksekusi query update
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){ //jika ada update data
        ?>
        echo "
        <script>
          alert('Data Berhasil Diubah!');
          document.location.href = 'index.php?page=kereta';
        </script>
        ";
        <?php
      }
      else{ // Jika sql sukses tapi tidak ada data yang berubah
        ?>
        echo "
        <script>
          alert('Data berhasil diupdate tetapi tanpa ada perubahan data!');
          document.location.href = 'index.php?page=kereta';
        </script>
        ";
        <?php
      }
    }
    else{ // gagal query
      ?>
      echo "
        <script>
          alert('Data Gagal diupdate!');
          document.location.href = 'index.php?page=kereta';
        </script>
        ";
        <?php
    }
  }
  else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
