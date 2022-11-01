<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Stasiun Akhir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=stasiunb">Stasiun Akhir</a></li>
              <li class="breadcrumb-item active">Data Stasiun Akhir</li>
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
              <a class="btn btn-info float-righ" href="index.php?page=addstasiunb">
                <i class="fas fa-pencil-alt"></i>
                + Tambah Stasiun Akhir
              </a>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                $db=dbConnect();
                if ($db->connect_errno==0) {
                  $sql = "SELECT * FROM stasiun_akhir";
                  $res=$db->query($sql);
                  if ($res) {
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Stasiun</th>
                          <th>Nama Stasiun</th>
                          <th>Kota</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                          ?>
                          <tr>
                            <td><?php echo $barisdata["final_kode"];?></td>
                            <td><?php echo $barisdata["station_name"];?></td>
                            <td><?php echo $barisdata["city_name"];?></td>

                            <!--View Button-->
                            <td class="project-actions text-center">
                              <a class="btn btn-primary btn-sm" href="index.php?page=detailstasiunb&final_kode=<?php echo $barisdata["final_kode"];?>">
                                <i class="fas fa-folder"></i>
                                View
                              </a>

                              <!--Edit Button-->
                              <a class="btn btn-info btn-sm" href="index.php?page=editstasiunb&final_kode=<?php echo $barisdata["final_kode"];?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                              </a>

                              <!--Delete Button-->
                              <a class="btn btn-danger btn-sm" href="index.php?page=deletestasiunb&final_kode=<?php echo $barisdata["final_kode"];?>">
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
                          <th>Kode Stasiun</th>
                          <th>Nama Stasiun</th>
                          <th>Kota</th>
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