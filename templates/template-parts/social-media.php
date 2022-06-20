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
			<a href="<?php echo $socmed_link; ?>"<?php echo ( ( array_key_exists( 0, $socmed_target ) && $socmed_target[0] == 'yes' ) ? ' target="_blank" ' : ''); ?>title="<?php echo $socmed_name; ?>">
				<i class="<?php echo $prefix . ' ' . $socmed_fa_class; ?>"></i>
			</a>
		</li>
	<?php
		}
	?>
	</ul>
<?php
	}