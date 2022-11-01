<?php 
$conn = dbConnect();
$no = mysqli_query($conn, "SELECT train_kode FROM kereta ORDER BY train_kode DESC");
$train_kode = mysqli_fetch_array($no);
$kode = $train_kode['train_kode'];

$urut = substr($kode,3,2);
$tambah = (int) $urut + 1;

if (strlen($tambah)==1) {
	$format = "TRT"."0".$tambah;
} else {
	$format = "TRT".$tambah;
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
            <h1>Tambah Kereta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <h3 class="card-title">Input <small>Data Kereta</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                  	<label>Kode Kereta</label>
                  	<input type="text" name="train_kode" class="form-control" value="<?php echo $format ?>" readonly>
                  </div>
                  <div class="form-group">
                  	<label>Nama Kereta</label>
                  	<input type="text" class="form-control" name="train_name" placeholder="Nama Kereta">
                  </div>
                  <div class="form-group">
                  	<label>Jumlah Gerbong</label>
                  	<input type="text" class="form-control" name="carriages_number" placeholder="Jumlah Gerbong">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_train" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href= "index.php?page=kereta" type="submit" name="keluar" value="Simpan" class="btn btn-danger">Keluar</a>
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
 if (isset($_POST["save_train"])) {
 	$db=dbConnect();
 	if ($db->connect_errno==0) {
				// Bersihkan Data
 		$train_kode       = $db->escape_string($_POST["train_kode"]);
 		$train_name       = $db->escape_string($_POST["train_name"]);
 		$carriages_number = $db->escape_string($_POST["carriages_number"]);

			// Query Insert
 		$sql="INSERT INTO kereta (train_kode,train_name,carriages_number)VALUES ('$train_kode','$train_name','$carriages_number')";
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
