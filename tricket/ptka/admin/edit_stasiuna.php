<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Stasiun Awal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=editstasiuna">Stasiun Awal</a></li>
              <li class="breadcrumb-item active">Edit Data Stasiun Awal</li>
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
                <h3 class="card-title">Ubah <small>Data Stasiun Awal</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["initial_kode"])){
                $db=dbConnect();
                $initial_kode=$db->escape_string($_GET["initial_kode"]);
                if($datastasiunawal=getDataStasiunAwal($initial_kode)){// cari data stasiun awal, kalau ada simpan di $data   
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Stasiun</label>
                    <input input type="text" class="form-control" name="initial_kode" value="<?php echo $datastasiunawal["initial_kode"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Stasiun</label>
                    <input type="text" class="form-control" name="station_name" value="<?php echo $datastasiunawal["station_name"];?>">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $datastasiunawal["address"];?>">
                  </div>
                  <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" name="city_name" value="<?php echo $datastasiunawal["city_name"];?>">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_stasiuna" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=stasiuna" class="btn btn-danger">Kembali</a>
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
if(isset($_POST["update_stasiuna"])){
  $db=dbConnect();
  if($db->connect_errno==0){
    // Bersihkan data
        $initial_kode = $db->escape_string($_POST["initial_kode"]);
        $station_name = $db->escape_string($_POST["station_name"]);
        $address      = $db->escape_string($_POST["address"]);  
        $city_name    = $db->escape_string($_POST["city_name"]);
    // Susun query update
    $sql="UPDATE stasiun_awal SET 
        initial_kode='$initial_kode', station_name='$station_name', address='$address', 
        city_name='$city_name' WHERE initial_kode='$initial_kode'";

    // Eksekusi query update
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){ // jika ada update data
        ?>
        <script>
          alert('Data berhasil diupdate!');
          document.location.href = 'index.php?page=stasiuna';
        </script>
        <?php
      }
      else{ // Jika sql sukses tapi tidak ada data yang berubah
        ?>
        <script>
          alert('Data Berhasil diupdate tapi tidak ada perubahan!');
          document.location.href = 'index.php?page=stasiuna';
        </script>
        <?php
      }
    }
    else{ // gagal query
      ?>
      <script>
          alert('Data Gagal diupdate!');
          document.location.href = 'index.php?page=editstasiuna';
        </script>
      <?php
    }
  }
  else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
