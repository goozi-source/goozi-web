<?php 
	include './includes/head.php';
    authenticateUser();
	include './includes/nav.php';
?>
<body >
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!--Main layout-->

    <main>
        <div class="container" style="margin-top: 5%;">
            <div class="card">
                <div class="card-header dark-background custom-header">
                    <h4 class="gold-color-text font-weight-bold float-right">Pending Runners</h4>
                </div>
                <div class="card-body">
                    <div class=" col-sm-12 table-responsive text-nowrap ">
                        <table id="data-table" class="table table-sm table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                            <thead class="dark-background gold-color-text">
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
                            <tbody>
                                <?php 
                                    $runners = getRunners('pending');
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
                                        <td><a href="/admin/runner/<?= $runner['id'] ?>" class="btn btn-sm signup-btn">View profile</a></td>
                                    </tr>
                                <?php endforeach ?>
                                
                            </tbody>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './includes/footer.php';?>