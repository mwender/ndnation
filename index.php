<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ndnation
 */

get_header(); ?>

<?php 
	if(is_home() && get_option( 'page_for_posts' )){ 
?>
		<h1 class="page-title"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
<?php	
	} 
	if ( have_posts() ){
		while ( have_posts() ) { 
			the_post();
			get_template_part( 'content', get_post_format() );
		} 
		ndnation_pagination(); 
	} else { 
		get_template_part( 'no-results', 'index' );
	} 
get_sidebar();
get_footer();