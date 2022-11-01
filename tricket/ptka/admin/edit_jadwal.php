<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=jadwal">Jadwal</a></li>
              <li class="breadcrumb-item active">Edit Data Jadwal</li>
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
                <h3 class="card-title">Ubah <small>Data Jadwal</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["id_schedule"])){
                $db=dbConnect();
                $id_schedule=$db->escape_string($_GET["id_schedule"]);
                if($datajadwal=getDataSchedule($id_schedule)){// cari data stasiun awal, kalau ada simpan di $data   
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Stasiun</label>
                    <input input type="text" class="form-control" name="id_schedule" value="<?php echo $datajadwal["id_schedule"];?>" readonly>
                  </div>
                  <!-- select hari-->
                  <div class="form-group">
                    <label>Hari Keberangkatan</label>
                    <select name="hari" class="form-control">
                      <?php echo $datajadwal["hari"];?>
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                  </div>
                  <!-- select stasiun awal-->
                  <div class="form-group">
                    <label>Stasiun Keberangkatan</label>
                    <select name="initial_kode" class="form-control">
                      <option>--Pilih Stasiun Keberangkatan--</option>
                      <?php
                      $data=getInitial();
                      foreach($data as $data_stasiuna){
                        echo "<option value=\"".$data_stasiuna["initial_kode"]."\"
                        ".($data_stasiuna["initial_kode"]==$datajadwal["initial_kode"]?"selected":"").">".$data_stasiuna["station_name"]."</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                  <!-- select stasiun akhir-->
                  <div class="form-group">
                    <label>Stasiun Tujuan</label>
                    <select name="final_kode" class="form-control">
                      <option>--Pilih Stasiun Tujuan--</option>
                      <?php
                      $data=getFinal();
                      foreach($data as $data_stasiunb){
                        echo "<option value=\"".$data_stasiunb["final_kode"]."\"
                        ".($data_stasiunb["final_kode"]==$datajadwal["final_kode"]?"selected":"").">".$data_stasiunb["station_name"]."</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Waktu Keberangkatan</label>
                    <input type="text" class="form-control" name="departure_time" value="<?php echo $datajadwal["departure_time"];?>">
                  </div>
                  <div class="form-group">
                    <label>Waktu Tiba</label>
                    <input type="text" class="form-control" name="arrival_time" value="<?php echo $datajadwal["arrival_time"];?>">
                  </div>
                  <!-- select kereta-->
                  <!-- pada kereta telah tersedia kelas dan harga-->
                  <div class="form-group">
                    <label>Kereta</label>
                    <select name="train_kode" class="form-control">
                      <option>--Pilih Kereta--</option>
                      <?php
                      $data=getTrain();
                      foreach($data as $data_kereta){
                        echo "<option value=\"".$data_kereta["train_kode"]."\"
                        ".($data_kereta["train_kode"]==$datajadwal["train_kode"]?"selected":"").">".$data_kereta["train_name"]."</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_jadwal" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=jadwal" class="btn btn-danger">Keluar</a>
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
</body>
<?php
if(isset($_POST["update_jadwal"])){
  $db=dbConnect();
  if($db->connect_errno==0){
    // Bersihkan data
        $id_schedule    = $db->escape_string($_POST["id_schedule"]);
        $hari           = $db->escape_string($_POST["hari"]);
        $initial_kode   = $db->escape_string($_POST["initial_kode"]);
        $final_kode     = $db->escape_string($_POST["final_kode"]);
        $departure_time = $db->escape_string($_POST["departure_time"]);
        $arrival_time   = $db->escape_string($_POST["arrival_time"]);
        $train_kode     = $db->escape_string($_POST["train_kode"]);

    // Susun query update
    $sql="UPDATE jadwal SET 
        id_schedule='$id_schedule', hari='$hari', initial_kode='$initial_kode', final_kode='$final_kode',
        departure_time='$departure_time', arrival_time='$arrival_time', train_kode='$train_kode' WHERE id_schedule='$id_schedule'";

    // Eksekusi query update
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){ // jika ada update data
        ?>
        <script>
          alert('Data berhasil diupdate!');
          document.location.href = 'index.php?page=jadwal';
        </script>
        <?php
      }
      else{ // Jika sql sukses tapi tidak ada data yang berubah
        ?>
        <script>
          alert('Data Berhasil diupdate tapi tidak ada perubahan!');
          document.location.href = 'index.php?page=jadwal';
        </script>
        <?php
      }
    }
    else{ // gagal query
      ?>
      <script>
        alert('Data Gagal diupdate!');
        document.location.href = 'index.php?page=updatejadwal';
      </script>
      <?php
    }
  }
  else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
