<?php
  //*
  $latest_posts = get_posts( [ 'numberposts' => 3 ] );
  if( $latest_posts ){
    ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="topper-wide">
            <h2>Latest Columns</h2>
        </div>
      </div>
    </div>
    <div class="row">
    <?php
    foreach( $latest_posts as $post ):
      setup_postdata( $post );
      ?>
      <div class="col-md-4">
        <header>
          <h4 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
        </header>
        <div class="post-excerpt">
          <?php the_excerpt(); ?>
        </div>
      </div>

      <?php
    endforeach;
    ?></div><!-- .row --><?php
    wp_reset_postdata();
  }
  /**/
?>