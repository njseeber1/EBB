<?php
	switch($menu){
		case 'Main Links':
			include_once('bll/main_links.php');
			$ml = new MainLinks();
			$ml->setCompanyId(1);
			$dtSideMenus = $ml->GetMenus();
			break;
		case 'Home Links':
			include_once('bll/homelinks.php');
			$homelink = new HomeLinks();
			$homelink->setCompanyId(1);
			$dtSideMenus = $homelink->GetMenus();
			break;
	}
?>
<div class="container-fluid">
	<div class="sidebar">
		<div class="well">
			<ul>
				<?php					
					switch($menu){
						case 'Users':
							echo '<li><a href="newUser.php">New User</a></li>';
							break;
						case 'Offices':
							echo '<li><a href="frmOffice.php">New Office</a></li>';
							break;
						case 'Blogs':
							echo '<li><a href="frmBlogs.php">New Blog</a></li>';
							break;
						case 'Testimonials':
							echo '<li><a href="frmTestimonials.php">New Testimonial</a></li>';
							break;
						case 'Brokers':
							echo '<li><a href="frmBrokers.php">New Broker</a></li>';
							break;
						case 'Listings':
							echo '<li><a href="frmListings.php">New Listing</a></li>';
							break;							
						case 'Resources':
							echo '<li><a href="frmResources.php">New Resource</a></li>';							
							break;
						case 'News':
							echo '<li><a href="frmNews.php">Add News</a></li>';
							break;
						case 'Page Links':
							echo '<li><a href="frmPageLinks.php">New Page Link</a></li>';							
							break;			
						case 'Settings':
							echo '<li><a href="frmSettings.php">Manage Settings</a></li>';							
							break;								
					}
					for($cnt=0; $cnt<count($dtSideMenus); $cnt++){
						echo '<li>'.$dtSideMenus[$cnt]->menu.'</li>';
					}
				?>
			</ul>
		</div>
	</div>
</div>