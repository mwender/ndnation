<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package ndnation
 */

/**
* Custom Post Types and Custom Widgets
*/
require_once get_stylesheet_directory() . '/includes/cpts.php';
require_once get_stylesheet_directory() . '/includes/widgets.php';
require_once get_stylesheet_directory() . '/includes/tools.php';

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function ndnation_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'ndnation_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function ndnation_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  return $classes;
}
add_filter( 'body_class', 'ndnation_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function ndnation_enhanced_image_navigation( $url, $id ) {
  if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
    return $url;

  $image = get_post( $id );
  if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
    $url .= '#main';

  return $url;
}
add_filter( 'attachment_link', 'ndnation_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function ndnation_wp_title( $title, $sep ) {
  global $page, $paged;

  if ( is_feed() )
    return $title;

  // Add the blog name
  $title .= get_bloginfo( 'name' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title .= " $sep $site_description";

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    $title .= " $sep " . sprintf( __( 'Page %s', 'ndnation' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'ndnation_wp_title', 10, 2 );

//****************************//
//****** WP ADMIN PAGES ******//
//****************************//

function barracuda_admin_footer_text($left){
    $link  = get_bloginfo('url');
    $left = '<a href="'. $link . '" target="_blank"><img src="/wp-content/themes/ndnation/images/ndnation-logo-smaller.png" width="100" align="left" style="padding:5px 10px 0 0;"/></a>';
    return $left;
}
add_filter('admin_footer_text', 'barracuda_admin_footer_text');

function remove_dashboard_meta() {
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_menu_page( 'link-manager.php' );
}
add_action( 'admin_menu', 'remove_dashboard_meta' );

// This is just an idea to remove the ACF menu to prevent accidents
// add_action( 'admin_init', 'remove_acf_menu' );
// function remove_acf_menu() { 
//     global $current_user;
//     if ($current_user->user_login != ('webapps' || 'project.team')) {
//         remove_menu_page( 'edit.php?post_type=acf-field-group' );
//     }
// }

//*************************************//
//****** ADD CATEGORIES TO PAGES ******//
//*************************************//

function wp_page_categories() {  
    register_taxonomy_for_object_type('category', 'page');  
}
add_action( 'init', 'wp_page_categories' );


//******************************//
//****** ACF OPTIONS PAGE ******//
//******************************//
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'NDNation General Settings',
        'menu_title'    => 'NDN Settings',
        'menu_slug'     => 'ndnation-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

//*****************************//
//****** MOVE ACF FIELDS ******//
//*****************************//

add_action('acf/input/admin_head', 'cpage_acf_admin_head');
function cpage_acf_admin_head() {
?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function(){
                $('.acf-field-597a2fb4e73d3 .acf-input').append( $('#postdivrich') );
            });
        })(jQuery);
    </script>
    <style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: #FFF;
            padding-top: 0;
        }
    </style>
<?php       
    }

add_theme_support('post-formats', array('video', 'audio', 'image', 'gallery'));

function strpos_array($haystack, $needles, $theOffset=0) {
    $matches = array();

    if(empty($haystack) || empty($needles)) {
        return $matches;
    }

    $haylen = strlen($haystack);

    if($theOffset < 0) {  // Support negative offsets
        $theOffest += $haylen;
    }

    foreach($needles as $needle) {
        $needlelen = strlen($needle);
        $offset = $theOffset;

        while(($match = strpos($haystack, $needle, $offset)) !== false) {
            $matches[] = $match;
            $offset = $match + $needlelen;
            if($offset >= $haylen) {
                break;
            }
        }
    }
    return $matches;
}

function custom_excerpt($len,$read_more){
    $content = strip_shortcodes(get_the_content());
    if(empty($len)){
        $len = 50;
    }
    if(empty($read_more)){
        $read_more = 'Read More';
    }
    $clean_cont = wp_strip_all_tags($content);
    $cont_arr = explode(' ', $clean_cont);
    $cont_len = count($cont_arr);
    $cont = wp_trim_words($content, $len, '');
    $allowed_end = array('.','!','?','...');
    $exc = explode(' ', $cont);
    $found = false;
    $last = '';
    $new_cont = '';
    while (!$found && !empty($exc)){
        $full_exc = $exc;
        $last = array_pop($exc);
        $end = strrev($last);
        $found = in_array($end{0}, $allowed_end);
        $new_cont = implode(' ', $full_exc);
    }
    echo '<p>' . $new_cont . '</p>';
    echo '<p class="continue"><a href="' . get_the_permalink() . '">' . $read_more . '</a></p>';
}

function ndnation_excerpt_more( $more ) {
    return sprintf( '... <p class="continue"><a class="super-fancy" href="%1$s">%2$s</a></p>',
            get_permalink( get_the_ID() ),
            __( 'Full Notre Dame Column', 'ndnation' )
        );
}
add_filter( 'excerpt_more', 'ndnation_excerpt_more' );

function first_image_post_content() {
    $content = get_the_content();
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    $first_img = $matches[1][0];

    if(empty($first_img)){ //Defines a default image
        $first_img = '';
    }
    return $first_img;
}

function unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Media_Audio');
    unregister_widget('WP_Widget_Media_Image');
    unregister_widget('WP_Widget_Media_Video');
    unregister_widget('WP_Widget_Media_Gallery');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_default_widgets', 11);

// Move Yoast to Bottom

function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

add_filter( 'rss2_ns', function(){
  echo 'xmlns:media="http://search.yahoo.com/mrss/"';
});

// insert the image object into the RSS item (see MB-191)
add_action('rss2_item', function(){
  global $post;
  if (has_post_thumbnail($post->ID)){
    $thumbnail_ID = get_post_thumbnail_id($post->ID);
    $thumbnail = wp_get_attachment_image_src($thumbnail_ID, 'medium');
    if (is_array($thumbnail)) {
      echo '<media:thumbnail url="' . $thumbnail[0] . '" width="' . $thumbnail[1] . '" height="' . $thumbnail[2] . '" />';
    }
  }
});

/**
    THE FOLLOWING IS AN IDEA I HAD ON PROCESSING FORM SUBMISSIONS ITS NOT BEING USED BUT MIGHT BE
*/
// if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //check ip from share internet
//   $ip = $_SERVER['HTTP_CLIENT_IP'];
// }
// elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //to check ip is pass from proxy
//   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
// } else {
//   $ip = $_SERVER['REMOTE_ADDR'];
// }
// $blocked_emails = get_field('blocked_emails', 'option');
// $bemails_arr_ini = preg_split('/<br[^>]*>/i', $blocked_emails);
// $bemails_arr = array_map('trim', $bemails_arr_ini);
// $email = 'supere1977@gmail.com';
// if($blocked_emails){
//   if(in_array($email, $bemails_arr) || in_array($ip, $bemails_arr)){
//     // echo '<pre>';
//     //   var_dump('It Is!');
//     // echo '</pre>';
//   }
// }