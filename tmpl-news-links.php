<?php
	/*
	Template Name: News Links Archive
	*/
	get_header();
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

	$national_sources = get_field('national_sources', 'option');
	if($national_sources){
		$national_sources_arr = array();
		foreach ($national_sources as $src) {
			$national_sources_arr[] = $src->slug;
		}
	} else {
		$national_sources_arr = array();
	}

	$opponent_sources = get_field('opponent_sources', 'option');
	if($opponent_sources){
		$opponent_sources_arr = array();
		foreach ($opponent_sources as $src) {
			$opponent_sources_arr[] = $src->slug;
		}
	} else {
		$opponent_sources_arr = array();
	}
?>
    <main class="nlarchive-wrap">
      <div class="nlarchive-header">
      	<h1 class="nlarchive-title"><?php the_title(); ?></h1>
      </div>
			<div id="js-nl-archive-tabs" class="nl-archive-tabs">
				<ul class="nl-archive-tabs-items">
					<?php
						$i = 0;
						foreach ($categories as $cat) {
							$cat_slug = $cat->slug;
							$cat_name_ini = $cat->name;
							$cat_name = str_replace(' News', '', $cat_name_ini);
					?>
						<li class="nl-archive-tab-item"><a href="#js-nl-archive-tab-<?php echo $i; ?>"><?php echo $cat_name; ?></a></li>
					<?php
							$i++;
						}
			    ?>
		  	</ul>
      	<?php
					$i = 0;
					foreach ($categories as $cat) {
						$cat_slug = $cat->slug;
						$cat_name = $cat->name;
				?>
					<div id="js-nl-archive-tab-<?php echo $i; ?>" class="nl-archive-tab">
						<?php
								$after_date = date('d.m.Y',strtotime("-13 month"));
								$args = array(
									'post_type' 	 => 'news_links',
									'posts_per_page' => 1999,
									'orderby'    => 'date',
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
											'after' => $after_date,
										),
									),
								);
							$loop = new WP_Query($args);
							$date = '';
							$prev_date = '';
							if($loop->have_posts()){
						?>
								<div class="nlarchive-items row">
									<div class="col-sm-12">
										<?php
											while($loop->have_posts()){
												$loop->the_post();
												$nlink_title      = get_the_title();
												$nlink_url        = get_field('news_link_url');
												$sources_arr      = wp_get_post_terms(get_the_ID(),'source_cat');
												$source_slug_arr  = wp_list_pluck( $sources_arr, 'slug' );
												$source_name_arr  = wp_list_pluck( $sources_arr, 'name' );
												$source_slug      = $source_slug_arr[0];
												$source_name      = ' ('.$source_name_arr[0] . ')';

												if($date != get_the_date('l, F j, Y')){
													$prev_date = $date;
													$date = get_the_date('l, F j, Y');
													if($prev_date != $date){
														echo '</ul>';
													}
										?>
												<div class="nlarchive-date-header">
													<h4 class="nlarchive-date"><?php echo $date; ?></h4>
												</div>
												<ul class="archive-items">
										<?php
												}
										?>
												<li class="nlarchive-item<?php echo ((in_array($source_slug, $national_sources_arr)) ? ' national-links' : ''); ?><?php echo ((in_array($source_slug, $opponent_sources_arr)) ? ' opponent-links' : ''); ?>">
													<a class="nlarchive-link" href="<?php echo $nlink_url; ?>" target="_blank"><?php echo $nlink_title;?> <strong><?php echo $source_name; ?></strong></a>
												</li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
						<?php
							}
						$i++;
					?>
					</div>
				<?php
					}
		    ?>
  		</div>
  	</main>
<?php
	get_sidebar();
	get_footer();
?>