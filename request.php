<?php 
	include './includes/head.php';
    authenticateUser();
	include './includes/nav.php';
    $requests = getWhere('requestStatus', 'batch', '=', $_GET['reference']);
    $request = array_shift($requests);
    $runners = getWhere('runners', 'email', '=', $_SESSION['email']);
    $runner = array_shift($runners); 
?>
<body >
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section">
            <div class="banner-text other-banner">
                <h3><?= AppName() ?></h3>
            </div>
        </div>
        <div class="container other-container z-depth-2" style="margin-top: -20%!important">
            <hr class="my-5 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h3 class="gold-color-text text-center">#<?= $_GET['reference']; ?></h3>
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
                                        <th scope="col">Market</th>
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
                                        <td> <?= marketDetails($item['market'])['market']?></td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php if ($request['runner'] != $runner['id']): ?>
        <div class="row">
            <div class="col-xs-9 ml-auto mx-auto">
                <form method="post" class="text-center">
                    <input type="hidden" name="status" value="active">
                    <input type="hidden" name="batch" value="<?=$_GET['reference'];?>">
                    <input type="hidden" name="id" value="<?= $runner['id'] ?>">
                    <input type="hidden" name="stat" value="Runner Assigned">
                    <button type="submit" name="setStatus" class="btn btn-lg btn-transparent z-depth-3" style="border-radius: 50%; height: 100px; width: 100px;">
                        <i class="far fa-check-circle fa-3x text-success font-weight-bold ml-n2"></i>
                    </button>
                    <?php setStatus(); ?>
                </form>
            </div>
        </div>
        <?php elseif ($request['runner'] == $runner['id'] && $request['status'] != 'completed'): ?>
        <div class="row">
            <div class="col-xs-9 ml-auto mx-auto mt-3">
                <form method="post" class="text-center">
                    <input type="hidden" name="batch" value="<?=$_GET['reference'];?>">
                    <select class="custom-select browser-default" name="status">
                        <option>Set you current status</option>
                        <option value="enroute-market">Enroute Market</option>
                        <option value="picking-up">Picked up From Market</option>
                        <option value="delivering">Delivering to Requester</option>'
                        <option value="completed">Delivered</option>
                    </select>
                    <button type="submit" name="setStatus" class="btn btn-lg btn-gold mt-3">Set Status</button>
                    <?php setStatus(); ?>
                </form>
            </div>
        </div>
        <?php endif ?>
        
    </main>
<?php include './includes/footer.php';?>