<?php
	$sched_link = get_bloginfo('url')  . '/' . $term_year_p1. '-football' 
?>
<div class="schedule-block">
	<table>
		<?php
			echo "<tr class=\"row sched-year-title\"><th colspan=\"3\"><h4>$term_year_p1 Football Schedule</h4></th></tr>";
			if($football_loop_p1->have_posts()){
				while($football_loop_p1->have_posts()){
					$football_loop_p1->the_post();
					$game_date_ini  = get_field('game_date');
					$game_date      = preg_split("/[-]+/", $game_date_ini);
					$game_day       = $game_date[2];
					$game_month     = $game_date[1];
					$game_year      = $game_date[0];
					$game_time_ini  = get_field('game_time');
					$tz             = $_GET['tz'];
					if($tz == 'pacific'){
						$game_time_str  = strtotime($game_time_ini) - 7200;
					}
					elseif($tz == 'mountain'){
						$game_time_str  = strtotime($game_time_ini) - 3600;
					}
					elseif($tz == 'eastern'){
						$game_time_str  = strtotime($game_time_ini) + 3600;
					} else {
						$game_time_str  = strtotime($game_time_ini);
					}
					$game_time      = date('g:i A', $game_time_str);
					$tv_network     = get_field('tv_network');
					$team       		= get_field('team');
					$team_score 		= get_field('team_score');
					$opponent_ini   = get_field('opponent');
					$opponent       = str_replace(array('Northern', 'Southern', 'Eastern', 'Western', 'State'), array('N.', 'S.', 'E.', 'W.', 'St.'), $opponent_ini);
					$opponent_score = get_field('opponent_score');
					$homeaway_ini   = get_field('homeaway');
					$neut_site_arr   = get_field('neut_site');
					$neut_site       = $neut_site_arr[0];
					if($neut_site == 'yes'){
						$neut_site_name = get_field('neut_site_name');
						$neut_site_city = get_field('neut_site_city');
					}
					$conf_champ_arr   = get_field('conf_champ');
					$conf_champ       = $conf_champ_arr[0];
					if($conf_champ == 'yes'){
						$conf_champ_name = get_field('conf_champ_name');
					}
					$bowl_game_arr    = get_field('bowl_game');
					$bowl_game        = $bowl_game_arr[0];
					if($bowl_game == 'yes'){
						$bowl_name       .= get_field('bowl_name');
					}
					$homeaway       = $homeaway_ini['value'];
					$game_type_arr  = wp_get_post_terms( get_the_ID(), 'game_type');
					$gt_id = '';
					foreach ($game_type_arr as $game_type) {
						$gt_id .= $game_type->term_id;
					}
					if($team_score != '' && $opponent_score != '' && $gt_id == '429'){
		?>
						<tr class="row game-row">
							<td class="game-date">
								<?php echo $game_month . '/' . $game_day . ' '; ?>
							</td>
							<td class="game-opponent" colspan="2">
								<a href="<?php echo get_the_permalink(); ?>" <?php echo $link_tgt; ?>>
									<?php echo $team . ' ' . $team_score . ', ' . $opponent . ' ' . $opponent_score; ?>
								</a>
							</td>
						</tr>
		<?php			
		} else {
		?>
			<tr class="row game-row">
				<td class="game-date">
					<?php 
						if($game_year != '9999'){
							echo $game_month . '/' . $game_day . ' ';	
						} else {
							echo ' - / - ';
						}
					?>
				</td>
				<td class="game-opponent">
					<?php if($homeaway == 'away' && $neut_site != 'yes' && $conf_champ != 'yes' && $bowl_game != 'yes'){ ?>
						<span class="schedule-at-symbol">@</span>
					<?php	} else if($neut_site == 'yes' || $conf_champ == 'yes' || $bowl_game == 'yes') { ?>
						<span class="schedule-vs-symbol">VS</span>
					<?php 
						} else {
							// Do nothing
						}
					?>
					<?php 
						echo ' <span class="opponent-name">' . $opponent .'</span>';
						if($neut_site == 'yes' && $conf_champ != 'yes' && $bowl_game != 'yes'){
							if($neut_site_name != '' && $neut_site_city != ''){
								echo ' <span class="neutral-site-name">('.$neut_site_name.')</span>';
							} else if($neut_site_name == '' && $neut_site_city != ''){
								echo ' <span class="neutral-site-name">('.$neut_site_city.')</span>';
							} else {
								// Do Nothing
							}
						}
						if($conf_champ == 'yes' && $conf_champ_name != '' && $neut_site != 'yes' && $bowl_game != 'yes'){
							echo ' <span class="neutral-site-name">('.$conf_champ_name.')</span>';
						}
						if($bowl_game == 'yes' && $bowl_name != '' && $neut_site != 'yes' && $conf_champ != 'yes'){
							echo ' <span class="neutral-site-name">('.$bowl_name.')</span>';
						}
					?>
				</td>
				<td class="game-time">
					<?php 
						if($team_score != '' && $opponent_score != ''){
							if($team_score > $opponent_score){
								echo (($team_score > $opponent_score) ? 'W ' : 'L ') . $team_score . '-' . $opponent_score;
							} else {
								echo (($team_score > $opponent_score) ? 'W ' : 'L ') . $opponent_score . '-' . $team_score;
							}
						} else {
							if($game_time_ini){
								echo $game_time; 
							} else {
								echo '<span class="no-time-spacer"></span>';
								echo 'TBA';
							}
						}
					?>
					<?php if($tv_network && $team_score == '' && $opponent_score == ''){ ?>
						<div class="tool-tip">
							<i class="fas fa-tv tv-hover" aria-hidden="true"></i>
							<div class="tv-tool-tip">
								<?php echo $tv_network; ?>
								<div class="tool-tip-arrow"></div>
							</div>
						</div>
					<?php } ?>
				</td>
			</tr>
		<?php
				}
			}
			wp_reset_query();
		}
		?>
	</table>
	<div class="text-center">
		<a class="btn" href="<?php echo $sched_link; ?>">Full <?php echo $term_year_p1; ?> Schedule</a>
	</div>
</div>