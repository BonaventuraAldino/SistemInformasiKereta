<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=account">Account</a></li>
              <li class="breadcrumb-item active">Data Account</li>
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
              <a class="btn btn-info float-righ" href="index.php?page=addaccount">
                <i class="fas fa-pencil-alt"></i>
                + Tambah Account
              </a>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                $db=dbConnect();
                if ($db->connect_errno==0) {
                  $sql = "SELECT * FROM account";
                  $res=$db->query($sql);
                  if ($res) {
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID Account</th>
                          <th>Username</th>
                          <th>Type</th>
                          <th>No. Telepon</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                          ?>
                          <tr>
                            <td><?php echo $barisdata["id_account"];?></td>
                            <td><?php echo $barisdata["username"];?></td>
                            <td><?php echo $barisdata["type"];?></td>
                            <td><?php echo $barisdata["phone_number"];?></td>

                            <!--View Button-->
                            <td class="project-actions text-center">
                              <a class="btn btn-primary btn-sm" href="index.php?page=detailaccount&id_account=<?php echo $barisdata["id_account"];?>">
                                <i class="fas fa-folder"></i>
                                View
                              </a>

                              <!--Edit Button-->
                              <a class="btn btn-info btn-sm" href="index.php?page=updateaccount&id_account=<?php echo $barisdata["id_account"];?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                              </a>

                              <!--Delete Button-->
                              <a class="btn btn-danger btn-sm" href="index.php?page=deleteaccount&id_account=<?php echo $barisdata["id_account"];?>">
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
                          <th>ID Account</th>
                          <th>Username</th>
                          <th>Type</th>
                          <th>No. Telepon</th>
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
</body>