<?php
/**
* 
* GazLab scripts
*
**/


// DISPLAY THE NAME OF THE TEMPLATE IN THE FOOTER
	add_action( 'wp_footer', 'get_what_template');

	function get_what_template() {
		global $current_user;
		get_currentuserinfo();

		if( $current_user->user_login == ('greg.apel' || 'pam.wyman' || 'aaron.frerichs' || 'chris.diamond' || 'ethan.fry' || 'webapps')) global $template; echo($template);
	}


	// Functions below return parent, child or grandchild slugs.
	// Usage: echo get_parent_slug()
	function get_uri_array() {
		$uri = $_SERVER['REQUEST_URI'];
		$uri = substr($uri, 1, strlen($uri));
		return explode("/", $uri);
	}

	function get_parent_slug() {
		$uri = get_uri_array();
		return $uri[0];
	}

	function get_child_slug() {
		$uri = get_uri_array();
		return $uri[1];
	}

	function get_grandchild_slug() {
		$uri = get_uri_array();
		return $uri[2];
	}
