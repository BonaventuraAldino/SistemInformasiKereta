<?php 
$conn = dbConnect();
$no = mysqli_query($conn, "SELECT final_kode FROM stasiun_akhir ORDER BY final_kode DESC");
$final_kode = mysqli_fetch_array($no);
$kode = $final_kode['final_kode'];

$urut = substr($kode,2,2);
$tambah = (int) $urut + 1;

if (strlen($tambah)==1) {
  $format = "ST"."0".$tambah;
} else {
  $format = "ST".$tambah;
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
            <h1>Tambah Stasiun Akhir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=addstasiunb">Home</a></li>
              <li class="breadcrumb-item active">Tambah Stasiun Akhir</li>
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
                <h3 class="card-title">Input <small>Data Stasiun Akhir</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                  	<label>Kode Stasiun</label>
                  	<input type="text" class="form-control" name="final_kode" value="<?php echo $format?>" readonly>
                  </div>
                  <div class="form-group">
                  	<label>Nama Stasiun</label>
                  	<input type="text" class="form-control" name="station_name" placeholder="Nama Stasiun">
                  </div>
                  <div class="form-group">
                  	<label>Alamat</label>
                  	<input type="text" class="form-control" name="address" placeholder="Alamat">
                  </div>                  
                  <div class="form-group">
                  	<label>Kota</label>
                  	<input type="text" class="form-control" name="city_name" placeholder="Kota">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_stasiunb" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=stasiunb" class="btn btn-danger">Kembali</a>
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
    if (isset($_POST["save_stasiunb"])) {
      $db=dbConnect();
      if ($db->connect_errno==0) {
        // Bersihkan Data
        $final_kode = $db->escape_string($_POST["final_kode"]);
        $station_name = $db->escape_string($_POST["station_name"]);
        $address      = $db->escape_string($_POST["address"]);  
        $city_name    = $db->escape_string($_POST["city_name"]);

      // Query Insert
      $sql="INSERT INTO stasiun_akhir (final_kode, station_name,  address, city_name)VALUES ('$final_kode','$station_name','$address','$city_name')";
      // Eksekusi Query
      $res=$db->query($sql);
      if ($res) {
        if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
          ?>
          <script>
            alert('Tambah Data Berhasil!');
            document.location.href = 'index.php?page=stasiunb';
          </script>
          <?php
          }
        } 
        else {
        ?> 
        <script>
          alert('Tambah Data Gagal !');
          document.location.href = 'index.php?page=addstasiunb';
        </script>
        <?php 
        }
      }  
      else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
    }
  ?>
