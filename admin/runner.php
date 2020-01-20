<?php 
    include './includes/head.php';
    $id = $_GET['runner'];
    $runners = getWhere('runners', 'id', '=', $id);
    $runner = array_shift($runners); 
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
                        <h1 class="h3 mb-0 text-gray-800"><?= $runner['fname'] . " " . $runner['lname']; ?>'s Application</h1>
						
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
                                        <h6 class="mb-4 font-weight-bold text-dark">First Name: <span class="text-primary ml-3"><?= $runner['fname'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Middle Name: <span class="text-primary ml-3"><?= $runner['mname'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Last Name: <span class="text-primary ml-3"><?= $runner['lname'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Phone Number: <span class="text-primary ml-3"><?= $runner['phone'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Email Address: <span class="text-primary ml-3"><?= $runner['email'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Date Of Birth: <span class="text-primary ml-3"><?= $runner['dob'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Gender: <span class="text-primary ml-3"><?= $runner['gender'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Marital Status: <span class="text-primary ml-3"><?= $runner['mstatus'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Number Of Kids: <span class="text-primary ml-3"><?= $runner['kids'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Religion: <span class="text-primary ml-3"><?= $runner['religion'];?></span></h6>
                                        <h6 class="mb-4 font-weight-bold text-dark">Address: <span class="text-primary ml-3"><?= $runner['address'];?></span></h6>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row float-right">
                                        <img src="/passports/<?= $runner['picture'] ?>" alt="<?= $runner['fname'] ?>" class="img-fluid img-thumbnail passport mb-4">
                                    </div>
                                    <div class="row text-center float-right">
                                        <a href="/passport/<?= $runner['picture']; ?>" class="btn btn-sm btn-primary shadow-sm mr-1 mb-4"><i class="fas fa-download fa-sm text-white-50" download></i> Download Passport</a>
                                        <a href="/police_reports/<?= $runner['police']; ?>" class="btn btn-sm btn-primary shadow-sm mr-1 mb-4"><i class="fas fa-download fa-sm text-white-50" download></i> Download Police Report</a>
                                        <a href="/results/<?= $runner['result']; ?>" class="btn btn-sm btn-primary shadow-sm mr-1 mb-4"><i class="fas fa-download fa-sm text-white-50" download></i> Download WAEC Certificate</a>
                                    </div>
                                    <div class="row float-right">
                                        <div class="text-center">
                                            <?php if ($runner['status'] == 'pending'): ?>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-primary bg-gradient-primary" name="inviteApplicant" type="submit">Invite For Interview</button>
                                                    <?php inviteApplicant('invited'); ?>
                                                </form>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-danger" name="declineApplication" type="submit">Decline Application</button>
                                                    <?php declineApplication('declined'); ?>
                                                </form>
                                            <?php elseif ($runner['status'] == 'invited'): ?>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-success bg-gradient-success" name="approveApplication" type="submit">Approve Runner</button>
                                                    <?php approveApplication('approved'); ?>
                                                </form>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-danger" name="declineApplication" type="submit">Decline Application</button>
                                                    <?php declineApplication('declined'); ?>
                                                </form>
                                            <?php elseif ($runner['status'] == 'declined'): ?>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-primary bg-gradient-primary" name="inviteApplicant" type="submit">Invite For Interview</button>
                                                    <?php inviteApplicant('invited'); ?>
                                                </form>
                                                <form method="post">
                                                    <input type="hidden" name="runner" value="<?=$id ?>">
                                                    <input type="hidden" name="fname" value="<?= $runner['fname'] ?>">
                                                    <input type="hidden" name="mail" value="<?= $runner['email'] ?>">
                                                    <button class="btn btn-md btn-success bg-gradient-success" name="approveApplication" type="submit">Approve Runner</button>
                                                    <?php approveApplication('approve'); ?>
                                                </form>
                                                
                                            <?php endif ?>
                                            
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
            <?php include './includes/footer.php';?>