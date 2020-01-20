<?php 
	include './includes/head.php';
    authenticateUser();
	include './includes/nav.php';
?>
<body >
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="other-container z-depth-3" style="margin-top: -.5%!important; padding-top: 20px; padding-bottom: 0!important;">
            <div class="row col-xs-12" style="width: 100%">
                <ul class="nav nav-tabs z-depth text-center" style="width: 100%" id="myTab" role="tablist">
                    <li class="nav-item text-center col-xs-3 ml-auto mx-auto">
                        <a class="nav-link tabs-text active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Markets</a>
                    </li>
                   
                    <li class="nav-item text-center col-xs-3 ml-auto mx-auto">
                        <a class="nav-link tabs-text" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="contact" aria-selected="false">History</a>
                    </li>
                
                    <li class="nav-item text-center col-xs-3 ml-auto mx-auto">
                        <a class="nav-link tabs-text" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                
                    <?php if (isset($_SESSION['user_type'])): ?>
                    <li class="nav-item text-center col-xs-3 ml-auto mx-auto">
                        <a class="nav-link tabs-text" title="Logout" href="/logout"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="container tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade gold-color-text show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h4 class="dark-color-text text-center">Choose a market</h4>
                <?php 
                    $markets = getAll('markets');
                    $runners = getWhere('runners', 'availability', '=', 'available');
                    if(count($runners) > 0 ):
                        foreach ($markets as $market): 
                ?>
                <div class="row market-row">
                    <div class="card card-body mb-4">
                        <div class="market-icon">
                            <i class="fas fa-store-alt fa-3x"></i>
                        </div>
                        <div class="text-center">
                            <a href="/market/<?= $market['id'] ?>"><h6 class="gold-color-text"><?= $market['market'] ?></h6></a>
                        </div>
                    </div>
                </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">Sorry you can't make any orders at the moment as there are no runners available at the moment</h4>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="history" role="tabpanel" aria-labelledby="history-tab">
                <?php 
                    $orders = groupWhere('requests', 'user', '=', userDetails()['id'], 'batch');
                    if(count($orders) > 0):
                        foreach ($orders as $order): 
                ?>
                    <div class="row">
                        <div class="card card-body mb-4">
                            <div class="market-icon">
                                <i class="fas fa-boxes fa-3x"></i>
                            </div>
                            <div class="text-center">
                                <a href="/order/<?= $order['batch'] ?>"><h6 class="gold-color-text"><?= $order['batch'] ?></h6></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">You haven't made any order yet</h4>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container mb-4">
                    <div class="row">
                        <div class="card card-body col-sm-4">
                            <div class="market-icon text-center">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="text-center gold-color-text">
                                <h6>Update your profile</h6>
                            </div>
                            <form method="post" id="mobileForm">
                                    <div class="md-form">
                                        <input type="text" class="form-control" value="<?= userDetails()['fname'];?>" name="fname" id="fname">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="text" class="form-control" value="<?= userDetails()['lname'];?>" name="lname" id="lname">
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="email" class="form-control" value="<?= userDetails()['email'];?>" name="email" id="email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="number" class="form-control" value="<?= userDetails()['phone'];?>" name="phone" id="phone">
                                        <label for="phone">Phone</label>
                                    </div>
                                    <div class="md-form">
                                        <textarea name="address" id="address" class="md-textarea form-control"><?= userDetails()['address'];?></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="text-center mt-4 mb-4" id="message">
                                        <?php if (isset($_SESSION['userUpdate_error'])): ?>
                                            <?= $_SESSION['userUpdate_error']; ?>
                                        <?php elseif(isset($_SESSION['userUpdate_success'])): ?>
                                            <?= $_SESSION['userUpdate_success']; ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-md signup-btn" type="submit" name="userUpdate">
                                            Update Profile
                                        </button>
                                    </div>
                                    <?php userUpdate(); ?>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
     <main id="web-view" style="display: none;">
        <div class="login-section">
            <ul class="nav nav-tabs z-depth-3 float-left" id="myTab" role="tablist">
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Markets</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" href="/user/cart" aria-selected="false">
                        <i class="fas fa-shopping-cart"></i><sup class="cart-icon">
                            <span class="badge badge-pill gold-bg"><?= countAnd('requests', 'session', '=', session_id(), 'status', '=', 'unpaid') ?></span>
                        </i>
                    </a>
                </li>
            </ul>
            <div class="container tab-content mt-4 float-right" id="myTabContent">
                <div class="tab-pane fade gold-color-text show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h4 class="dark-color-text text-center">Choose a market</h4>
                <?php 
                    $markets = getAll('markets');
                    $runners = getWhere('runners', 'availability', '=', 'available');
                    if(count($runners) > 0 ):
                        foreach ($markets as $market): 
                ?>
                <div class="row">
                    <div class="card card-body mb-4">
                        <div class="market-icon">
                            <i class="fas fa-store-alt fa-3x"></i>
                        </div>
                        <div class="text-center">
                            <a href="/market/<?= $market['id'] ?>"><h6 class="gold-color-text"><?= $market['market'] ?></h6></a>
                        </div>
                    </div>
                </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">Sorry you can't make any orders at the moment as there are no runners available at the moment</h4>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="history" role="tabpanel" aria-labelledby="history-tab">
                <?php 
                    $orders = groupWhere('requests', 'user', '=', userDetails()['id'], 'batch');
                    if(count($orders) > 0):
                        foreach ($orders as $order): 
                ?>
                    <div class="row col-sm-9">
                        <div class="card card-body mb-4">
                            <div class="market-icon">
                                <i class="fas fa-boxes fa-3x"></i>
                            </div>
                            <div class="text-center">
                                <a href="/order/<?= $order['batch'] ?>"><h6 class="gold-color-text"><?= $order['batch'] ?></h6></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">You haven't made any order yet</h4>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container mb-4">
                    <div class="row">
                        <div class="card card-body col-sm-9">
                            <div class="market-icon text-center">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="text-center gold-color-text">
                                <h6>Update your profile</h6>
                            </div>
                            <form method="post" id="mobileForm">
                                    <div class="md-form">
                                        <input type="text" class="form-control" value="<?= userDetails()['fname'];?>" name="fname" id="fname">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="text" class="form-control" value="<?= userDetails()['lname'];?>" name="lname" id="lname">
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="email" class="form-control" value="<?= userDetails()['email'];?>" name="email" id="email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="number" class="form-control" value="<?= userDetails()['phone'];?>" name="phone" id="phone">
                                        <label for="phone">Phone</label>
                                    </div>
                                    <div class="md-form">
                                        <textarea name="address" id="address" class="md-textarea form-control"><?= userDetails()['address'];?></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="text-center mt-4 mb-4" id="message">
                                        <?php if (isset($_SESSION['userUpdate_error'])): ?>
                                            <?= $_SESSION['userUpdate_error']; ?>
                                        <?php elseif(isset($_SESSION['userUpdate_success'])): ?>
                                            <?= $_SESSION['userUpdate_success']; ?>
                                        <?php endif ?>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-md signup-btn" type="submit" name="userUpdate">
                                            Update Profile
                                        </button>
                                    </div>
                                    <?php userUpdate(); ?>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>
<?php include './includes/footer.php';?>