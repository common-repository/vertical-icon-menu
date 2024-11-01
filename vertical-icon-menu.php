<?php
/**
 * Plugin Name:       Vertical Icon Menu
 * Plugin URI:        https://wordpress.org/plugins/vertical-icon-menu
 * Description:       Create a Vertical Icon Menu
 * Version:           1.0
 * Author:            Wow-Company
 * Author URI:        http://wow-company.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
  */
if ( ! defined( 'WPINC' ) ) {die;}


if ( ! defined( 'WOW_VIMP_NAME' ) ) {	
	define( 'WOW_VIMP_NAME', 'Vertical Icon Menu' );
	define( 'WOW_VIMP_VERSION', '1.0' );
	define( 'WOW_VIMP_BASENAME', dirname(plugin_basename(__FILE__)) );
	define( 'WOW_VIMP_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WOW_VIMP_URL', plugin_dir_url( __FILE__ ) );
	
}

// Activate-Diactivate plugin
function wow_plugin_activate_vimp() {
	require_once plugin_dir_path( __FILE__ ) . 'include/activator.php';	
}	
register_activation_hook( __FILE__, 'wow_plugin_activate_vimp' );

function wow_plugin_deactivate_vimp() {	
	require_once plugin_dir_path( __FILE__ ) . 'include/deactivator.php';
}
register_deactivation_hook( __FILE__, 'wow_plugin_deactivate_vimp' );



// Include class for plugin
if( !class_exists( 'JavaScriptPacker' )) {
	require_once plugin_dir_path( __FILE__ ) . 'include/class/packer.php';
}

if( !class_exists( 'WOW_DATA' )) {
	require_once plugin_dir_path( __FILE__ ) . 'include/class/data.php';
}

require_once plugin_dir_path( __FILE__ ) . 'include/connect.php';

require_once plugin_dir_path( __FILE__ ) . 'admin/admin.php';

require_once plugin_dir_path( __FILE__ ) . 'public/public.php';

add_filter( 'plugin_row_meta', 'wow_row_meta_vimp', 10, 4 );
function wow_row_meta_vimp( $meta, $plugin_file ){
	if( false === strpos( $plugin_file, basename(__FILE__) ) )
		return $meta;

	$meta[] = '<a href="https://wordpress.org/support/plugin/vertical-icon-menu" target="_blank">Support </a> | <a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a>';
	return $meta;
}

add_filter( 'plugin_action_links', 'wow_action_links_vimp', 10, 2 );
function wow_action_links_vimp( $actions, $plugin_file ){
	if( false === strpos( $plugin_file, basename(__FILE__) ) )
		return $actions;

	$settings_link = '<a href="admin.php?page='. WOW_VIMP_BASENAME .'">Settings</a>'; 
	array_unshift( $actions, $settings_link ); 
	return $actions; 
}