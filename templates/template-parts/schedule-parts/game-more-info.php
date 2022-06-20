<?php
	if($tax_slug == 'football'){
		$v_label = 'Stadium';
	} else {
		$v_label = 'Arena';
	}
	if(have_rows('media_links') || have_rows('site_links')){
		$mi_col_wrap_class = 'col-sm-6 nopad-r';
		$mi_sub_col_class  = 'col-sm-12 nopad-l';
	} else {
		$mi_col_wrap_class = 'col-sm-12';
		$mi_sub_col_class  = 'col-sm-12 nopad';
	}
	if(have_rows('media_links') && !have_rows('site_links')){
		$mlsl_class = ' col-sm-6';
	} elseif(have_rows('site_links') && !have_rows('media_links')){
		$mlsl_class = ' col-sm-6';
	} else {
		$mlsl_class = ' col-sm-3';
	}

?>
<?php if(have_rows('media_links') || have_rows('site_links') || $opponent_nname || $opponent_colors || ($opponent_city && $opponent_state) || $opponent_conf_name || $opponent_enrollment){ ?>
	<div class="game-more-info-trigger">
		<i class="fas fa-plus-circle"></i>
	</div>
	<div class="game-more-info col-sm-12">
		<div class="game-mi-header row">
			<div class="game-mi-head-col">
				<?php echo  $game_month . '/' . $game_day; ?>
				<?php if($homeaway != 'home' && $neut_site != 'yes' && $conf_champ != 'yes' && $bowl_game != 'yes'){ ?>
					<span class="game-mi-head-sep away">@</span> 
				<?php } else { ?>
					<span class="game-mi-head-sep">vs</span> 
				<?php } ?>
				<?php 
					echo $opponent;
					echo (($tv_network) ? ' - <i class="fas fa-tv"></i> ' . $tv_network : '' );
				?>
			</div>
			<?php if($venue && $venue_link){ ?>
				<div class="game-mi-head-col text-right">
					<a href="<?php echo $venue_link; ?>" target="_blank"><?php echo $venue; ?></a>
				</div>
			<?php 
				} else {
			?>
				<div class="game-mi-head-col text-right">
					<?php 
						if($neut_site == 'yes' && $conf_champ != 'yes' && $bowl_game != 'yes'){
							echo $neut_site_name;
						} else if($neut_site != 'yes' && $conf_champ == 'yes' && $bowl_game != 'yes'){
							echo $conf_champ_name;
						} else if($neut_site != 'yes' && $conf_champ != 'yes' && $bowl_game == 'yes'){
							echo $bowl_name;
						} else {
							// Do nothing
						}
					?>
				</div>
			<?php
				} 
			?>
			<div style="clear:both;"></div>
		</div>
		<div class="game-mi-content row">
			<?php if($opponent_nname || $opponent_colors || ($opponent_city && $opponent_state) || $opponent_conf_name || $opponent_enrollment){ ?>
				<div class="game-mi-links-section <?php echo $mi_col_wrap_class; ?>">
					<div class="game-mi-school-info col-sm-12 nopad">
						<div class="game-mi-head <?php echo $mi_sub_col_class; ?>">
							<span class="mi-head-title">Opponent Info</span>
						</div>
						<div class="game-mi-opponent-info col-sm-12 nopad">	
							<?php
								if($opponent_logo && have_rows('media_links') && have_rows('site_links')){
							?>
								<div class="game-mi-opponent-logo with-links">
									<img src="<?php echo $opponent_logo['sizes']['thumbnail']; ?>">
								</div>
							<?php
								} else if($opponent_logo && (have_rows('media_links') || have_rows('site_links'))) {
							?>
								<div class="game-mi-opponent-logo with-links">
									<img src="<?php echo $opponent_logo['sizes']['thumbnail']; ?>">
								</div>
							<?php
								} else if($opponent_logo && !have_rows('media_links') && !have_rows('site_links')) {
							?>
								<div class="game-mi-opponent-logo">
									<img src="<?php echo $opponent_logo['sizes']['thumbnail']; ?>">
								</div>
							<?php
								} else {
									// Do Nothing
								}
							?>
							<?php if($opponent_nname){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title">Nickname:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo $opponent_nname; ?>
									</div>
								</div>
							<?php } ?>
							<?php if($opponent_colors){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title">Colors:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo $opponent_colors; ?>
									</div>
								</div>
							<?php } ?>
							<?php if($opponent_city && $opponent_state){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title">Address:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo $opponent_city; ?>, <?php echo $opponent_state; ?>
									</div>
								</div>
							<?php } ?>
							<?php if($opponent_enrollment){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title">Enrollment:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo number_format($opponent_enrollment, 0, '', ','); ?>
									</div>
								</div>
							<?php } ?>
							<?php if($opponent_conf_name){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title">Conference:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo (($opponent_conf_link) ? '<a href="'.$opponent_conf_link.'" target="_blank">'.$opponent_conf_name.'</a>' : $opponent_conf_name); ?>
									</div>
								</div>
							<?php } ?>
							<?php if($opponent_capacity && $homeaway != 'home' && $venue && $neut_site != 'yes' && $conf_champ != 'yes'){ ?>
								<div class="<?php echo $mi_sub_col_class; ?>">
									<div class="col-sm-7 nopad">	
										<span class="game-mi-title"><?php echo $v_label ?> Capacity:</span>
									</div>
									<div class="col-sm-5 nopad-r text-left">
										<?php echo number_format($opponent_capacity, 0, '', ','); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php
				if(have_rows('media_links')){
			?>
					<div class="game-mi-mlsl-section nopad-l<?php echo $mlsl_class; ?>">
						<div class="game-mi-head">
							<span class="mi-head-title">Media Links</span>
						</div>
						<ul class="game-mi-items">	
							<?php
								while(have_rows('media_links')){
									the_row();
									$link_text   = get_sub_field('media_link_text');
									$link        = get_sub_field('media_link');
									$link_target = get_sub_field('media_link_target');
							?>
								<li class="game-mi-item">
									<a href="<?php echo $link; ?>"<?php echo (($link_target[0] == 'yes') ? ' target="_blank"' : ''); ?>><?php echo $link_text; ?></a>
								</li>
							<?php
								}
							?>
						</ul>
					</div>
			<?php
				}
			?>
			<?php
				if(have_rows('site_links')){
			?>
					<div class="game-mi-mlsl-section nopad-l<?php echo $mlsl_class; ?>">
						<div class="game-mi-head">
							<span class="mi-head-title">Site Links</span>
						</div>
						<ul class="game-mi-items">
							<?php
								while(have_rows('site_links')){
									the_row();
									$link_text   = get_sub_field('site_link_text');
									$link        = get_sub_field('site_link');
									$link_target = get_sub_field('site_link_target');	
							?>
								<li class="game-mi-item">
									<a href="<?php echo $link; ?>"<?php echo (($link_target[0] == 'yes') ? ' target="_blank"' : ''); ?>><?php echo $link_text; ?></a>
								</li>
							<?php	
								}
							?>
						</ul>
					</div>
			<?php 
				}
			?>
			<?php if($venue && $neut_site != 'yes' && $conf_champ != 'yes' && $team_score == '' && $opponent_score == ''){ ?>
				<?php if($homeaway != 'home' && $opponent_to_link){ ?>
					<div class="game-mi-tl col-sm-12 nopad text-center">
						<a class="btn" href="<?php echo $opponent_to_link; ?>" target="_blank"><?php echo $opponent; ?> Ticket Office</a>
					</div>
				<?php } else if($homeaway == 'home' && $team_to_link){ ?>
					<div class="game-mi-tl col-sm-12 nopad text-center">
						<a class="btn" href="<?php echo $team_to_link; ?>" target="_blank"><?php echo $team; ?> Ticket Office</a>
					</div>
				<?php 
					} else {
						// Do Nothing
					} 
				?>
			<?php } ?>
		</div>
	</div>
<?php } ?>