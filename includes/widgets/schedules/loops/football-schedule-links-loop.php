<?php
	$fball_args = array(
		'post_type' 	 => 'page',
		'posts_per_page' => $ppage,
		'orderby' 		 => 'title',
		'order' 		 => 'ASC',
		'category_name' => $fball_cat,
	);
	$fball_loop = new WP_Query($fball_args);
	if($fball_loop->have_posts()){
?>
		<h4>Football Schedules</h4>
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
			?>
		</ul>
<?php
	}
?>