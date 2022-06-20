<?php
	$hockey_args = array(
		'post_type' 	 => 'page',
		'posts_per_page' => $ppage,
		'orderby' 		 => 'title',
		'order' 		 => 'ASC',
		'category_name' => $hockey_cat,
	);
	$hockey_loop = new WP_Query($hockey_args);
	if($hockey_loop->have_posts()){
?>
		<h4>Hockey Schedules</h4>
		<ul class="schedule-link-items">
			<?php
				while($hockey_loop->have_posts()){
					$hockey_loop->the_post();
					$ptitle_ini  = str_replace(array('Hockey','hockey','Schedule','schedule'), '', get_the_title());
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