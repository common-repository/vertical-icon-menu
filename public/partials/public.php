<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	
	$menu = '<ul class="vimp-menu">';	
	$count_i = count($param['menu_1']['item_type']);	
	for ($i=0; $i<$count_i; $i++){
		$menu .= '<li>';
		$class = 'class="fa '.$param['menu_1']['item_icon'][$i].'"';			
		if($param['menu_1']['item_type'][$i] == 'link'){
			$menu .= '<a href="'.$param['menu_1']['item_link'][$i].'" '.$class.'></a>';			
		}				
			
		$menu .= '</li>';
		
	}	
	$menu .= '</ul>';
	
	echo $menu;
	
	
?>