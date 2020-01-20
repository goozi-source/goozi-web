<?php 
    include './includes/head.php';
    $id = $_GET['user'];
    $runners = getWhere('users', 'id', '=', $id);
    $user = array_shift($runners); 
?>
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
                    
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $user['fname'] . " " . $user['lname']; ?>'s Profile</h1>
						
					</div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Applicantion Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="float-left">
                                        <h6 class="mb-4 font-weight-bold text-dark">First Name: <span class="text-primary ml-3"><?= $user['fname'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Last Name: <span class="text-primary ml-3"><?= $user['lname'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Phone Number: <span class="text-primary ml-3"><?= $user['phone'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Email Address: <span class="text-primary ml-3"><?= $user['email'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Address: <span class="text-primary ml-3"><?= $user['address'];?></span></h6>
                                    </div>
                                </div>
                                
                            </div>
                            <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Market</th>
                                            <th>Runner</th>
                                            <th>Paid At</th>
                                            <th>Delivered At</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Market</th>
                                            <th>Runner</th>
                                            <th>Paid At</th>
                                            <th>Delivered At</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            $items = getWhere('requests', 'user', '=', $user['id']);
                                            foreach ($items as $item): 
                                        ?>
                                        <tr>
                                            <td><?= $item['batch'] ?></td>
                                            <td><?= itemDetails($item['item'])['name'] ?></td>
                                            <td><?= itemDetails($item['item'])['price'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['amount'] ?></td>
                                            <td><?= marketDetails($item['market'])['market'] ?></td>
                                            <td><?= runnerDetails($item['runner'], 'runners')['fname'] ?></td>
                                            <td><?= $item['paidAt'] ?></td>
                                            <td><?= $item['deliveredAt'] ?></td>
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