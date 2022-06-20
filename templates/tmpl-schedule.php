<?php
/*
Template Name: Schedule Page
*/
get_header(); 
$game_taxonomy  = get_field('game_taxonomy');
$tax_id         = $game_taxonomy->term_id;
$tax_slug       = $game_taxonomy->slug;

$sched_year_ini = get_field('sched_year');
$sched_year_arr = get_term_by('id', $sched_year_ini, 'sched_year_cat');
$sched_year_name = $sched_year_arr->name;
$sched_year = str_replace(' Schedule', '', $sched_year_name);
$sched_year_int = intval($sched_year);

$conf_finish   = get_field('conf_finish');
$over_finish   = get_field('over_finish');

$bowl_name     = "";
$game_type_excld = array('spring-game', 'exhibition');
if($tax_slug == 'football'){
	$rec_title = 'Record';
} else {
	$rec_title = 'Overall Record';
}
?>
  <main class="schedule-wrap">
    <div class="schedule-header">
    	<h1 class="schedule-title"><?php the_title(); ?></h1>
    </div>
    <div class="schedule-body row">
			<?php
				$args = array(
					'post_type' 	 => 'game',
					'posts_per_page' => 999,
					'order'          => 'ASC',
					'meta_key'       => 'game_date',
					'orderby'       => 'meta_value',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'game_cat',
							'field'    => 'term_id',
							'terms'    => array($tax_id)
						),
						array(
							'taxonomy' => 'sched_year_cat',
							'field'    => 'slug',
							'terms'    => array($sched_year_name)
						),
					)
				);
				$loop = new WP_Query($args);
	    	if($loop->have_posts()){
	    		$wins        = 0;
	    		$losses      = 0;
	    		$ties        = 0;
	    		$conf_wins   = 0;
	    		$conf_losses = 0;
	    		$conf_ties   = 0;

	    		include(locate_template('templates/template-parts/schedule-parts/schedule-column-titles.php'));
	    		
	    		while($loop->have_posts()){
	    			$loop->the_post();
	    			$game_date_arr    = get_field('game_date');
	    			$game_date        = preg_split("/[-]+/", $game_date_arr);
	    			$game_day         = $game_date[2];
	    			$game_month       = $game_date[1];
	    			$game_year        = $game_date[0];
	    			$game_time_arr    = get_field('game_time');
	    			$game_time_comp   = intval(str_replace(':', '', $game_time_arr));
	    			$game_time_str    = strtotime($game_time_arr);
	    			$game_time        = date('g:i a', $game_time_str);
	    			$homeaway_arr     = get_field('homeaway');
	    			$homeaway         = $homeaway_arr['value'];
	    			$tv_network       = get_field('tv_network');
	    			$homecomming_arr  = get_field('homecomming');
	    			$homecomming      = $homecomming_arr[0];
	    			$night_game_arr  = get_field('night_game');
	    			$night_game      = $night_game_arr[0];
	    			$bowl_game_arr    = get_field('bowl_game');
	    			$bowl_game        = $bowl_game_arr[0];
	    			if($bowl_game == 'yes'){
	    				$bowl_name       .= get_field('bowl_name');
	    			}
	    			$conf_champ_arr   = get_field('conf_champ');
	    			$conf_champ       = $conf_champ_arr[0];
	    			if($conf_champ == 'yes'){
	    				$conf_champ_name = get_field('conf_champ_name');
	    			}
	    			$neut_site_arr   = get_field('neut_site');
	    			$neut_site       = $neut_site_arr[0];
	    			if($neut_site == 'yes'){
	    				$neut_site_name = get_field('neut_site_name');
	    			}
	    			$team             = get_field('team');
	    			$team_score       = get_field('team_score');
	    			$team_to_link     = get_field('team_to_link', 'option');
	    			$opponent_score   = get_field('opponent_score');
	    			$ot_arr           = get_field('overtime');
	    			$ot               = $ot_arr[0];
	    			$num_ots_eis      = get_field('num_ots_eis');
	    			if($ot == 'yes'){
	    				if($num_ots_eis){
	    					$ots_eis = get_field('num_ots_eis');
	    				} else {
	    					$ots_eis = '';
	    				}
	    			}
	    			$conf_game_arr    = get_field('conf_game');
	    			$conf_game        = $conf_game_arr[0];
	    			if($homeaway == 'away'){
	    				if($bowl_game == 'yes'){
	    					$school_city  = get_field('bowl_city');
	    					$school_state = get_field('bowl_state');
	    					$venue        = get_field('bowl_site_name');
	    					$venue_link   = get_field('bowl_site_link');
	    				} elseif($conf_champ == 'yes') {
	    					$school_city  = get_field('conf_champ_city');
	    					$school_state = get_field('conf_champ_state');
	    					$venue        = get_field('conf_champ_site_name');
	    					$venue_link   = get_field('conf_champ_site_link');
	    				} elseif($neut_site == 'yes'){
	    					$school_city  = get_field('neut_site_city');
	    					$school_state = get_field('neut_site_state');
	    					$venue        = get_field('neut_site_name');
	    					$venue_link   = get_field('neutral_site_link');
	    				} else {
	    					$school_city  = get_field('school_city');
	    					$school_state = get_field('school_state');
	    					$venue        = get_field('op_stadium_name');
	    					$venue_link   = get_field('op_stadium_link');
	    				}
	    			} else {
	    				if($bowl_game == 'yes'){
	    					$school_city  = get_field('bowl_city');
	    					$school_state = get_field('bowl_state');
	    					$venue        = get_field('bowl_site_name');
	    					$venue_link   = get_field('bowl_site_link');
	    				} elseif($conf_champ == 'yes') {
	    					$school_city  = get_field('conf_champ_city');
	    					$school_state = get_field('conf_champ_state');
	    					$venue        = get_field('conf_champ_site_name');
	    					$venue_link   = get_field('conf_champ_site_link');
	    				} elseif($neut_site == 'yes'){
	    					$school_city  = get_field('neut_site_city');
	    					$school_state = get_field('neut_site_state');
	    					$venue        = get_field('neut_site_name');
	    					$venue_link   = get_field('neutral_site_link');
	    				} else {
	    					$school_city  = get_field('team_school_city', 'option');
	    					$school_state = get_field('team_school_state', 'option');
	    					if($tax_slug == 'football'){
	    						$venue = get_field('football_stadium', 'option');
	    						$venue_link = get_field('football_stadium_link', 'option');
	    					} 
	    					if($tax_slug == 'mens-basketball' || $tax_slug == 'womens-basketball'){
	    						$venue = get_field('basketball_stadium', 'option');
	    						$venue_link = get_field('basketball_stadium_link', 'option');
	    					} 
	    					if($tax_slug == 'hockey') {
	    						$venue = get_field('hockey_stadium', 'option');
	    						$venue_link = get_field('hockey_stadium_link', 'option');
	    					} 
	    					if($tax_slug == 'baseball') {
	    						$venue = get_field('baseball_stadium', 'option');
	    						$venue_link = get_field('baseball_stadium_link', 'option');
	    					}
	    				}
	    			}
	    			$opponent              = get_field('opponent');
	    			$opponent_city         = get_field('school_city');
	    			$opponent_state        = get_field('school_state');
	    			$opponent_nname        = get_field('mascott');
	    			$opponent_colors       = get_field('colors');
	    			$opponent_enrollment   = get_field('enrollment');
	    			$opponent_conf_name    = get_field('op_conf_name');
	    			$opponent_conf_link    = get_field('op_conf_link');
	    			$opponent_capacity     = get_field('stadium_capacity');
	    			$opponent_to_link      = get_field('op_to_link');
	    			$opponent_logo         = get_field('team_logo');
	    			$game_type_ini = get_the_terms(get_the_ID(), 'game_type');
	    			$game_type_arr = wp_list_pluck( $game_type_ini, 'slug' );
	    			$game_type_name_arr = wp_list_pluck($game_type_ini, 'name');
	    			$game_type = $game_type_arr[0];
	    			$game_type_name =  $game_type_name_arr[0];
	    			
	    			$terms_arr = array('Championship', 'Bowl', 'championship', 'bowl');

	    			include(locate_template('templates/template-parts/schedule-parts/game.php'));
	    		}
	    		wp_reset_query();
	    		include(locate_template('templates/template-parts/schedule-parts/schedule-key.php'));
					include(locate_template('templates/template-parts/schedule-parts/schedule-key.php'));
	    		include(locate_template('templates/template-parts/schedule-parts/schedule-record.php'));
	    	}
	    ?>
	   </div>
  </main>
<?php get_sidebar('schedules'); ?>
<?php get_footer(); ?>