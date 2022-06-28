<?php

namespace NDNation\shortcodes;

function get_latest_news( $atts ){
  $args = shortcode_atts([
    'category'    => null,
    'css_classes' => 'nopad section',
  ], $atts );
  if( is_null( $args['category'] ) || empty( $args['category'] ) )
    return '<div>Please specify a <code>category</code>.</div>';

  $sanitized_category_slug = sanitize_title( $args['category'] );

  $term = get_term_by( 'slug', $sanitized_category_slug, 'news_links_cat' );

  $cat_term_metas = get_option("taxonomy_{$term->term_id}_metas");
  $cat_pos        = $cat_term_metas['category-order'];
  if( $cat_pos != 0 ){
    $cclass = ' collapsible';
  } else {
    $cclass = '';
  }

  $get_posts_args = [
    'post_type'   => 'news_links',
    'numberposts' => 5,
    'tax_query'   => [
      [
        'taxonomy'  => 'news_links_cat',
        'field'     => 'term_id',
        'terms'     => $term->term_id,
      ],
    ],
  ];

  $posts = get_posts( $get_posts_args );
  $html = '';
  if( $posts ):
    ob_start();
    ?>
    <div id="nl-<?php echo $term->slug; ?>" class="nl <?php echo $args['css_classes'] ?>">
      <div class="nl-title">
        <div class="toggle"><i class="fas fa-plus-circle"></i></div>
        <h3><a href="/news-links?tab=<?php echo $cat_pos; ?>"><?php echo $term->name; ?></a></h3>
        <div class="clear"></div>
      </div>
      <div class="nl-list<?php echo $cclass; ?>">
        <ul class="nl-items">
          <?php
          global $post;
          foreach( $posts as $post ):
            //global $post;
            setup_postdata( $post );
            $sources_arr      = wp_get_post_terms( get_the_ID(), 'source_cat' );
            $source_slug_arr  = wp_list_pluck( $sources_arr, 'slug' );
            $source_name_arr  = wp_list_pluck( $sources_arr, 'name' );
            $source_slug      = $source_slug_arr[0];
            if($source_slug == 'other' || $source_slug == 'opponent'){
              $source_name = '';
            } else {
              $source_name = ' ('.$source_name_arr[0] . ')';
            }
            ?>
            <li class="nl-item">
              <span class="nl-date"><?php echo get_the_date( 'n/j' ); ?></span> <a href="<?php echo get_field('news_link_url'); ?>" target="_blank"><?php the_title();?><?php echo $source_name; ?></a>
            </li>
            <?php
          endforeach;
          wp_reset_query();
          ?>
        </ul>
        <div class="text-center">
          <a class="btn" href="/news-links?tab=<?php echo $cat_pos; ?>">View More</a>
        </div>
      </div>
    </div>
    <?php
    $html = ob_get_clean();
  endif;

  return $html;
}
add_shortcode( 'latestnews', __NAMESPACE__ . '\\get_latest_news' );

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
add_shortcode( 'latestnewsOLD', __NAMESPACE__ . '\\latest_news' );
