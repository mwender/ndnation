<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package ndnation
 */
$site_name = get_field('site_name', 'option');
?>

	<?php get_template_part( 'templates/template-parts/main-content-wrapper-end'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
		<div class="container-fluid">
			<div class="row">
				<div class="site-footer-inner col-sm-12">

					<div class="site-info">
						&copy; <?php echo date('Y'); ?> <?php echo $site_name; ?>, All Rights Reserved | <a href="/privacy-policy" title="Review NDNation's Privacy Policy">Privacy Policy</a> | <a href="/advertise" title="Advertise with NDNation">Advertise</a>
					</div><!-- close .site-info -->
				</div>
			</div>
		</div><!-- close .container -->
	</footer><!-- close #colophon -->

	<?php 
		wp_footer(); 
		require("/home/elkabong/public_html/data/_phpinc/_foot_main.inc");
	?>

	</body>
	</html>
