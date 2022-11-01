<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cek Pemesanan Tiket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
              <!-- /.card-header -->
              <div class="card-body">
                <?php $db = dbConnect();
                if ($db->connect_errno==0) {
                  $sql = "SELECT p.order_number, p.order_date, l.id_account, l.nama nama_customer, m.id_schedule, m.hari harih, m.departure_time waktu_berangkat, p.payment_code
                    FROM pemesanan p JOIN account l ON p.id_account=l.id_account
                    JOIN jadwal m ON p.id_schedule=m.id_schedule";
                  $res=$db->query($sql);
                  if ($res) {
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nomor Pesanan</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Nama Pemesan</th>
                          <th>Jadwal Keberangkatan</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                          ?>
                          <tr>
                            <td><?php echo $barisdata["order_number"];?></td>
                            <td><?php echo $barisdata["order_date"];?></td>
                            <td><?php echo $barisdata["nama_customer"];?></td>
                            <td><?php echo $barisdata["harih"];?>, <?php echo $barisdata["waktu_berangkat"];?></td>

                            <!--View Button-->
                            <td class="project-actions text-center">
                              <a class="btn btn-primary btn-sm" href="index.php?page=detailpemesanan&order_number=<?php echo $barisdata["order_number"];?>">
                                <i class="fas fa-folder"></i>
                                View
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nomor Pesanan</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Nama Pemesan</th>
                          <th>Jadwal Keberangkatan</th>
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