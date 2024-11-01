<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<table>
    <thead>
		<tr>
			<th><u><?php esc_attr_e("Order", "wow-vimp-lang") ?></u></th>
			<th><u><?php esc_attr_e("Name", "wow-vimp-lang") ?></u></th> 
			<th><u><?php esc_attr_e("Shortcode", "wow-mwp-lang") ?></u></th>
			<th><u><?php esc_attr_e("ID", "wow-vimp-lang") ?></u></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
    <tbody>
		<?php
			if ($resultat) {
				$i = 0;
				foreach ($resultat as $key => $value) {
					$i++;			   
					$id = $value->id;
					$title = $value->title;        
				?>
				<tr>
					<td><?php echo "$i"; ?></td>
					<td><?php echo $title; ?></td>
					<td><?php echo "[Vertical-Icon-Menu-Pro id=$id]"; ?></td>
					<td><?php echo "$id"; ?></td>         
					<td><u><a href="admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&tool=add&act=update&id=<?php echo $id; ?>"><?php esc_attr_e("Edit", "wow-vimp-lang") ?></a></u></td>
					<td><u><a href="admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&info=del&did=<?php echo $id; ?>"><?php esc_attr_e("Delete", "wow-vimp-lang") ?></a></u></td>
					<td><u><a href="admin.php?page=<?php echo WOW_VIMP_BASENAME;?>&tool=add&act=duplicate&id=<?php echo $id; ?>"><?php esc_attr_e("Duplicate", "wow-vimp-lang") ?></a></u></td>        
				</tr>
				<?php
				}
			}
		?>
		
	</tbody>
</table>
