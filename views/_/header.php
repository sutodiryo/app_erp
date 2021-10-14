<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sentragro - Easy Farming">
	<meta name="author" content="Creative Tim">
	<title><?php echo $title ?> - Sentragro</title>
	<!-- Favicon -->
	<link rel="icon" href="<?php echo ASSETS ?>img/brand/favicon.png" type="image/png">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<!-- Icons -->
	<link rel="stylesheet" href="<?php echo ASSETS ?>vendor/nucleo/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="<?php echo ASSETS ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

	<!-- Page plugins -->
	<?php //if ($page == "pelanggan" || $page == "spending" || $page == "income" || $page == "sales" || $page == "produk") { 
	?>

	<link rel="stylesheet" href="<?php echo ASSETS ?>vendor/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
	<!-- <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css"> -->
	<?php // } else { } 
	?>

	<!-- Argon CSS -->
	<link rel="stylesheet" href="<?php echo ASSETS ?>css/argon.css?v=1.1.0" type="text/css">
</head>

<body>
	<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
		<div class="scrollbar-inner">
			<div class="sidenav-header d-flex align-items-center">
				<a class="navbar-brand" href="<?php echo base_url() ?>">
					<img src="<?php echo ASSETS ?>img/brand/blue.png" class="navbar-brand-img" alt="...">
				</a>
				<div class="ml-auto">
					<div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
						<div class="sidenav-toggler-inner">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="navbar-inner">
				<div class="collapse navbar-collapse" id="sidenav-collapse-main">
					<ul class="navbar-nav">

						<li class="nav-item">
							<a class="nav-link <?php if ($page == "dashboard") {
													echo "active";
												} ?>" href="<?php echo base_url() ?>">
								<i class="ni ni-shop text-primary"></i>
								<span class="nav-link-text">Dashboard</span>
							</a>
						</li>

						<?php if ($this->session->userdata('log_admin') == TRUE) {
							if ($this->session->userdata('log_level') == 'admin') { ?>

								<li class="nav-item">
									<a class="nav-link <?php if ($page == "bid") {
																	echo "active";
																} ?>" href="<?php echo base_url('admin/') ?>bid/all">
										<i class="fa fa-paper-plane text-yellow"></i>
										<span class="nav-link-text">Penawaran</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php if ($page == "sales") {
																	echo "active";
																} ?>" href="<?php echo base_url('admin/') ?>sales/all">
										<i class="ni ni-cart text-green"></i>
										<span class="nav-link-text">Penjualan</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php if ($page == "spending") {
																	echo "active";
																} ?>" href="<?php echo base_url('admin/') ?>spending/all">
										<i class="ni ni-cart text-red"></i>
										<span class="nav-link-text">Pengeluaran</span>
									</a>
								</li>

								<li class="nav-item">
									<a class="nav-link <?php if ($page == "material" || $page == "product" || $page == "stock") {
																	echo "active";
																} ?>" href="#navbar-product" data-toggle="collapse" role="button" aria-expanded="<?php if ($page == "material" || $page == "product" || $page == "stock") {
																																								echo "true";
																																							} else {
																																								echo "false";
																																							} ?>" aria-controls="navbar-product">
										<i class="fa fa-cubes text-orange"></i>
										<span class="nav-link-text">Produk</span>
									</a>
									<div class="collapse <?php if ($page == "material" || $page == "product" || $page == "stock") {
																		echo "show";
																	} ?>" id="navbar-product">
										<ul class="nav nav-sm flex-column">
											<li class="nav-item">
												<a href="<?php echo base_url('admin/') ?>material/all" class="nav-link <?php if ($page == "material") {
																																	echo "active";
																																} ?>">Material</a>
											</li>
											<li class="nav-item">
												<a href="<?php echo base_url('admin/') ?>product/all" class="nav-link <?php if ($page == "product") {
																																	echo "active";
																																} ?>">Produk Setengah Jadi</a>
											</li>
											<li class="nav-item">
												<a href="<?php echo base_url('admin/') ?>stock/all" class="nav-link <?php if ($page == "stock") {
																																echo "active";
																															} ?>">Stok</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php if ($page == "cash") {
																	echo "active";
																} ?>" href="<?php echo base_url('admin/cash/total') ?>">
										<i class="ni ni-credit-card text-orange"></i>
										<span class="nav-link-text">Kas</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php if ($page == "report") {
																	echo "active";
																} ?>" href="<?php echo base_url('admin/report') ?>">
										<i class="ni ni-book-bookmark text-info"></i>
										<span class="nav-link-text">Laporan</span>
									</a>
								</li>

					</ul>
					<hr class="my-3">
					<h6 class="navbar-heading p-0 text-muted">Master</h6>
					<ul class="navbar-nav mb-md-3">

						<li class="nav-item">
							<a class="nav-link <?php if ($page == "pelanggan") {
															echo "active";
														} ?>" href="<?php echo base_url('admin/pelanggan/s') ?>">
								<i class="fa fa-users"></i>
								<span class="nav-link-text">Pelanggan</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($page == "user") {
															echo "active";
														} ?>" href="<?php echo base_url() ?>">
								<i class="ni ni-circle-08"></i>
								<span class="nav-link-text">User</span>
							</a>
						</li>

					<?php } elseif ($this->session->userdata('log_level') == 'team') { ?>

						<li class="nav-item">
							<a class="nav-link <?php if ($page == "bid") {
															echo "active";
														} ?>" href="<?php echo base_url('admin/') ?>bid/all">
								<i class="fa fa-paper-plane text-yellow"></i>
								<span class="nav-link-text">Penawaran</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($page == "sales") {
															echo "active";
														} ?>" href="<?php echo base_url('admin/') ?>sales/all">
								<i class="ni ni-cart text-green"></i>
								<span class="nav-link-text">Penjualan</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($page == "spending") {
															echo "active";
														} ?>" href="<?php echo base_url('admin/') ?>spending/all">
								<i class="ni ni-cart text-red"></i>
								<span class="nav-link-text">Pengeluaran</span>
							</a>
						</li>

					<?php } elseif ($this->session->userdata('log_level') == 'fa') { ?>

						<li class="nav-item">
							<a class="nav-link <?php if ($page == "sales") {
															echo "active";
														} ?>" href="<?php echo base_url('admin/') ?>sales/all">
								<i class="ni ni-cart text-green"></i>
								<span class="nav-link-text">Penjualan</span>
							</a>
						</li>

					<?php } ?>

				<?php } elseif ($this->session->userdata('log_pilot') == TRUE) { ?>

					<li class="nav-item">
						<a class="nav-link <?php if ($page == "report") {
													echo "active";
												} ?>" href="<?php echo base_url('admin/report/index') ?>">
							<i class="ni ni-book-bookmark text-info"></i>
							<span class="nav-link-text">Laporan</span>
						</a>
					</li>
				<?php } elseif ($this->session->userdata('log_user') == TRUE) { ?>
				<?php }  ?>

					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- Topnav -->

		<!-- Topnav -->
		<nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Search form -->
					<form class="navbar-search navbar-search-dark form-inline mr-sm-3" id="navbar-search-main">
						<div class="form-group mb-0">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control" placeholder="Pencarian..." type="text">
							</div>
						</div>
						<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</form>
					<!-- Navbar links -->
					<ul class="navbar-nav align-items-center ml-md-auto">
						<li class="nav-item d-xl-none">
							<!-- Sidenav toggler -->
							<div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
								<div class="sidenav-toggler-inner">
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
								</div>
							</div>
						</li>
						<li class="nav-item d-sm-none">
							<a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
								<i class="ni ni-zoom-split-in"></i>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="ni ni-bell-55"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
								<!-- Dropdown header -->
								<div class="px-3 py-3">
									<h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
								</div>
								<!-- List group -->
								<div class="list-group list-group-flush">
									<a href="#!" class="list-group-item list-group-item-action">
										<div class="row align-items-center">
											<div class="col-auto">
												<!-- Avatar -->
												<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/team-1.jpg" class="avatar rounded-circle">
											</div>
											<div class="col ml--2">
												<div class="d-flex justify-content-between align-items-center">
													<div>
														<h4 class="mb-0 text-sm">John Snow</h4>
													</div>
													<div class="text-right text-muted">
														<small>2 hrs ago</small>
													</div>
												</div>
												<p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
											</div>
										</div>
									</a>
									<a href="#!" class="list-group-item list-group-item-action">
										<div class="row align-items-center">
											<div class="col-auto">
												<!-- Avatar -->
												<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/team-2.jpg" class="avatar rounded-circle">
											</div>
											<div class="col ml--2">
												<div class="d-flex justify-content-between align-items-center">
													<div>
														<h4 class="mb-0 text-sm">John Snow</h4>
													</div>
													<div class="text-right text-muted">
														<small>3 hrs ago</small>
													</div>
												</div>
												<p class="text-sm mb-0">A new issue has been reported for Argon.</p>
											</div>
										</div>
									</a>
									<a href="#!" class="list-group-item list-group-item-action">
										<div class="row align-items-center">
											<div class="col-auto">
												<!-- Avatar -->
												<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/team-3.jpg" class="avatar rounded-circle">
											</div>
											<div class="col ml--2">
												<div class="d-flex justify-content-between align-items-center">
													<div>
														<h4 class="mb-0 text-sm">John Snow</h4>
													</div>
													<div class="text-right text-muted">
														<small>5 hrs ago</small>
													</div>
												</div>
												<p class="text-sm mb-0">Your posts have been liked a lot.</p>
											</div>
										</div>
									</a>
									<a href="#!" class="list-group-item list-group-item-action">
										<div class="row align-items-center">
											<div class="col-auto">
												<!-- Avatar -->
												<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/profil.jpg" class="avatar rounded-circle">
											</div>
											<div class="col ml--2">
												<div class="d-flex justify-content-between align-items-center">
													<div>
														<h4 class="mb-0 text-sm">John Snow</h4>
													</div>
													<div class="text-right text-muted">
														<small>2 hrs ago</small>
													</div>
												</div>
												<p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
											</div>
										</div>
									</a>
									<a href="#!" class="list-group-item list-group-item-action">
										<div class="row align-items-center">
											<div class="col-auto">
												<!-- Avatar -->
												<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/team-5.jpg" class="avatar rounded-circle">
											</div>
											<div class="col ml--2">
												<div class="d-flex justify-content-between align-items-center">
													<div>
														<h4 class="mb-0 text-sm">John Snow</h4>
													</div>
													<div class="text-right text-muted">
														<small>3 hrs ago</small>
													</div>
												</div>
												<p class="text-sm mb-0">A new issue has been reported for Argon.</p>
											</div>
										</div>
									</a>
								</div>
								<!-- View all -->
								<a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
							</div>
						</li>
						<!-- <li class="nav-item dropdown">
							<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="ni ni-ungroup"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
								<div class="row shortcuts px-4">
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-red">
											<i class="ni ni-calendar-grid-58"></i>
										</span>
										<small>Calendar</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-orange">
											<i class="ni ni-email-83"></i>
										</span>
										<small>Email</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-info">
											<i class="ni ni-credit-card"></i>
										</span>
										<small>Payments</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-green">
											<i class="ni ni-books"></i>
										</span>
										<small>Reports</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-purple">
											<i class="ni ni-pin-3"></i>
										</span>
										<small>Maps</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
											<i class="ni ni-basket"></i>
										</span>
										<small>Shop</small>
									</a>
								</div>
							</div>
						</li> -->
					</ul>
					<ul class="navbar-nav align-items-center ml-auto ml-md-0">
						<li class="nav-item dropdown">
							<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="media align-items-center">
									<span class="avatar avatar-sm rounded-circle">
										<img alt="Image placeholder" src="<?php echo ASSETS ?>img/theme/profil.jpg">
									</span>
									<div class="media-body ml-2 d-none d-lg-block">
										<span class="mb-0 text-sm  font-weight-bold"><?php echo $this->session->userdata('log_name'); ?></span>
									</div>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome!</h6>
								</div>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-single-02"></i>
									<span>My profile</span>
								</a>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-settings-gear-65"></i>
									<span>Settings</span>
								</a>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-calendar-grid-58"></i>
									<span>Activity</span>
								</a>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-support-16"></i>
									<span>Support</span>
								</a>
								<div class="dropdown-divider"></div>
								<a href="<?php if ($this->session->userdata('log_admin') == TRUE) {
												echo base_url('auth/logout/admin');
											} elseif ($this->session->userdata('log_pilot') == TRUE) {
												echo base_url('auth/logout/pilot');
											} elseif ($this->session->userdata('log_sales') == TRUE) {
												echo base_url('auth/logout/sales');
											} elseif ($this->session->userdata('log_user') == TRUE) {
												echo base_url('auth/logout/user');
											}  ?>" class="dropdown-item">
									<i class="ni ni-user-run"></i>
									<span>Logout</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Header -->

		<?php echo $this->session->flashdata('report'); ?>