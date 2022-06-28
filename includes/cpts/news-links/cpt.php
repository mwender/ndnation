<?php
//******************************************//
//******* NEWS LINKS CUSTOM POST TYPE ******//
//******************************************//

function news_links_cpt(){
  $labels = array(
    'name'                  => _x( 'News Links', 'Post Type General Name', 'ndnation' ),
    'singular_name'         => _x( 'News Link', 'Post Type Singular Name', 'ndnation' ),
    'menu_name'             => __( 'News Links', 'ndnation' ),
    'name_admin_bar'        => __( 'News Link', 'ndnation' ),
    'archives'              => __( 'News Link Archives', 'ndnation' ),
    'parent_item_colon'     => __( 'Parent News Link:', 'ndnation' ),
    'all_items'             => __( 'All News Links', 'ndnation' ),
    'add_new_item'          => __( 'Add New', 'ndnation' ),
    'add_new'               => __( 'Add New', 'ndnation' ),
    'new_item'              => __( 'New News Link', 'ndnation' ),
    'edit_item'             => __( 'Edit News Link', 'ndnation' ),
    'update_item'           => __( 'Update News Link', 'ndnation' ),
    'view_item'             => __( 'View News Link', 'ndnation' ),
    'search_items'          => __( 'Search News Links', 'ndnation' ),
    'not_found'             => __( 'Not found', 'ndnation' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'ndnation' ),
    'featured_image'        => __( 'News Link Image', 'ndnation' ),
    'set_featured_image'    => __( 'Set News Link Image', 'ndnation' ),
    'remove_featured_image' => __( 'Remove News Link Image', 'ndnation' ),
    'use_featured_image'    => __( 'Use as News Link Image', 'ndnation' ),
    'insert_into_item'      => __( 'Insert into News Link', 'ndnation' ),
    'uploaded_to_this_item' => __( 'Uploaded to this News Link', 'ndnation' ),
    'items_list'            => __( 'News Links list', 'ndnation' ),
    'items_list_navigation' => __( 'News Links list navigation', 'ndnation' ),
    'filter_items_list'     => __( 'Filter News Link list', 'ndnation' ),
  );
  $args = array(
    'label'                 => __( 'news_links', 'ndnation' ),
    'description'           => __( 'News Link Posts', 'ndnation' ),
    'labels'                => $labels,
    'supports'              => array('title','revisions'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-admin-links',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,        
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  );
  register_post_type('news_links', $args );
}
add_action('init', 'news_links_cpt', 0);

function categories() {
  $labels = array(
    'name'              => _x( 'Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Categories' ),
    'all_items'         => __( 'All Categories' ),
    'parent_item'       => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item'         => __( 'Edit Category' ),
    'update_item'       => __( 'Update Category' ),
    'add_new_item'      => __( 'Add New Category' ),
    'new_item_name'     => __( 'New Category Name' ),
    'menu_name'         => __( 'Categories' ),
  );
  $args = array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'labels'            => $labels,
    'query_var'         => true,
    'show_admin_column' => true
  );
  register_taxonomy('news_links_cat','news_links',$args);
}
add_action( 'init', 'categories' );

function source() {
  $labels = array(
    'name'              => _x( 'Sources', 'taxonomy general name' ),
    'singular_name'     => _x( 'Source', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Sources' ),
    'all_items'         => __( 'All Sources' ),
    'parent_item'       => __( 'Parent Source' ),
    'parent_item_colon' => __( 'Parent Source:' ),
    'edit_item'         => __( 'Edit Source' ),
    'update_item'       => __( 'Update Source' ),
    'add_new_item'      => __( 'Add New Source' ),
    'new_item_name'     => __( 'New Source Name' ),
    'menu_name'         => __( 'Sources' ),
  );
  $args = array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'labels'            => $labels,
    'query_var'         => true,
    'show_admin_column' => true
  );
  register_taxonomy('source_cat','news_links',$args);
}
add_action( 'init', 'source' );


// CATEGORY ORDER

function add_news_links_cat_columns($columns){
    $columns['category-order'] = __('Category Order', 'ndnation');
    return $columns;
}
add_filter('manage_edit-news_links_cat_columns', 'add_news_links_cat_columns');

