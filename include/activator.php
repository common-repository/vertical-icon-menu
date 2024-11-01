<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$table = $wpdb->prefix . 'wow_vimp';
	$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
	$sql = "CREATE TABLE {$table} (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	title VARCHAR(200) NOT NULL,  
	param TEXT,  
	UNIQUE KEY id (id)
	) {$charset_collate};";
	dbDelta($sql);
