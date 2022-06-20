<?php

function hf_header_scripts() {
    echo get_option('header_scripts');
    if ( is_singular() ) {
        $page_header_scripts = get_post_meta( get_the_ID(), 'hf_page_header_script', true );
        echo $page_header_scripts;
    }
}
add_action('wp_head','hf_header_scripts');

function hf_footer_scripts(){
    echo get_option('footer_scripts');
    if ( is_singular() ) {
        $page_footer_scripts = get_post_meta( get_the_ID(), 'hf_page_footer_script', true );
        echo $page_footer_scripts;
    }
}
add_action('wp_footer','hf_footer_scripts');
