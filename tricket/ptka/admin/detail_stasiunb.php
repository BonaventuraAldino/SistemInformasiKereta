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
              <li class="breadcrumb-item"><a href="index.php?page=stasiunb">Stasiun Akhir</a></li>
              <li class="breadcrumb-item active">Detail Stasiuan Akhir</li>
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
                <h3 class="card-title">Detail <small>Stasiun Akhir</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["final_kode"])){
                $db=dbConnect();
                $final_kode=$db->escape_string($_GET["final_kode"]);
                if($datastasiunb=getDataStasiunAkhir($final_kode))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Stasiun</label>
                    <input type="text" class="form-control" value="<?php echo $datastasiunb["final_kode"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Stasiun</label>
                    <input type="text" class="form-control" value="<?php echo $datastasiunb["station_name"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="<?php echo $datastasiunb["address"];?>" readonly>
                  </div>                  
                  <!-- select -->
                  <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" value="<?php echo $datastasiunb["city_name"];?>" readonly>  
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="index.php?page=stasiunb" class="btn btn-primary">
                      Kembali
                    </a>
                </div>
              </form>
              <?php
                }
                else
                echo "Stasiun dengan Kode : $final_kode tidak ada. Pengeditan dibatalkan";
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
</body>
