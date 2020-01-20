<?php 
	include './includes/head.php';
	include './includes/nav.php';
?>
<body>
    <!--Main layout-->
    <main id="mobile-view" style="display: none">
        <div class="banner-section">
            <div class="banner-text text-center">
                <img src="/img/logo.png">
            </div>
            <div class="banner-img">
            </div>
            <div class="man text-center">
                <img src="/img/woman.jpg">
            </div>
        </div>
        <div class="container">
            <hr class="my-3 mobile-hr">
            <section class="login-section">
                <div class="col-sm-6 mx-auto ml-auto">
                    <p class="text-center welcome-text">Welcome to GOOZI, the app that goes to the market in your behalf using exclusive runners</p>
                </div>
                <hr class="my-3 mobile-hr">
                <div class="row">
                    <div class="col-xs-6 mx-auto ml-auto">
                        <a href="/user-login" class="btn btn-md signup-btn">Proceed as user</a>
                    </div>
                    <div class="col-xs-6 mx-auto ml-auto">
                        <a href="/runner-login" class="btn btn-md signup-btn">Proceed as runner</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <main id="web-view" style="display: none;">
        <section class="login-section">
            <div class="col-sm-6 mx-auto ml-auto">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="gold-color-text">Welcome Back!</h5>
                        <hr class="my-5">
                        <form method="post">
                            <div class="md-form">
                                <input class="form-control" type="text" name="email" id="email">
                                <label for="email">Email address</label>
                            </div>  

                            <div class="md-form">
                                <input class="form-control" type="password" name="password" id="password">
                                <label for="password">Password</label>
                            </div>     
                            <div class="mt-4 mb-4 text-center">
                                <?php if(isset($_SESSION['userLogin'])): ?>
                                    <?= $_SESSION['userLogin'] ?>
                                <?php endif;?>
                            </div>
                            
                            <p class="color-text text-center">Don't have an account? <a href="/user-reg">Register Now!</a></p>   
                            <div class="text-center">
                                <button class="btn btn-md signup-btn" name="userLogin" type="submit">Login</button>
                            </div>
                            <?php userLogin(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--Main layout-->

<!--Footer-->
<?php include './includes/footer.php';?>