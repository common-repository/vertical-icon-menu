<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
delete_option( 'wow_license_key_vimp' );
delete_option( 'wow_license_status_vimp' );
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wow_vimp" );
