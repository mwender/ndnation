<?php
class schedules_widget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'schedules_widget', //Base ID
			__('Schedules', 'schedules_text_domain'), //Name
			array(
				'description' => __('Displays Schedules in a widget', 'schedules_text_domain'),
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
			$sched_title       = ( ! empty( $instance['sched_title'] ) ) ? $instance['sched_title'] : __( 'Schedule' );
			$sched_cat         = $instance['sched_cat'];
			$add_sched_years   = $instance['incl_additional_fball_sched_years'];

			// Football Vars
			$sched_year_cat        = $instance['sched_year_cat'];
			$term_year             = get_term($sched_year_cat);
			$term_year_name        = str_replace(' Schedule', '', $term_year->name);
			$term_year_p1          = $term_year_name + 1;
			$term_year_p2          = $term_year_name + 2;
			$term_year_slug_p1     = $term_year_p1 . '-schedule';
			$term_year_slug_p2     = $term_year_p2 . '-schedule';
			$term_year_slug        = $term_year->slug;

			// Men's Basketball Vars
			$mbball_sched_year_cat = $instance['mbball_sched_year_cat'];
			$mbball_term_year      = get_term($mbball_sched_year_cat);
			$mbball_term_year_name = str_replace(' Schedule', '', $mbball_term_year->name);
			$mbball_term_year_slug =  $mbball_term_year->slug;

			// Women's Basketball Vars
			$wbball_sched_year_cat = $instance['wbball_sched_year_cat'];
			$wbball_term_year      = get_term($wbball_sched_year_cat);
			$wbball_term_year_name = str_replace(' Schedule', '', $wbball_term_year->name);
			$wbball_term_year_slug =  $wbball_term_year->slug;

			// Hockey Vars
			$hockey_sched_year_cat = $instance['hockey_sched_year_cat'];
			$hockey_term_year      = get_term($hockey_sched_year_cat);
			$hockey_term_year_name = str_replace(' Schedule', '', $hockey_term_year->name);
			$hockey_term_year_slug =  $hockey_term_year->slug;

			if(is_front_page() && !is_home()){
				$active_tab = 0;
			} else if(in_category('mens-basketball') && in_category('basketball') && !in_category('football')){
				$active_tab = 1;
			} else if(in_category('womens-basketball') && in_category('basketball') && !in_category('football')){
				$active_tab = 2;
			} else if(in_category('hockey')){
				$active_tab = 3;
			} else if(in_category('football')) {
				$active_tab = 0;
			} else {
				$active_tab = 0;
			}
?>
	<script>
		jQuery(document).ready(function($){
			var active_tab = parseInt("<?php echo $active_tab; ?>");
			$('#js-schedule-tabs').tabs(
				{
					active: active_tab
				}
			);
		});
	</script>
<?php
	    $football_args = array(
	    	'post_type' 	 => 'game',
	    	'posts_per_page' => 100,
	    	'order'          => 'ASC',
	    	'meta_key'       => 'game_date',
	    	'orderby'       => 'meta_value',
	    	'tax_query' => array(
	    		array(
	    			'taxonomy' => 'sched_year_cat',
	    			'field'    => 'slug',
	    			'terms'    => array($term_year_slug)
	    		),
	    		array(
	    			'taxonomy' => 'game_cat',
	    			'field'    => 'slug',
	    			'terms'    => array('football')
	    		)
	    	)
	    );
	    $football_loop = new WP_Query($football_args);
	    if($add_sched_years > 1){
		    $football_args_p1 = array(
		    	'post_type' 	 => 'game',
		    	'posts_per_page' => 100,
		    	'order'          => 'ASC',
		    	'meta_key'       => 'game_date',
		    	'orderby'       => 'meta_value',
		    	'tax_query' => array(
		    		array(
		    			'taxonomy' => 'sched_year_cat',
		    			'field'    => 'slug',
		    			'terms'    => array($term_year_slug_p1)
		    		),
		    		array(
		    			'taxonomy' => 'game_cat',
		    			'field'    => 'slug',
		    			'terms'    => array('football')
		    		)
		    	)
		    );
		    $football_loop_p1 = new WP_Query($football_args_p1);
		  }
		  if($add_sched_years > 2){
		    $football_args_p2 = array(
		    	'post_type' 	 => 'game',
		    	'posts_per_page' => 100,
		    	'order'          => 'ASC',
		    	'meta_key'       => 'game_date',
		    	'orderby'       => 'meta_value',
		    	'tax_query' => array(
		    		array(
		    			'taxonomy' => 'sched_year_cat',
		    			'field'    => 'slug',
		    			'terms'    => array($term_year_slug_p2)
		    		),
		    		array(
		    			'taxonomy' => 'game_cat',
		    			'field'    => 'slug',
		    			'terms'    => array('football')
		    		)
		    	)
		    );
		    $football_loop_p2 = new WP_Query($football_args_p2);
		  }

	    $mhoops_args = array(
	    	'post_type' 	 => 'game',
	    	'posts_per_page' => 100,
	    	'order'          => 'ASC',
	    	'meta_key'       => 'game_date',
	    	'orderby'       => 'meta_value',
	    	'tax_query' => array(
	    		array(
	    			'taxonomy' => 'sched_year_cat',
	    			'field'    => 'slug',
	    			'terms'    => array($mbball_term_year_slug)
	    		),
	    		array(
	    			'taxonomy' => 'game_cat',
	    			'field'    => 'slug',
	    			'terms'    => array('mens-basketball')
	    		)
	    	)
	    );
	    $mhoops_loop = new WP_Query($mhoops_args);

	    $whoops_args = array(
	    	'post_type' 	 => 'game',
	    	'posts_per_page' => 100,
	    	'order'          => 'ASC',
	    	'meta_key'       => 'game_date',
	    	'orderby'       => 'meta_value',
	    	'tax_query' => array(
	    		array(
	    			'taxonomy' => 'sched_year_cat',
	    			'field'    => 'slug',
	    			'terms'    => array($wbball_term_year_slug)
	    		),
	    		array(
	    			'taxonomy' => 'game_cat',
	    			'field'    => 'slug',
	    			'terms'    => array('womens-basketball')
	    		)
	    	)
	    );
	    $whoops_loop = new WP_Query($whoops_args);

	    $hockey_args = array(
	    	'post_type' 	 => 'game',
	    	'posts_per_page' => 100,
	    	'order'          => 'ASC',
	    	'meta_key'       => 'game_date',
	    	'orderby'       => 'meta_value',
	    	'tax_query' => array(
	    		array(
	    			'taxonomy' => 'sched_year_cat',
	    			'field'    => 'slug',
	    			'terms'    => array($hockey_term_year_slug)
	    		),
	    		array(
	    			'taxonomy' => 'game_cat',
	    			'field'    => 'slug',
	    			'terms'    => array('hockey')
	    		)
	    	)
	    );
	    $hockey_loop = new WP_Query($hockey_args);

	    $all_set     = $football_loop->have_posts() && $mhoops_loop->have_posts() && $whoops_loop->have_posts() && $hockey_loop->have_posts();
	    
	    $fball_set1  = $football_loop->have_posts() && $mhoops_loop->have_posts() && $whoops_loop->have_posts();
	    $fball_set2  = $football_loop->have_posts() && $mhoops_loop->have_posts() && $hockey_loop->have_posts();
	    $fball_set3  = $football_loop->have_posts() && $whoops_loop->have_posts() && $hockey_loop->have_posts();
	    $fball_set4  = $football_loop->have_posts() && $mhoops_loop->have_posts();
	    $fball_set5  = $football_loop->have_posts() && $whoops_loop->have_posts();
	    $fball_set6  = $football_loop->have_posts() && $hockey_loop->have_posts();

	    $mbball_set1 = $mhoops_loop->have_posts() && $football_loop->have_posts() && $whoops_loop->have_posts();
	    $mbball_set2 = $mhoops_loop->have_posts() && $football_loop->have_posts() && $hockey_loop->have_posts();
	    $mbball_set3 = $mhoops_loop->have_posts() && $whoops_loop->have_posts() && $hockey_loop->have_posts();
	    $mbball_set4 = $mhoops_loop->have_posts() && $football_loop->have_posts();
	    $mbball_set5 = $mhoops_loop->have_posts() && $whoops_loop->have_posts();
	    $mbball_set6 = $mhoops_loop->have_posts() && $hockey_loop->have_posts();

	    $wbball_set1 = $whoops_loop->have_posts() && $football_loop->have_posts() && $mhoops_loop->have_posts();
	    $wbball_set2 = $whoops_loop->have_posts() && $football_loop->have_posts() && $hockey_loop->have_posts();
	    $wbball_set3 = $whoops_loop->have_posts() && $mhoops_loop->have_posts() && $hockey_loop->have_posts();
	    $wbball_set4 = $whoops_loop->have_posts() && $football_loop->have_posts();
	    $wbball_set5 = $whoops_loop->have_posts() && $mhoops_loop->have_posts();
	    $wbball_set6 = $whoops_loop->have_posts() && $hockey_loop->have_posts();

	    $hockey_set1 = $hockey_loop->have_posts() && $football_loop->have_posts() && $mhoops_loop->have_posts();
	    $hockey_set2 = $hockey_loop->have_posts() && $football_loop->have_posts() && $whoops_loop->have_posts();
	    $hockey_set3 = $hockey_loop->have_posts() && $mhoops_loop->have_posts() && $whoops_loop->have_posts();
	    $hockey_set4 = $hockey_loop->have_posts() && $football_loop->have_posts();
	    $hockey_set5 = $hockey_loop->have_posts() && $mhoops_loop->have_posts();
	    $hockey_set6 = $hockey_loop->have_posts() && $whoops_loop->have_posts();
?>
				<div class="content-box nopad-r">
					<div class="sidebar-padder">
						<?php echo $before_widget; ?>
							<div class="widget-head topper">
								<?php 
									if ( $sched_title ) {
										echo $args['before_title'] . $sched_title . $args['after_title'];
									}
								?>
							</div>
							<div id="schedule-wrap" class="widget-wrap">
								<div class="widget-body">
									<div id="js-schedule-tabs" class="schedule-tabs">
										<?php
											if( $all_set || $fball_set1 || $fball_set2 || $fball_set3 || $fball_set4 || $fball_set5 || $fball_set6 || $mbball_set1 || $mbball_set2 || $mbball_set3 || $mbball_set4 || $mbball_set5 || $mbball_set6 || $wbball_set1 || $wbball_set2 || $wbball_set3 || $wbball_set4 || $wbball_set5 || $wbball_set6 || $hockey_set1 || $hockey_set2 || $hockey_set3 || $hockey_set4 || $hockey_set5 || $hockey_set6){
										?>
										<ul class="schedule-tabs-items">
											<?php if($football_loop->have_posts()){ ?>
												<li class="schedule-tab-item"><a href="#js-schedule-tab-1"><i class="fas fa-football-ball"></i></a></li>
											<?php } ?>
											<?php if($mhoops_loop->have_posts()){ ?>
												<li class="schedule-tab-item"><a href="#js-schedule-tab-2"><i class="fas fa-basketball-ball"></i> - <i class="fas fa-male"></i></a></li>
											<?php } ?>
											<?php if($whoops_loop->have_posts()){ ?>
												<li class="schedule-tab-item"><a href="#js-schedule-tab-3"><i class="fas fa-basketball-ball"></i> - <i class="fas fa-female"></i></a></li>
											<?php } ?>
											<?php if($hockey_loop->have_posts()){ ?>
												<li class="schedule-tab-item"><a href="#js-schedule-tab-4"><i class="fas fa-hockey-puck"></i></a></li>
											<?php } ?>
										</ul>
										<?php
											}
										?>
										<?php if($football_loop->have_posts()){ ?>
											<div id="js-schedule-tab-1" class="schedule-tab-1">
												<?php include_once('loops/football-schedule-loop.php'); ?>
												<?php 
													if($add_sched_years > 1){	
														if($football_loop_p1->have_posts()){
															include_once('loops/football-schedule-loop-p1.php');
														}
													}
													if($add_sched_years > 2){
														if($football_loop_p2->have_posts()){
															include_once('loops/football-schedule-loop-p2.php');
														}
													}
												?>
											</div>
										<?php } ?>
										<?php if($mhoops_loop->have_posts()){ ?>
											<div id="js-schedule-tab-2" class="schedule-tab-2">
												<?php include_once('loops/mhoop-schedule-loop.php'); ?>
											</div>
										<?php } ?>
										<?php if($whoops_loop->have_posts()){ ?>
											<div id="js-schedule-tab-3" class="schedule-tab-3">
												<?php include_once('loops/whoop-schedule-loop.php'); ?>
											</div>
										<?php } ?>
										<?php if($hockey_loop->have_posts()){ ?>
											<div id="js-schedule-tab-4" class="schedule-tab-4">
												<?php include_once('loops/hockey-schedule-loop.php'); ?>
											</div>
										<?php } ?>
									</div>
							<div class="clear"></div>
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
		$sched_title    = isset( $instance['sched_title'] ) ? esc_attr( $instance['sched_title'] ) : 'Schedule';
		$checked        = $instance['incl_additional_fball_sched_years'];
		$echo           = 'checked = "checked"';
		$sched_cat      = $instance['sched_cat'];
		$sched_year_cat = $instance['sched_year_cat'];
		$mbball_sched_year_cat = $instance['mbball_sched_year_cat'];
		$wbball_sched_year_cat = $instance['wbball_sched_year_cat'];
		$hockey_sched_year_cat = $instance['hockey_sched_year_cat'];
		$terms = get_terms(
			'game_cat',
			array(
				'hide_empty' => true,
			)
		);
		$terms_year = get_terms(
			'sched_year_cat',
			array(
				'hide_empty' => true,
			)
		);
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'sched_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'sched_title' ); ?>" name="<?php echo $this->get_field_name( 'sched_title' ); ?>" type="text" value="<?php echo $sched_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sched_year_cat' ); ?>"><?php _e( 'Football Schedule Year:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'sched_year_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'sched_year_cat' ); ?>">
				<option value="" <?php echo (($instance['sched_year_cat'] == '') ? 'selected' : ''); ?>>Select Schedule Year</option>
				<?php
					foreach ($terms_year as $term_year) {
						$term_year_id = $term_year->term_id;
						$term_year_name = $term_year->name;
				?>
						<option value="<?php echo $term_year_id; ?>" <?php echo (($instance['sched_year_cat'] == $term_year_id) ? 'selected' : ''); ?>><?php echo $term_year_name;?></option>
				<?php
					}
				?>
			</select>
		</p>
		<p>
			<label><?php _e( 'Include more football schedules in the widget' ); ?></label><br>
			<input class="widefat" id="<?php echo $this->get_field_id( 'incl_additional_fball_sched_years' ); ?>" name="<?php echo $this->get_field_name( 'incl_additional_fball_sched_years' ); ?>" type="radio" value="1" <?php checked( $checked, 1, $echo ); ?>/> None<br>
			<input class="widefat" id="<?php echo $this->get_field_id( 'incl_additional_fball_sched_years' ); ?>" name="<?php echo $this->get_field_name( 'incl_additional_fball_sched_years' ); ?>" type="radio" value="2" <?php checked( $checked, 2, $echo ); ?>/> 1 additional year<br>
			<input class="widefat" id="<?php echo $this->get_field_id( 'incl_additional_fball_sched_years' ); ?>" name="<?php echo $this->get_field_name( 'incl_additional_fball_sched_years' ); ?>" type="radio" value="3" <?php checked( $checked, 3, $echo ); ?>/> 2 additional years
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mbball_sched_year_cat' ); ?>"><?php _e( 'Men\'s Basketball Schedule Year:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'mbball_sched_year_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'mbball_sched_year_cat' ); ?>">
				<option value="" <?php echo (($instance['mbball_sched_year_cat'] == '') ? 'selected' : ''); ?>>Select Schedule Year</option>
				<?php
					foreach ($terms_year as $mbball_term_year) {
						$mbball_term_year_id = $mbball_term_year->term_id;
						$mbball_term_year_name = $mbball_term_year->name;
						$prev_year_ini = str_replace(' Schedule', '', $mbball_term_year_name);
						$prev_year = $prev_year_ini - 1;
						$mbball_select_name = $prev_year . '-' . $mbball_term_year_name;
				?>
						<option value="<?php echo $mbball_term_year_id; ?>" <?php echo (($instance['mbball_sched_year_cat'] == $mbball_term_year_id) ? 'selected' : ''); ?>><?php echo $mbball_select_name;?></option>
				<?php
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'wbball_sched_year_cat' ); ?>"><?php _e( 'Women\'s Basketball Schedule Year:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'wbball_sched_year_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'wbball_sched_year_cat' ); ?>">
				<option value="" <?php echo (($instance['wbball_sched_year_cat'] == '') ? 'selected' : ''); ?>>Select Schedule Year</option>
				<?php
					foreach ($terms_year as $wbball_term_year) {
						$wbball_term_year_id = $wbball_term_year->term_id;
						$wbball_term_year_name = $wbball_term_year->name;
						$prev_year_ini = str_replace(' Schedule', '', $wbball_term_year_name);
						$prev_year = $prev_year_ini - 1;
						$wbball_select_name = $prev_year . '-' . $wbball_term_year_name;
				?>
						<option value="<?php echo $wbball_term_year_id; ?>" <?php echo (($instance['wbball_sched_year_cat'] == $wbball_term_year_id) ? 'selected' : ''); ?>><?php echo $wbball_select_name;?></option>
				<?php
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'hockey_sched_year_cat' ); ?>"><?php _e( 'Hockey Schedule Year:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'hockey_sched_year_cat' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'hockey_sched_year_cat' ); ?>">
				<option value="" <?php echo (($instance['hockey_sched_year_cat'] == '') ? 'selected' : ''); ?>>Select Schedule Year</option>
				<?php
					foreach ($terms_year as $hockey_term_year) {
						$hockey_term_year_id = $hockey_term_year->term_id;
						$hockey_term_year_name = $hockey_term_year->name;
						$prev_year_ini = str_replace(' Schedule', '', $hockey_term_year_name);
						$prev_year = $prev_year_ini - 1;
						$hockey_select_name = $prev_year . '-' . $hockey_term_year_name;
				?>
						<option value="<?php echo $hockey_term_year_id; ?>" <?php echo (($instance['hockey_sched_year_cat'] == $hockey_term_year_id) ? 'selected' : ''); ?>><?php echo $hockey_select_name;?></option>
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
			$instance['sched_title'] = sanitize_text_field( $new_instance['sched_title'] );
			$instance['sched_year_cat'] = ( ! empty( $new_instance['sched_year_cat'] ) ) ? strip_tags( $new_instance['sched_year_cat'] ) : '';
			$instance['incl_additional_fball_sched_years'] = ( ! empty( $new_instance['incl_additional_fball_sched_years'] ) ) ? strip_tags( $new_instance['incl_additional_fball_sched_years'] ) : '';
			$instance['mbball_sched_year_cat'] = ( ! empty( $new_instance['mbball_sched_year_cat'] ) ) ? strip_tags( $new_instance['mbball_sched_year_cat'] ) : '';
			$instance['wbball_sched_year_cat'] = ( ! empty( $new_instance['wbball_sched_year_cat'] ) ) ? strip_tags( $new_instance['wbball_sched_year_cat'] ) : '';
			$instance['hockey_sched_year_cat'] = ( ! empty( $new_instance['hockey_sched_year_cat'] ) ) ? strip_tags( $new_instance['hockey_sched_year_cat'] ) : '';
			return $instance;
		}
}
function register_schedules_widget(){
	register_widget('schedules_widget');
}
add_action('widgets_init', 'register_schedules_widget');