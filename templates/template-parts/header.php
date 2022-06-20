<?php
/**
* This template for displaying the site header in header.php.
*
* Override this template by copying it to yourtheme/templates/template_parts/header.php
*
* @author 		GazLab
* @package 	ndnation
* @version     2.1.0
*/
?>
	

	<header id="masthead" class="site-header" role="banner">
		<?php get_template_part( 'templates/template-parts/top-bar-navigation'); ?>
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
		<div class="main-navigation">
			<div class="container-fluid">
				<div class="site-header-inner">

					<?php 
						$header_image = get_header_image();
						if ( ! empty( $header_image ) ) { 
							$blog_name = get_bloginfo( 'name');
					?>
						<h1 alt="<?php echo $blog_name ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
							</a>
						</h1>
					<?php 
						} // end if ( ! empty( $header_image ) ) 
					?>


					<div class="site-branding navbar-left">
						<p class="site-description lead"><?php bloginfo( 'description' ); ?></p>
					</div>

				</div>
				<?php get_template_part( 'templates/template-parts/site-navigation'); ?>
			</div>
		</div><!-- .container -->
	</header><!-- #masthead -->
