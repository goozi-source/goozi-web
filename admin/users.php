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
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4">Goozi users</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Requests Made</th>
                                            <th>Registered At</th>
                                            <th>View Profile</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Requests Made</th>
                                            <th>Registered At</th>
                                            <th>View Profile</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $users = getWhere('users', 'type', '>', '1');
                                            foreach ($users as $user): 
                                        ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['fname'] ?></td>
                                            <td><?= $user['lname'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['phone'] ?></td>
                                            <td><?= $user['address'] ?></td>
                                            <td><?= countDistinct('requests', 'user', '=', $user['id'], 'batch') ?></td>
                                            <td><?= $user['createdAt'] ?></td>
                                            <td><a href="/admin/user/<?= $user['id'] ?>" class="btn btn-sm btn-primary">View profile</a></td>
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