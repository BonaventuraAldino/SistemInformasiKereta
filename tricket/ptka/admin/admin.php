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

			<!--Jumlah Data Account-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM account";
                  $data_account = mysqli_query($db,$sql);
                  $jumlah_account = mysqli_num_rows($data_account);
			?>

			<!--Jumlah Data Pemesanan-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM pemesanan";
                  $data_pemesanan = mysqli_query($db,$sql);
                  $jumlah_pemesanan = mysqli_num_rows($data_pemesanan);
			?>

			<!--Jumlah Data Kereta-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM kereta";
                  $data_kereta = mysqli_query($db,$sql);
                  $jumlah_kereta = mysqli_num_rows($data_kereta);
			?>

			<!--Jumlah Data Jadwal-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM jadwal";
                  $data_jadwal = mysqli_query($db,$sql);
                  $jumlah_jadwal = mysqli_num_rows($data_jadwal);
			?>

			<!--Jumlah Data Stasiun Awal-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM stasiun_awal";
                  $data_stasiuna = mysqli_query($db,$sql);
                  $jumlah_stasiuna = mysqli_num_rows($data_stasiuna);
			?>

			<!--Jumlah Data Stasiun Akhir-->
			<?php
				$db=dbConnect();
                  $sql = "SELECT * FROM stasiun_akhir";
                  $data_stasiunb = mysqli_query($db,$sql);
                  $jumlah_stasiunb = mysqli_num_rows($data_stasiunb);
			?>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- Small Box (Stat card) -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-danger">
								<div class="inner">
									<h3><?php echo $jumlah_account?></h3>
									<p>Account</p>
								</div>
								<div class="icon">
									<i class="fas fa-address-book"></i>
								</div>
								<a href="index.php?page=account" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-primary">
								<div class="inner">
									<h3><?php echo $jumlah_pemesanan?></h3>
									<p>Pemesanan</p>
								</div>
								<div class="icon">
									<i class="fas fa-shopping-cart"></i>
								</div>
								<a href="index.php?page=pemesanan" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-secondary">
								<div class="inner">
									<h3><?php echo $jumlah_kereta?></h3>

									<p>Kereta</p>
								</div>
								<div class="icon">
									<i class="fas fa-train"></i>
								</div>
								<a href="index.php?page=kereta" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3><?php echo $jumlah_jadwal?></h3>
									<p>Jadwal</p>
								</div>
								<div class="icon">
									<i class="far fa-calendar-alt"></i>
								</div>
								<a href="index.php?page=jadwal" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3><?php echo $jumlah_stasiuna?></h3>
									<p>Stasiun Awal</p>
								</div>
								<div class="icon">
									<i class="fas fa-hourglass-start"></i>
								</div>
								<a href="index.php?page=stasiuna" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small card -->
							<div class="small-box bg-warning">
								<div class="inner">
									<h3><?php echo $jumlah_stasiunb?></h3>
									<p>Stasiun Akhir</p>
								</div>
								<div class="icon">
									<i class="fas fa-hourglass-end"></i>
								</div>
								<a href="index.php?page=stasiunb" class="small-box-footer">
									More info <i class="fas fa-arrow-circle-right"></i>
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

