<?php
/**
 * Template Name: News Links Widget Page
 * This template will only display the news links widget
 */
?>
<html <?php language_attributes(); ?> class="no-js widget-page">
	<head>
	    <meta charset="<?php bloginfo( 'charset' ); ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?php wp_head(); ?>
	</head>
	<body class="widget-include">
		<?php dynamic_sidebar('widget-sidebar'); ?>
	</body>
</html>