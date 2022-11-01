<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=updateaccount">Account</a></li>
              <li class="breadcrumb-item active">Edit Data Account</li>
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
                <h3 class="card-title">Ubah <small>Data Account</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["id_account"])){
                $db=dbConnect();
                $id_account=$db->escape_string($_GET["id_account"]);
                if($dataaccount=getDataAcc($id_account))
                {// cari data kereta, kalau ada simpan di $data
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>ID Account</label>
                    <input input type="text" class="form-control" name="id_account" value="<?php echo $dataaccount["id_account"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $dataaccount["username"];?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control">
                      <option><?php echo $dataaccount["type"];?></option>
                      <option value="user">user</option>
                      <option value="admin">admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $dataaccount["nama"];?>">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $dataaccount["address"];?>">
                  </div>
                  <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" class="form-control" name="phone_number" value="<?php echo $dataaccount["phone_number"];?>">
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <select name="gender" class="form-control">
                      <option><?php echo $dataaccount["gender"];?></option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_account" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=account" class="btn btn-danger">Kembali</a>
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
<?php
 if (isset($_POST["update_account"])) {
  $db=dbConnect();
  if ($db->connect_errno==0) {
    // Bersihkan Data   
    $id_account   = $db->escape_string($_POST["id_account"]);
    $username     = $db->escape_string($_POST["username"]);
    $password     = $db->escape_string($_POST["password"]);  
    $type         = $db->escape_string($_POST["type"]);
    $nama         = $db->escape_string($_POST["nama"]);
    $address      = $db->escape_string($_POST["address"]);
    $phone_number = $db->escape_string($_POST["phone_number"]);  
    $gender       = $db->escape_string($_POST["gender"]);
    $paswd_hash   = md5($password);
    // Query Update
    $sql="UPDATE account SET id_account='$id_account', username='$username',  password='$paswd_hash', type='$type', nama='$nama', address='$address', phone_number='$phone_number', gender='$gender' WHERE id_account='$id_account'";
    // Eksekusi Query
    $res=$db->query($sql);
    if ($res) {
      if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
        ?>
        <script>
          alert('Update Data Berhasil!');
          document.location.href = 'index.php?page=account';
        </script>
        <?php
      }
    } 
    else {
      ?> 
      <script>
        alert('Update Data Gagal !');
        document.location.href = 'index.php?page=updateaccount';
      </script>
      <?php 
    }
  }  
  else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
