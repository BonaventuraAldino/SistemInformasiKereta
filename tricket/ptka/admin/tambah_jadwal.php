<?php 
$conn = dbConnect();
$no = mysqli_query($conn, "SELECT id_schedule FROM jadwal ORDER BY id_schedule DESC");
$id_schedule = mysqli_fetch_array($no);
$kode = $id_schedule['id_schedule'];

$urut = substr($kode,3,3);
$tambah = (int) $urut + 1;

if (strlen($tambah)==1) {
  $format = "SC"."00".$tambah;
} elseif (strlen($tambah)==2) {
  $format = "SC"."0".$tambah;
} else {
  $format = "SC".$tambah;
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=jadwal">Jadwal</a></li>
              <li class="breadcrumb-item active">Tambah Kereta</li>
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
                <h3 class="card-title">Input <small>Data Jadwal</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                  	<label>Kode Kereta</label>
                  	<input type="text" class="form-control" name="id_schedule" value="<?php echo $format?>" readonly>
                  </div>
                  <!-- select hari-->
                  <div class="form-group">
                    <label>Hari Keberangkatan</label>
                    <select name="hari" class="form-control">
                      <option>--Pilih Hari--</option>
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
                  		<option>--Pilih Stasiun Keberangkatan--
                  			<?php
                        $data_stasiunawal=getInitial();
                        foreach ($data_stasiunawal as $data) {
                          echo "<option value=\"".$data["initial_kode"]."\">".$data["station_name"]."</option>";
                        }
                        ?>
                  		</option>
                  	</select>
                  </div>
                  <!-- select stasiun akhir-->
                  <div class="form-group">
                    <label>Stasiun Tujuan</label>
                    <select name="final_kode" class="form-control">
                      <option>--Pilih Stasiun Tujuan--
                        <?php
                        $data_stasiunakhir=getFinal();
                        foreach ($data_stasiunakhir as $data) {
                          echo "<option value=\"".$data["final_kode"]."\">".$data["station_name"]."</option>";
                        }
                        ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                  	<label>Waktu Keberangkatan</label>
                  	<input type="text" name="departure_time" class="form-control" placeholder="--:--:--" required>
                  </div>
                  <div class="form-group">
                    <label>Waktu Tiba</label>
                    <input type="text" name="arrival_time" class="form-control" placeholder="--:--:--" required>
                  </div>
                  <!-- select kereta-->
                  <!-- pada kereta telah tersedia kelas dan harga-->
                  <div class="form-group">
                    <label>Kereta</label>
                    <select name="train_kode" class="form-control">
                      <option>--Pilih Kereta--
                        <?php
                        $data_kereta=getTrain();
                        foreach ($data_kereta as $data) {
                          echo "<option value=\"".$data["train_kode"]."\">".$data["train_name"]."</option>";
                        }
                        ?>
                      </option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_jadwal" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=jadwal" type="submit" name="keluar" class="btn btn-danger">Keluar</a>
                </div>
              </form>
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
 <?php
    if (isset($_POST["save_jadwal"])) {
      $db=dbConnect();
      if ($db->connect_errno==0) {
        // Bersihkan Data
        $id_schedule    = $db->escape_string($_POST["id_schedule"]);
        $hari           = $db->escape_string($_POST["hari"]);
        $initial_kode   = $db->escape_string($_POST["initial_kode"]);
        $final_kode     = $db->escape_string($_POST["final_kode"]);
        $departure_time = $db->escape_string($_POST["departure_time"]);
        $arrival_time   = $db->escape_string($_POST["arrival_time"]);
        $train_kode     = $db->escape_string($_POST["train_kode"]); 

      // Query Insert
      $sql="INSERT INTO jadwal (id_schedule,hari,initial_kode,final_kode,departure_time,arrival_time,train_kode) VALUES ('$id_schedule','$hari','$initial_kode','$final_kode','$departure_time','$arrival_time','$train_kode')";
      // Eksekusi Query
      $res=$db->query($sql);
      if ($res) {
        if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
          ?>
          <script>
          alert('Data Jadwal Berhasil Ditambahkan!');
          document.location.href = 'index.php?page=jadwal';
        </script>
          <?php
          }
        } 
        else {
        ?> 
        <script>
          alert('Data Jadwal Gagal Ditambahkan!!');
          document.location.href = 'index.php?page=addjadwal';
        </script>
        <?php 
        }
      }  
      else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
    }
  ?>
 <?php
 if (isset($_POST["save_train"])) {
 	$db=dbConnect();
 	if ($db->connect_errno==0) {
				// Bersihkan Data
 		$train_kode       = $db->escape_string($_POST["train_kode"]);
 		$train_name       = $db->escape_string($_POST["train_name"]);
 		$carriages_number = $db->escape_string($_POST["carriages_number"]);
 		$id_class         = $db->escape_string($_POST["id_class"]);	
 		$harga            = $db->escape_string($_POST["harga"]);

			// Query Insert
 		$sql="INSERT INTO kereta (train_kode,train_name,carriages_number,id_class,harga)VALUES ('$train_kode','$train_name','$carriages_number','$id_class','$harga')";
			// Eksekusi Query
 		$res=$db->query($sql);
 		if ($res) {
 			if ($db->affected_rows>0) {
				// Jika Ada Penambahan Data
 				?>
 				echo "
 				<script>
 					alert('Tambah Data Berhasil!');
 					document.location.href = 'index.php?page=kereta';
 				</script>
 				";
 				<?php
 			}
 		} 
 		else {
 			?> 
 			echo "
 			<script>
 				alert('Tambah Data Gagal !');
 				document.location.href = 'index.php?page=kereta';
 			</script>
 			";
 			<?php 
 		}
 	}  
 	else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
 }
 ?>
</body>
