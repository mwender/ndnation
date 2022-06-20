<?php
/**
 * The Template for displaying all single posts.
 *
 * @author   GazLab
 * @package  ndnation
 * @version  2.1.1
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>
		
		<?php 
			if(is_active_sidebar( 'article-leaderboard-ad-slot-1' )){
				dynamic_sidebar('article-leaderboard-ad-slot-1');
			}
		?>

		<?php // ndnation_content_nav( 'nav-below' ); ?>
        <?php ndnation_pagination(); ?>
			
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>

	<?php endwhile; // end of the loop. ?>

<?php get_sidebar('articles'); ?>
<?php get_footer(); ?>