function toggleCircleDiv(entity, direction) {
	if (direction == "out") {
		jQuery('#circleTooltip').hide();
	} else {
		jQuery("div[id^='circleTooltip_']").hide();
		jQuery('#circleTooltip_'+entity).show();	
		jQuery('#circleTooltip').show();
	}
}
function isMobileDevice () {
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		return true;
	} else {
		return false;
	}
}


jQuery( document ).ready(function() {

	// enable the tooltip that shows up when you highlight text with a maouse
    jQuery('p,h4,h1,h2,h3').selectionSharer();

    // add interactivity to the circular svg on the networks page
    jQuery("path[class$='_circle'],g[class$='_circle']").css('cursor','pointer'); 			
	jQuery("path[class$='_circle'],g[class$='_circle']").hover( 
		function(e) {
			var entity = jQuery(this).attr('class').split("_").shift().split(" ");
			entity = entity[1];
			toggleCircleDiv(entity,'in');
			if ( isMobileDevice() ) {
				jQuery("html, body").animate({ scrollTop:  jQuery('#circleTooltip').offset().top - jQuery('#header-inner-bg').height() }, 750);
			}
		},
		function(e) {
			toggleCircleDiv('','out');
		}
	);
	jQuery('#circleTooltip').hide() 

	//hide the 'Awards' item in the list of category filters, since there is already an 'all' button
	jQuery("ul.filter-tabs li a[data-filter='.awards']").hide();

	//by default, the images in the list of board members don't link. Let's make them clickable.
	jQuery('div.team-member-description a.simple-read-more').each(function() {
		link = jQuery(this).attr('href');
		jQuery(this).parent().parent().find('img').wrap("<a href='" + link + "'></a>");
	});

});


