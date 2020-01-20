<nav class="navbar fixed-top navbar-expand-lg navbar-light" id="topNav" style="display: none;">
	<div class="container">

		<!-- Brand -->
		<a class="navbar-brand" href="/index">
			<strong class="font-effect-anaglyph headings">
				<h2><?php echo AppName(); ?></h2>
			</strong>
		</a>

		<!-- Collapse -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Links -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			</ul>
			<!-- Right -->
			
			<ul class="navbar-nav">
				<?php 
				    if (isset($_SESSION['email'])):
				?>
				<li class="nav-item ml-3">
					<a class="nav-link" href="/<?= $_SESSION['user_type'] ?>/home">Home
					</a>
				</li>
				<li class="nav-item ml-3">
					<a class="nav-link" href="/logout">Logout</a>
				</li>
				<?php elseif (!isset($_SESSION['email'])): ?>
				<li class="nav-item ml-3">
					<a class="nav-link" href="/index">Home
					</a>
				</li>
				<li class="nav-item ml-3">
					<a class="nav-link" href="/runner-reg">Runners</a>
				</li>
				<li class="nav-item ml-3">
					<a class="nav-link" href="/contact-us">Contact Us</a>
				</li>
				<li class="nav-item ml-5">
					<a href="/user-reg" class="nav-link ml-5 p-2 nav-buttons">
						<i class="fa fa-plus-circle mr-2"></i> Sign Up
					</a>
				</li>
				<?php endif ?>
			</ul>

		</div>

	</div>
</nav>

<!-- Navbar -->
<?php 
    if (isset($_SESSION['email'])):
?>
    <nav class="navbar fixed-bottom navbar-dark pt-2 text-center light-nav z-depth-2" id="bottomNav" style="display: none">
		<?php if (isset($_SESSION['user_type'])): ?>
			<?php if ($_SESSION['user_type'] == 'user'): ?>
                <a class="h4 float-left" title="Home" href="/user/home"><i class="fas fa-home"></i></a>
                <a class="h4" href="/user/cart">
                    <i class="fas fa-shopping-cart"></i>
                    <sup class="cart-icon">
                        <span class="badge badge-pill gold-bg"><?= countAnd('requests', 'session', '=', session_id(), 'status', '=', 'unpaid') ?></span>
                    </sup>
                </a>
			<?php elseif($_SESSION['user_type'] == 'runner'): ?>
				<a class="h4 float-left" title="Home" href="/runner/home"><i class="fas fa-home"></i></a>
			<?php endif ?>
		<?php endif ?>	
		<a href="javascript:history.back()" class="h4 float-right"><i class="fas fa-chevron-left"></i></a>
	</nav>

<?php else:?>
	<?php if ($_SERVER['REQUEST_URI'] == '/user-login' || $_SERVER['REQUEST_URI'] == '/user-reg' || $_SERVER['REQUEST_URI'] == '/runner-login' || $_SERVER['REQUEST_URI'] == '/runner-reg'): ?>
		<nav class="navbar fixed-bottom navbar-dark pt-2 pb-1 text-right light-nav z-depth-2" id="bottomNav" style="display: none">
			<a href="javascript:history.back()" class="h4 float-right"><i class="fas fa-chevron-left"></i></a>
		</nav>
	<?php elseif($_SERVER['REQUEST_URI'] == '/index' || $_SERVER['REQUEST_URI'] == '/'): ?>
	<?php else: ?>
		<nav class="navbar fixed-bottom navbar-dark pt-2 text-right light-nav z-depth-2" id="bottomNav" style="display: none">
			<a class="h4 float-left" title="Home" href="/index"><i class="fas fa-home"></i></a>
			<a href="javascript:history.back()" class="h4 float-right"><i class="fas fa-chevron-left"></i></a>
		</nav>
	<?php endif ?>
	<!-- Bottom NavBar -->
	
	<!-- End Bottom NavBar -->
<?php endif ?>
