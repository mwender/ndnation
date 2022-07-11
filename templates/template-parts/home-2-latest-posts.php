<?php
  //*
  $latest_posts = get_posts( [ 'numberposts' => 2 ] );
  if( $latest_posts ){
    ?>
    <div class="row">
      <div class="col-lg-8">
        <div class="topper-wide">
            <h2>Latest Columns</h2>
        </div>
        <div class="row articles">
        <?php
        foreach( $latest_posts as $post ):
          setup_postdata( $post );
          ?>
          <div class="col-lg-6">
            <header>
              <h4 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
            </header>
            <div class="post-excerpt">
              <?php the_excerpt(); ?>
            </div>
          </div>

          <?php
        endforeach;
        ?></div><!-- .row.articles -->
      </div><!-- .col-lg-8 -->
      <div class="col-lg-4">
        <div id='rectangle_1'></div>
      </div><!-- .col-lg-4 -->
    </div><!-- .row -->
<?php
    wp_reset_postdata();
  }
  /**/
?>