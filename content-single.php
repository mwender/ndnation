<?php
/**
 * @package ndnation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1 class="page-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php ndnation_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-content-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php the_content(); ?>
		<?php sportsfanconnect_category_tag_list('featured'); ?>
		<?php include_once('templates/template-parts/social-share.php'); ?>
		<div id="ws_widget291" class="row nomarg"></div>
		<script>
			!function (d, id, opt) {
			  var js = d.createElement("script");
			  js.src = "https://wise.space/embed.js";
			  js.onload = js.onreadystatechange = function () {
			  if(!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
			  if(!this.executed) { this.executed = true;
			  setTimeout(function() { WiseSpace.insertWidget(id,opt) }, 0)}}};
			  d.documentElement.appendChild(js)
			}(document,"ws_widget291",{uId: 399, wId: 291, is_parent: false, wType: 1})
		</script>
		<?php ndnation_link_pages(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
