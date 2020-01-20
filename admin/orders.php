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
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>
                    <p class="mb-4">Goozi Orders</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Market</th>
                                            <th>User</th>
                                            <th>Runner</th>
                                            <th>Paid At</th>
                                            <th>Delivered At</th>
                                            <th>View Order</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Market</th>
                                            <th>User</th>
                                            <th>Runner</th>
                                            <th>Paid At</th>
                                            <th>Delivered At</th>
                                            <th>View Order</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $items = groupBy('requests', 'batch');
                                            foreach ($items as $item): 
                                        ?>
                                        <tr>
                                            <td><?= $item['batch'] ?></td>
                                            <td><?= itemDetails($item['item'])['name'] ?></td>
                                            <td><?= itemDetails($item['item'])['price'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['amount'] ?></td>
                                            <td><?= $item['status'] ?></td>
                                            <td><?= marketDetails($item['market'])['market'] ?></td>
                                            <td><?= runnerDetails($item['user'], 'users')['fname'] ?></td>
                                            <td><?= runnerDetails($item['runner'], 'runners')['fname'] ?></td>
                                            <td><?= $item['paidAt'] ?></td>
                                            <td><?= $item['deliveredAt'] ?></td>
                                            <td><a href="/admin/order/<?= $item['batch'] ?>" class="btn btn-sm btn-primary">View</a></td>
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