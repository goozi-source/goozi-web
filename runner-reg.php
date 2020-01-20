<?php  
	include './includes/head.php';
	include './includes/nav.php';
?>
<body>

    <!--Main layout-->
    <main id="mobile-view" style="display: none;">
        <div class="banner-section other-banner">
            <div class="banner-text text-center">
                <img class="img-fluid" src="/img/logo.png">
            </div>
        </div>
        
        <div class="container other-container">
            <hr class="my-5 mobile-hr">
            <section class="login-section mb-4">
                <div class="col-sm-6 mx-auto ml-auto">
                    <h3 class="mb-4 text-center gold-color-text">Runner Sign Up</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="#">
                                <div class="md-form">
                                    <input type="text" class="form-control" name="fname" id="fname">
                                    <label for="fname">First Name</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="mname" id="mname">
                                    <label for="mname">Middle Name</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="lname" id="lname">
                                    <label for="lname">Last Name</label>
                                </div>
                                <label for="dob" class="mb-1 text-dark">Date Of Birth</label>
                                <div class="md-form">
                                    <input type="date" class="form-control" name="dob" id="dob">
                                </div>
                                <div class="md-form">
                                    <input type="number" class="form-control" name="bvn" id="bvn">
                                    <label for="bvn">BVN</label>
                                </div>
                                <div class="md-form">
                                    <select name="gender" id="gender" class="browser-default custom-select">
                                        <option>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="mstatus" id="mstatus">
                                    <label for="mstatus">Marital Status</label>
                                </div>
                                <div class="md-form">
                                    <input type="number" class="form-control" name="kids" id="kids">
                                    <label for="kids">Number Of Kids</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" class="form-control" name="religion" id="religion">
                                    <label for="religion">Religion</label>
                                </div>
                                <div class="md-form">
                                    <textarea name="address" id="address" class="md-textarea form-control"></textarea>
                                    <label for="address">Address</label>
                                </div>
                                <div class="md-form">
                                    <input type="email" class="form-control" name="email" id="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="text-center mb-3">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn btn-gold btn-md">upload police report</button>
                                        <input type="file" name="police" id="police" required>
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn btn-gold btn-md">upload passport photograph</button>
                                        <input type="file" name="picture" id="picture" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="runnerSignup" class="btn btn-md signup-btn">
                                        Sign Up
                                    </button>
                                </div>
                                <?php runnerSignup(); ?>
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
                <h3 class="mb-4 text-center gold-color-text">Runner Sign Up</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="#">
                            <div class="md-form">
                                <input type="text" class="form-control" name="fname" id="fname">
                                <label for="fname">First Name</label>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="mname" id="mname">
                                <label for="mname">Middle Name</label>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="lname" id="lname">
                                <label for="lname">Last Name</label>
                            </div>
                            <label for="dob" class="mb-1 text-dark">Date Of Birth</label>
                            <div class="md-form">
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                            <div class="md-form">
                                <input type="number" class="form-control" name="bvn" id="bvn">
                                <label for="bvn">BVN</label>
                            </div>
                            <div class="md-form">
                                <select name="gender" id="gender" class="browser-default custom-select">
                                    <option>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="mstatus" id="mstatus">
                                <label for="mstatus">Marital Status</label>
                            </div>
                            <div class="md-form">
                                <input type="number" class="form-control" name="kids" id="kids">
                                <label for="kids">Number Of Kids</label>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="religion" id="religion">
                                <label for="religion">Religion</label>
                            </div>
                            <div class="md-form">
                                <textarea name="address" id="address" class="md-textarea form-control"></textarea>
                                <label for="address">Address</label>
                            </div>
                            <div class="md-form">
                                <input type="email" class="form-control" name="email" id="email">
                                <label for="email">Email</label>
                            </div>
                            <div class="md-form">
                                <input type="number" class="form-control" name="phone" id="phone">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="text-center mb-3">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn-gold btn-md">upload police report</button>
                                    <input type="file" name="police" id="police" required>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn-gold btn-md">upload passport photograph</button>
                                    <input type="file" name="picture" id="picture" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="runnerSignup" class="btn btn-md signup-btn">
                                    Sign Up
                                </button>
                            </div>
                            <?php runnerSignup(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include './includes/footer.php';?>