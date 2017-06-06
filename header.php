<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
 ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

	<!-- START head -->
	<head>
	<?php global $theme_focus_color; ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="theme-color" content="<?php echo $theme_focus_color; ?>">

	<?php if ( hb_options('hb_responsive') ) { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php } ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if (hb_options('hb_apple_icon_144')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo hb_options('hb_apple_icon_144'); ?>" />
	<?php } ?>
	<?php if (hb_options('hb_apple_icon_114')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo hb_options('hb_apple_icon_114') ?>" />
	<?php } ?>
	<?php if (hb_options('hb_apple_icon_72')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo hb_options('hb_apple_icon_72') ?>" />
	<?php } ?>
	<?php if (hb_options('hb_apple_icon')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo hb_options('hb_apple_icon'); ?>" />
	<?php } ?>

	<?php if ( hb_options('hb_ios_bookmark_title') && hb_options('hb_ios_bookmark_title') != "") { ?>
		<meta name="apple-mobile-web-app-title" content="<?php echo hb_options('hb_ios_bookmark_title'); ?>" />
	<?php } ?>

	<?php
	if ( !hb_seo_plugin_installed() ) {
		$og_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
		if($og_image !== false) { ?>
			<meta property="og:image" content="<?php echo $og_image[0]; ?>" />
		<?php }
	} ?>

	<!--[if lte IE 8]>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/html5shiv.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>

	<!-- Theme Options Font Settings -->
	<style type="text/css">
	<?php
		
		$font_weight = "400";
		$font_style = "normal";
		$font_subsets = hb_options('hb_font_body_subsets');


		// Disable Content Area if selected in Metabox settings
		if ( vp_metabox('layout_settings.hb_content_area') == 'hide' && ( !is_search() && !is_archive() )){
			echo '#main-content { display:none; }
			#slider-section { top:0px; }';
		}

		// Body Font
		if ( hb_options('hb_font_body') == 'hb_font_custom' ){
			$font_face = hb_options('hb_font_body_face');
			$font_weight = hb_options('hb_font_body_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'body, .team-position, .hb-single-next-prev .text-inside, .hb-dropdown-box.cart-dropdown .buttons a, input[type=text], textarea, input[type=email], input[type=password], input[type=tel], #fancy-search input[type=text], #fancy-search .ui-autocomplete li .search-title, .quote-post-format .quote-post-wrapper blockquote, table th, .hb-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, input[type=submit], a.read-more, blockquote.pullquote, blockquote, .hb-skill-meter .hb-skill-meter-title, .hb-tabs-wrapper .nav-tabs li a, #main-wrapper .coupon-code input.button,#main-wrapper .form-row input.button,#main-wrapper input.checkout-button,#main-wrapper input.hb-update-cart,.woocommerce-page #main-wrapper .shipping-calculator-form-hb button.button, .hb-accordion-pane, .hb-accordion-tab {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_body_size') .'px;
				line-height: '. hb_options('hb_font_body_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_body_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';

			echo 'a.read-more, input[type=submit], .hb-caption-layer .hb-button, .hb-push-button-text, #pre-footer-area .hb-button, .hb-button, .hb-single-next-prev .text-inside, #main-wrapper .coupon-code input.button,#main-wrapper .form-row input.button,#main-wrapper input.checkout-button,#main-wrapper input.hb-update-cart,.woocommerce-page #main-wrapper .shipping-calculator-form-hb button.button { font-weight: 700; letter-spacing: 1px }';
		}

		// Navigation Font
		if ( hb_options('hb_font_navigation') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_nav_subsets');
			$font_face = hb_options('hb_font_navigation_face');
			$font_weight = hb_options('hb_font_nav_weight');
			$text_transform = "none";

			if (hb_options('hb_font_navigation_transform')){
				$text_transform = "uppercase";
			}

			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo '#hb-side-menu li a, #main-nav ul.sub-menu li a, #main-nav ul.sub-menu ul li a, #main-nav, #main-nav li a, .light-menu-dropdown #main-nav > li.megamenu > ul.sub-menu > li > a, #main-nav > li.megamenu > ul.sub-menu > li > a {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_navigation_size') .'px;
				letter-spacing: '. hb_options('hb_font_navigation_letter_spacing') .'px;
				font-weight: '.$font_weight.';
				text-transform: '.$text_transform.';
			}';
		}

		// Navigation Dropdown Font
		if ( hb_options('hb_font_navigation_dropdown') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_nav_subsets_dropdown');
			$font_face = hb_options('hb_font_navigation_face_dropdown');
			$font_weight = hb_options('hb_font_nav_weight_dropdown');
			$text_transform = "none";

			if (hb_options('hb_font_navigation_transform_dropdown')){
				$text_transform = "uppercase";
			}

			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo '#main-nav ul.sub-menu li a, #hb-side-menu ul.sub-menu li a, #main-nav ul.sub-menu ul li a, ul.sub-menu .widget-item h4, #main-nav > li.megamenu > ul.sub-menu > li > a #main-nav > li.megamenu > ul.sub-menu > li > a, #main-nav > li.megamenu > ul.sub-menu > li > a {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_navigation_size_dropdown') .'px;
				letter-spacing: '. hb_options('hb_font_navigation_letter_spacing_dropdown') .'px;
				font-weight: '.$font_weight.';
				text-transform: '.$text_transform.';
			}';
		}

		// Copyright Font
		if ( hb_options('hb_font_copyright') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_copyright_subsets');
			$font_face = hb_options('hb_font_copyright_face');
			$font_weight = hb_options('hb_font_copyright_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo '#copyright-wrapper, #copyright-wrapper a {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_copyright_size') .'px;
				line-height: '. hb_options('hb_font_copyright_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_copyright_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 1
		if ( hb_options('hb_font_h1') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h1_subsets');
			$font_face = hb_options('hb_font_h1_face');
			$font_weight = hb_options('hb_font_h1_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h1, article.single h1.title, #hb-page-title .light-text h1, #hb-page-title .dark-text h1 {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h1_size') .'px;
				line-height: '. hb_options('hb_font_h1_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h1_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 2
		if ( hb_options('hb_font_h2') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h2_subsets');
			$font_face = hb_options('hb_font_h2_face');
			$font_weight = hb_options('hb_font_h2_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h2, #hb-page-title h2, .post-content h2.title {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h2_size') .'px;
				line-height: '. hb_options('hb_font_h2_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h2_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 3
		if ( hb_options('hb_font_h3') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h3_subsets');
			$font_face = hb_options('hb_font_h3_face');
			$font_weight = hb_options('hb_font_h3_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h3, h3.title-class, .hb-callout-box h3, .hb-gal-standard-description h3 {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h3_size') .'px;
				line-height: '. hb_options('hb_font_h3_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h3_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 4
		if ( hb_options('hb_font_h4') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h4_subsets');
			$font_face = hb_options('hb_font_h4_face');
			$font_weight = hb_options('hb_font_h4_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h4, .widget-item h4, #respond h3, .content-box h4, .feature-box h4.bold {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h4_size') .'px;
				line-height: '. hb_options('hb_font_h4_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h4_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 5
		if ( hb_options('hb_font_h5') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h5_subsets');
			$font_face = hb_options('hb_font_h5_face');
			$font_weight = hb_options('hb_font_h5_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h5, #comments h5, #respond h5, .testimonial-author h5 {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h5_size') .'px;
				line-height: '. hb_options('hb_font_h5_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h5_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Heading 6
		if ( hb_options('hb_font_h6') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_h6_subsets');
			$font_face = hb_options('hb_font_h6_face');
			$font_weight = hb_options('hb_font_h6_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h6, h6.special {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_font_h6_size') .'px;
				line-height: '. hb_options('hb_font_h6_line_height') .'px;
				letter-spacing: '. hb_options('hb_font_h6_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Pre-Footer Callout
		if ( hb_options('hb_pre_footer_font') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_pre_footer_subsets');
			$font_face = hb_options('hb_pre_footer_font_face');
			$font_weight = hb_options('hb_font_pre_footer_weight');
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo '#pre-footer-area {
				font-family: "' . $font_face . '", sans-serif;
				font-size: '. hb_options('hb_pre_footer_font_size') .'px;
				line-height: '. hb_options('hb_pre_footer_line_height') .'px;
				letter-spacing: '. hb_options('hb_pre_footer_letter_spacing') .'px;
				font-weight: '.$font_weight.';
			}';
		}

		// Modern Title
		if ( hb_options('hb_font_modern_title') == 'hb_font_custom' ){
			$font_subsets = hb_options('hb_font_modern_title_subsets');
			$font_face = hb_options('hb_font_modern_title_face');
			$font_weight = hb_options('hb_font_modern_title_weight');
			$text_transform = "none";
			if (hb_options('hb_font_modern_title_transform')){
				$text_transform = "uppercase";
			}
			VP_Site_GoogleWebFont::instance()->add($font_face, $font_weight, $font_style, $font_subsets);
			echo 'h1.modern,h2.modern,h3.modern,h4.modern,h5.modern,h6.modern {
				font-family: "' . $font_face . '", sans-serif;
				letter-spacing: '. hb_options('hb_font_modern_title_letter_spacing') .'px;
				font-weight: '.$font_weight.';
				text-transform: '.$text_transform.';
			}';
		}

		VP_Site_GoogleWebFont::instance()->register_and_enqueue();
	?>
	</style>

	</head>
	<!-- END head -->

	<?php

		global $woocommerce;

        $cart_count=$cart_url="";
        if ( class_exists('Woocommerce') ){ 
            global $woocommerce;
            $cart_url = $woocommerce->cart->get_cart_url();
            $cart_count = $woocommerce->cart->cart_contents_count;
        }

        $search_in_header = ' data-search-header=0';
        if ( hb_options('hb_search_in_menu') ){
            $search_in_header = ' data-search-header=1';
        }

		$hb_layout_class = hb_options('hb_global_layout');
		if ( vp_metabox('misc_settings.hb_boxed_stretched_page') == 'hb-boxed-layout' ) {
			$hb_layout_class = 'hb-boxed-layout';
		} else if ( vp_metabox('misc_settings.hb_boxed_stretched_page') == 'hb-stretched-layout' ){
			$hb_layout_class = 'hb-stretched-layout';
		}


		$fixed_footer_data = hb_options('hb_fixed_footer_effect');
		$fixed_footer_class = ' data-fixed-footer="0"';

		if ( $fixed_footer_data ){
			$fixed_footer_class = ' data-fixed-footer="1"';
		}
		

		$bg_image_render = "";

		if ( hb_options('hb_global_layout') == 'hb-boxed-layout' || vp_metabox('misc_settings.hb_boxed_stretched_page') == 'hb-boxed-layout' || ( isset($_GET['layout']) && $_GET['layout'] == 'boxed') ){
			$bg_url = hb_options('hb_default_background_image');
			$bg_repeat = ' background-repeat: ' . hb_options('hb_background_repeat') . ';';
			$bg_attachment = ' background-attachment: ' . hb_options('hb_background_attachment') . ';';
			$bg_position = ' background-position: ' . hb_options('hb_background_position') . ';';
			$bg_size = ' background-size: auto auto;';

			if ( hb_options('hb_background_stretch') ){
				$bg_size = " background-size: cover;";
			}

			if( hb_options('hb_default_background_image') && hb_options('hb_upload_or_predefined_image') == 'upload-image' ) {
				$bg_url = hb_options('hb_default_background_image');
				$bg_image_render = ' style="background-image: url('. $bg_url .');' . $bg_repeat . $bg_attachment . $bg_position . $bg_size . '"';
			} 

			if ( hb_options('hb_upload_or_predefined_image') == 'predefined-texture' ) {
				$bg_image_render = ' style="background-image: url('. hb_options('hb_predefined_bg_texure') .'); background-repeat:repeat; background-position: center center; background-attachment:scroll; background-size:initial;"';
			}

			if ( vp_metabox('background_settings.hb_background_page_settings') == "image" && vp_metabox('background_settings.hb_page_background_image') ) {
				$bg_url = vp_metabox('background_settings.hb_page_background_image');
				$bg_image_render = ' style="background-image: url('. $bg_url .');' . $bg_repeat . $bg_attachment . $bg_position . $bg_size . '"';
			}

			if ( vp_metabox('background_settings.hb_background_page_settings') == "color" ) {
				$bg_image_render = ' style="background-color: ' . vp_metabox('background_settings.hb_page_background_color') . ';';
			}
		}

		$extra_body_class = vp_metabox('misc_settings.hb_page_extra_class');
		if ( hb_options('hb_queryloader') == 'ytube-like' ){
			$extra_body_class .= ' hb-preloader';
		}

		if ( vp_metabox('misc_settings.hb_special_header_style') ){
			$extra_body_class .= ' hb-special-header-style';
		}

		if ( hb_options('hb_header_layout_style') == "left-panel" ) {
			$extra_body_class .= ' hb-side-navigation';
		}

		if ( hb_options('hb_side_section') ) {
			$extra_body_class .= ' has-side-section';
		}

		// Check if transparent side menu is selected
		if ( hb_options('hb_side_nav_style') == 'hb-side-transparent' ){
			$extra_body_class .= ' transparent-side-navigation';
		}

		// Check if animation for side menu is selected
		if (hb_options('hb_side_nav_with_animation')){
			$extra_body_class .= ' side-navigation-with-animation';
		}

		// Check if alternative sidebar
		if (hb_options('hb_sidebar_style') == 'hb-alt-sidebar')
			$extra_body_class .= ' hb-alt-sidebar';

		// Check sidebar size
		if ( hb_options('hb_sidebar_size') == 'hb-sidebar-20' )
			$extra_body_class .= ' hb-sidebar-20';

		// Check if modern search
		if ( hb_options('hb_search_style') == 'hb-modern-search')
			$extra_body_class .= ' hb-modern-search';

		if ( hb_module_enabled ('hb_module_prettyphoto') )
			{
				$extra_body_class .= ' highend-prettyphoto';
			} else {
				$extra_body_class .= ' disable-native-prettyphoto';
			}

		$extra_body_class .= ' ' . $hb_layout_class;

	?>

	<!-- START body -->
	<body <?php body_class($extra_body_class); echo $fixed_footer_class; echo $bg_image_render; ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

	<?php 
	if ( hb_options('hb_queryloader') == 'circle-spinner' ) { ?>
		<div id="hb-preloader">

			<!--<div class="spinner"></div>-->
			<span class="default-loading-icon"></span>
			
		</div>
	<?php } ?>

	<?php
	// MAP UTILS
    global $hb_gmap;
    $hb_gmap = null;

    // Check if options are ok
    $hb_gmap = array();

    $hb_gmap[1]['lat'] = hb_options('hb_map_1_latitude');
    $hb_gmap[1]['lng'] = hb_options('hb_map_1_longitude');
    $hb_gmap[1]['ibx'] = hb_options('hb_location_1_info');

    $count = 1;
    for($i = 2; $i <= 10; $i++){
        if( hb_options('hb_enable_location_' . $i) ) {
            $count++;
            $hb_gmap[$count]['lat'] = hb_options('hb_map_' . $i . '_latitude');
            $hb_gmap[$count]['lng'] = hb_options('hb_map_' . $i . '_longitude');
            $hb_gmap[$count]['ibx'] = hb_options('hb_location_' . $i . '_info');
        }   
    }

    function json_hb_map() {
        global $hb_gmap; 
        return $hb_gmap;
    }
    
    wp_localize_script( 'hb_map', 'hb_gmap', json_hb_map() );
	?>

	<?php

		$page_global_layout = vp_metabox('misc_settings.hb_boxed_stretched_page');
		if ( $page_global_layout != "default" && $page_global_layout && !is_search() && !is_archive() ) {
			$hb_layout_class = $page_global_layout;
		}

		if ( isset($_GET['layout']) && $_GET['layout'] == 'boxed' ){
			$hb_layout_class = 'hb-boxed-layout';
		}

		$hb_shadow_class = "no-shadow";
		if ( hb_options('hb_boxed_shadow') ){
			$hb_shadow_class = "with-shadow";
		}

		$hb_content_width = "width-1140";
		if ( hb_options('hb_content_width') == '940px' ){
			$hb_content_width = "width-940";
		} else if ( hb_options('hb_content_width') == 'fw-100' ) {
			$hb_content_width = "fw-100";
		}

		$hb_logo_alignment = "";
		if ( hb_options('hb_header_layout_style') != "nav-type-2 centered-nav" )
			$hb_logo_alignment = hb_options('hb_logo_alignment');

		$sticky_shop_button = "";
		if ( hb_options('hb_enable_sticky_shop_button') && class_exists('Woocommerce') ){
			$sticky_shop_button = " with-shop-button";
		}

		$hb_resp = "";
		if ( hb_options('hb_responsive') ) {
			$hb_resp = " hb-responsive";
		}

		$hb_logo_alignment = hb_options('hb_logo_alignment');

		$footer_separator = "";
		if ( hb_options('hb_enable_footer_separators') ) {
			$footer_separator = " with-footer-separators";
		}

	?>

	<?php
		if (hb_options('hb_responsive')){
			echo hb_mobile_menu();
		}
	?>


	<?php if ( hb_options('hb_header_layout_style') == "left-panel" &&  !is_page_template('page-blank.php') ) {
		get_template_part('includes/header' , 'side-nav');
	} ?>


	<!-- BEGIN #hb-wrap -->
	<div id="hb-wrap">

	<!-- BEGIN #main-wrapper -->
	<div id="main-wrapper" class="<?php if ( vp_metabox('misc_settings.hb_onepage') ) { echo 'hb-one-page '; } echo $hb_layout_class; echo $footer_separator; echo ' ' . hb_options('hb_boxed_layout_type'); echo $hb_logo_alignment; echo ' ' . $hb_shadow_class; echo $hb_logo_alignment; echo ' ' . $hb_content_width; echo $sticky_shop_button . $hb_resp; echo ' ' . hb_options('hb_header_layout_style'); ?>" data-cart-url="<?php echo $cart_url; ?>" data-cart-count="<?php echo $cart_count; ?>" <?php echo $search_in_header; ?>>

		<?php
		$additional_class = "";
		if ( hb_options('hb_header_layout_style') == "nav-type-1 nav-type-4" ) {
	    	$additional_class .= "special-header";
		}
		if ( !hb_options('hb_top_header_bar') ) {
			$additional_class .= " without-top-bar";	
		}
		?>

		<?php if ( !is_page_template('page-blank.php') ) {
			if ( hb_options('hb_header_layout_style') != "left-panel" ) { ?>
				<!-- BEGIN #hb-header -->
				<header id="hb-header" class="<?php echo $additional_class; ?>">

					<?php get_template_part( 'includes/header' , 'top-bar' ); ?>
					<?php get_template_part( 'includes/header' , 'navigation' ); ?>

				</header>
				<!-- END #hb-header -->

				<?php get_template_part ( 'includes/header' , 'page-title' );
			} ?>
			<?php get_template_part( 'includes/header' , 'slider-section'); ?>
		<?php } ?>