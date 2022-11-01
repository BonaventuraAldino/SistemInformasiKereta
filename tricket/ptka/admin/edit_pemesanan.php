<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Pemesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=pemesanan">Pemesanan</a></li>
              <li class="breadcrumb-item active">Edit Data Pemesanan</li>
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
                <h3 class="card-title">Ubah <small>Data Pemesanan</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["order_number"])){
                $db=dbConnect();
                $order_number=$db->escape_string($_GET["order_number"]);
                if($datapemesanan=getDataPemesanan($order_number)){// cari data stasiun awal, kalau ada simpan di $data   
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Pemesanan</label>
                    <input input type="text" class="form-control" name="order_number" value="<?php echo $datapemesanan["order_number"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemesanan</label>
                    <input type="date" class="form-control" name="order_date" value="<?php echo $datapemesanan["order_date"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['nama'];?>" readonly>
                    <input type="hidden" class="form-control" name="id_account" value="<?php echo $datapemesanan["id_account"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jadwal Keberangkatan</label>
                    <select name="id_schedule" class="form-control">
                      <?php
                      $data=getJadwal();
                      foreach($data as $data_jadwal){
                        echo "<option value=\"".$data_jadwal["id_schedule"]."\"
                        ".($data_jadwal["id_schedule"]==$datapemesanan["id_schedule"]?"selected":"").">".$data_jadwal["hari"].", ".$data_jadwal["departure_time"]."-".$data_jadwal["arrival_time"]." </option>\n";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kode Pembayaran</label>
                    <input type="text" class="form-control" name="payment_code" value="<?php echo $datapemesanan["payment_code"];?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_pemesanan" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href= "index.php?page=pemesanan" type="submit" name="keluar" value="Simpan" class="btn btn-danger">Keluar</a>
                </div>
              </form>
              <?php
            }
            else
              echo "Pemesanan dengan Kode : $order_number tidak ada. Pengeditan dibatalkan";
            ?>
            <?php
          }
          else
            echo "Kode Pemesanan tidak ada. Pengeditan dibatalkan.";
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
if(isset($_POST["update_pemesanan"])){
  $db=dbConnect();
  if($db->connect_errno==0){
    // Bersihkan data
        $order_number  = $db->escape_string($_POST["order_number"]);
        $order_date    = $db->escape_string($_POST["order_date"]);
        $id_account    = $db->escape_string($_POST["id_account"]);
        $id_schedule   = $db->escape_string($_POST["id_schedule"]);
        $payment_code  = $db->escape_string($_POST["payment_code"]);

    // Susun query update
    $sql="UPDATE pemesanan SET 
        order_number='$order_number', order_date='$order_date', id_account='$id_account', id_schedule='$id_schedule', payment_code='$payment_code' WHERE order_number='$order_number'";

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
          document.location.href = 'index.php?page=pemesanan';
        </script>
        <?php
      }
    }
    else{ // gagal query
      ?>
      <script>
        alert('Data Gagal diupdate!');
        document.location.href = 'index.php?page=updatepemesanan';
      </script>
      <?php
    }
  }
  else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
