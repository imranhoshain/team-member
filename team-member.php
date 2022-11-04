<?php
/*
Plugin Name: Team Member
Plugin URI: https://github.com/princ-imran/team-member
Description: Team member testing plugin
Author: spytoever
Version: 1.0
Author URI: https://themeforest.net/user/spytoever
Text Domain: team-member
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Load Team Member
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */

function team_member_load_textdomain(){
	load_plugin_textdomain('team-member',false,dirname(__FILE__)."/languages/");
}
add_action('plugin_loaded','team_member_load_textdomain');

//Plugin Css And JS
function team_toolkit_include_files() { 
    wp_enqueue_style('team-member', plugins_url( '/assets/css/team-member.css', __FILE__ ) );    
}

add_action( 'wp_enqueue_scripts','team_toolkit_include_files');

// If your string has a custom filter, add its tag name in an applicable add_filter function
add_filter( 'widget_text', 'do_shortcode' ); //For WP old version

/*
 * Set Page templates for CPT "your_cpt"
 */



function team_member_archive_single_post( $template ) {

    $post_type = 'team-member'; // Change this to the name of your custom post type!

    if ( is_post_type_archive( $post_type ) && file_exists( plugin_dir_path(__DIR__) . "shortcodes/archive-$post_type.php" ) ){
        $template = plugin_dir_path(__DIR__) . "shortcodes/archive-$post_type.php";
    }

    if ( is_singular( $post_type ) && file_exists( plugin_dir_path(__DIR__) . "shortcodes/single-$post_type.php" ) ){
        $template = plugin_dir_path(__DIR__) . "shortcodes/single-$post_type.php";
    }

    return $template;
}
add_filter( 'template_include', 'team_member_archive_single_post' );
/**
 * Implement Find me Addons.
 */
include_once ('shortcodes/custom-post.php');

/**
 * Implement Find me Addons.
 */
include_once ('shortcodes/team-section-shortcode.php');

