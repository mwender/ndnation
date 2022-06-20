<?php
/*
Template Name: Schedules Overview Page
*/
get_header();
$fball_args = array(
	'post_type' 	 => 'page',
	'posts_per_page' => 999,
	'orderby' 		 => 'title',
	'order' 		 => 'ASC',
	'category_name' => 'football-schedule',
);
$fball_loop = new WP_Query($fball_args);
$mbball_args = array(
	'post_type' 	 => 'page',
	'posts_per_page' => 999,
	'orderby' 		 => 'title',
	'order' 		 => 'ASC',
	'category_name' => 'mens-basketball-schedule',
);
$mbball_loop = new WP_Query($mbball_args);
$wbball_args = array(
	'post_type' 	 => 'page',
	'posts_per_page' => 999,
	'orderby' 		 => 'title',
	'order' 		 => 'ASC',
	'category_name' => 'womens-basketball-schedule',
);
$wbball_loop = new WP_Query($wbball_args);
$hockey_args = array(
	'post_type' 	 => 'page',
	'posts_per_page' => 999,
	'orderby' 		 => 'title',
	'order' 		 => 'ASC',
	'category_name' => 'hockey-schedule',
);
$hockey_loop = new WP_Query($hockey_args);
$baseball_args = array(
	'post_type' 	 => 'page',
	'posts_per_page' => 999,
	'orderby' 		 => 'title',
	'order' 		 => 'ASC',
	'category_name' => 'baseball-schedule',
);
$baseball_loop = new WP_Query($baseball_args);
$content = get_the_content();
?>
<main class="schedule-wrap">
  <div class="schedule-header">
  	<h1 class="schedule-title"><?php the_title(); ?></h1>
  </div>
  <div class="schedule-body row">
	  <div class="col-sm-12 schedule-wrap">
	  	<div class="row">
		  	<?php
		  		if($fball_loop->have_posts()){
		  	?>
		  			<div class="col-xs-12 col-sm-6 col-md-6">
			  			<h3>Football Schedules</h3>
			  			<ul class="schedule-link-items">
			  				<?php
			  					while($fball_loop->have_posts()){
			  						$fball_loop->the_post();
			  						$ptitle = str_replace(array('Football','football','Schedule','schedule'), '', get_the_title());
			  				?>		
			  						<li class="schedule-link-item">
			  							<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
			  						</li>
			  				<?php
			  					}
			  					wp_reset_query();
			  				?>
			  			</ul>
		  			</div>
		  	<?php
		  		}
		  	?>
		  	<?php
		  		if($mbball_loop->have_posts()){
		  	?>
		  			<div class="col-xs-12 col-sm-6 col-md-6">
			  			<h3>Men's Hoops Schedules</h3>
			  			<ul class="schedule-link-items">
			  				<?php
			  					while($mbball_loop->have_posts()){
			  						$mbball_loop->the_post();
			  						$ptitle_ini = str_replace(array("Men&#8217;s", "Basketball", "Schedule"), '', get_the_title());
			  						$ptitle     = str_replace(array('-18','-19','-20','-21'),'-', $ptitle_ini);
			  				?>		
			  						<li class="schedule-link-item">
			  							<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
			  						</li>
			  				<?php
			  					}
			  					wp_reset_query();
			  				?>
			  			</ul>
		  			</div>
		  	<?php
		  		}
		  	?>
	  	</div>
	  	<div class="row">
		  	<?php
		  		if($wbball_loop->have_posts()){
		  	?>
		  			<div class="col-xs-12 col-sm-6 col-md-6">
			  			<h3>Women's Hoops Schedules</h3>
			  			<ul class="schedule-link-items">
			  				<?php
			  					while($wbball_loop->have_posts()){
			  						$wbball_loop->the_post();
			  						$ptitle_ini = str_replace(array("Women&#8217;s", "Basketball", "Schedule"), '', get_the_title());
			  						$ptitle     = str_replace(array('-18','-19','-20','-21'),'-', $ptitle_ini);
			  				?>		
			  						<li class="schedule-link-item">
			  							<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
			  						</li>
			  				<?php
			  					}
			  					wp_reset_query();
			  				?>
			  			</ul>
		  			</div>
		  	<?php
		  		}
		  	?>
		  	<?php
		  		if($hockey_loop->have_posts()){
		  	?>
		  			<div class="col-xs-12 col-sm-6 col-md-6">
			  			<h3>Hockey Schedules</h3>
			  			<ul class="schedule-link-items">
			  				<?php
			  					while($hockey_loop->have_posts()){
			  						$hockey_loop->the_post();
			  						$ptitle_ini = str_replace(array('Hockey','hockey','Schedule','schedule'), '', get_the_title());
			  						$ptitle     = str_replace(array('-18','-19','-20','-21'),'-', $ptitle_ini);
			  				?>		
			  						<li class="schedule-link-item">
			  							<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
			  						</li>
			  				<?php
			  					}
			  					wp_reset_query();
			  				?>
			  			</ul>
		  			</div>
		  	<?php
		  		}
		  	?>
	  	</div>
	  	<div class="row">
		  	<?php
		  		if($baseball_loop->have_posts()){
		  	?>
		  			<div class="col-xs-12 col-sm-6 col-md-6">
			  			<h3>Baseball Schedules</h3>
			  			<ul class="schedule-link-items">
			  				<?php
			  					while($baseball_loop->have_posts()){
			  						$baseball_loop->the_post();
			  						$ptitle = str_replace(array('Baseball','baseball','Schedule','schedule'), '', get_the_title());
			  				?>		
			  						<li class="schedule-link-item">
			  							<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
			  						</li>
			  				<?php
			  					}
			  					wp_reset_query();
			  				?>
			  			</ul>
		  			</div>
		  	<?php
		  		}
		  	?>
	  	</div>
  	  <?php if($content){ ?>
  		  <div class="schedule-content">
  		  	<?php the_content(); ?>
  			</div>
  		<?php } ?>
	  </div>
  </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>