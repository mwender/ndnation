<?php
//****************************************//
//******* SCHEDULE CUSTOM POST TYPE ******//
//****************************************//

function game_cpt(){
    $labels = array(
        'name'                  => _x( 'Games', 'Post Type General Name', 'ndnation' ),
        'singular_name'         => _x( 'Game', 'Post Type Singular Name', 'ndnation' ),
        'menu_name'             => __( 'Games', 'ndnation' ),
        'name_admin_bar'        => __( 'Game', 'ndnation' ),
        'archives'              => __( 'Game Archives', 'ndnation' ),
        'parent_item_colon'     => __( 'Parent Game:', 'ndnation' ),
        'all_items'             => __( 'All Games', 'ndnation' ),
        'add_new_item'          => __( 'Add New', 'ndnation' ),
        'add_new'               => __( 'Add New', 'ndnation' ),
        'new_item'              => __( 'New Game', 'ndnation' ),
        'edit_item'             => __( 'Edit Game', 'ndnation' ),
        'update_item'           => __( 'Update Game', 'ndnation' ),
        'view_item'             => __( 'View Game', 'ndnation' ),
        'search_items'          => __( 'Search Games', 'ndnation' ),
        'not_found'             => __( 'Not found', 'ndnation' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'ndnation' ),
        'featured_image'        => __( 'Featured Image', 'ndnation' ),
        'set_featured_image'    => __( 'Set Featured Image', 'ndnation' ),
        'remove_featured_image' => __( 'Remove Featured Image', 'ndnation' ),
        'use_featured_image'    => __( 'Use as Featured Image', 'ndnation' ),
        'insert_into_item'      => __( 'Insert into Game', 'ndnation' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Game', 'ndnation' ),
        'items_list'            => __( 'Games list', 'ndnation' ),
        'items_list_navigation' => __( 'Games list navigation', 'ndnation' ),
        'filter_items_list'     => __( 'Filter Game list', 'ndnation' ),
    );
    $args = array(
        'label'                 => __( 'game', 'ndnation' ),
        'description'           => __( 'Game Posts', 'ndnation' ),
        'labels'                => $labels,
        'supports'              => array('title', 'revisions',),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('game', $args );

}
add_action('init', 'game_cpt', 0);

function game_taxonomy() {
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
    register_taxonomy('game_cat','game',$args);

}
add_action( 'init', 'game_taxonomy' );

function game_type_taxonomy() {
    $labels = array(
        'name'              => _x( 'Game Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Game Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Game Types' ),
        'all_items'         => __( 'All Game Types' ),
        'parent_item'       => __( 'Parent Game Type' ),
        'parent_item_colon' => __( 'Parent Game Type:' ),
        'edit_item'         => __( 'Edit Game Type' ),
        'update_item'       => __( 'Update Game Type' ),
        'add_new_item'      => __( 'Add New Game Type' ),
        'new_item_name'     => __( 'New Game Type Name' ),
        'menu_name'         => __( 'Game Types' ),
    );
    $args = array(
        'hierarchical'      => true,
        'show_ui'           => true,
        'labels'            => $labels,
        'query_var'         => true,
        'show_admin_column' => true,
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
        )
    );
    register_taxonomy('game_type','game',$args);
    // wp_insert_term('Spring Game','game_type',array('slug' => 'spring-game'));

}
add_action( 'init', 'game_type_taxonomy' );

function sched_year_taxonomy() {
    $labels = array(
        'name'              => _x( 'Schedule Years', 'taxonomy general name' ),
        'singular_name'     => _x( 'Schedule Year', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Schedule Years' ),
        'all_items'         => __( 'All Schedule Years' ),
        'parent_item'       => __( 'Parent Schedule Year' ),
        'parent_item_colon' => __( 'Parent Schedule Year:' ),
        'edit_item'         => __( 'Edit Schedule Year' ),
        'update_item'       => __( 'Update Schedule Year' ),
        'add_new_item'      => __( 'Add New Schedule Year' ),
        'new_item_name'     => __( 'New Schedule Year Name' ),
        'menu_name'         => __( 'Schedule Years' ),
    );
    $args = array(
        'hierarchical'      => true,
        'show_ui'           => true,
        'labels'            => $labels,
        'query_var'         => true,
        'show_admin_column' => true
    );
    register_taxonomy('sched_year_cat','game',$args);

}
add_action( 'init', 'sched_year_taxonomy' );

//*************************************************************//
//****** CHANGE PLACEHOLDER TEXT FOR SCHEDULE POST TYPE *******//
//*************************************************************//

function change_game_title_placeholder($title){
    $screen = get_current_screen();
    if('game' == $screen->post_type){
        $title = 'Game Name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_game_title_placeholder');

function reorder_games($query){
    if(is_admin()){
        $post_type = $query->query['post_type'];
        if($post_type == 'game'){
            if(!isset($_GET['orderby'])){
                $query->set('orderby', 'meta_value_num');
                $query->set('meta_key', 'game_date');
                $query->set('order', 'ASC');
            }
        }
    }
}
add_filter('pre_get_posts', 'reorder_games');


//**********************************************//
//****** ADD COLUMNS TO GAMES ADMIN PAGE *******//
//**********************************************//


// Add Game Date Column to game edit.php page
add_filter( 'manage_game_posts_columns', 'set_custom_edit_game_columns' );
function set_custom_edit_game_columns($columns) {
    unset( $columns['date'] );
    $columns['game_date'] = __('Game Date', 'ndnation');
    return $columns;
}

// Add Game Date to Game Date Column on game edit.php page
add_action( 'manage_game_posts_custom_column' , 'custom_game_column', 10, 2 );
function custom_game_column( $column, $post_id ) {
    global $post;
    $game_date_ini = get_post_meta( $post_id, 'game_date', true );
    $game_date     = date('m/d/Y', strtotime($game_date_ini));
    switch($column){
        case 'game_date' :
            echo $game_date;
            break;
        default :
            break;
    }
}

// add_filter( 'manage_edit-game_sortable_columns', 'sortable_game_date_column' );
// function sortable_game_date_column( $columns ) {
//     $columns['game_date'] = 'game_date';
//     return $columns;
// }