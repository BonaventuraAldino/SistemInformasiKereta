<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal Kereta</h1>
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
                <?php
                $db=dbConnect();
                if ($db->connect_errno==0) {
                  $sql = "SELECT jadwal.id_schedule, jadwal.hari, stasiun_awal.station_name initial_station, stasiun_akhir.station_name final_station, jadwal.departure_time, jadwal.arrival_time, kereta.train_name 
                  FROM jadwal JOIN kereta ON jadwal.train_kode = kereta.train_kode 
                  JOIN stasiun_awal ON jadwal.initial_kode = stasiun_awal.initial_kode 
                  JOIN stasiun_akhir ON jadwal.final_kode = stasiun_akhir.final_kode";
                  $res=$db->query($sql);
                  if ($res) {
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Tiket</th>
                          <th>Waktu Berangkat</th>
                          <th>Stasiun Keberangkatan</th>
                          <th>Kereta</th>
                          <th class="project-actions text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                          ?>
                          <tr>
                            <td><?php echo $barisdata["id_schedule"];?></td>
                            <td><?php echo $barisdata["hari"];?> <?php echo $barisdata["departure_time"];?>-<?php echo $barisdata["arrival_time"];?></td>
                            <td><?php echo $barisdata["initial_station"];?> Ke <?php echo $barisdata["final_station"];?></td>
                            <td><?php echo $barisdata["train_name"];?></td>

                            <!--View Button-->
                            <td class="project-actions text-center">
                              <a class="btn btn-primary btn-sm" href="index.php?page=detailjadwal&id_schedule=<?php echo $barisdata["id_schedule"];?>">
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
                          <th>Kode Tiket</th>
                          <th>Waktu Berangkat</th>
                          <th>Stasiun Keberangkatan</th>
                          <th>Kereta</th>
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