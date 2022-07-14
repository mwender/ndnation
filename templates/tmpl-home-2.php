<?php
/*
Template Name: Home 2
*/
get_header();

	while(have_posts()){ 
		the_post(); 
?>
<style type="text/css">
	.video-placeholder{background-color: #eee; width: 1140px; height: 642px;}
	.container{padding-top: 20px; background-color: #fff; margin-bottom: 31px;}
	.hide-title .widget-title{display: none;}
	.home-hero .widget-title{display: none;}
	.row{margin-bottom: 1em;}
	.topper-wide{content: ' ';border-bottom: 4px solid #c99700;}
	.topper-wide h2{margin: 0; padding: 5px 10px; background-color: #c99700; color: #0c2340; font-size: 1.6em; font-weight: bold; border-bottom: 5px solid #fff;}
	.home-hero .topper-wide{margin-bottom: 1em;}
	#schedule-wrap{margin-top: 0;}
	#schedule-wrap .topper-wide{margin-bottom: 1em;}
	.rectangle-ad, .skyscraper-ad{background-color: rgba(224, 224, 224, .5); border: 1px solid rgba(224, 224, 224, 1); background-image: url('<?= THEME_DIR_URI ?>/images/ad-placeholder_1024x1024.png');background-size: contain;background-position: center center;background-repeat: no-repeat; margin-bottom: 1em;}
	.rectangle-ad{height: 280px;}
	.skyscraper-ad{height: 598px;}
	/*.row.news .widget .nl-list{min-height: 250px; display: flex; flex-direction: column; justify-content: space-between;}*/
	.row.home-hero .nl-title h3{margin-top: 0}
	.top-margin .custom-html-widget{margin-top: 1em;}
	@media (max-width: 1080px) {
		.row.home-hero .col-md-8{
			margin-bottom: 1em;
		}
	}
</style>
<?php
	if( is_active_sidebar( 'home-2-top-wide-ad-slot' ) ){ ?>
		<div class="row home-hero">
			<div class="col-md-12"><?php dynamic_sidebar('home-2-top-wide-ad-slot'); ?></div>
		</div><!-- .home-hero -->
<?php	} ?>
<div class="container">
	<?php
	/**
	 * LATEST POSTS TEMPLATE
	 *
	 * This is a completely self-contained row. Add this code
	 * in between rows in tmpl-home-2.php.
	 */
	get_template_part( 'templates/template-parts/home-2', 'latest-posts' );
	?>
	<?php
		if( is_active_sidebar( 'home-2-top' ) ){ ?>
			<div class="row home-hero">
				<div class="col-md-12"><?= dynamic_sidebar('home-2-top'); ?></div>
			</div><!-- .home-hero -->
	<?php	} ?>
	<?php
	/**
	 * 2/3 + 1/3 Row
	 *
	 * Great for:
	 *
	 * - Video in 2/3 column
	 * - Schedule in 1/3 column
	 */
	if( is_active_sidebar( 'home-2-top-left-two-thirds' ) || is_active_sidebar( 'home-2-top-left-one-third' ) ){ ?>
			<div class="row home-hero">
				<div class="col-md-8">
					<?php dynamic_sidebar('home-2-top-left-two-thirds'); ?>
				</div>
				<div class="col-md-4">
		      <div class="topper-wide">
		        <h2>Latest News</h2>
		      </div>
		      <div>
						<?php dynamic_sidebar('home-2-top-left-one-third'); ?>
					</div>
				</div>
			</div><!-- .home-hero -->
	<?php	} ?>
	<?php if( is_active_sidebar( 'home-2-news-row' ) ): ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="topper-wide">
        <h2>Latest News</h2>
      </div>
    </div>
  </div>
  <div class="row news"><?php dynamic_sidebar( 'home-2-news-row' ); ?></div>
	<?php endif; ?>
	<?php if( is_active_sidebar( 'home-2-news-row-one-third') || is_active_sidebar( 'home-2-news-row-two-thirds') ): ?>
	<div class="row news">
    <div class="col-md-4">
    	<?php dynamic_sidebar( 'home-2-news-row-one-third' ); ?>
  	</div>
    <div class="col-md-8">
      <div class="topper-wide">
          <h2>More News</h2>
      </div>
      		<style type="text/css">
		      	.news-grid{
		      		display: grid;
		      		grid-template-columns: repeat(auto-fill, minmax(33%, 1fr)); /* see notes below */
		      		gap: 1.5em;
		      	}
		      	.news-grid:before{
		      		display: none;
		      	}
		      	@media screen and (max-width: 768px) {
		      		.news-grid{
		      			display: block;
		      		}
		      	}
		      </style>
      <div class="news news-grid" id="grid"><?php dynamic_sidebar( 'home-2-news-row-two-thirds' ); ?></div>
    </div>
  </div><!-- .row -->
	<?php endif; ?>
	<div class="row">
		<div class="col-md-4">
			<?php
				if( is_active_sidebar( 'home-2-column-1' ) ){
					dynamic_sidebar( 'home-2-column-1' );
				}
			?>
		</div>
		<div class="col-md-4">
			<?php
				if( is_active_sidebar( 'home-2-column-2' ) ){
					dynamic_sidebar( 'home-2-column-2' );
				}
			?>
		</div>
		<div class="col-md-4">
			<?php
				if( is_active_sidebar( 'home-2-column-3' ) ){
					dynamic_sidebar( 'home-2-column-3' );
				}
			?>
		</div>
	</div>
</div>
<?php } // end of the loop.
get_footer(); ?>