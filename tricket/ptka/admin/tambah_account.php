<?php 
$conn = dbConnect();
$no = mysqli_query($conn, "SELECT id_account FROM account ORDER BY id_account DESC");
$account = mysqli_fetch_array($no);
$kode = $account['id_account'];

$urut = substr($kode,3,3);
$tambah = (int) $urut + 1;

if (strlen($tambah)==1) {
  $format = "AC"."00".$tambah;
} elseif (strlen($tambah)==2) {
  $format = "AC"."0".$tambah;
} else {
  $format = "AC".$tambah;
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
            <h1>Tambah Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=account">Account</a></li>
              <li class="breadcrumb-item active">Tambah Account</li>
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
                <h3 class="card-title">Input <small>Data Account</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                  	<label>ID Account</label>
                  	<input type="text" class="form-control" name="id_account" value="<?php echo $format?>" readonly>
                  </div>
                  <div class="form-group">
                  	<label>Username</label>
                  	<input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control">
                      <option>--Pilih Type--</option>
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                  	<label>Nama</label>
                  	<input type="text" class="form-control" name="nama" placeholder="Nama">
                  </div>                  
                  <div class="form-group">
                  	<label>Alamat</label>
                  	<input type="text" class="form-control" name="address" placeholder="Alamat">
                  </div>
                  <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" class="form-control" name="phone_number" placeholder="No. Telepon">
                  </div>                  
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="gender" class="form-control">
                      <option>--Pilih Jenis Kelamin--</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_account" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=account" class="btn btn-danger">Kembali</a>
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
 if (isset($_POST["save_account"])) {
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

    // Query Insert
    $sql="INSERT INTO account (id_account, username,  password, type, nama, address,  phone_number, gender) VALUES ('$id_account','$username','$paswd_hash','$type','$nama','$address','$phone_number','$gender')";
    // Eksekusi Query
    $res=$db->query($sql);
    if ($res) {
      if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
        ?>
        <script>
          alert('Tambah Data Berhasil!');
          document.location.href = 'index.php?page=account';
        </script>
        <?php
      }
    } 
    else {
      ?> 
      <script>
        alert('Tambah Data Gagal !');
        document.location.href = 'index.php?page=addaccount';
      </script>
      <?php 
    }
  }  
  else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>