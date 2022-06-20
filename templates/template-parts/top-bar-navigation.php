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
?>
	<nav class="top-navigation">
		<div class="container-fluid">
			<div class="top-navigation-inner">
				<div class="navbar-right">
					<!-- The WordPress Menu goes here -->
					<?php include('social-media.php'); ?>
					<?php wp_nav_menu(
						array(
							'theme_location' 	=> 'top-menu',
							'depth'             => 2,
							//'container'         => 'div',
							'container'         => 'nav',
							'container_class'   => 'collapse navbar-collapse nopad-r',
							'menu_class' 		=> 'nav navbar-nav',
							'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
							'menu_id'			=> 'top-menu',
							'walker' 			=> new wp_bootstrap_navwalker()
						)
					); ?>
					<?php if(is_active_sidebar( 'top-nav-login-sidebar' )){ ?>
						<div class="top-nav-login-container">
							<?php dynamic_sidebar('top-nav-login-sidebar'); ?>
						</div>
					<?php } ?>
				</div><!-- .navbar -->
			</div>
		</div>
	</nav><!-- .site-navigation -->
