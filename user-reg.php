<?php
	include './includes/head.php';
	include './includes/nav.php';
    userSignup();
?>
<body>
    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section other-banner">
            <div class="banner-text text-center">
                 <img src="/img/logo.png">
            </div>
        </div>
        <div class="container other-container">
            <hr class="my-5 mobile-hr">
            <section class="login-section mb-4">
                <div class="col-sm-6 mx-auto ml-auto">
                <h3 class="mb-4 text-center gold-color-text">Let's set up your profile</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="mobileForm">
                                <div class="md-form">
                                    <input type="text" class="form-control" name="fname" id="fname">
                                    <label for="fname">First Name</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="lname" id="lname">
                                    <label for="lname">Last Name</label>
                                </div>
                                <div class="md-form">
                                    <input type="email" class="form-control" name="email" id="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="md-form">
                                    <textarea name="address" id="address" class="md-textarea form-control"></textarea>
                                    <label for="address">Address</label>
                                </div>
                                <p class="text-muted">This would be your default delivery address unless otherwise specified at checkout</p>
                                <div class="md-form">
                                    <input name="password" id="password" type="password" class="form-control">
                                    <label for="password">Password</label>
                                </div>
                                <div class="md-form">
                                    <input name="cpassword" id="cpassword" type="password" class="form-control">
                                    <label for="cpassword">Confirm Password</label>
                                </div>
                                <div class="text-center mt-4 mb-4" id="message">
                                    <?php if (isset($_SESSION['userReg_error'])): ?>
                                        <?= $_SESSION['userReg_error']; ?>
                                    <?php elseif(isset($_SESSION['userReg_success'])): ?>
                                        <?= $_SESSION['userReg_success']; ?>
                                    <?php endif ?>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-md signup-btn" type="submit" name="userSignup">
                                        Sign Up
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <main id="web-view" style="display: none;">
        <section class="login-section mb-4">
            <div class="col-sm-6 mx-auto ml-auto">
            <h3 class="mb-4 text-center gold-color-text">Let's set up your profile</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="webForm">
                            <div class="md-form">
                                <input type="text" class="form-control" name="fname" id="wfname">
                                <label for="wfname">First Name</label>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="lname" id="wlname">
                                <label for="wlname">Last Name</label>
                            </div>
                            <div class="md-form">
                                <input type="email" class="form-control" name="email" id="wemail">
                                <label for="wemail">Email</label>
                            </div>
                            <div class="md-form">
                                <input type="number" class="form-control" name="phone" id="wphone">
                                <label for="wphone">Phone</label>
                            </div>
                            <div class="md-form">
                                <textarea name="address" id="waddress" class="md-textarea form-control"></textarea>
                                <label for="waddress">Address</label>
                            </div>
                            <p class="text-muted">This would be your default delivery address unless otherwise specified at checkout</p>
                            <div class="md-form">
                                <input name="password" id="wpassword" type="password" class="form-control">
                                <label for="wpassword">Password</label>
                            </div>
                            <div class="md-form">
                                <input name="cpassword" id="wcpassword" type="password" class="form-control">
                                <label for="wcpassword">Confirm Password</label>
                            </div>
                            <div class="text-center mt-4 mb-4" id="wmessage">
                                <?php if (isset($_SESSION['userReg_error'])): ?>
                                    <?= $_SESSION['userReg_error']; ?>
                                <?php elseif(isset($_SESSION['userReg_success'])): ?>
                                    <?= $_SESSION['userReg_success']; ?>
                                <?php endif ?>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-md signup-btn" type="submit" name="userSignup">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include './includes/footer.php';?>