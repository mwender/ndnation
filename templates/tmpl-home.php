<?php
/*
Template Name: Home
*/
get_header();
?>
<?php 
	while(have_posts()){ 
		the_post(); 
?>
		<div class="home-leaderboard">
			<?php 
				if(is_active_sidebar( 'home-leaderboard-ad-slot-1' )){
					dynamic_sidebar('home-leaderboard-ad-slot-1');
				}
			?>
		</div>
		<div class="premium-ad-slot">	
			<?php 
				if(is_active_sidebar( 'premium-ad-slot' )){
					dynamic_sidebar('premium-ad-slot');
				}
			?>
		</div>
		<div class="hp-sidebar content-box">
			<div class="topper"><h2>Latest News</h2></div>
			<?php include(locate_template('templates/template-parts/news-module.php')); ?>
		</div>
		<div class="local-ad-mobile">
			<?php 
				if(is_active_sidebar( 'local-ad-slot-2' )){
					dynamic_sidebar('local-ad-slot-2');
				}
			?>
		</div>
		<div class="hp-main">
			<!-- <div class="content-box featured-story"> -->
				<?php 
					//include(locate_template('templates/template-parts/featured-story.php')); 
					// if(is_active_sidebar( 'home-page-video-ad-slot' )){
					// 	dynamic_sidebar('home-page-video-ad-slot');
					// }	
				?>
			<!-- </div> -->
			<div class="hp-main-left">
				<?php 
					if(is_active_sidebar( 'latest-columns-home-ad-1' )){
						dynamic_sidebar('latest-columns-home-ad-1');
					}
				?>
				<div class="content-box">
					<div class="topper"><h2>Latest Columns<h2></div>
					<?php include(locate_template('templates/template-parts/top-stories.php')); ?>
				</div>
				<?php 
					// if(is_active_sidebar( 'local-ad-slot-1' )){
					// 	dynamic_sidebar('local-ad-slot-1');
					// }
					if(is_active_sidebar('latest-columns-home-ad-2')){
						dynamic_sidebar('latest-columns-home-ad-2');	
					}
				?>
			</div>
			<div class="hp-main-right">
				<!-- <div class="local-ad-desktop"> -->
					<?php 
						// if(is_active_sidebar( 'local-ad-slot-2' )){
						// 	dynamic_sidebar('local-ad-slot-2');
						// }
					?>
				<!-- </div> -->
				<?php get_sidebar('home'); ?>
			</div>
		</div>
<?php } // end of the loop. ?>
<?php get_footer(); ?>