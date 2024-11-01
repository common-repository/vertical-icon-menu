<?php
	add_action('admin_init', 'wow_register_option_brmp');
	function wow_register_option_brmp() {
		register_setting('wow_license_brmp', 'wow_license_key_brmp', 'wow_sanitize_license_brmp' );
	}
	function wow_sanitize_license_brmp( $new ) {
		$old = get_option( 'wow_license_key_brmp' );
		if( $old && $old != $new ) {
			delete_option( 'wow_license_status_brmp' );
		}
		return $new;
	}
	add_action('admin_init', 'wow_activate_license_brmp');
	function wow_activate_license_brmp() {
		if( isset( $_POST['wow_license_activate_brmp'] ) ) {
			if( ! check_admin_referer( 'wow_nonce_brmp', 'wow_nonce_brmp' ) )
			return; 
			$license = trim( get_option( 'wow_license_key_brmp' ) );
			$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( WOW_BRMP_NAME ), 
			'url'       => home_url()
			);
			$response = wp_remote_post( WOW_ESTORE, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
			if ( is_wp_error( $response ) )
			return false;
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			update_option( 'wow_license_status_brmp', $license_data->license );
		}
	}
	add_action('admin_init', 'wow_deactivate_license_brmp');
	function wow_deactivate_license_brmp() {
		if( isset( $_POST['wow_license_deactivate_brmp'] ) ) {
			if( ! check_admin_referer( 'wow_nonce_brmp', 'wow_nonce_brmp' ) )
			return; 
			$license = trim( get_option( 'wow_license_key_brmp' ) );
			$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( WOW_BRMP_NAME ), 
			'url'       => home_url()
			);
			$response = wp_remote_post( WOW_ESTORE, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
			if ( is_wp_error( $response ) )
			return false;
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			if( $license_data->license == 'deactivated' )
			delete_option( 'wow_license_status_brmp' );
		}
	}
	function wow_check_license_brmp() {
		global $wp_version;
		$license = trim( get_option( 'wow_license_key_brmp' ) );
		$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( WOW_BRMP_NAME ),
		'url'       => home_url()
		);
		$response = wp_remote_post( WOW_ESTORE, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
		if ( is_wp_error( $response ) )
		return false;
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		if( $license_data->license == 'valid' ) {
			echo 'valid'; exit;
			} else {
			echo 'invalid'; exit;
		}
	}	