<?php

add_action('admin_menu', 'hf_scripts');
function hf_scripts() {
	/*
	add_menu_page('HF Script Settings', 'HF Scripts', 'administrator', __FILE__, 'hf_scripts_page',
	HFS_URL . '/img/fusionfarm-icon.png');
	*/
	add_management_page( 'HF Script Settings', 'HF Scripts', 'administrator', 'hf-scripts', 'hf_scripts_page' );
	add_action( 'admin_init', 'hf_scripts_register' );
}

function hf_scripts_register() {
	register_setting('hf-script-settings-group', 'header_scripts');
	register_setting('hf-script-settings-group', 'footer_scripts');
}

function hf_scripts_page() {
?>
	<div class="wrap">
		<h2>Header and Footer Scripts</h2>
		<form method="post" action="options.php">
			<?php
			settings_fields('hf-script-settings-group');
			do_settings_sections( 'hf-script-settings-group');
			?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row">Header Scripts</th>
				<td>
					<textarea style="width: 500px; height: 300px;" name="header_scripts"><?php echo esc_attr(get_option('header_scripts')); ?></textarea>
				</tr>
				<tr valign="top">
				<th scope="row">Footer Scripts</th>
				<td>
					<textarea style="width: 500px; height: 300px;" name="footer_scripts"><?php echo esc_attr(get_option('footer_scripts')); ?></textarea>
				</tr>
			</table>
			<?php
			submit_button();
			?>
		</form>
	</div>
<?php
}
