<?php 
$conn = dbConnect();
$no = mysqli_query($conn, "SELECT order_number FROM pemesanan ORDER BY order_number DESC");
$order_number = mysqli_fetch_array($no);
$kode = $order_number['order_number'];

$urut = substr($kode,3,3);
$tambah = (int) $urut + 1;

if (strlen($tambah)==1) {
  $format = "OR"."00".$tambah;
} elseif (strlen($tambah)==2) {
  $format = "OR"."0".$tambah;
} else {
  $format = "OR".$tambah;
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
            <h1>Tambah Pemesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=pemesanan">Pemesanan</a></li>
              <li class="breadcrumb-item active">Tambah Pemesanan</li>
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
                <h3 class="card-title">Input <small>Data Pemesanan</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="fname" onsubmit="return validateForm()">
                <div class="card-body">
                  <div class="form-group">
                  	<label>Kode Pemesanan</label>
                  	<input type="text" name="order_number" class="form-control" value="<?php echo $format ?>" readonly>
                  </div>
                  <div class="form-group">
                  	<label>Tanggal Pemesanan</label>
                  	<input type="date" class="form-control" name="order_date" value="<?php echo date("Y-m-d"); ?>" readonly>
                  </div>
                  <!-- select jadwal-->
                  <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['nama'];?>" readonly>
                    <input type="hidden" name="id_account" class="form-control" value="<?php echo $_SESSION['id_account'];?>" readonly>
                  </div>                 
                  <!-- select jadwal-->
                  <div class="form-group">
                  	<label>Jadwal Keberangkatan</label>
                  	<select name="id_schedule" class="form-control">
                  		<option value="0">--Pilih Jadwal--</option>
                  			<?php
                        $data_schedule=getJadwal();
                        foreach($data_schedule as $data){
                          echo "<option value=\"".$data["id_schedule"]."\">".$data["hari"]." ".$data["departure_time"]."-".$data["arrival_time"]."</option>";
                        }
                        ?>
                  	</select>
                  </div>
                  	<input type="hidden" name="payment_code" value="PY001"class="form-control" placeholder="Kode Pembayaran">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_pesanan" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href= "index.php?page=pemesanan" type="submit" name="keluar" value="Simpan" class="btn btn-danger">Keluar</a>
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
    if (isset($_POST["save_pesanan"])) {
      $db=dbConnect();
      if ($db->connect_errno==0) {
        // Bersihkan Data
        $order_number  = $db->escape_string($_POST["order_number"]);
        $order_date    = $db->escape_string($_POST["order_date"]);
        $id_account   = $db->escape_string($_POST["id_account"]);
        $id_schedule   = $db->escape_string($_POST["id_schedule"]);
        $payment_code  = $db->escape_string($_POST["payment_code"]);  

      // Query Insert
      $sql="INSERT INTO pemesanan (order_number,order_date,id_account,id_schedule,payment_code)VALUES ('$order_number','$order_date','$id_account','$id_schedule','$payment_code')";
      // Eksekusi Query
      $res=$db->query($sql);
      if ($res) {
        if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
          ?>
          echo "
          <script>
            alert('Tambah Pemesanan Berhasil!');
            document.location.href = 'index.php?page=pemesanan';
          </script>
          ";
          <?php
          }
        } 
        else {
        ?> 
        echo "
        <script>
          alert('Tambah Pemesanan Gagal !');
          document.location.href = 'index.php?page=addpemesanan';
        </script>
        ";
        <?php 
        }
      }  
      else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
    }
 ?>
  <script>
        function validateForm() {
            if (document.forms["fname"]["id_customer"].selectedIndex < 1) {
                alert("Pilih Customer");
                document.forms["fname"]["id_customer"].focus();
                return false;
            }
            if (document.forms["fname"]["id_schedule"].selectedIndex < 1) {
                alert("Pilih Jadwal");
                document.forms["fname"]["id_schedule"].focus();
                return false;
            }
            if (document.forms["fname"]["payment_code"].value == "") {
                alert("Kode Pembayaran Tidak Boleh Kosong");
                document.forms["fname"]["payment_code"].focus();
                return false;
            }
        }
    </script>
</body>