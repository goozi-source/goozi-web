<?php 
	include './includes/head.php';
	include './includes/nav.php';
?>
<body >

    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section">
            <div class="banner-text other-banner login-ban text-center">
                 <img src="/img/logo.png">
            </div>
        </div>
        <div class="container other-container login-cont">
            <hr class="my-5 mobile-hr">
            <section class="login-section login-sec">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h3 class="mb-4 text-center gold-color-text">Runner Login</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="md-form">
                                    <input type="email" class="form-control" name="email" id="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form">
                                    <input type="password" class="form-control" name="password" id="password">
                                    <label for="password">Pin</label>
                                </div>
                                <div class="mt-4 mb-4 text-center">
                                    <?php if(isset($_SESSION['runnerLogin'])): ?>
                                        <?= $_SESSION['runnerLogin'] ?>
                                    <?php endif;?>
                                </div>
                                <div class="text-center mb-3">
                                    <button class="btn btn-md login-btn" name="runnerLogin" type="submit">
                                        Login
                                    </button>
                                </div>
                                <?php runnerLogin(); ?>
                                <p class="color-text text-center">Don't have an account? <a href="/runner-reg">Register Now!</a></p>   
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
<?php include './includes/footer.php';?>