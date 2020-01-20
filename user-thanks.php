<?php 
	include './includes/head.php';
    authenticateUser();
	include './includes/nav.php';
?>
<body >
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section">
            <div class="banner-text other-banner text-center">
                 <img src="/img/logo.png">
            </div>
        </div>
        <div class="container other-container z-depth-4" style="margin-top: -20%!important">
            <hr class="my-5 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h2 class="mb-4 text-center gold-color-text"><i class="fas fa-check-circle fa-3x"></i></h2>
                    <h1 class="gold-color-text text-center">Your account is all set up now!</h1>
                    <hr class="mobile-hr">
                    <h4 class="text-center mb-4 gold-color-text">Here's how to use goozi</h4>
                    <div class="mt-3 text-center">
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span>Login</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> Choose Market</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> Select Items</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> A runner is assigned to you</p>
                        <a href="/user/home" class="btn btn-gold">Proceed</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <main id="web-view" style="display: none;">
        <div class="banner-section">
            <div class="banner-text other-banner">
                <h3><?= AppName() ?></h3>
            </div>
        </div>
        <div class="container other-container z-depth-4 mt-2">
            <hr class="my-5 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h2 class="mb-4 text-center gold-color-text"><i class="fas fa-check-circle fa-3x"></i></h2>
                    <h1 class="gold-color-text text-center">Your account is all set up now!</h1>
                    <hr class="mobile-hr">
                    <h4 class="text-center mb-4 gold-color-text">Here's how to use goozi</h4>
                    <div class="mt-3 text-center">
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span>Login</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> Choose Market</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> Select Items</p>
                        <p class="gold-color-text"><span class="float-left mr-2"> <i class="fas fa-circle"></i></span> A runner is assigned to you</p>
                        <a href="/user/home" class="btn btn-gold">Proceed</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
<?php include './includes/footer.php';?>