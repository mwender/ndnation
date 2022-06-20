<?php
class login_widget extends WP_Widget {
	function __construct(){
		parent::__construct(
			'login_widget', //Base ID
			__('Login Form', 'ndnation'), //Name
			array(
				'description' => __('Login Form widget', 'ndnation'),
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
			$login_widget_title   = $instance['login_widget_title'];
?>
				<?php echo $args['before_widget']; ?>
				<?php 
					if ( $login_widget_title ) {
						echo $args['before_title'] . $login_widget_title . $args['after_title'];
					}
				?>
				<form class="navbar-form form-inline row nopad" method="POST" action="../userfunc/login.php">
          <input type="hidden" name="Boardparm" value="football">
					<label for="Handle">Handle</label>
          <input type="text" class="form-control input-sm" name="Handle" autocomplete="off" style="cursor: auto;">
					<label for="Password">Password</label>
          <input type="password" class="form-control input-sm" name="Password" autocomplete="off">

          <button type="submit" class="btn btn-primary btn-sm">Login</button>
        </form>
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
		$login_widget_title = isset( $instance['login_widget_title'] ) ? esc_attr( $instance['login_widget_title'] ) : 'Login';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'login_widget_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'login_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'login_widget_title' ); ?>" type="text" value="<?php echo $login_widget_title; ?>" />
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
			$instance['login_widget_title']   = sanitize_text_field( $new_instance['login_widget_title'] );
			return $instance;
		}
}
function register_login_widget(){
	register_widget('login_widget');
}
add_action('widgets_init', 'register_login_widget');