<?php
	$wbball_args = array(
		'post_type' 	 => 'page',
		'posts_per_page' => $ppage,
		'orderby' 		 => 'title',
		'order' 		 => 'ASC',
		'category_name' => $wbball_cat,
	);
	$wbball_loop = new WP_Query($wbball_args);
	if($wbball_loop->have_posts()){
?>
		<h4>Women's Hoops Schedules</h4>
		<ul class="schedule-link-items">
			<?php
				while($wbball_loop->have_posts()){
					$wbball_loop->the_post();
					$ptitle_ini  = str_replace(array("Women&#8217;s", "Basketball", "Schedule"), '', get_the_title());
					$ptitle      = str_replace(array('-18','-19','-20'),'-', $ptitle_ini);
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