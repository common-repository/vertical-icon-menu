<?php if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	$data = $wpdb->prefix . "wow_vimp";
	$info = (isset($_REQUEST["info"])) ? $_REQUEST["info"] : '';
	if ($info == "saved") {
		echo "<div class='updated' id='message'><p><strong>".__("Record Added", "wow-vimp-lang")."</strong>.</p></div>";
	}
	if ($info == "update") {
		echo "<div class='updated' id='message'><p><strong>".__("Record Updated", "wow-vimp-lang")."</strong>.</p></div>";
	}
	if ($info == "del") {
		$delid = $_GET["did"];
		$wpdb->query("delete from " . $data . " where id=" . $delid);
		echo "<div class='updated' id='message'><p><strong>".__("Record Deleted", "wow-vimp-lang").".</strong>.</p></div>";
	}
	$resultat = $wpdb->get_results("SELECT * FROM " . $data . " order by id asc");
	$count = count($resultat);
?>

<div class="wow">
    <h1><?php esc_attr_e(WOW_VIMP_NAME, "wow-vimp-lang") ?> <a href='https://www.facebook.com/wowaffect/' target="_blank" title="Join us on Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a> </h1>
	<ul class="wow-admin-menu">
		<li><a href='admin.php?page=<?php echo WOW_VIMP_BASENAME;?>'><?php esc_attr_e("List", "wow-bmp-lang") ?></a></li>
		<li>
		<?php if($count<1){?>
			<a href='admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&tool=add' ><?php esc_attr_e("Add new", "wow-bmp-lang") ?></a>
		<?php } ?>
		</li>		
		<li><a href='admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&tool=pro' ><?php esc_attr_e("Pro version", "wow-bmp-lang") ?></a></li>
		<li><a href='admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&tool=items'><b><?php esc_attr_e("Plugins", "wow-bmp-lang") ?></b></a></li>
		</ul>
	
	
	<?php
		$tool= (isset($_REQUEST["tool"])) ? sanitize_text_field($_REQUEST["tool"]) : '';
		if ($tool == "add"){
			include_once( 'add.php' );
			return;	
		}
		if ($tool == ""){
			include_once( 'list.php' );
			return;
		}		
		if ($tool == "items"){
			include_once( 'items.php' );	
			return;
		}
		if ($tool == "pro"){
			include_once( 'pro.php' );	
			return;
		}		
	?>
</div>