<?php 
	include './includes/head.php';
	include './includes/nav.php';
?>
<body >
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section">
            <div class="banner-text other-banner">
                <h3><?= AppName() ?></h3>
            </div>
        </div>
        <div class="container other-container z-depth-4" style="margin-top: -20%!important">
            <hr class="my-5 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h2 class="mb-4 text-center gold-color-text"><i class="fas fa-check-circle fa-3x"></i></h2>
                    <h3 class="gold-color-text text-center">Your order #<?= $_GET['reference']; ?> has been received!</h3>
                    <hr class="mobile-hr">
                    <div class="mt-3 text-center">
                        <div class="table-responsive table-responsive text-nowrap">
                            <table class="table bg-transparent table-borderless">
                                <thead>
                                    <tr class="gold-color-text text-center">
                                        <th scope="col">Image</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="ml-2">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $items = getWhere('requests', 'batch', '=', $_GET['reference'], 'status', '=', 'paid');  
                                        if(count($items) > 0):
                                        foreach ($items as $item): 
                                    ?>
                                    <tr class="gold-color-text text-center border-bottom-1 bottom-gold">
                                        <td>
                                            <img src="/items/<?= itemDetails($item['item'])['picture'] ?>" alt="<?= itemDetails($item['item'])['name'] ?>" class="img-thumbnail" style="height: 50px; width: 70px;">
                                        </td>
                                        <td> <?= itemDetails($item['item'])['name'];?></td>
                                        <td><?=$item['quantity']?></td>
                                        <td> <?=$item['amount']?></td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    </main>
    <main id="web-view" style="display: none;">
        <div class="login-section">
            <div class="container other-container z-depth-4 mt-2">
                <hr class="my-5 hr">
                <section class="login-section">
                    <div class="col-sm-6 mx-auto ml-auto">
                        <h2 class="mb-4 text-center gold-color-text"><i class="fas fa-check-circle fa-3x"></i></h2>
                        <h3 class="gold-color-text text-center">Your order #<?= $_GET['reference']; ?> has been received!</h3>
                        <hr class="mobile-hr">
                        <div class="mt-3 text-center">
                            <div class="table-responsive table-responsive text-nowrap">
                                <table class="table bg-transparent table-borderless">
                                    <thead>
                                        <tr class="gold-color-text text-center">
                                            <th scope="col">Image</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col" class="ml-2">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $items = getWhere('requests', 'batch', '=', $_GET['reference'], 'status', '=', 'paid');  
                                            if(count($items) > 0):
                                            foreach ($items as $item): 
                                        ?>
                                        <tr class="gold-color-text text-center border-bottom-1 bottom-gold">
                                            <td>
                                                <img src="/items/<?= itemDetails($item['item'])['picture'] ?>" alt="<?= itemDetails($item['item'])['name'] ?>" class="img-thumbnail" style="height: 50px; width: 70px;">
                                            </td>
                                            <td> <?= itemDetails($item['item'])['name'];?></td>
                                            <td><?=$item['quantity']?></td>
                                            <td> <?=$item['amount']?></td>
                                        </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
<?php include './includes/footer.php';?>