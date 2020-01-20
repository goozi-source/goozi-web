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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Applicants</h1>
                    <p class="mb-4">A list of runners who have been invited for interviews at GOOZI</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Approved Applicants</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Registered At</th>
                                            <th>View Profile</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Registered At</th>
                                            <th>View Profile</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $runners = $runners = getWhere('runners', 'status', '=', 'approved');
                                            foreach ($runners as $runner): 
                                        ?>
                                        <tr>
                                            <td><?= $runner['id'] ?></td>
                                            <td><?= $runner['fname'] ?></td>
                                            <td><?= $runner['lname'] ?></td>
                                            <td><?= $runner['gender'] ?></td>
                                            <td><?= $runner['email'] ?></td>
                                            <td><?= $runner['phone'] ?></td>
                                            <td><?= $runner['createdAt'] ?></td>
                                            <td><a href="/admin/runner/<?= $runner['id'] ?>" class="btn btn-sm btn-primary">View profile</a></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php include './includes/footer.php';?>