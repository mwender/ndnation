<?php
class nl_widget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'nl_widget', //Base ID
			__('News Links', 'ndnation'), //Name
			array(
				'description' => __('Displays News Links in a widget', 'ndnation'),
			)
		);
	}

	/**
	 * Front end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			extract($args);
			$nl_widget_title   = ( ! empty( $instance['nl_widget_title'] ) ) ? $instance['nl_widget_title'] : __( 'News Links' );
			$nl_widget_numshow = $instance['nl_widget_numshow'];
			if(in_category('mens-basketball') && in_category('basketball') && !in_category('football')){
				$taxquery = array(
					array(
						'taxonomy' => 'news_links_cat',
						'field' => 'slug',
						'terms' => array('mens-hoops-news'),
					),
				);
				$widget_subtitle   = 'Men\'s Hoops News';
				$widget_term_obj   = get_term_by('slug', 'mens-hoops-news', 'news_links_cat');
				$widget_term_id = $widget_term_obj->term_id;
				$widget_term_metas = get_option("taxonomy_{$widget_term_id}_metas");
				$widget_term_order = $widget_term_metas['category-order'];
				$widget_nl_link    = '/news-links/?tab=' . $widget_term_order;
			} else if(in_category('womens-basketball') && in_category('basketball') && !in_category('football')){
				$taxquery = array(
					array(
						'taxonomy' => 'news_links_cat',
						'field' => 'slug',
						'terms' => array('womens-hoops-news'),
					),
				);
				$widget_subtitle   = 'Women\'s Hoops News';
				$widget_term_obj   = get_term_by('slug', 'womens-hoops-news', 'news_links_cat');
				$widget_term_id = $widget_term_obj->term_id;
				$widget_term_metas = get_option("taxonomy_{$widget_term_id}_metas");
				$widget_term_order = $widget_term_metas['category-order'];
				$widget_nl_link    = '/news-links/?tab=' . $widget_term_order;
			} else if(in_category('basketball') && !in_category('football')) {
				$taxquery = array(
					array(
						'taxonomy' => 'news_links_cat',
						'field' => 'slug',
						'terms' => array('womens-hoops-news', 'mens-hoops-news'),
					),
				);
				$widget_subtitle = 'Hoops News';
				$widget_nl_link = '/news-links/';
			} else if(in_category('hockey')){
				$taxquery = array(
					array(
						'taxonomy' => 'news_links_cat',
						'field' => 'slug',
						'terms' => array('hockey-news'),
					),
				);
				$widget_subtitle   = 'Hockey News';
				$widget_term_obj   = get_term_by('slug', 'hockey-news', 'news_links_cat');
				$widget_term_id = $widget_term_obj->term_id;
				$widget_term_metas = get_option("taxonomy_{$widget_term_id}_metas");
				$widget_term_order = $widget_term_metas['category-order'];
				$widget_nl_link    = '/news-links/?tab=' . $widget_term_order;
			} else if((in_category('football') || in_category('bk') || in_category('frecruiting') || in_category('football-team-info')) && !in_category('basketball')){
				$taxquery = array(
					array(
						'taxonomy' => 'news_links_cat',
						'field' => 'slug',
						'terms' => array('football-news'),
					),
				);
				$widget_subtitle   = 'Football News';
				$widget_term_obj   = get_term_by('slug', 'football-news', 'news_links_cat');
				$widget_term_id = $widget_term_obj->term_id;
				$widget_term_metas = get_option("taxonomy_{$widget_term_id}_metas");
				$widget_term_order = $widget_term_metas['category-order'];
				$widget_nl_link    = '/news-links/?tab=' . $widget_term_order;
			} else {
				// $taxquery = array(
				// 	array(
				// 		'taxonomy' => 'news_links_cat',
				// 		'field' => 'slug',
				// 		'terms' => array('football-news', 'mens-hoops-news', 'womens-hoops-news', 'hockey-news'),
				// 		'operator' => 'NOT IN',
				// 	),
				// );
				$taxquery = '';
				$widget_subtitle = '';
				$widget_nl_link = '/news-links/';
			}
			$nl_args = array(
				'post_type' 	 => 'news_links',
				'posts_per_page' => $nl_widget_numshow,
				'orderby' 		 => 'date',
				'order' 		 => 'DESC',
				'tax_query' => $taxquery,
			);
			$loop = new WP_Query($nl_args);
?>
				<div class="content-box nopad-r">
					<div class="sidebar-padder">
						<?php echo $before_widget; ?>
							<div class="widget-head topper">
								<?php 
									if ( $nl_widget_title ) {
										echo $args['before_title'] . $nl_widget_title . $args['after_title'];
									}
								?>
							</div>
							<div id="nl-widget-wrap" class="widget-wrap">
								<div class="widget-body">
									<?php
										if($loop->have_posts()){
											if($widget_subtitle != ''){
									?>
												<h3 class="nl-widget-subtitle"><a href="<?php echo $widget_nl_link; ?>"><?php echo $widget_subtitle; ?></a></h3>
										<?php
											}
										?>
											<ul class="nl-widget-items">
												<?php
													while($loop->have_posts()){
														$loop->the_post();
														$nlink_title = get_the_title();
														$nlink_url   = get_field('news_link_url');
														$nlink_date  = get_the_date('n/j');
														$sources_arr = wp_get_post_terms(get_the_ID(),'source_cat');
														$source_arr  = wp_list_pluck( $sources_arr, 'name' );
														$source      = $source_arr[0];
												?>
													<li class="nl-widget-item">
														<span class="nl-date"><?php echo $nlink_date; ?></span> <a href="<?php echo $nlink_url; ?>" target="_blank"><?php echo $nlink_title;?> (<?php echo $source; ?>)</a>
													</li>
												<?php
													}
												?>
											</ul>
									<?php
										}
									?>
									<div class="text-center">
										<a class="btn" href="<?php echo $widget_nl_link; ?>">View More</a>
									</div>
								</div>
							</div>
						<?php echo $args['after_widget']; ?>
					</div>
				</div>
<?php

	}
	/**
	 * Back-end widget form
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form($instance){
		$nl_widget_title = isset( $instance['nl_widget_title'] ) ? esc_attr( $instance['nl_widget_title'] ) : 'News Links';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'nl_widget_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'nl_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'nl_widget_title' ); ?>" type="text" value="<?php echo $nl_widget_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nl_widget_numshow' ); ?>"><?php _e( 'Number of links to show:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'nl_widget_numshow' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'nl_widget_numshow' ); ?>">
				<?php 
					for ($i = 1; $i < 21; $i++) { 
				?>
					<option value="<?php echo $i; ?>" <?php echo (($instance['nl_widget_numshow'] == $i) ? 'selected' : ''); ?>><?php echo $i; ?></option>
				<?php
					}
				?>
			</select>
		</p>
<?php
	}
	/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['nl_widget_title']   = sanitize_text_field( $new_instance['nl_widget_title'] );
			$instance['nl_widget_numshow'] = sanitize_text_field( $new_instance['nl_widget_numshow'] );
			return $instance;
		}
}
function register_nl_widget(){
	register_widget('nl_widget');
}
add_action('widgets_init', 'register_nl_widget');