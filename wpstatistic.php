<?php
/*
   Plugin Name: Wordpress Statistic
   Plugin URI: https://github.com/Nekrofage/WordpressStatistic
   Description: Wordpress Statistic
   Version: 0.1
   Author: Le Sanglier des Ardennes
   Author URI: http://rockstarninja.info/
   License: GPL2 license
 */

/*
   Initialize/install or uninstall
 */

/* 
   Runs when plugin is activated 
 */
register_activation_hook(__FILE__,'wpstatistic_install'); 

/* 
   Runs on plugin deactivation
 */
register_deactivation_hook( __FILE__, 'wpstatistic_remove' );

/* 
   The wpstatistic_data field is created in wp_options table
   Creates new database field 
 */
function wpstatistic_install() {
        $default_option = array(
                        "'version'" => '0.1',
                        "'introduction'" => 'Wordpress Statistic'
                        );
        add_option("wpstatistic_data", $default_option, "", "yes");


}

/* Deletes the database field */
function wpstatistic_remove() {
        delete_option('wpstatistic_data');
}

/*
   Display administration page
 */
if ( is_admin() ) {

        function wpstatistic_menu() {
                add_options_page('WP-Statistic', 'WP-Statistic', 'administrator', basename(__FILE__), 'wpstatistic_option');

                add_menu_page('WP-Statistic', 'WP-Statistic', 'manage_options', 'displayStatistic', 'displayStatistic');

        }

        add_action('admin_menu','wpstatistic_menu');

        function wpstatistic_option() {
                include('admin/wpstatistic_option.php');
        } 
}

/*
   Add stylesheet and javascript in header
 */
function addHeader() {
        print '<link media="screen" type="text/css" href="/wp-content/plugins/wpstatistic/css/style.css" rel="stylesheet">';
        print '<script type="text/javascript" src="/wp-content/plugins/wpstatistic/js/main.js"></script>';
}
add_action('wp_head', 'addHeader');


// Add settings link on plugin page
function wpstatistic_settings_link($links) { 
        $settings_link = '<a href="options-general.php?page=wpstatistic.php">Paramètre</a>'; 
        array_unshift($links, $settings_link); 
        return $links; 
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'wpstatistic_settings_link' );

// Add a custom query vars
function add_query_vars_filter( $vars ){
  $vars[] = "daystat";
  $vars[] = "monthstat";
  $vars[] = "yearstat";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'admin/displayStatistic.php');
?>
