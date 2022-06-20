<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ndnation
 */
// Uncomment this line when pushing to Production
if( ! NDNATION_DEV_ENV )
	require_once( NDNATION_DATA_DIR_PATH . '_phpinc/_allfunc.inc' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php 
		wp_head();
		require_once( NDNATION_DATA_DIR_PATH . '_phpinc/_head_main.inc' );
	?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

	<?php get_template_part( 'templates/template-parts/header'); ?>

	<?php 
		if ( is_front_page() && !is_home() ){
			get_template_part( 'templates/template-parts/home-page-content-wrapper-start'); 
		} else {
			get_template_part( 'templates/template-parts/main-content-wrapper-start'); 
		}
	?>
