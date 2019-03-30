<div class="topbar">
	<div class="topbar-inner">
		<div class="container-fluid"><a class="brand" href="dashboard.php">CMS - Eagle Business Brokers</a>
			<ul class="nav">
				<li <?php if($menu == 'Dashboard') echo 'class="active"'; ?>><a href="dashboard.php">Home</a></li>
				<li <?php if($menu == 'Users') echo 'class="active"'; ?>><a href="users.php">Users</a></li>
				<li <?php if($menu == 'Offices') echo 'class="active"'; ?>><a href="offices.php">Offices</a></li>
				<li <?php if($menu == 'Testimonials') echo 'class="active"'; ?>><a href="testimonials.php">Testimonials</a></li>
				<li <?php if($menu == 'Brokers') echo 'class="active"'; ?>><a href="brokers.php">Brokers</a></li>
				<li <?php if($menu == 'Listings') echo 'class="active"'; ?>><a href="listings.php">Listings</a></li>
				<li <?php if($menu == 'Blogs') echo 'class="active"'; ?>><a href="blogs.php">Blogs</a></li>
				<li <?php if($menu == 'News') echo 'class="active"'; ?>><a href="news.php">News</a></li>
				<li <?php if($menu == 'Resources') echo 'class="active"'; ?>><a href="resources.php">Resources</a></li>
				<li <?php if($menu == 'Settings') echo 'class="active"'; ?>><a href="frmSettings.php">Settings</a></li>
			</ul>
			<p class="pull-right"><a href="logout.php">Logout</a></p>
		</div>
	</div>
</div>