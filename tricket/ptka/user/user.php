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
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!--Jumlah Data Pemesanan-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM pemesanan";
                  $data_pemesanan = mysqli_query($db,$sql);
                  $jumlah_pemesanan = mysqli_num_rows($data_pemesanan);
			?>
			<!--Jumlah Data Jadwal-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM jadwal";
                  $data_jadwal = mysqli_query($db,$sql);
                  $jumlah_jadwal = mysqli_num_rows($data_jadwal);
			?>
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- Small Box (Stat card) -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-maroon">
								<div class="inner">
									<h3>Pesan</h3>
									<p>Tiket</p>
								</div>
								<div class="icon">
									<i class="fas fa-shopping-cart"></i>
								</div>
								<a href="index.php?page=addpemesanan" class="small-box-footer">
									Lengkapi Data Pemesanan <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-olive">
								<div class="inner">
									<h3><?php echo $jumlah_pemesanan?></h3>
									<p>Pemesanan</p>
								</div>
								<div class="icon">
									<i class="fas fa-search"></i>
								</div>
								<a href="index.php?page=pemesanan" class="small-box-footer">
									Cek Pesanan <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-lightblue">
								<div class="inner">
									<h3><?php echo $jumlah_jadwal?></h3>
									<p>Jadwal</p>
								</div>
								<div class="icon">
									<i class="far fa-calendar-alt"></i>
								</div>
								<a href="index.php?page=jadwal" class="small-box-footer">
									Cek Jadwal <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!--<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
	<i class="fas fa-chevron-up"></i>
</a>-->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>

