<?php
/**
 * @package WordPress
 * @subpackage Highend
 */

//the title/headline field, followed by the URL and the author's twitter handle
$twitterText = "";
$twitterText .= html_entity_decode( get_the_title() );
$twitterText .= " " . get_permalink();
$twitterText .= " via @bbggov #BBGannual";

$twitterURL = "//twitter.com/intent/tweet?text=" . rawurlencode( $twitterText );
$fbUrl = "//www.facebook.com/sharer/sharer.php?u=" . urlencode( get_permalink() );
$hideFeaturedImage = FALSE;

?>
<?php if ( vp_metabox('misc_settings.hb_onepage') && !vp_metabox('misc_settings.hb_disable_navigation')) { ?>
	<ul id="hb-one-page-bullets"></ul>
<?php } ?>

<?php if ( hb_options('hb_to_top_button') && !is_page_template('page-blank.php') ) { ?>
<!-- Back to Top Button -->
<a id="to-top"><i class="<?php echo hb_options('hb_back_to_top_icon'); ?>"></i></a>
<!-- END #to-top -->
<?php } ?>

<!-- BEGIN social-buttons -->
<a id="contact-button" class="bbg__article-share__link twitter button-top" href="<?php echo $twitterURL; ?>"><i class="hb-moon-twitter"></i></a>
<a id="contact-button" class="bbg__article-share__link facebook" href="<?php echo $fbUrl; ?>" target="_blank"><i class="hb-moon-facebook"></i></a>
<!-- END social-buttons -->

<?php if ( !is_page_template('page-blank.php') && hb_options('hb_enable_quick_contact_box') ) {
	get_template_part('includes/aside-contact-panel');
} ?>

<?php
	// Google Analytics from Theme Options
	$google_analytics_code = hb_options('hb_analytics_code');
	if ($google_analytics_code){
		echo $google_analytics_code;
	}

	// Custom Script from Theme Options
	$custom_script_code = hb_options('hb_custom_script');
	if ($custom_script_code){
		echo '<script type="text/javascript">' . $custom_script_code . '</script>';
	}
?>

<?php
if ( !is_page_template('page-presentation-fullwidth.php') ){
 if ( !is_page_template('page-blank.php') && (hb_options('hb_enable_pre_footer_area') && vp_metabox('layout_settings.hb_pre_footer_callout') == "default" || hb_options('hb_enable_pre_footer_area') && vp_metabox('layout_settings.hb_pre_footer_callout') == "" || vp_metabox('layout_settings.hb_pre_footer_callout') == "show" ) ) {
 	get_template_part('includes/pre-footer');
} } ?>
<?php
if ( !is_page_template( 'page-presentation-fullwidth.php' ) ) {
if (
	( ( hb_options('hb_enable_footer_widgets') && (vp_metabox('layout_settings.hb_footer_widgets') == "default" || vp_metabox('layout_settings.hb_footer_widgets') == "" )) || vp_metabox('layout_settings.hb_footer_widgets') == "show" ) &&
	!is_page_template('page-blank.php')
) { ?>

<?php
	$footer_bg_image = "";
	$footer_bg = "";
if ( hb_options('hb_enable_footer_background' ) ) {
	$footer_bg_image = " background-image";
}

if ( hb_options("hb_footer_bg_image") ){
	$footer_bg_image = " footer-bg-image";
	$footer_bg = ' style="background-image: url('. hb_options("hb_footer_bg_image") .')"';
}

?>

<!-- BEGIN #footer OPTION light-style -->
<footer id="footer" class="dark-style<?php echo $footer_bg_image; ?>" <?php echo $footer_bg; ?>>

	<!-- BEGIN .container -->
	<div class="container">
		<div class="row footer-row">

	<?php
	$hb_footer_class = array(
		'style-1'=>array('1'=>'col-3', '2'=>'col-3', '3'=>'col-3', '4'=>'col-3'),
		'style-2'=>array('1'=>'col-3', '2'=>'col-3', '3'=>'col-6', '4'=>'hidden'),
		'style-3'=>array('1'=>'col-6', '2'=>'col-3', '3'=>'col-3', '4'=>'hidden'),
		'style-4'=>array('1'=>'col-3', '2'=>'col-6', '3'=>'col-3', '4'=>'hidden'),
		'style-5'=>array('1'=>'col-4', '2'=>'col-4', '3'=>'col-4', '4'=>'hidden'),
		'style-6'=>array('1'=>'col-8', '2'=>'col-4', '3'=>'hidden', '4'=>'hidden'),
		'style-7'=>array('1'=>'col-4', '2'=>'col-8', '3'=>'hidden', '4'=>'hidden'),
		'style-8'=>array('1'=>'col-6', '2'=>'col-6', '3'=>'hidden', '4'=>'hidden'),
		'style-9'=>array('1'=>'col-3', '2'=>'col-9', '3'=>'hidden', '4'=>'hidden'),
		'style-10'=>array('1'=>'col-9', '2'=>'col-3', '3'=>'hidden', '4'=>'hidden'),
		'style-11'=>array('1'=>'col-12', '2'=>'hidden', '3'=>'hidden', '4'=>'hidden'),
	);

	$hb_footer_style = hb_options('hb_footer_layout');
	if ( !$hb_footer_style ) {
		$hb_footer_style = 'style-1';
	}

	$separator_class = "";
	if (!hb_options('hb_enable_footer_separators')){
		$separator_class = " no-separator";
	}

	for( $i = 1 ; $i <= 4 ; $i++ ){
		echo '<div class="' . $hb_footer_class[$hb_footer_style][$i] . ' widget-column' . $separator_class . '">';
		dynamic_sidebar('Footer ' . $i);
		echo '</div>';
	}

	?>
		</div>
	</div>
	<!-- END .container -->

</footer>
<!-- END #footer -->
<?php } } ?>

