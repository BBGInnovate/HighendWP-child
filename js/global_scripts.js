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

	 var shareConfig = {
        Width: 500,
        Height: 500
    };

    // add handler links
    var shareLink = document.querySelectorAll('li a.bbg__article-share__link');
    for (var a = 0; a < shareLink.length; a++) {
        shareLink[a].onclick = PopupHandler;
    }

    
    urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
        return null;
        }else{
        return results[1] || 0;
        }   
    }

    var awardFilter = urlParam( 'awardFilter' ); 
    if (awardFilter) {
        var selector = "a[data-filter='." + awardFilter + "']";
        setTimeout(function() {
            jQuery(selector).click();    
        },1000);
    }

    // create popup
    function PopupHandler(e) {

        /*you could tweet the highlighted/selected text by encoding and concatenating it with the URL
        var text = "";
        if (window.getSelection) {
            text = window.getSelection().toString();
        } else if (document.selection && document.selection.type != "Control") {
            text = document.selection.createRange().text;
        }
        console.log(text);
        */

        e = (e ? e : window.event);

        //changed e.target.parentNode to e.target when i removed the <img/> tag
        //var t = (e.target.parentNode ? e.target.parentNode : e.srcElement);
        var t = (e.target ? e.target : e.srcElement);
        //logger(t)


        // popup position
        var px = Math.floor(((screen.availWidth || 1024) - shareConfig.Width) / 2),
            py = Math.floor(((screen.availHeight || 700) - shareConfig.Height) / 2);

        // open popup
        var popup = window.open(t.parentElement.href, "social",
            "width="+shareConfig.Width+",height="+shareConfig.Height+
            ",left="+px+",top="+py+
            ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
        if (popup) {
            popup.focus();
            if (e.preventDefault) e.preventDefault();
            e.returnValue = false;
        }

        return !!popup;
    }


});

