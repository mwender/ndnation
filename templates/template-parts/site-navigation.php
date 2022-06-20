<?php
/**
* This template for displaying the navigation bar in the header.
*
* Override this template by copying it to yourtheme/templates/template_parts/site-navigation.php
*
* @author 	GazLab
* @package 	ndnation
* @version  2.1.1
*/
$keywords = ( isset( $_GET['s'] ) )? $_GET['s'] : null ;
?>

	<nav class="site-navigation">
		<div class="site-navigation-inner">
			<div class="navbar navbar-default">
				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location' 	=> 'primary',
						'depth'             => 2,
						//'container'         => 'div',
						'container'         => 'nav',
						'container_class'   => 'collapse navbar-collapse',
						'menu_class' 		=> 'nav navbar-nav',
						'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
						'menu_id'			=> 'main-menu',
						'walker' 			=> new wp_bootstrap_navwalker()
					)
				); ?>
				<div class="search-icon">
					<i class="fas fa-search"></i>
				</div>
				<div class="search-dropdown">
					<form role="search" method="get" id="searchform" class="searchform" action="/">
						<label class="screen-reader-text" for="s">Search for:</label>
						<input type="text" value="<?php echo $keywords; ?>" placeholder="Keywords" name="s" id="s">
						<input class="btn" type="submit" id="searchsubmit" value="Search">
					</form>
				</div>
			</div><!-- .navbar -->
		</div>
	</nav><!-- .site-navigation -->
