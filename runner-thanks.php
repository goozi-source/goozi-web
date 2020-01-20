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
        <div class="container other-container">
            <hr class="my-5 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h1 class="mb-4 text-center gold-color-text"><i class="fas fa-check-circle fa-3x"></i></h1>
                    <p class="gold-color-text text-center">Thank you for signing up, an email would be sent to you with your pin once your application has been vetted and you meet our requirements</p>
                </div>
            </section>
        </div>
    </main>
<?php include './includes/footer.php';?>