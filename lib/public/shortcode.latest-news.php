<?php

namespace NDNation\shortcodes;

function latest_news(){
  ob_start();
  ?>
      <div class="topper-wide">
        <h2>Latest News</h2>
      </div>
      <?php include(locate_template('templates/template-parts/news-module.php')); ?>
  <?php
  $html = ob_get_clean();
  return $html;
}
add_shortcode( 'latestnews', __NAMESPACE__ . '\\latest_news' );
