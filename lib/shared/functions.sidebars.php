<?php
/**
 * Register widgetized Sidebars
 *
 * @package ndnation
 */


add_action( 'widgets_init', 'ndnation_widgets_init' );

function ndnation_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Top Wide Ad Slot', 'ndnation' ),
			'id'            => 'home-2-top-wide-ad-slot',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Top', 'ndnation' ),
			'id'            => 'home-2-top',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Top Left 2/3', 'ndnation' ),
			'id'            => 'home-2-top-left-two-thirds',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Top Right 1/3', 'ndnation' ),
			'id'            => 'home-2-top-left-one-third',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - News Row (Full Width)', 'ndnation' ),
			'id'            => 'home-2-news-row',
			'before_widget' => '<div id="%1$s" class="col-md-4 widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Home 2 - News Row (1/3 Width)', 'ndnation' ),
			'id'            => 'home-2-news-row-one-third',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - News Row (2/3 Width)', 'ndnation' ),
			'id'            => 'home-2-news-row-two-thirds',
			'before_widget' => '<div id="%1$s" class="colXXX-md-6 widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Column 1', 'ndnation' ),
			'id'            => 'home-2-column-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Column 2', 'ndnation' ),
			'id'            => 'home-2-column-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home 2 - Column 3', 'ndnation' ),
			'id'            => 'home-2-column-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'ndnation' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Sidebar', 'ndnation' ),
			'id'            => 'home-sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Schedules Sidebar', 'ndnation' ),
			'id'            => 'schedules-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Articles Sidebar', 'ndnation' ),
			'id'            => 'articles-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Latest Columns Home Ad Slot', 'ndnation' ),
			'id'            => 'latest-columns-home-ad-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Home Leaderboard Ad Slot', 'ndnation' ),
			'id'            => 'home-leaderboard-ad-slot-1',
			'before_widget' => '<div id="%1$s" class="leaderboard-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="leaderboard-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Leaderboard Ad Slot', 'ndnation' ),
			'id'            => 'leaderboard-ad-slot-1',
			'before_widget' => '<div id="%1$s" class="leaderboard-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="leaderboard-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Article Leaderboard Ad Slot', 'ndnation' ),
			'id'            => 'article-leaderboard-ad-slot-1',
			'before_widget' => '<div id="%1$s" class="leaderboard-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="leaderboard-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Article Before Content', 'ndnation' ),
			'id'            => 'article-before-content',
			'before_widget' => '<div id="%1$s" class="article-before-content %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="article-before-content">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Premium Ad Slot', 'ndnation' ),
			'id'            => 'premium-ad-slot',
			'before_widget' => '<div id="%1$s" class="local-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="local-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Local Ad Slot 1', 'ndnation' ),
			'id'            => 'local-ad-slot-1',
			'before_widget' => '<div id="%1$s" class="local-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="local-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Local Ad Slot 2', 'ndnation' ),
			'id'            => 'local-ad-slot-2',
			'before_widget' => '<div id="%1$s" class="local-ad %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="local-ad-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
    array(
      'name' => 'Widget Sidebar',
      'id' => 'widget-sidebar',
      'class' =>  'widget-sidebar',
      'description' => 'Widget Sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title' => '<h2>',
      'after_title' => '</h2>'
    )
	);
	register_sidebar(
    array(
      'name' => 'Top Nav Login Sidebar',
      'id' => 'top-nav-login-sidebar',
      'class' =>  'login-sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title' => '<h2>',
      'after_title' => '</h2>'
    )
	);
	for( $i = 1; $i < 10; $i++ ) {
		register_sidebar(
			array(
		      'name' => 'News Links Inline '.$i,
		      'id' => 'nlinline-'.$i,
		      'class' =>  'nlinline-sidebar',
		      'before_widget' => '<div id="%1$s" class="widget %2$s">',
		      'after_widget'  => '</div>',
		      'before_title' => '<h2>',
		      'after_title' => '</h2>'
			)
		);
	}
}
