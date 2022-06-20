<div class="game-record-wrap col-sm-12">
	<div class="col-sm-12 oa-record">
		<span class="bold"><?php echo $rec_title; ?>:</span> 
		<?php echo $wins; ?> - <?php echo $losses; ?>
		<?php if($tax_slug == 'hockey'){ ?> - <?php echo $ties;?><?php } ?><?php echo (($over_finish) ? ' ' . $over_finish : ''); ?>
	</div>
	<?php if($tax_slug == 'mens-basketball' || $tax_slug == 'womens-basketball' || $tax_slug == 'hockey' || $tax_slug == 'baseball'){ ?>
		<div class="col-sm-12 conf-record">
			<?php if($tax_slug == 'mens-basketball' || $tax_slug == 'womens-basketball' || $tax_slug == 'baseball'){ ?>
				<span class="bold"><img class="game-conf-icon" src="<?php echo get_stylesheet_directory_uri();?>/images/acc-conference-icon.png"> Record:</span> 
			<?php } else { ?>
				<span class="bold"><img class="game-conf-icon" src="<?php echo get_stylesheet_directory_uri();?>/images/big-ten-conference-icon.png"> Record:</span> 
			<?php } ?>
			<?php echo $conf_wins; ?> - <?php echo $conf_losses; ?>
			<?php if($tax_slug == 'hockey'){ ?> - <?php echo $conf_ties;?><?php } ?><?php echo (($conf_finish) ? ' ' . $conf_finish : ''); ?>
		</div>
	<?php } ?>
</div>