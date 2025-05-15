<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

				<div class="sidebar-brand-text mx-3">Penggajian</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url('pegawai/dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('pegawai/absen') ?>">
					<i class="fas fa-fw fa-money-bill-wave-alt"></i>
					<span>Input Absen</span></a>
			</li>

			<li class="nav-item" id="data-mengajar-link">
				<a class="nav-link" href="<?php echo base_url('pegawai/data_mengajar') ?>">
					<i class="fas fa-fw fa-money-bill-wave-alt"></i>
					<span>Input Mengajar</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('pegawai/datagaji') ?>">
					<i class="fas fa-fw fa-money-bill-wave-alt"></i>
					<span>Data Gaji</span></a>
			</li>


			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('pegawai/gantiPassword') ?>">
					<i class="fas fa-fw fa-lock"></i>
					<span>Ganti Password</span></a>
			</li>

			<!-- Nav Item - Tables -->
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('welcome/logout') ?>">
					<i class="fas fa-fw fa-sign-out-alt"></i>
					<span>LogOut</span></a>
			</li>


			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>



		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Search -->
					<h5 class="font-weight-bold">Aplikasi Penggajian</h5>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">



						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang
									<?php echo $this->session->userdata('nama_pegawai') ?></span>
								<img class="img-profile rounded-circle"
									src="<?php echo base_url('assets/img/').$this->session->userdata('photo') ?>">
							</a>
							<!-- Dropdown - User Information -->
						</li>

					</ul>

				</nav>

				<script type="text/javascript">
					// Ambil status pengguna dari PHP
					var userStatus = '<?php echo $user_status; ?>';

					// Periksa status pengguna dan sembunyikan elemen jika tidak mengajar
					if (userStatus !== 'mengajar') {
						document.getElementById('data-mengajar-link').style.display = 'none';
					}

				</script>
