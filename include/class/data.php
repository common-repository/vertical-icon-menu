<?php if ( ! defined( 'ABSPATH' ) ) exit; 
class WOW_DATA {
    function addNewItem($tblname, $info) {
        global $wpdb;
		$tablefields = $wpdb->get_results( 'SHOW COLUMNS FROM '.$tblname, OBJECT );
        $columns = count($tablefields);
        $field_array = array();
        for ($i = 0; $i < $columns; $i++) {
			$fieldname = $tablefields[$i]->Field;
			$field_array[] = $fieldname;
		}
        $count = sizeof($info);
        if ($count > 0) {
            $id = 0;
            $field = "";
            $vals = "";
            foreach ($field_array as $key) {
                if ($field == "") {
                    $field = "`" . $key . "`";
                    $vals = "'" . addcslashes($info[$key],"'") . "'";
                } else {
                    $field = $field . ",`" . $key . "`";
                    $vals = $vals . ",'" . addcslashes($info[$key],"'") . "'";
                }
            }			
            $sSQL = "INSERT INTO " . $tblname . " ($field) values ($vals)";
			$wpdb->query($sSQL);
            $lastid = $wpdb->insert_id; 
			$SQL = $wpdb->prepare("select * from ".$tblname." WHERE id = %d", $lastid);
			$result = $wpdb->get_results($SQL);
			if (count($result) > 0) {
				foreach ($result as $key => $val) {
					$param = unserialize($val->param);					
					$file_script = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/admin/partials/generator/script.php';
					if (file_exists ( $file_script )){
					$path_script = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/asset/js/script-'.$lastid.'.js';
					ob_start();
					include ($file_script);
					$content_script = ob_get_contents();
					$packer = new JavaScriptPacker($content_script, 'Normal', true, false);
					$packed = $packer->pack();					
					ob_end_clean();
					file_put_contents($path_script, $packed);
				}
				$file_style = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/admin/partials/generator/style.php';
				if (file_exists ( $file_style )){
					$path_style = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/asset/css/style-'.$lastid.'.css';
					ob_start();
					include ($file_style);
					$content_style = ob_get_contents();										
					ob_end_clean();
					file_put_contents($path_style, $content_style);
				}				
			}
			}		
            return true;
        } else {
            return false;
        }
    }
    function updItem($tblname, $info) {
        global $wpdb;		
		$tablefields = $wpdb->get_results( 'SHOW COLUMNS FROM '.$tblname, OBJECT );
        $columns = count($tablefields);
        $field_array = array();
        for ($i = 0; $i < $columns; $i++) {
			$fieldname = $tablefields[$i]->Field;
			$field_array[] = $fieldname;
		}
		$count = sizeof($info);
        if ($count > 0) {
            $field = "";
            $vals = "";
            foreach ($field_array as $key) {
                if ($field == "" && $key != "id" && $key != "mails") {
                    $field = "`" . $key . "` = '" . addcslashes($info[$key],"'") . "'";
                } else if ($key != "id" && $key != "mails") {
                    $field = $field . ",`" . $key . "` = '" . addcslashes($info[$key],"'") . "'";
                }
            }
			$id = $info["id"];
            $sSQL = "update " . $tblname . " set $field where id=" . $id;
            $wpdb->query($sSQL);			
			$SQL = $wpdb->prepare("select * from ".$tblname." WHERE id = %d", $id);
			$result = $wpdb->get_results($SQL);
			if (count($result) > 0) {
			foreach ($result as $key => $val) {
				$param = unserialize($val->param);
				$file_script = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/admin/partials/generator/script.php';
				if (file_exists ( $file_script )){
					$path_script = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/asset/js/script-'.$id.'.js';
					ob_start();
					include ($file_script);
					$content_script = ob_get_contents();
					$packer = new JavaScriptPacker($content_script, 'Normal', true, false);
					$packed = $packer->pack();					
					ob_end_clean();
					file_put_contents($path_script, $packed);
				}
				$file_style = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/admin/partials/generator/style.php';
				if (file_exists ( $file_style )){
					$path_style = WP_PLUGIN_DIR.'/'.$info["plugdir"] .'/asset/css/style-'.$id.'.css';
					ob_start();
					include ($file_style);
					$content_style = ob_get_contents();										
					ob_end_clean();
					file_put_contents($path_style, $content_style);
				}				
			}			
			}
            return true;
        } else {
            return false;
        }
    }		
}
?>