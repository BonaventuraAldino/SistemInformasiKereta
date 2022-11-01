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
              <li class="breadcrumb-item"><a href="index.php?page=stasiuna">Account</a></li>
              <li class="breadcrumb-item active">Hapus Account</li>
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
                <h3 class="card-title">Hapus <small>Account</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["id_account"])){
                $db=dbConnect();
                $id_account=$db->escape_string($_GET["id_account"]);
                if($dataaccount=getDataAcc($id_account))
                {//cari data stasiun awal, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Stasiun</label>
                    <input type="text" name="id_account" class="form-control" value="<?php echo $dataaccount["id_account"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $dataaccount["username"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $dataaccount["password"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" value="<?php echo $dataaccount["type"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Lengkap</label>
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="delete_account" value="Delete" class="btn btn-danger">Hapus Data</button>
                  <a href="index.php?page=account" class="btn btn-primary"> Kembali </a>
                </div>
              </form>
              <?php
                }
              else
                echo "Account dengan ID : $id_account tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "ID Account tidak ada. Pengeditan dibatalkan.";
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
<?php 
if (isset($_POST["delete_account"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $id_account = $db->escape_string($_POST["id_account"]);

    $sql = "DELETE FROM account
    WHERE id_account='$id_account'";
  //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Account Berhasil!');
          document.location.href = 'index.php?page=account';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Account Gagal !');
        document.location.href = 'index.php?page=deleteaccount';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }

  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>

