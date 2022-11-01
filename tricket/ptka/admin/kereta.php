<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kereta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=kereta">Kereta</a></li>
              <li class="breadcrumb-item active">Data Kereta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <a class="btn btn-info float-righ" href="index.php?page=addkereta">
                <i class="fas fa-pencil-alt"></i>
                + Tambah Kereta
              </a>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                $db=dbConnect();
                if ($db->connect_errno==0) {
                  $sql = "SELECT * FROM kereta";
                  $res=$db->query($sql);
                  if ($res) {
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Kereta</th>
                          <th>Nama Kereta</th>
                          <th>Panjang Gerbong</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                          ?>
                          <tr>
                            <td><?php echo $barisdata["train_kode"];?></td>
                            <td><?php echo $barisdata["train_name"];?></td>
                            <td><?php echo $barisdata["carriages_number"];?></td>

                            <!--View Button-->
                            <td class="project-actions text-center">
                              <a class="btn btn-primary btn-sm" href="index.php?page=detailkereta&train_kode=<?php echo $barisdata["train_kode"];?>">
                                <i class="fas fa-folder"></i>
                                View
                              </a>

                              <!--Edit Button-->
                              <a class="btn btn-info btn-sm" href="index.php?page=updatekereta&train_kode=<?php echo $barisdata["train_kode"];?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                              </a>

                              <!--Delete Button-->
                              <a class="btn btn-danger btn-sm" href="index.php?page=hapuskereta&train_kode=<?php echo $barisdata["train_kode"];?>">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Kode Kereta</th>
                          <th>Nama Kereta</th>
                          <th>Panjang Gerbong</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </tfoot>
                    </table>
                    <?php
                    $res->free();
                  } else "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
                } else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
                ?>
              </div>
              </form>
              <!--Tabel-->
            </div>
          </div>
          <!-- /.card -->
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
if (isset($_POST["delete_train"])) {
  $db=dbConnect();
  if($db->connect_errno==0){
    $train_kode = $db->escape_string($_POST["train_kode"]);

    $sql = "DELETE FROM kereta WHERE train_kode='$train_kode'";
    //echo $sql;
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows > 0){
        ?>
        <script>
          alert('Hapus Data Berhasil!');
          document.location.href = 'index.php?page=kereta';
        </script>
        <?php
      }
    }else{
      ?>
      <script>
        alert('Hapus Data Gagal !');
        document.location.href = 'index.php?page=kereta';
      </script>
      <?php
      echo "Error Query : ".$db->error."</br>";
    }
  }else{
    echo "Error : ".$db->connect_error."</br>";
  }
}
?>

</body>
