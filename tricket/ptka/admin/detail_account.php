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
              <li class="breadcrumb-item"><a href="index.php?page=jadwal">Account</a></li>
              <li class="breadcrumb-item active">Detail Data Account</li>
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
                <h3 class="card-title">Detail <small>Data Account</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["id_account"])){
                $db=dbConnect();
                $id_account=$db->escape_string($_GET["id_account"]);
                if($dataaccount=getDataAcc($id_account))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>ID Account</label>
                    <input type="text" name="id_account" class="form-control" value="<?php echo $dataaccount["id_account"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $dataaccount["username"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" value="<?php echo $dataaccount["password"];?>" readonly>
                  </div>                  
                  <!-- select -->
                  <div class="form-group">
                    <label>Type</label>
                    <input type="text" class="form-control" name="type" value="<?php echo $dataaccount["type"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $dataaccount["nama"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $dataaccount["address"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="phone_number" class="form-control" value="<?php echo $dataaccount["phone_number"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="gender" class="form-control" value="<?php echo $dataaccount["gender"];?>" readonly>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="index.php?page=account" class="btn btn-primary">Kembali</a>
                </div>
              </form>
              <?php
                }
                else
                echo "Account dengan ID : $id_account tidak ada.";
              ?>
              <?php
              }
              else
                echo "ID Account tidak ada.";
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
