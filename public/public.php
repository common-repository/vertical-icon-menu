<?php if ( ! defined( 'ABSPATH' ) ) exit;
	
	add_action( 'wp_enqueue_scripts', 'wow_scripts_styles_vimp' );
	
	function wow_scripts_styles_vimp() {
		wp_enqueue_style( 'font-awesome', WOW_VIMP_URL . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	}
	
	//* shortcode
	add_shortcode('Vertical-Icon-Menu', 'wow_shortcode_vimp');
	function wow_shortcode_vimp($atts) {
		extract(shortcode_atts(array('id' => ""), $atts));		
		global $wpdb;
		$table = $wpdb->prefix . "wow_vimp";    
		$sSQL = $wpdb->prepare("select * from $table WHERE id = %d", $id);
		$arrresult = $wpdb->get_results($sSQL); 	
		if (count($arrresult) > 0) {
			foreach ($arrresult as $key => $val) {
				$param = unserialize($val->param);				
				ob_start();
				include( 'partials/public.php' );
				$menu = ob_get_contents();
				ob_end_clean();
				
				
				echo $menu;
				wp_enqueue_style( WOW_VIMP_BASENAME.'-style', plugin_dir_url( __FILE__ ). 'css/style.css', null, WOW_VIMP_VERSION);				
				
				$custom_css = '.vimp-menu li a { height: '.$param['menusize'].'em; width: '.$param['menusize'].'em; line-height: '.$param['menusize'].'em;} .vimp-menu li a:before {font-size: '.$param['itemsize'].'em;}';
				wp_add_inline_style( WOW_VIMP_BASENAME.'-style', $custom_css );
				
			}
		}
		
		return ;
	}
	
	//* Include on page and posts
	add_action( 'wp_footer', 'wow_display_vimp' );
	function wow_display_vimp() {
		global $wpdb;    
		$table = $wpdb->prefix . "wow_vimp";   
		$arrresult = $wpdb->get_results("SELECT * FROM " . $table . " order by id asc");
		if (count($arrresult) > 0) {		
			foreach ($arrresult as $key => $val) {
				$param = unserialize($val->param);			
				echo do_shortcode('[Vertical-Icon-Menu id='.$val->id.']');
				
			}
		}
	}
