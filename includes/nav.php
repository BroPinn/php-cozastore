<header class="header-v4">
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->
		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					Free shipping for standard order over $100
				</div>

				<div class="right-top-bar flex-w h-full">
					<a href="#" class="flex-c-m trans-04 p-lr-25">
						Help & FAQs
					</a>

					<a href="#" class="flex-c-m trans-04 p-lr-25">
						My Account
					</a>

					<a href="#" class="flex-c-m trans-04 p-lr-25">
						EN
					</a>

					<a href="#" class="flex-c-m trans-04 p-lr-25">
						USD
					</a>
				</div>
			</div>
		</div>

		<div class="wrap-menu-desktop how-shadow1">
			<nav class="limiter-menu-desktop container">

				<!-- Logo desktop -->
				<a href="#" class="logo">
					<img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/icons/logo-01.png" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li class="<?= urlIs('index.php') ? 'active-menu' : '' ?>">
							<a href="index.php?page=index">Home</a>
						</li>

						<li class="<?= urlIs('shop.php') ? 'active-menu' : '' ?>">
							<a href="index.php?page=shop">Shop</a>
						</li>

						<li class="<?= urlIs('checkout.php') ? 'active-menu' : '' ?> label1" data-label1="hot">
							<a href="index.php?page=checkout">Features</a>
						</li>

						<li class="<?= urlIs('blog.php') ? 'active-menu' : '' ?>">
							<a href="index.php?page=blog">Blog</a>
						</li>

						<li class="<?= urlIs('about.php') ? 'active-menu' : '' ?>">
							<a href="index.php?page=about">About</a>
						</li>

						<li class="<?= urlIs('contact.php') ? 'active-menu' : '' ?>">
							<a href="index.php?page=contact">Contact</a>
						</li>
					</ul>
				</div>

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
						<i class="zmdi zmdi-search"></i>
					</div>

					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>

					<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
				</div>
			</nav>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->
		<div class="logo-mobile">
			<a href="index.php"><img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/icons/logo-01.png" alt="IMG-LOGO"></a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
				<i class="zmdi zmdi-search"></i>
			</div>

			<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" id="shoptxt" data-notify="0">
				<i class="zmdi zmdi-shopping-cart"></i>
			</div>

			<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
				<i class="zmdi zmdi-favorite-outline"></i>
			</a>
		</div>

		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<ul class="topbar-mobile">
			<li>
				<div class="left-top-bar">
					Free shipping for standard order over $100
				</div>
			</li>

			<li>
				<div class="right-top-bar flex-w h-full">
					<a href="#" class="flex-c-m p-lr-10 trans-04">
						Help & FAQs
					</a>

					<a href="#" class="flex-c-m p-lr-10 trans-04">
						My Account
					</a>

					<a href="#" class="flex-c-m p-lr-10 trans-04">
						EN
					</a>

					<a href="#" class="flex-c-m p-lr-10 trans-04">
						USD
					</a>
				</div>
			</li>
		</ul>

		<ul class="main-menu-m">
			<li class="<?= urlIs('index.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=index">Home</a>
			</li>

			<li class="<?= urlIs('shop.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=shop">Shop</a>
			</li>

			<li class="<?= urlIs('checkout.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=checkout" class="label1 rs1" data-label1="hot">Features</a>
			</li>

			<li class="<?= urlIs('blog.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=blog">Blog</a>
			</li>

			<li class="<?= urlIs('about.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=about">About</a>
			</li>

			<li class="<?= urlIs('contact.php') ? 'active-menu' : '' ?>">
				<a href="index.php?page=contact">Contact</a>
			</li>
		</ul>
	</div>

	<!-- Modal Search -->
	<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
		<div class="container-search-header">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/icons/icon-close2.png" alt="CLOSE">
			</button>

			<form class="wrap-search-header flex-w p-l-15">
				<button class="flex-c-m trans-04">
					<i class="zmdi zmdi-search"></i>
				</button>
				<input class="plh3" type="text" name="search" placeholder="Search...">
			</form>
		</div>
	</div>
</header>