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
	.home-hero .widget, .col-lg-4 .widget{margin-bottom: 1em;}
	.row{margin-bottom: 1em;}
	.topper-wide{border-bottom: 4px solid #c99700;}
	.topper-wide h2{margin: 0; padding: 5px 10px; background-color: #c99700; color: #0c2340; font-size: 1.6em; font-weight: bold; border-bottom: 5px solid #fff;}
	#schedule-wrap{margin-top: 0;}
	#schedule-wrap .topper-wide{margin-bottom: 1em;}
	.rectangle-ad, .skyscraper-ad{background-color: rgba(224, 224, 224, .5); border: 1px solid rgba(224, 224, 224, 1); margin-bottom: 1em;}
	.rectangle-ad{height: 280px;}
	.skyscraper-ad{height: 598px;}
</style>
<div class="container">
	<?php
		if( is_active_sidebar( 'home-2-top' ) ){
			echo '<div class="row home-hero"><div class="col-lg-12">';
			dynamic_sidebar('home-2-top');
			echo '</div></div>';
		} else if( current_user_can( 'edit_posts' ) ){
	?>
	<div class="row">
		<div class="col-lg-12"><code>Home 2 - Top Sidebar</code></div>
	</div>
	<?php
		}
	?>
	<?php
	//*
	$latest_posts = get_posts( [ 'numberposts' => 3 ] );
	if( $latest_posts ){
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="topper-wide">
						<h2>Latest Columns</h2>
				</div>
			</div>
		</div>
		<div class="row">
		<?php
		foreach( $latest_posts as $post ):
			setup_postdata( $post );
			?>
			<div class="col-md-4">
        <header>
          <h4 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
        </header>
				<div class="post-excerpt">
          <?php the_excerpt(); ?>
				</div>
			</div>

			<?php
		endforeach;
		?></div><!-- .row --><?php
		wp_reset_postdata();
	}
	/**/
	?>
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