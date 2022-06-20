<div class="col-sm-12 game-wrap">
  <div class="game-date col-lg-2 col-md-2 col-sm-12">
  	<span class="mobile-game-heading hidden-md hidden-lg">Date:</span>
  	<?php 
  		echo '<span class="gdate">' . $game_month . '/' . $game_day . '</span>'; 
  		if($team_score == '' && $opponent_score == ''){
  			if($game_time_arr != ''){
  				echo ' <span class="gtime">' . $game_time . '</span>';
  			} else {
  				echo ' <span class="gtime">TBA</span>';
  			}
  		} else {
  			// Do Nothing
  		}
  	?>
	</div>
	<div class="game-opponent col-lg-5 col-md-5 col-sm-12">
		<span class="mobile-game-heading hidden-md hidden-lg">Opponent:</span>
		<?php 
			if($conf_game == 'yes'){ 
				if($tax_slug == 'mens-basketball' || $tax_slug == 'womens-basketball' || $tax_slug == 'baseball'){
					echo '<img class="game-conf-icon" src="'. get_stylesheet_directory_uri() .'/images/acc-conference-icon.png" title="Conference Game">&nbsp;'; 
				} else if($tax_slug == 'hockey'){
					echo '<img class="game-conf-icon" src="'. get_stylesheet_directory_uri() .'/images/big-ten-conference-icon.png" title="Conference Game">&nbsp;';
				} else {
					// Do nothing
				}
			} 
		?>
		<?php echo ((strpos_array($game_type, $game_type_excld) != false) ? '<span class="pre-icon"><i class="far fa-star" title="Exhibition"></i></span> ': ''); ?>
		<?php if($bowl_game == 'yes'){ echo '<span class="pre-icon"><i class="fas fa-trophy" title="Bowl Game"></i></span> ';} ?>
		<?php echo $opponent; ?>
		<?php 
			if($neut_site == 'yes' && $neut_site_name != ''){
				echo '(' . $neut_site_name . ')';
			}
			if($conf_champ == 'yes' && $conf_champ_name != ''){
				echo '(' . $conf_champ_name . ')';	
			}
			if($bowl_game == 'yes' && $bowl_name != ''){
				echo '(' . $bowl_name . ')';	
			}
		?>
		<?php 
			if($neut_site == 'yes' || $homecomming == 'yes' || $night_game == 'yes'){
				echo ' &ndash;';
			}
		?>
		<?php echo (($neut_site == 'yes') ? ' <i class="fas fa-hands-helping" title="Neutral Site"></i> ' : '' ); ?>
		<?php echo (($homecomming == 'yes') ? ' <i class="fas fa-home" title="Homecoming"></i> ' : ''); ?>
		<?php echo (($night_game == 'yes') ? ' <i class="fas fa-moon" title="Night Game"></i> ' : ''); ?>
	</div>
	<div class="game-loc col-lg-3 col-md-3 col-sm-12">
		<span class="mobile-game-heading hidden-md hidden-lg">Location:</span>
		<?php echo (($school_city != '') ? $school_city . ', ' . $school_state : '<div class="schedule-none"> - </div>');?>
	</div>
	<div class="game-score col-lg-2 col-md-2 col-sm-12 nopad-l">
		<span class="mobile-game-heading hidden-md hidden-lg">Result:</span>
		<?php 
			if($team_score != '' && $opponent_score != '') {
				if($team_score > $opponent_score){
					echo $team_score . '-' . $opponent_score;
					if($tax_slug != 'baseball'){
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.'OT)</span>' : '');
					} else {
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.')</span>' : '');
					}
					echo ' <span class="win-loss">W</span>';
					if(strpos_array($game_type, $game_type_excld) == false){
						$wins++;
						if($conf_game == 'yes'){
							$conf_wins++;
						}
					}
				} 
				if($team_score < $opponent_score) {
					echo $opponent_score . '-' . $team_score;
					if($tax_slug != 'baseball'){
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.'OT)</span>' : '');
					} else {
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.')</span>' : '');
					}
					echo ' <span class="win-loss">L</span>';
					if(strpos_array($game_type, $game_type_excld) == false){
						$losses++;
						if($conf_game == 'yes'){
							$conf_losses++;
						}
					}
				}
				if($team_score == $opponent_score) {
					echo $team_score . '-' . $opponent_score;
					if($tax_slug != 'baseball'){
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.'OT)</span>' : '');
					} else {
						echo (($ot == 'yes') ? ' <span class="overtime">('.$ots_eis.')</span>' : '');
					}
					echo ' <span class="win-loss">T</span>';
					if(strpos_array($game_type, $game_type_excld) == false){
						$ties++;
						if($conf_game == 'yes'){
							$conf_ties++;
						}
					}
				}
			} else {
				echo '<span class="schedule-none"> &mdash; </span>';
			}
		?>
	</div>
	<?php 
		include(locate_template('templates/template-parts/schedule-parts/game-more-info.php'));
	?>
</div>