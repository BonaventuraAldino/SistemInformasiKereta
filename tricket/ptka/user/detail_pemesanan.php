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
              <li class="breadcrumb-item"><a href="index.php?page=pemesanan">Pemesanan</a></li>
              <li class="breadcrumb-item active">Detail Data Pemesanan</li>
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
                <h3 class="card-title">Detail <small>Pemesanan</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["order_number"])){
                $db=dbConnect();
                $order_number=$db->escape_string($_GET["order_number"]);
                if($datapemesanan=getDataPemesanan($order_number))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Pemesanan</label>
                    <input type="text" name="order_number" class="form-control" value="<?php echo $datapemesanan["order_number"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemesanan</label>
                    <input type="text" class="form-control" name="order_date" value="<?php echo $datapemesanan["order_date"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" class="form-control" name="nama_customer" value="<?php echo $datapemesanan["nama_customer"];?>" readonly>
                  </div>                  
                  <!-- select -->
                  <div class="form-group">
                    <label>Jadwal</label>
                        
                    <input type="text" class="form-control" name="waktu_berangkat" value="<?php echo $datapemesanan["waktu_berangkat"];?>" readonly>  
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="index.php?page=pemesanan" class="btn btn-primary">
                      Kembali
                    </a>
                </div>
              </form>
              <?php
                }
                else
                echo "Pemesanan dengan Kode : $order_number tidak ada.";
              ?>
              <?php
              }
              else
                echo "Pemesanan tidak ada.";
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
