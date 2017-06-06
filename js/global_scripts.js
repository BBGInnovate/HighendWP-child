function toggleCircleDiv(entity, direction) {
	if (direction == "out") {
		jQuery('#circleTooltip').hide();
	} else {
		jQuery("div[id^='circleTooltip_']").hide();
		jQuery('#circleTooltip_'+entity).show();	
		jQuery('#circleTooltip').show();
	}
}

jQuery( document ).ready(function() {
    jQuery('p,h4,h1,h2,h3').selectionSharer();

    jQuery("path[class$='_circle'],g[class$='_circle']").css('cursor','pointer'); 			
	jQuery("path[class$='_circle'],g[class$='_circle']").hover( 
		function(e) {
			var entity = jQuery(this).attr('class').split("_").shift().split(" ");
			entity = entity[1];
			toggleCircleDiv(entity,'in');
		},
		function(e) {
			toggleCircleDiv('','out');
		}
	);
	jQuery('#circleTooltip').hide() //.addClass('hb-testimonial');
	jQuery("ul.filter-tabs li a[data-filter='.awards']").hide();
});


