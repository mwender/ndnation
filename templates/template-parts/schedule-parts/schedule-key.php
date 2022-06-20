<div class="game-key-wrap col-sm-12">
  <ul class="game-key-items">
  	<li class="game-key">Key:</li>
    <?php if($tax_slug == 'mens-basketball' || $tax_slug == 'womens-basketball' || $tax_slug == 'baseball'){ ?>	
    	<li id="game-key-conf" class="game-key">
    		<span class="conf-logo acc"><img class="game-conf-icon" src="<?php echo get_stylesheet_directory_uri();?>/images/acc-conference-icon.png"></span> &ndash; Conference Game
    	</li>
    <?php } ?>
    <?php if($tax_slug == 'hockey'){ ?>	
    	<li id="game-key-conf" class="game-key">
    		<span class="conf-logo bten"><img class="game-conf-icon" src="<?php echo get_stylesheet_directory_uri();?>/images/big-ten-conference-icon.png"></span> &ndash; Conference Game
    	</li>
    <?php } ?>
  	<?php if($tax_slug == 'football'){ ?>
    	<!-- <li id="game-key-homecomming" class="game-key">
    		<span class="pre-icon"><i class="fas fa-home"></i></span> &ndash; Homecoming
    	</li> -->
    	<li id="game-key-night" class="game-key">
    		<span class="pre-icon"><i class="fas fa-moon"></i></span> &ndash; Night Game
    	</li>
  	<?php } ?>
  	<?php if($bowl_name && $tax_slug == 'football'){ ?>
    	<li id="game-key-bowl" class="game-key">
    		<span class="pre-icon"><i class="fas fa-trophy"></i></span> &ndash; <?php echo $bowl_name; ?>
    	</li>
  	<?php } ?>
  	<?php if($neut_site_name){ ?>
    	<li id="game-key-bowl" class="game-key">
    		<span class="pre-icon"><i class="fas fa-hands-helping"></i></span> &ndash; Neutral Site
    	</li>
  	<?php } ?>
  	<?php if($tax_slug != 'football'){ ?>
  		<li id="game-key-exhpsspg" class="game-key">
  			<span class="pre-icon"><i class="far fa-star"></i></span> &ndash; Exhibition
  		</li>
  	<?php } ?>
	</ul>
</div>