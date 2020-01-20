<?php 
	include './includes/head.php';
    authenticateUser();
    include './includes/nav.php';
    $session = session_id();
    $sum = getSumAnd('requests', 'amount', 'session', '=', $session, 'status', '=', 'unpaid');
?>
<body >

    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="other-container z-depth-3" style="margin-top: -.5%!important; padding-top: 20px; padding-bottom: 0!important; display: inline-flex; width: 100%">
            <div class="col-xs-3 ml-2 mt-3 mr-2 pb-3">
                <h6 class="gold-color-text font-weight-bold">₦<?= number_format($sum) ?></h6>
            </div>
            <div class="col-xs-7 mt-1 ml-5 pb-3 text-center">
                <h4 class="gold-color-text font-weight-bold text-center">Shopping Cart</h4>
            </div>
            <div class="col-xs-2 pb-3 mt-3 ml-3 right-texts pr-3">
                <form method="post" id="paymentForm">
                    <input type="hidden" name="amount" value="<?= $sum ?>">
                    <button type="button" onclick="payWithPaystack()" class="btn-md btn-transparent gold-color-text font-weight-bold"><h6><i class="far fa-credit-card"></i> Pay</h6></button>
                </form>
                <?php makePayment(); ?>
            </div>
        </div>
        <div class="container">
            <?php 
                $items = getAnd('requests', 'session', '=', $session, 'status', '=', 'unpaid');  
                if(count($items) > 0):
                foreach ($items as $item): 
            ?>
            <div class="row">
                <div class="card card-body mb-4">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="market-icon float-left">
                                <img src="/items/<?= itemDetails($item['item'])['picture'] ?>" alt="<?= itemDetails($item['item'])['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <h6 class="gold-color-text mt-5 p-2"><?= itemDetails($item['item'])['name']. " (" . $item['quantity'] . ")" ?></h6>
                        </div>
                        <div class="col-xs-4">
                            <div class="mt-5 p-2 right-texts">
                                <a href="#" data-toggle="modal" data-target="#item-<?= $item['item'] ?>">
                                    <i class="fas fa-pencil-alt gold-color-text float-right"></i>
                                </a>
                                <form method="post">
                                    <div class="text-right">
                                        <button type="submit" name="delete<?= $item['id'] ?>" class="btn-sm btn-transparent float-right"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                    <?php deleteItem($item['id']);?>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal bottom fade" id="item-<?= $item['item'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= itemDetails($item['item'])['name'] ?>" aria-hidden="true">
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
                                    <img src="/items/<?= itemDetails($item['item'])['picture'] ?> " alt="<?= itemDetails($item['item'])['name'] ?> ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                </div>
                                <div class="text-center mt-5 float-right ml-5">
                                    <h6 class="gold-color-text"><?= itemDetails($item['item'])['name'] ?></h6>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <form class="col-sm-12" method="post">
                                    <input type="hidden" name="item" value="<?= $item['item'] ?>">
                                    <input type="hidden" name="price" value="<?= itemDetails($item['item'])['price'] ?>">
                                    <div class="md-form text-center">
                                        <input type="number" id="quantity" class="form-control" name="quantity" value="<?= $item['quantity'] ?>">
                                        <label for="quantity">Quantity</label>
                                    </div> 
                                    <div class="text-center">
                                        <button type="submit" name="updateCart<?= $item['item'] ?>" class="btn btn-gold ml-2 mt-3">Update Item</button>
                                    </div>
                                    <?php updateCart($item['item']);?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach; 
                else:
            ?>
            <h4 class="dark-color-text text-center mt-5">Nothing to see here</h4>
            <?php endif;?>
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
                <li class="nav-item ml-2">
                    <a class="nav-link tabs-text" href="#" aria-selected="false">
                        <form method="post">
                            <button type="submit" name="makePayment" class="btn-md btn-transparent gold-color-text font-weight-bold"><h6><i class="far fa-credit-card"></i> Pay</h6></button>
                        </form>
                        <?php makePayment(); ?>
                    </a>
                </li>
            </ul>
            <div class="container">
                <?php 
                    $items = getAnd('requests', 'session', '=', $session, 'status', '=', 'unpaid');  
                    if(count($items) > 0):
                    foreach ($items as $item): 
                ?>
                <div class="row col-sm-10">
                    <div class="card card-body mb-4">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="market-icon float-left">
                                    <img src="/items/<?= itemDetails($item['item'])['picture'] ?>" alt="<?= itemDetails($item['item'])['name'] ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <h6 class="gold-color-text mt-5 p-2"><?= itemDetails($item['item'])['name']. " (" . $item['quantity'] . ")" ?></h6>
                            </div>
                            <div class="col-xs-4">
                                <div class="mt-5 p-2 right-texts">
                                    <a href="#" data-toggle="modal" data-target="#item-<?= $item['item'] ?>">
                                        <i class="fas fa-pencil-alt gold-color-text float-right"></i>
                                    </a>
                                    <form method="post">
                                        <div class="text-right">
                                            <button type="submit" name="delete<?= $item['id'] ?>" class="btn-sm btn-transparent float-right"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        <?php deleteItem($item['id']);?>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal bottom fade" id="item-<?= $item['item'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= itemDetails($item['item'])['name'] ?>" aria-hidden="true">
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
                                        <img src="/items/<?= itemDetails($item['item'])['picture'] ?> " alt="<?= itemDetails($item['item'])['name'] ?> ?>" class="img-thumbnail" style="height: 100px; width: 150px;">
                                    </div>
                                    <div class="text-center mt-5 float-right ml-5">
                                        <h6 class="gold-color-text"><?= itemDetails($item['item'])['name'] ?></h6>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <form class="col-sm-12" method="post">
                                        <input type="hidden" name="item" value="<?= $item['item'] ?>">
                                        <input type="hidden" name="price" value="<?= itemDetails($item['item'])['price'] ?>">
                                        <div class="md-form text-center">
                                            <input type="number" id="quantity" class="form-control" name="quantity" value="<?= $item['quantity'] ?>">
                                            <label for="quantity">Quantity</label>
                                        </div> 
                                        <div class="text-center">
                                            <button type="submit" name="updateCart<?= $item['item'] ?>" class="btn btn-gold ml-2 mt-3">Update Item</button>
                                        </div>
                                        <?php updateCart($item['item']);?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        endforeach; 
                    else:
                ?>
                <h4 class="dark-color-text text-center mt-5">Nothing to see here</h4>
                <?php endif;?>
            </div>
        </div>
    </main>
    
<?php include './includes/footer.php';?>