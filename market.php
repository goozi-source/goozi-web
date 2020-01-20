<?php 
	include './includes/head.php';
    authenticateUser();
    include './includes/nav.php';
    $markets = getWhere('markets', 'id', '=', $_GET['market']);  
    $market = array_shift($markets);
    $runners = countWhere('runners', 'currentLGA', '=', $market['lga']);
?>
<body >
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="other-container z-depth-3" style="margin-top: -.5%!important; padding-top: 20px; padding-bottom: 0!important;">
            <h4 class="gold-color-text pb-3 font-weight-bold text-center"><?= $market['market'] ?></h4>
        </div>
        <div class="container">
            <?php 
                if($runners > 0):
                    $items = getWhere('items', 'market', '=', $_GET['market']);  
                    foreach ($items as $item): 
            ?>
                <div class="row">
                    <div class="card card-body mb-4">
                        <div class="row">
                            <div class="market-icon float-left">
                                <img src="/items/<?= $item['picture'] ?>" alt="<?= $item['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                            </div>
                            <div class="text-center mt-5 float-right ml-5">
                                <a href="#" data-toggle="modal" data-target="#item-<?= $item['id'] ?>">
                                    <h6 class="gold-color-text"><?= $item['name'] ?></h6>
                                    <h6 class="gold-color-text">₦<?= number_format($item['price']) ?></h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal bottom fade" id="item-<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $item['name'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-bottom" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="border:none;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><h1 class="dark-color-text pr-3">&times;</h1></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="market-icon float-left">
                                        <img src="/items/<?= $item['picture'] ?>" alt="<?= $item['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                    </div>
                                    <div class="text-center mt-5 float-right ml-5">
                                        <h6 class="gold-color-text"><?= $item['name'] ?></h6>
                                        <h6 class="gold-color-text">₦<?= number_format($item['price']) ?></h6>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <form class="col-sm-12" method="post" action = "">
                                        <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                        <input type="hidden" name="market" value="<?= $_GET['market'] ?>">
                                        <div class="md-form text-center">
                                            <input type="number" id="quantity" class="form-control" name="quantity">
                                            <label for="quantity">Quantity</label>
                                        </div> 
                                        <div class="text-center">
                                            <button type="submit" name="addCart-m-<?= $item['id']?>" class="btn btn-gold ml-2 mt-3">Add to cart</button>
                                        </div>
                                        <?php addToCart($item['id']);?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            <?php else:?>
                 <h4 class="dark-color-text text-center mt-5">Sorry you can't order from this market as they're no runners available for this market</h4>
            <?php endif; ?>
        </div>
    </main>
    <main id="web-view" style="display: none;">
        <div class="login-section">
            <ul class="nav nav-tabs z-depth-3 float-left" id="myTab" role="tablist">
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text active" href="/user/home#home"  aria-controls="home" aria-selected="true">Markets</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" href="/user/home#history" aria-selected="false">History</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" href="/user/home#profile" aria-selected="false">Profile</a>
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
                    <div class="container">
                        <div class="row">
                            <?php 
                                $items = getWhere('items', 'market', '=', $_GET['market']);  
                                foreach ($items as $item): 
                            ?>
                            <div class="col-sm-4">
                                <div class="card card-body mb-4">
                                    <div class="row">
                                        <div class="market-icon float-left">
                                            <img src="/items/<?= $item['picture'] ?>" alt="<?= $item['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                        </div>
                                        <div class="text-center mt-5 float-right ml-5">
                                            <a href="#" data-toggle="modal" data-target="#item-<?= $item['id'] ?>">
                                                <h6 class="gold-color-text"><?= $item['name'] ?></h6>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="item-<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $item['name'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="<?= $item['name'] ?>"><?= $item['name'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="market-icon float-left">
                                                    <img src="/items/<?= $item['picture'] ?>" alt="<?= $item['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                                </div>
                                                <div class="text-center mt-5 float-right ml-5">
                                                    <h6 class="gold-color-text"><?= $item['name'] ?></h6>
                                                    <h6 class="gold-color-text">₦<?= number_format($item['price']) ?></h6>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <form class="col-sm-12" method="post" action="">
                                                    <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                                    <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                                    <input type="hidden" name="market" value="<?= $_GET['market'] ?>">
                                                    <div class="md-form text-center">
                                                        <input type="number" id="quantity" class="form-control" name="quantity">
                                                        <label for="quantity">Quantity</label>
                                                    </div> 
                                                    <div class="text-center">
                                                        <button type="submit" name="addCart-w-<?= $item['id']?>" class="btn btn-gold ml-2 mt-3">Add to cart</button>
                                                    </div>
                                                    <?php addWToCart($item['id']);?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
<?php include './includes/footer.php';?>