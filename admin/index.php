<?php include './includes/head.php'; ?>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<?php include './includes/sidebar.php'; ?>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<?php include './includes/nav.php'; ?>
				<!-- End of Topbar -->
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Runners</h1>
					</div>
					<!-- Content Row -->
					<div class="row">
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Runners</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countStuff('runners') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-running fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Applicants</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'status', '=', 'pending')?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-pause fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Invited Applicants</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'status', '=', 'invited') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-calendar-check fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Approved Runners</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'status', '=', 'approved') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-thumbs-up fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Available Runners</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'availability', '=', 'available') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-blog fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unavailable Runners</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'availability', '=', 'unavailable') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-toggle-off fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Active Runners</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('runners', 'availability', '=', 'active') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-skating fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Orders Value</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">₦<?= getTotal('requests', 'amount', 'status', '!=', 'unpaid') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-briefcase fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<hr class="my-3">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Markets</h1>
					</div>
					<div class="row">
						
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Markets</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countStuff('markets') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-store-alt fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Vendors</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countStuff('vendors') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-tag fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Items Listed</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countStuff('items') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-boxes fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Orders</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('requests', 'status', '!=', 'unpaid') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-comments fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Completed Orders</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('requestStatus', 'status', '=', 'completed') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-truck-loading fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Orders Value</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">₦<?= getTotal('requests', 'amount', 'status', '!=', 'unpaid') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-briefcase fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Users</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countWhere('users', 'type', '=', '2') ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-users fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Active Orders</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= countAnd('requestStatus', 'runner', '!=', '', 'status', '!=', 'completed') ?></div>
										</div>
										<div class="col-auto">
											<i class="far fa-skating fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					
					
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->
			<?php include './includes/footer.php'; ?>