function add_news_links_cat_column_content($string = '', $column, $term_id){
    $cat_ord = get_term_meta($term_id, 'category-order', true);
    switch($column){
      case 'category-order':
        echo $cat_ord;
        break;
      default:
        break;
    }
}
add_filter('manage_news_links_cat_custom_column', 'add_news_links_cat_column_content', 10, 3);

function news_links_cat_quick_edit_category_field( $column, $screen, $term_id ) {
    $cat_order = get_term_meta($term_id, 'category-order', true);
    // If we're not iterating over our custom column, then skip
    if ( $screen != 'news_links_cat' && $column != 'category-order' ) {
        return false;
    }
    ?>
    <fieldset>
        <div id="sportsfanconnect-category-order" class="inline-edit-col">
            <label>
                <span class="title"><?php _e( 'Category Order', 'ndnation' ); ?></span>
                <span class="input-text-wrap"><input type="text" name="<?php echo esc_attr( $column ); ?>" class="ptitle" value="<?php echo $cat_order;?>"></span>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action( 'quick_edit_custom_box', 'news_links_cat_quick_edit_category_field', 10, 3 );

function news_links_cat_quick_edit_save_category_field( $term_id ) {
    if ( isset( $_POST['category-order'] ) ) {
        // security tip: kses
        update_term_meta( $term_id, 'category-order', $_POST['category-order'] );
    }
}
add_action( 'edited_news_links_cat', 'news_links_cat_quick_edit_save_category_field' );

add_action('news_links_cat_edit_form_fields','news_links_cat_edit_form_fields');
add_action('news_links_cat_add_form_fields','news_links_cat_edit_form_fields');
add_action('edited_news_links_cat', 'news_links_cat_save_form_fields', 10, 2);
add_action('created_news_links_cat', 'news_links_cat_save_form_fields', 10, 2);

function news_links_cat_save_form_fields($term_id) {
    $meta_name = 'category-order';
    if ( isset( $_POST[$meta_name] ) ) {
        $meta_value = $_POST[$meta_name];
        // This is an associative array with keys and values:
        // $term_metas = Array($meta_name => $meta_value, ...)
        $term_metas = get_option("taxonomy_{$term_id}_metas");
        if (!is_array($term_metas)) {
            $term_metas = Array();
        }
        // Save the meta value
        $term_metas[$meta_name] = $meta_value;
        update_option( "taxonomy_{$term_id}_metas", $term_metas );
    }
}

function news_links_cat_edit_form_fields ($term_obj) {
    // Read in the order from the options db
    if( is_object( $term_obj ) ){
        $term_id = $term_obj->term_id;
        $term_metas = get_option("taxonomy_{$term_id}_metas");
    }

    if ( isset($term_metas['category-order']) ) {
        $cat_order = $term_metas['category-order'];
    } else {
        $cat_order = '0';
    }
?>
    <tr class="form-field">
            <th valign="top" scope="row">
                <label for="category-order"><?php _e('Category Order', ''); ?></label>
            </th>
            <td>
                <input type="text" id="category-order" name="category-order" value="<?php echo $cat_order; ?>"/>
            </td>
        </tr>
<?php 
}
function news_links_cat_quickedit_category_javascript() {
    $current_screen = get_current_screen();

    if ( $current_screen->id != 'edit-news_links_cat' || $current_screen->taxonomy != 'news_links_cat' ) {
        return;
    }

    // Ensure jQuery library is loaded
    wp_enqueue_script( 'jquery' );
    ?>
    <script type="text/javascript">
        /*global jQuery*/
        jQuery(function($) {
            $('#the-list').on( 'click', 'a.editinline', function( e ) {
                e.preventDefault();
                var $tr = $(this).closest('tr');
                var val = $tr.find('td.category-order').text();
                // Update field
                $('tr.inline-edit-row :input[name="category-order"]').val(val ? val : '');
            });
        });
    </script>
    <?php
}
add_action( 'admin_print_footer_scripts-edit-tags.php', 'news_links_cat_quickedit_category_javascript' );