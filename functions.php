<?php
/**
 * NDNation functions and definitions
 *
 * @package ndnation
 */


 /**
  * Store the theme's directory path and uri in constants
  */
 define('THEME_DIR_PATH', get_template_directory());
 define('THEME_DIR_URI', get_template_directory_uri());
 define( 'NDNATION_DATA_DIR_PATH', THEME_DIR_PATH . '/../../../data/' );

/**
 * Detect "development" environment
 */
$dev_env = ( '.local' == stristr( site_url(), '.local' ) ) ? true : false ;
define( 'NDNATION_DEV_ENV', $dev_env );


/**
 * NDNation includes
 *
 * The $ndnation_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

$ndnation_includes = array(
    '/lib/shared/functions.setup.php',                  // Theme Setup
    '/lib/shared/functions.sidebars.php',               // Register Sidebars

    '/lib/admin/functions.custom-header.php',           // Implement the Custom Header feature. (for customizer).
    '/lib/admin/functions.customizer.php',              // Customizer additions.
    '/lib/shared/functions.template-tags.php',          // Custom template tags for this theme.
    '/lib/shared/functions.extras.php',                 // Custom functions that act independently of the theme templates.

    '/lib/public/functions.enqueue-scripts.php',        // Enqueue Scripts and Styles
    '/lib/public/functions.fusionfarm-functions.php',   // Custom fusionfarm functions
    '/lib/public/class.bootstrap-wp-navwalker.php',     // Load custom WordPress nav walker.

    '/lib/public/shortcode.latest-news.php',            // Load Latest News shortcode handler.

    '/lib/plugins/functions.woocommerce.php',           // Woocommerce Hook & Filter Functions

    '/lib/admin/class.ff-theme-update-checker.php'      // Theme Update Checker
);


foreach ($ndnation_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'ndnation'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}

unset($file, $filepath);



//Initialize the update checker.
/*

$example_update_checker = new NDNation_Update_Checker (
    'ndnation',
    'http://iplusplus.dev.fusionfarm.com/themes/ndnation/info.json'
);

*/

// Add the image node to RSS feed
function add_rss_node_image() {
    global $post;
    if(has_post_thumbnail($post->ID)):
        $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
        echo "<enclosure url=\"{$thumbnail}\" type=\"image/jpg\" />";
    endif;
}

add_action('rss2_item', 'add_rss_node_image');
