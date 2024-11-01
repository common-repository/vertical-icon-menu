<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php include ('include/data.php'); ?>
<form action="admin.php?page=<?php echo WOW_VIMP_BASENAME;?>" method="post">
	
	<div class="wowcolom">
		
		<div id="wow-leftcol">
			
			<div class="wow-admin">
				<input placeholder="Name is used only for admin purposes" type='text' name='title' value="<?php echo $title; ?>" class="input-100 wow-title"/>
			</div>
			
			
			<div class="tab-box wow-admin">
				
				<ul class="tab-nav">
					<li><a href="#t1"><i class="fa fa-css3" aria-hidden="true"></i> <?php esc_attr_e("Style", "wow-vimp-lang") ?></a></li>
					<li><a href="#t2">Menu</a></li>					
					
				</ul>
				
				<div class="tab-panels">
					
					<div id="t1">
						
						<div class="wow-admin-col">
							
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Position", "wow-vimp-lang") ?>:<br/>									
								<select disabled="disabled">																	
									<option>Left</option>																			
								</select>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
							</div>	
							
						</div>
							
						<div class="wow-admin-col">
							
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Menu size", "wow-vimp-lang") ?>:<br/>
								<input type='text' name='param[menusize]' value="<?php if(empty($param['menusize'])){echo "3.5";}else{echo $param['menusize'];}?>"/> em
								
								
							</div>
							
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Item size", "wow-vimp-lang") ?>:<br/>
								<input type='text' name='param[itemsize]' value="<?php if(empty($param['itemsize'])){echo "1.4";}else{echo $param['itemsize'];}?>"/> em
								
							</div>	
							
						</div>
						
						<div class="wow-admin-col">
							
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Menu background", "wow-vimp-lang") ?>:<br/>
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/color.png" alt=""/>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
								
							</div>
							
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Item color", "wow-vimp-lang") ?>:<br/>
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/color.png" alt=""/>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
								
							</div>	
							
						</div>
						
						<div class="wow-admin-col">
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Item color on hover", "wow-vimp-lang") ?>:<br/>
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/color.png" alt=""/>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
								
							</div>						
						
							<div class="wow-admin-col-4">
								<?php esc_attr_e("Item background color on hover", "wow-vimp-lang") ?>:<br/>
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/color.png" alt=""/>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
								
							</div>
						
						</div>
						
					</div>
					
					<div id="t2">
						<div class="menu_1">
						<?php if ($count_i > 0){							
							for ($i = 0; $i < $count_i; $i++) { ?>
							<div class="menu_1-items-<?php echo $i+1;?>">
								<h3>Item <span class="menu_1-icount"><?php echo $i+1;?></span></h3>						
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										<?php esc_attr_e("Select Icon", "wow-vimp-lang") ?>:<br/>
										<span id="menu_1_icons_<?php echo $i;?>"></span>	
										<input type="hidden" value="<?php echo $param['menu_1']['item_icon'][$i]; ?>" id="menu_1_item_icon_<?php echo $i;?>">	
									</div>				
																
									
								</div>
								
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">	
										<?php esc_attr_e("Item type", "wow-vimp-lang") ?>:<br/>
										<select name="param[menu_1][item_type][<?php echo $i;?>]" >
											<option value="link">Link</option>																				
										</select>
										<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
									</div>
									<div class="wow-admin-col-4 menu_1_item_link_<?php echo $i;?>">
									<span id="menu_1_item_link_<?php echo $i;?>">Link</span>:<br/>
										
										<input type="text" name="param[menu_1][item_link][<?php echo $i;?>]" value="<?php if(!empty($param['menu_1']['item_link'][$i])) echo $param['menu_1']['item_link'][$i]; ?>">
										
									</div>
									
								
								</div>
								
								
							</div>
							<?php	
							} 
						} 											
						
						?>
						</div>
						<div class="submit-bottom">
							<input type="button" value="Add item" class="formsub fully-rounded" onclick="itemadd(1)"> 
							<input type="button" class="formpreview fully-rounded" value="Delete last item" onclick="itemremove(1)">
						</div>
						
					</div>
					
				</div>
			</div>
			
		</div>
		
		<div id="wow-rightcol">
			<div class="wowbox">
				<h3><?php esc_attr_e("Publish", "wow-vimp-lang") ?></h3>
				<div class="wow-admin" style="display: block;">
					<div class="wowcolom">
						<div style="float:left;">
							<?php if ($id != ""){ echo '<p class="wowdel"><a href="admin.php?page='.WOW_VIMP_BASENAME.'&info=del&did='.$id.'">Delete</a></p>';}; ?>
						</div>
						<div style="float:right;">
							<p/>
							<input name="submit" id="submit" class="button button-primary" value="<?php echo $btn; ?>" type="submit">
						</div>
					</div>
					
				</div>
			</div>
			
			<div class="wowbox">
				<h3><?php esc_attr_e("Show menu", "wow-brmp-lang") ?></h3>
				<div class="inside wow-admin" style="display: block;">
					
					<div class="wow-admin-col">
						<div class="wow-admin-col-12">
							<?php esc_attr_e("Show for users", "wow-bmp-lang") ?>: <br/>
							<input type="radio" checked="checked" > All users <br />
							<input type="radio" disabled="disabled"> If a user logged in <span class="dashicons dashicons-lock" style="color:#37c781;"></span><br />
							<input type="radio" disabled="disabled" > If user not logged <span class="dashicons dashicons-lock" style="color:#37c781;"></span>
						</div>
						
						<div class="wow-admin-col-12">
							<input type="checkbox" disabled="disabled"> <?php esc_attr_e("Depending on the language", "wow-bmp-lang") ?> <span class="dashicons dashicons-lock" style="color:#37c781;"></span>
							
						</div>
						
						<div class="wow-admin-col-12">
							<?php esc_attr_e("Show menu", "wow-bmp-lang") ?>:<br/>
							<select disabled="disabled">
									<option value="">Only Pro Version</option>									
								</select>
								<span class="dashicons dashicons-lock" style="color:#37c781;"></span>
						</div>						
					</div>
				</div>
			</div>
			
			<div class="wowbox">
				<h3><i class="fa fa-plug" aria-hidden="true"></i> <?php esc_attr_e("Well use with", "wow-fp-lang") ?>:</h3>
				<div class="wow-admin wow-plugins">
					<ul>						
						<li><a href="https://wordpress.org/plugins/side-menu/" target="_blank">Side Menu</a></li>
						<li><a href="https://wordpress.org/plugins/bubble-menu/" target="_blank">Bubble Menu</a></li>
						<li><a href="https://wordpress.org/plugins/hover-effects/" target="_blank">Hover Effects</a></li>	
						<li><a href="https://wordpress.org/plugins/wow-icons/" target="_blank">Wow Icons</a></li>
						<li><a href="https://wordpress.org/plugins/modal-window/" target="_blank">Modal Windows</a></li>
					</ul>
				</div>
			</div>
			
			
			
			
		</div>
	</div>
	<input type="hidden" name="add" value="<?php echo $hidval; ?>" />    
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="data" value="<?php echo $data; ?>" />
	<input type="hidden" name="page" value="<?php echo WOW_VIMP_BASENAME;?>" />	
	<input type="hidden" name="plugdir" value="<?php echo WOW_VIMP_BASENAME;?>" />		
	<?php wp_nonce_field('wow_plugin_action','wow_plugin_nonce_field'); ?>
</form>	
<div style="display:none;">
<select id="icons" class="icons">
	<?php
		include ('icon.php');										
		
	?> 
</select>
</div>