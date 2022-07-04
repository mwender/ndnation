<?php
	$categories = get_terms(
		array(
			'taxonomy'   => 'news_links_cat',
			'hide_empty' => true,
			'meta_query' => array(
			  'position_clause' => array(
				  'key' => 'category-order',
			    'value' => 0,
			    'compare' => '>='
			  ),
			),
			'orderby'    => 'meta_value_num',
			'order'      => 'ASC'
		)
	);
	
	// $national_sources = get_field('national_sources', 'option');
	// if($national_sources){
	// 	$national_sources_arr = [];
	// 	foreach ($national_sources as $src) {
	// 		$national_sources_arr[] = $src->slug;
	// 	}
	// } else {
	// 	$national_sources_arr = [];
	// }

	// $opponent_sources = get_field('opponent_sources', 'option');
	// if($opponent_sources){
	// 	$opponent_sources_arr = [];
	// 	foreach ($opponent_sources as $src) {
	// 		$opponent_sources_arr[] = $src->slug;
	// 	}
	// } else {
	// 	$opponent_sources_arr = [];
	// }

	foreach ($categories as $cat) {
		$cat_slug       = $cat->slug;
		$cat_name       = $cat->name;
		$cat_term_obj   = get_term_by('slug', $cat_slug, 'news_links_cat');
		$cat_term_id    = $cat_term_obj->term_id;
		$cat_term_metas = get_option("taxonomy_{$cat_term_id}_metas");
		$cat_pos        = $cat_term_metas['category-order'];
		if($cat_pos != 0){
			$cclass = ' collapsible';
		} else {
			$cclass = '';
		}
		$today          = date('d.m.Y');
		$yesterday      = date('d.m.Y',strtotime("-1 days"));
		$last_week      = date('d.m.Y',strtotime("-6 days"));
		// GET COUNT OF TODAYS LINKS
		$count_args = array(
			'post_type' 	 => 'news_links',
			'posts_per_page' => 999,
			'orderby' 		 => 'date',
			'order' 		 => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'news_links_cat',
					'field' => 'slug',
					'terms' => $cat_slug,
				),
			),
			'date_query' => array(
				array(
					'after' => $today,
				),
			),
		);
		$count_loop = new WP_Query($count_args);
		$count = $count_loop->post_count;
		wp_reset_query();
		
		// GET COUNT OF YESTERDAYS LINKS
		$yesterday_count_args = array(
			'post_type' 	 => 'news_links',
			'posts_per_page' => 999,
			'orderby' 		 => 'date',
			'order' 		 => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'news_links_cat',
					'field' => 'slug',
					'terms' => $cat_slug,
				),
			),
			'date_query' => array(
				array(
					'after' => $yesterday,
				),
			),
		);
		$yesterday_count_loop = new WP_Query($yesterday_count_args);
		$yesterday_count = $yesterday_count_loop->post_count;
		wp_reset_query();

		// SET DATE QUERY FOR $args
		if( $count > 6 ){
			$date_query = array(
				array(
					'after' =>  $today,
				)
			);
			$pppage = $count;
		} else if($count == 0 && $yesterday_count >= 15){
			$date_query = array(
				array(
					'after' =>  $yesterday,
				)
			);
			$pppage = $yesterday_count;
		} else {
			$date_query = '';
			$pppage = 5;
		}
		$args = array(
			'post_type' 	 => 'news_links',
			'posts_per_page' => $pppage,
			'orderby' 		 => 'date',
			'order' 		 => 'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'news_links_cat',
					'field' => 'slug',
					'terms' => $cat_slug,
				),
			),
			'date_query' => $date_query,
		);

		$loop = new WP_Query($args);
		if($loop->have_posts()){
?>
			<div id="nl-<?php echo $cat_slug; ?>" class="nl nopad section">
				<div class="nl-title">
					<div class="toggle"><i class="fas fa-plus-circle"></i></div>
					<h3><a href="/news-links?tab=<?php echo $cat_pos; ?>"><?php echo $cat_name; ?></a></h3>
					<div class="clear"></div>
				</div>
				<div class="nl-list<?php echo $cclass; ?>">
					<ul class="nl-items">
						<?php
							while($loop->have_posts()){
								$loop->the_post();
								$nlink_title = get_the_title();
								$nlink_url   = get_field('news_link_url');
								$nlink_date  = get_the_date('n/j');
								$sources_arr      = wp_get_post_terms(get_the_ID(),'source_cat');
								$source_slug_arr  = wp_list_pluck( $sources_arr, 'slug' );
								$source_name_arr  = wp_list_pluck( $sources_arr, 'name' );
								$source_slug      = $source_slug_arr[0];
								$source_name      = ' ('.$source_name_arr[0] . ')';

						?>
							<li class="nl-item">
								<span class="nl-date"><?php echo $nlink_date; ?></span> <a href="<?php echo $nlink_url; ?>" target="_blank"><?php echo $nlink_title;?><?php echo $source_name; ?></a>
							</li>
						<?php
							}
						?>
					</ul>
					<div class="text-center">
						<a class="btn" href="/news-links?tab=<?php echo $cat_pos; ?>">View More</a>
					</div>
				</div>
			</div>
<?php
	}
	wp_reset_query();
}
?>