<?php
/**
 * @package ndnation
 */
?>


<?php // Styling Tip!

// Want to wrap for example the post content in blog listings with a thin outline in Bootstrap style?
// Just add the class "panel" to the article tag here that starts below.
// Simply replace post_class() with post_class('panel') and check your site!
// Remember to do this for all content templates you want to have this,
// for example content-single.php for the post single view. ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h2 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ndnation_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() ){ // Only display Excerpts for Search and Archive Pages ?>
	<div class="entry-summary row">
		<div class="col-sm-12">
			<?php
				if(has_post_thumbnail()){
      ?>
          <div class="col-xs-12 col-sm-4 col-md-4 nopad-l">
            <?php the_post_thumbnail(); ?>
          </div>
      <?php
        } else {
          if(first_image_post_content() != ''){
			?>
						<div class="col-xs-12 col-sm-4 col-md-4 nopad-l">
							<img src="<?php echo first_image_post_content(); ?>">
						</div>
			<?php	
				  }
        }
			?>
			<div class="post-excerpt">
				<?php //custom_excerpt(120, 'Full Notre Dame Column'); ?>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div><!-- .entry-summary -->
	<?php } else { ?>
	<div class="entry-content row">
		<div class="col-sm-12">
			<?php
				if(has_post_thumbnail()){
      ?>
          <div class="col-xs-3 col-sm-3 col-md-3 nopad-l">
            <?php the_post_thumbnail(); ?>
          </div>
      <?php
        } else {
          if(first_image_post_content() != ''){
			?>
						<div class="col-xs-3 col-sm-3 col-md-3 nopad-l">
							<img src="<?php echo first_image_post_content(); ?>">
						</div>
			<?php	
				  }
        }
			?>
			<div class="post-excerpt">
				<?php //custom_excerpt(120, 'Full Notre Dame Column'); ?>
				<?php the_excerpt(); ?>
			</div>
		</div>
		<?php ndnation_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php } ?>
</article><!-- #post-## -->
