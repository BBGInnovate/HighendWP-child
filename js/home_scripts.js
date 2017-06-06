jQuery( document ).ready(function() {
	//there is an issue with the Visual Composer line chart that happens on the hompage
	//adding this window resize call makes sure that the Waypoint will get recalculated at the appropriate times
	//so that the animation will be triggered
	function fakeWindowResize(){
		jQuery(window).resize();
	}
	setInterval(fakeWindowResize, 500); 

	function showButton() {
		jQuery('#btnPlay').addClass('importantVisible');
	}
	setTimeout(showButton,2000);

	jQuery(document).on('pumBeforeOpen', '.pum', function () {
		var $iframe = jQuery('iframe', jQuery(this));
			if ("undefined" === typeof window.popSrc) {
				window.popSrc = $iframe.prop('src');
			}
	 		$iframe.prop('src', '').prop('src', window.popSrc + '?autoplay=1');
	}).on('pumBeforeClose', function () {
			var $iframe = jQuery('iframe', jQuery(this));
			//$iframe.prop('src', '').prop('src', window.popSrc);
		});
		
}); 