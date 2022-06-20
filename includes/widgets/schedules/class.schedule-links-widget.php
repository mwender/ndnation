<?php
class schedule_links_widget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'schedule_links_widget', //Base ID
			__('Schedule Links', 'ndnation'), //Name
			array(
				'description' => __('Schedule Links widget', 'ndnation'),
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
			$widget_title = ( ! empty( $instance['schedule_links_widget_title'] ) ) ? $instance['schedule_links_widget_title'] : __( 'Schedule Links' );
			$ppage        = $instance['schedule_links_widget_numshow'];
			$fball_cat    = ($instance['schedule_links_widget_fball_cat'] != null ? 'football-schedule' : '');
			$mbball_cat   = ($instance['schedule_links_widget_mbball_cat'] != null ? 'mens-basketball-schedule' : '');
			$wbball_cat   = ($instance['schedule_links_widget_wbball_cat'] != null ? 'womens-basketball-schedule' : '');
			$hockey_cat   = ($instance['schedule_links_widget_hockey_cat'] != null ? 'hockey-schedule' : '');
			$baseball_cat = ($instance['schedule_links_widget_baseball_cat'] != null ? 'baseball-schedule' : '');
?>
				<div class="content-box nopad-r">
					<div class="sidebar-padder">
						<?php echo $args['before_widget']; ?>
						<div class="widget-head topper">
							<?php 
								if ( $widget_title ) {
									echo $args['before_title'] . $widget_title . $args['after_title'];
								}
							?>
						</div>
						<div id="schedule-links-wrap" class="widget-wrap">
							<div class="widget-body">
								<?php
									if($fball_cat != ''){
										include_once('loops/football-schedule-links-loop.php');
									}
									if($mbball_cat != ''){
										include_once('loops/mhoop-schedule-links-loop.php');
									}
									if($wbball_cat != ''){
										include_once('loops/whoop-schedule-links-loop.php');
									}
									if($hockey_cat != ''){
										include_once('loops/hockey-schedule-links-loop.php');
									}
									if($baseball_cat != ''){
										include_once('loops/baseball-schedule-links-loop.php');
									}
								?>
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
		$widget_title = isset( $instance['schedule_links_widget_title'] ) ? esc_attr( $instance['schedule_links_widget_title'] ) : 'Schedule Links';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'schedule_links_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_title' ); ?>" type="text" value="<?php echo $widget_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_numshow' ); ?>"><?php _e( 'Number of links to show:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'schedule_links_widget_numshow' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'schedule_links_widget_numshow' ); ?>">
				<?php 
					for ($i = 1; $i < 21; $i++) { 
				?>
					<option value="<?php echo $i; ?>" <?php echo (($instance['schedule_links_widget_numshow'] == $i) ? 'selected' : ''); ?>><?php echo $i; ?></option>
				<?php
					}
				?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'schedule_links_widget_fball_cat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'schedule_links_widget_fball_cat' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_fball_cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_fball_cat' ); ?>"><?php _e( 'Football Schedules' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'schedule_links_widget_mbball_cat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'schedule_links_widget_mbball_cat' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_mbball_cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_mbball_cat' ); ?>"><?php _e( 'Men\'s Basketball Schedules' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'schedule_links_widget_wbball_cat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'schedule_links_widget_wbball_cat' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_wbball_cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_wbball_cat' ); ?>"><?php _e( 'Women\'s Basketball Schedules' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'schedule_links_widget_hockey_cat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'schedule_links_widget_hockey_cat' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_hockey_cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_hockey_cat' ); ?>"><?php _e( 'Hockey Schedules' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'schedule_links_widget_baseball_cat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'schedule_links_widget_baseball_cat' ); ?>" name="<?php echo $this->get_field_name( 'schedule_links_widget_baseball_cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'schedule_links_widget_baseball_cat' ); ?>"><?php _e( 'Baseball Schedules' ); ?></label>
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
			$instance['schedule_links_widget_title']      = sanitize_text_field( $new_instance['schedule_links_widget_title'] );
			$instance['schedule_links_widget_numshow']    = $new_instance['schedule_links_widget_numshow'];
			$instance['schedule_links_widget_fball_cat']  = $new_instance['schedule_links_widget_fball_cat'];
			$instance['schedule_links_widget_mbball_cat'] = $new_instance['schedule_links_widget_mbball_cat'];
			$instance['schedule_links_widget_wbball_cat'] = $new_instance['schedule_links_widget_wbball_cat'];
			$instance['schedule_links_widget_hockey_cat'] = $new_instance['schedule_links_widget_hockey_cat'];
			$instance['schedule_links_widget_baseball_cat'] = $new_instance['schedule_links_widget_baseball_cat'];
			return $instance;
		}
}
function register_schedule_links_widget(){
	register_widget('schedule_links_widget');
}
add_action('widgets_init', 'register_schedule_links_widget');