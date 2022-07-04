<?php
/**
* Enqueue scripts and style
 *
 * @package ndnation
 */

// FRONT END ENQUEUES

add_action( 'wp_enqueue_scripts', 'ndnation_scripts' );

function ndnation_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( 'ndnation-bootstrap-wp', THEME_DIR_URI . '/lib/public/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( 'ndnation-bootstrap', THEME_DIR_URI . '/lib/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	//wp_enqueue_style( 'font-awesome', THEME_DIR_URI . '/lib/public/css/font-awesome.min.css', false, '4.1.0' );
	// wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
	wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.12/js/all.js');
	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.0.12/css/all.css' );

	// load ndnation styles
	$theme_css = ( NDNATION_DEV_ENV )? 'style.css' : 'style.min.css';
	wp_enqueue_style( 'ndnation-style', trailingslashit( THEME_DIR_URI ) . 'lib/public/css/' . $theme_css );
	wp_enqueue_style( 'ndnation-style', trailingslashit( THEME_DIR_URI ) . 'lib/public/css/' . $theme_css, null, filemtime( trailingslashit( THEME_DIR_PATH ) . 'lib/public/css/' . $theme_css ) );

	// load fonts
	wp_enqueue_style('ndnation-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700|Roboto+Slab:400,700');

	// load bootstrap js
	wp_enqueue_script('ndnation-bootstrapjs', THEME_DIR_URI.'/lib/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( 'ndnation-bootstrapwp', THEME_DIR_URI . '/lib/public/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'ndnation-skip-link-focus-fix', THEME_DIR_URI . '/lib/public/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-ui-tabs', array('jquery'), true, false);

	wp_enqueue_script( 'ndnation-scripts', THEME_DIR_URI . '/lib/public/js/ndnation-scripts.js', array(), true, true);

	// if(is_page()){
	// 	global $wp_query;
	// 	$template = get_post_meta($wp_query->post->ID, '_wp_page_template', true);
	// 	if($template != 'templates/tmpl-home.php' && $template != 'templates/tmpl-schedule.php'){
	// 		wp_enqueue_script('ndnation-page-scripts', THEME_DIR_URI . '/lib/public/js/ndnation-page-scripts.js', true, true);
	// 	}
	// }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'ndnation-keyboard-image-navigation', THEME_DIR_URI . '/lib/public/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}

// ADMIN ENQUEUES

add_action('admin_head', 'sportsfanconnect_admin_enqueues');

function sportsfanconnect_admin_enqueues(){
	wp_enqueue_script('sportsfanconnect-admin-js', THEME_DIR_URI . '/lib/admin/js/sportsfanconnect-admin-js.js', array('jquery'), true, false);
  wp_enqueue_style( 'sportsfanconnect-admin-css', THEME_DIR_URI . '/lib/admin/stylesheets/sportsfanconnect-admin-style.css' );
}

// LOGIN ENQUEUES

add_action('login_head', 'sportsfanconnect_login_enqueues');
function sportsfanconnect_login_enqueues(){
	wp_enqueue_script('sportsfanconnect-login-js', THEME_DIR_URI . '/lib/admin/js/sportsfanconnect-login-js.js', array('jquery'), true, false);
	wp_enqueue_style('sportsfanconnect-login-css', THEME_DIR_URI . '/lib/admin/stylesheets/sportsfanconnect-login-style.css' );
	wp_enqueue_style('login-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700|Roboto+Slab:400,700');
}
