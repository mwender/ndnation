<?php
	$baseball_args = array(
		'post_type' 	 => 'page',
		'posts_per_page' => $ppage,
		'orderby' 		 => 'title',
		'order' 		 => 'ASC',
		'category_name' => $baseball_cat,
	);
	$baseball_loop = new WP_Query($baseball_args);
	if($baseball_loop->have_posts()){
?>
		<h4>Baseball Schedules</h4>
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
			?>
		</ul>
<?php
	}
?>