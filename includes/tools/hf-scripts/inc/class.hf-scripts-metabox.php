<?php
/**
 * HF-Scripts - Metabox for pages/ posts and CPTs
 *
 * @author   GazLab
 * @package  GazLab Scripts
 * @version  1.0.5
 */

class HF_Scripts_Metabox {

	public function __construct() {
		add_action( 'admin_init', array($this, 'hf_scripts_metabox'));
		add_action( 'save_post', array($this, 'save_hf_scripts_metabox'));
	}



	/**
	 * Create the metabox for posts and pages.
	 *
	 * @return void
	 **/
	public function hf_scripts_metabox() {

		add_meta_box("hf-scripts-meta", "HF Scripts for This Page", array(&$this, 'hf_scripts_mb_options'), "post", "normal", "low", null);
		add_meta_box("hf-scripts-meta", "HF Scripts for This Page", array(&$this, 'hf_scripts_mb_options'), "page", "normal", "low", null);

		$hf_scripts_cpts = get_post_types( array('public' => true, 'publicly_queryable' => true, '_builtin' => false) );

		if ( $hf_scripts_cpts ) {

			foreach ( $hf_scripts_cpts as $hf_scripts_cpts ) {

				add_meta_box("hf-scripts-meta", "HF Scripts for This Page", array(&$this, 'hf_scripts_mb_options'), $hf_scripts_cpts, "normal", "low", null);

			}

		}

	}



	/**
	 * The form for the metabox
	 *
	 * @return html
	 **/
	public function hf_scripts_mb_options() {

		global $post;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

		$custom = get_post_custom($post->ID);

		$post_header_script = $custom["hf_page_header_script"][0];

		$post_footer_script = $custom["hf_page_footer_script"][0];

		//$menus = $this->Get_All_Wordpress_Menus();

		?>

		<label for="hf_page_header_script" style="display: block; font-weight: bold; margin: 0; padding: 0;">Header Script</label><br />

		<textarea name="hf_page_header_script" rows="4" style="width: 80%; margin: -10px 10px 20px;"><?php echo $post_header_script; ?></textarea><br />


		<label for="hf_page_footer_script" style="display: block; font-weight: bold; margin: 0; padding: 0;">Footer Script</label><br />

		<textarea name="hf_page_footer_script" rows="4" style="width: 80%; margin: -10px 10px 20px;"><?php echo $post_footer_script; ?></textarea><br />


    <?php

	}



	/**
	 * Save the metabox form data
	 *
	 * @return void
	 **/
	public function save_hf_scripts_metabox() {
		global $post;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){

			return $post_id;

		}else{

			update_post_meta($post->ID, 'hf_page_header_script', $_POST["hf_page_header_script"]);

			update_post_meta($post->ID, 'hf_page_footer_script', $_POST["hf_page_footer_script"]);

		}
	}


}


// Instantiate the class
$sidebar = new HF_Scripts_Metabox();
