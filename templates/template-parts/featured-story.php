<?php
	$args = array(
		'post_type' 	 => 'post',
		'posts_per_page' => 1,
    'category_name' => 'featured',
		'orderby' 		 => 'date',
		'order' 		 => 'DESC'
	);
	$loop = new WP_Query($args);
	if($loop->have_posts()){
?>
  	<div class="feat-posts-container">
    <?php
  		while($loop->have_posts()){
  			$loop->the_post();
    ?>
  			<article id="feat-post-<?php the_ID(); ?>" <?php post_class(); ?>>
  				<div class="row">
  					<header>
              <h2 class="feat-article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              <div class="feat-entry-meta">
                <?php ndnation_posted_on(); ?>
              </div><!-- .entry-meta -->
            </header>
            <div class="feat-post-excerpt col-xs-9 col-sm-9 col-md-9 nopad-l">
              <?php custom_excerpt(120, 'Full Notre Dame Column'); ?>
            </div>
            <?php
              if(has_post_thumbnail()){
            ?>
                <div class="col-xs-3 col-sm-3 col-md-3 nopad-r">
                  <?php the_post_thumbnail(); ?>
                </div>
            <?php
              } else {
                if(first_image_post_content() != ''){
            ?>
                  <div class="col-xs-3 col-sm-3 col-md-3 nopad-r">
                    <img src="<?php echo first_image_post_content(); ?>">
                  </div>
            <?php 
                }
              }
            ?>
  				</div>
  			</article>
    <?php	
  		}
    ?>
  	</div>
<?php
	}
?>