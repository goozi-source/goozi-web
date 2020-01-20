<?php 
	include './includes/head.php';
    include './includes/nav.php';
    authenticateUser();
    $id = $_SESSION['email'];
    $runners = getWhere('runners', 'email', '=', $id);
    $runner = array_shift($runners); 
	
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
                <h4 class="dark-color-text text-center">Available Requests</h4>
                <?php 
                    if($runner['availability'] == 'available' ):
                        $requests = groupAnd('requests', 'status', '=', 'paid', 'runner', '=', '0', 'batch');
                        if(count($requests) > 0):
                            foreach ($requests as $request): 
                ?>
                <div class="row">
                    <div class="card card-body mb-4">
                        <div class="market-icon">
                            <i class="fas fa-boxes fa-3x"></i>
                        </div>
                        <div class="text-center">
                            <a href="/request/<?= $request['batch'] ?>"><h6 class="gold-color-text"><?= $request['batch'] ?></h6></a>
                        </div>
                    </div>
                </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <h4 class="dark-color-text text-center mt-5">No requests at this moment</h4>
                    <?php endif; ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">Set your status as available to see requests</h4>
                    <a href="#" class="btn btn-lg circle mt-4" data-toggle="modal" data-target="#availability">Go Online</a>
                    
                    <div class="modal bottom fade" id="availability" tabindex="-1" role="dialog" aria-labelledby="Availability" aria-hidden="true">
                        <div class="modal-dialog modal-bottom" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="border:none;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><h1 class="dark-color-text pr-3">&times;</h1></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" class="text-center">
                                        <select class="custom-select browser-default" name="lga">
                                            <option>Select LGA</option>
                                            <?php 
                                                $lgas = groupBy('markets', 'lga');
                                                foreach ($lgas as $lga): 
                                            ?>
                                            <option value="<?= $lga['lga'] ?>"> <?= $lga['lga'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" name="status" value="available">
                                        <input type="hidden" name="id" value="<?= $runner['id'] ?>">
                                        <button class="btn btn-gold btn-md mt-2"  type="submit" name="setStatus">Go Online</button>
                                        <?php setStatus(); ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="history" role="tabpanel" aria-labelledby="history-tab">
                <?php 
                    $orders = groupWhere('requests', 'runner', '=', $runner['id'], 'batch');
                    if(count($orders) > 0):
                        foreach ($orders as $order): 
                ?>
                    <div class="row">
                        <div class="card card-body mb-4">
                            <div class="market-icon">
                                <i class="fas fa-boxes fa-3x"></i>
                            </div>
                            <div class="text-center">
                                <a href="/request/<?= $order['batch'] ?>"><h6 class="gold-color-text"><?= $order['batch'] ?></h6></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h4 class="dark-color-text text-center mt-5">You haven't run any errands yet</h4>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade gold-color-text" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container">
                    <div class="row">
                        <div class="card card-body col-sm-4 mb-4">
                            <div class="text-center dark-color-text">
                                <h6><?= $runner['fname'] . " " . $runner['lname'] ?></h6>
                            </div>
                        </div>
                        <div class="card card-body col-sm-4 mb-4">
                            <div class="text-center dark-color-text">
                                <h4><?= countDistinct('requests', 'runner', '=', $runner['id'], 'batch') ?></h4>
                                <h6 class="gold-color-text">Errands Run</h6>
                            </div>
                        </div>
                        <div class="card card-body col-sm-4 mb-4">
                            <div class="text-center dark-color-text">
                                <h4><?= number_format(calcDiscount('paid', $runner['id'])) ?></h4>
                                <h6 class="gold-color-text">Commission Earned</h6>
                            </div>
                        </div>
                        <form method="post" class="text-center mx-auto ml-auto">
                            <input type="hidden" name="status" value="unavailable">
                            <input type="hidden" name="id" value="<?= $runner['id'] ?>">
                            <button class="btn btn-gold btn-md mt-2"  type="submit" name="setStatus">Go Offline</button>
                            <?php setStatus(); ?>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <!-- <main id="web-view" style="display: none;">
        <div class="login-section">
            <ul class="nav nav-tabs z-depth-3 float-left" id="myTab" role="tablist">
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Markets</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Merchants</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">History</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Profile</a>
                </li>
            </ul>
            <div class="container tab-content mt-4 float-right" id="myTabContent">
                <div class="tab-pane fade gold-color-text show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="dark-color-text text-center">Choose a market</h4>
                    <div class="container">
                        <div class="row">
                        <?php 
                            $requests = getAll('markets');
                            foreach ($requests as $request): 
                        ?>
                        <div class="col-sm-4">
                            <div class="card card-body mb-4">
                                <div class="market-icon">
                                    <i class="fas fa-store-alt fa-3x"></i>
                                </div>
                                <div class="text-center">
                                    <a href="/request/<?= $request['id'] ?>"><h6 class="gold-color-text"><?= $request['market'] ?></h6></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade gold-color-text" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        <div class="row">
                            <div class="card card-body col-sm-4">
                                <div class="market-icon text-center">
                                    <i class="fas fa-user fa-3x"></i>
                                </div>
                                <div class="text-center gold-color-text">
                                    <h6>Update your profile</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade gold-color-text" id="contact" role="tabpanel" aria-labelledby="contact-tab">Etsy mixtape
                wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack
                lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify
                squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
                etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog
                stumptown. Pitchfork sustainable tofu synth chambray yr.</div>
            </div>
        </div>
    </main> -->
<?php include './includes/footer.php';?>