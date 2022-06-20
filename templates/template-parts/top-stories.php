<?php
	$cat_obj = get_category_by_slug('featured');
  $exclude = $cat_obj->cat_ID;
  $args = array(
		'post_type' 	 => 'post',
		'posts_per_page' => 5,
		'orderby' 		 => 'date',
		'order' 		 => 'DESC',
    // 'category__not_in' => array( $exclude )
	);
	$loop = new WP_Query($args);
	if($loop->have_posts()){
?>
  	<div class="posts-container section">
    <?php
  		while($loop->have_posts()){
  			$loop->the_post();
    ?>
  			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header>
            <h4 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
            <!-- <div class="entry-meta"> -->
              <?php //ndnation_posted_on(); ?>
            <!-- </div> .entry-meta -->
          </header>
					<div class="post-excerpt">
						<?php //custom_excerpt(50, 'Full Notre Dame Column'); ?>
            <?php the_excerpt(); ?>
					</div>
  			</article>
    <?php	
  		}
    ?>
      <div class="text-center">
        <a class="btn" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">View More</a>
      </div>
  	</div>
<?php
	}
?>