<?php
if ( !is_page_template( 'page-presentation-fullwidth.php' ) ){
if ( hb_options('hb_enable_footer_copyright') && !is_page_template('page-blank.php') ) {
	get_template_part('includes/copyright');
} } ?>

<?php if ( ( is_singular('post') && hb_options('hb_blog_enable_next_prev') ) || (is_singular('portfolio') && hb_options('hb_portfolio_enable_next_prev') ) || ( is_singular('team') && hb_options('hb_staff_enable_next_prev') ) ) { ?>
	<nav class="hb-single-next-prev">
	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	?>

	<?php if ( !empty($prev_post) ) { ?>
	<a href="<?php echo get_permalink($prev_post->ID); ?>" title="<?php echo $prev_post->post_title; ?>" class="hb-prev-post">
		<i class="hb-moon-arrow-left-4"></i>
		<span class="text-inside"><?php _e('Prev','hbthemes'); ?></span>
	</a>
	<?php } ?>

	<?php if ( !empty($next_post) ) { ?>
	<a href="<?php echo get_permalink($next_post->ID); ?>" title="<?php echo $next_post->post_title; ?>" class="hb-next-post">
		<i class="hb-moon-arrow-right-5"></i>
		<span class="text-inside"><?php _e('Next','hbthemes'); ?></span>
	</a>
	<?php } ?>

</nav>
<!-- END LINKS -->
<?php } ?>

</div>
<!-- END #main-wrapper -->

</div>
<!-- END #hb-wrap -->

<?php if ( hb_options('hb_side_section') ) { ?>
	<div id="hb-side-section">
		<a href="#" class="hb-close-side-section"><i class="hb-icon-x"></i></a>
		<?php if ( is_active_sidebar( 'hb-side-section-sidebar' ) ) {
			dynamic_sidebar('hb-side-section-sidebar');
		} else {
			echo '<p class="aligncenter" style="margin-top:30px;">';
			_e('Please add widgets to this widgetized area ("Side Panel Section") in Appearance > Widgets.', 'hbthemes');
			echo '</p>';
		} ?>
	</div>
<?php } ?>


<?php if ( hb_options('hb_search_style') == 'hb-modern-search') { ?>
	<!-- BEGIN #fancy-search -->
	<div id="modern-search-overlay">
		<a href="#" class="hb-modern-search-close"><i class="hb-icon-x"></i></a>

		<div class="table-middle hb-modern-search-content">
			<p><?php _e('Type and press Enter to search', 'hbthemes'); ?></p>

			<form method="get" id="hb-modern-form" action="<?php echo home_url( '/' ); ?>" novalidate="" autocomplete="off">
				<input type="text" value="" name="s" id="hb-modern-search-input" autocomplete="off">
			</form>
		</div>

	</div>
<?php } ?>

<!-- BEGIN #hb-modal-overlay -->
<div id="hb-modal-overlay"></div>
<!-- END #hb-modal-overlay -->

<?php wp_footer(); ?>
</body>
<!-- END body -->

</html>
<!-- END html -->