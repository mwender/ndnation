<?php
/**
* This template for displaying the main content wrappers opening tags.
*
* Override this template by copying it to yourtheme/templates/parts/main-content-wrapper-start.php
*
* @author 	GazLab
* @package 	ndnation
* @version  2.1.0
*/
?>


	<div class="main-content">
		<?php 
			if(is_active_sidebar( 'leaderboard-ad-slot-1' )){
				dynamic_sidebar('leaderboard-ad-slot-1');
			}
		?>
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
		<div class="container">
			<div class="row">
				<div id="content" class="main-content-inner col-sm-12 col-md-8">
		