<?php
	$mbball_args = array(
		'post_type' 	 => 'page',
		'posts_per_page' => $ppage,
		'orderby' 		 => 'title',
		'order' 		 => 'ASC',
		'category_name' => $mbball_cat,
	);
	$mbball_loop = new WP_Query($mbball_args);
	if($mbball_loop->have_posts()){
?>
		<h4>Men's Hoops Schedules</h4>
		<ul class="schedule-link-items">
			<?php
				while($mbball_loop->have_posts()){
					$mbball_loop->the_post();
					$ptitle_ini  = str_replace(array("Men&#8217;s", "Basketball", "Schedule"), '', get_the_title());
					$ptitle      = str_replace(array('-18','-19','-20'),'-', $ptitle_ini);
			?>		
					<li class="schedule-link-item">
						<a href="<?php echo get_the_permalink(); ?>"><?php echo $ptitle; ?></a>
					</li>
			<?php
				}
				wp_reset_query();
			?>
		</ul>
<?php
	}
?>