<?php
/**
* Set up HF-Script Options and Page Actions
 *
 * @author   GazLab
 * @package  GazLab Scripts
 * @version  1.0.5
 */



/**
 * Create the Admin Menu
 */
add_action('admin_menu', 'hf_scripts');

function hf_scripts() {

	/*
	add_menu_page('HF Script Settings', 'HF Scripts', 'administrator', __FILE__, 'hf_scripts_page',
	HFS_URL . '/img/fusionfarm-icon.png');
	*/

	add_management_page( 'HF Script Settings', 'HF Scripts', 'administrator', 'hf-scripts', 'hf_scripts_page' );

	add_action( 'admin_init', 'hf_scripts_register' );

}



/**
 * Register the hf-scripts settings
 */
function hf_scripts_register() {
	register_setting('hf-script-settings-group', 'header_scripts');
	register_setting('hf-script-settings-group', 'footer_scripts');
}



/**
 * The hf-scripts settings page
 */
function hf_scripts_page() {

	?>

	<div class="wrap">

		<h2>Header and Footer Scripts</h2>

		<form method="post" action="options.php">

			<?php

				submit_button();
				settings_fields('hf-script-settings-group');
				do_settings_sections( 'hf-script-settings-group');

			?>

			<table class="form-table">

				<tr valign="top">

					<th scope="row">Header Scripts</th>

					<td>

						<textarea class="widefat" style="height: 300px;" name="header_scripts"><?php echo esc_attr(get_option('header_scripts')); ?></textarea>

					</td>

				</tr>

				<tr valign="top">

					<th scope="row">Footer Scripts</th>

					<td>

						<textarea class="widefat" style="height: 300px;" name="footer_scripts"><?php echo esc_attr(get_option('footer_scripts')); ?></textarea>

					</td>

				</tr>

			</table>

			<?php

				submit_button();

			?>

		</form>

	</div>

	<?php

}



/**
 * Print any header scripts on the front end
 */
add_action('wp_head','hf_header_scripts');

function hf_header_scripts() {

    echo get_option('header_scripts'); // Sitewide scripts from options

    if ( is_singular() ) { // Individual Page scripts

        $page_header_scripts = get_post_meta( get_the_ID(), 'hf_page_header_script', true );

        echo $page_header_scripts;

    }

}



/**
 * Print any footer scripts on the front end
 */
add_action('wp_footer','hf_footer_scripts');

function hf_footer_scripts() {

    echo get_option('footer_scripts'); // Sitewide scripts from options

    if ( is_singular() ) { // Individual Page scripts

        $page_footer_scripts = get_post_meta( get_the_ID(), 'hf_page_footer_script', true );

        echo $page_footer_scripts;

    }

}
