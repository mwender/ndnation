<?php
class SocialWidget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'social_widget', //Base ID
			__('Social Media', 'ndnation'), //Name
			array(
				'description' => __('Social Media widget', 'ndnation'),
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
			$social_widget_title   = $instance['social_widget_title'];
?>
				<?php echo $args['before_widget']; ?>
				<?php 
					if ( $social_widget_title ) {
						echo $args['before_title'] . $social_widget_title . $args['after_title'];
					}
				?>
				<?php
					if(have_rows('social_media', 'option')){
				?>
					<ul class="socmed-items">
					<?php
						while(have_rows('social_media', 'option')){
							the_row();
							$socmed_service  = get_sub_field('socmed_service');
							$socmed_name     = $socmed_service['label'];
							$socmed_fa_class = $socmed_service['value'];
							if($socmed_name == 'RSS'){
								$prefix = 'fas';
							} else {
								$prefix = 'fab';
							}
							$socmed_link     = get_sub_field('socmed_link');
							$socmed_target   = get_sub_field('socmed_target');
					?>
						<li class="socmed-item">
							<a href="<?php echo $socmed_link; ?>"<?php echo (($socmed_target[0] == 'yes') ? ' target="_blank" ' : ''); ?>title="<?php echo $socmed_name; ?>">
								<i class="<?php echo $prefix . ' ' . $socmed_fa_class; ?>"></i>
							</a>
						</li>
					<?php
						}
					?>
					</ul>
				<?php
					}
				?>
				<?php echo $args['after_widget']; ?>
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
		$social_widget_title = isset( $instance['social_widget_title'] ) ? esc_attr( $instance['social_widget_title'] ) : 'Social Media';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'social_widget_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'social_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'social_widget_title' ); ?>" type="text" value="<?php echo $social_widget_title; ?>" />
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
			$instance['social_widget_title']   = sanitize_text_field( $new_instance['social_widget_title'] );
			return $instance;
		}
}
function register_social_widget(){
	register_widget('SocialWidget');
}
add_action('widgets_init', 'register_social_widget');