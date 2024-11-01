jQuery(document).ready(function($) {
	//* Vertical table
	$('.tab-nav li:first').addClass('select'); 
	$('.tab-panels>div').hide().filter(':first').show();    
	$('.tab-nav a').click(function(){
		$('.tab-panels>div').hide().filter(this.hash).show(); 
		$('.tab-nav li').removeClass('select');
		$(this).parent().addClass('select');
		return (false); 
	})
	
	$('.tab-box').after('<span style="float:right;"><a href="https://wow-estore.com/en/vertical-icon-menu-pro/" target="_blank">GET PRO VERSION</a></span>');
		
	$('.icons').fontIconPicker({
		theme: 'fip-darkgrey',
		emptyIcon: false,
		allCategoryText: 'Show all'
	});
	
	
	
	var i_menu_1 = jQuery('.menu_1-icount:last').html();
	var i = 0;
	while (i < i_menu_1) {				
		var icons = jQuery("#icons").clone().attr("name","param[menu_1][item_icon]["+i+"]");		
		$("#menu_1_icons_"+i).html(icons);
		var menu_item_icon = $('#menu_1_item_icon_'+i).val(); 
		$("#menu_1_icons_"+i+" [value='"+menu_item_icon+"']").attr("selected", "selected");
		jQuery('.icons').fontIconPicker({
			theme: 'fip-darkgrey',
			emptyIcon: false,
			allCategoryText: 'Show all'
		});
		i++;	
	}
	
});


function itemadd(menu){   	
	var menu = 'menu_'+menu;
	var icount = jQuery('.'+menu+'-icount:last').html();
	if (isNaN(icount) ){
		var icount = 0;
	}
	var nexticount = icount*1+1;
	var icons = jQuery("#icons").clone().attr("name","param["+menu+"][item_icon]["+icount+"]");	
	var item = '<div class="'+menu+'-items-'+nexticount+'"><h3>Item <span class="'+menu+'-icount">'+nexticount+'</span></h3> <div class="wow-admin-col"> <div class="wow-admin-col-4"> Select Icon:<br/><span id="'+menu+'_icons_'+icount+'"></span>  </div> </div><div class="wow-admin-col"><div class="wow-admin-col-4">Item type<br/><select name="param['+menu+'][item_type]['+icount+']"> <option value="link">Link</option>  </select> </div> <div class="wow-admin-col-4 '+menu+'_item_link_'+icount+'"><span id="'+menu+'_item_link_'+icount+'">Link</span>:<br/> <input type="text" name="param['+menu+'][item_link]['+icount+']" value=""> </div> </div>';	
	jQuery(item).appendTo("."+menu);	
	jQuery("#"+menu+"_icons_"+icount).html(icons);
	
	jQuery('.icons').fontIconPicker({
		theme: 'fip-darkgrey',
		emptyIcon: false,
		allCategoryText: 'Show all'
	});
	
}

function itemremove(menu){   	
	var menu = 'menu_'+menu;	
	var icount = jQuery('.'+menu+'-icount:last').html(); 	
	jQuery("."+menu+"-items-"+icount).remove();
}


