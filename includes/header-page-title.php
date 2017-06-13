<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
 
global $wp_query, $post;
if ( !is_archive() && !is_404() && !is_search() && vp_metabox('misc_settings.hb_special_header_style') ) return;

if ( !is_search() && !is_archive() ) {
	if ( is_page_template( 'page-presentation-fullwidth.php' ) ) return;
}

// Return if is 404 page
if ( is_404() ) return;
// Return if latest posts are shown on home page - metabox fields not possible
if ( is_home() ) return;

$post_id = $post->ID;
$is_shop = false;

if ( function_exists('is_woocommerce') && is_woocommerce() ) {
	if ( function_exists('is_shop') && is_shop() ){
		if ( function_exists('wc_get_page_id') ) {
			$post_id = wc_get_page_id( 'shop' );
			$is_shop = true;
		}
	}
}
$page_title_type = hb_options('hb_page_title_type');

if ( vp_metabox('general_settings.hb_page_title_option', null, $post_id) == "custom" && (!is_archive()||(function_exists('is_shop') && is_shop())) && !is_search() ) {
	$page_title_type = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_type', null, $post_id);
}

// Return if Hide Page title is chosen
if ( $page_title_type == "none" ) return;


// Proceed with displaying the page title
$page_title_background_color = hb_options('hb_page_title_background_color');
$page_title_background_image = hb_options('hb_page_title_background_image');
$page_title_background_parallax = hb_options('hb_page_title_background_image_parallax');
$page_title_animation = hb_options('hb_page_title_animation');
$page_subtitle_animation = hb_options('hb_page_title_subtitle_animation');
$page_title_height = hb_options('hb_page_title_height');
$page_title_style = hb_options('hb_page_title_style');
$page_title_color = hb_options('hb_page_title_color');
$page_title_alignment = hb_options('hb_page_title_alignment');

if ( vp_metabox('general_settings.hb_page_title_option', null, $post_id) == "custom" && (!is_archive()||(function_exists('is_shop') && is_shop())) && !is_search() ) {
	$page_title_background_color = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_background_color', null, $post_id);
	$page_title_background_image = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_background_image', null, $post_id);	
	$page_title_background_parallax = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_background_image_parallax', null, $post_id);
	$page_title_animation = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_animation', null, $post_id);
	$page_subtitle_animation = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_subtitle_animation', null, $post_id);
	$page_title_height = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_height', null, $post_id);
	$page_title_style = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_style', null, $post_id);
	$page_title_color = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_color', null, $post_id);
	$page_title_alignment = vp_metabox('general_settings.hb_title_settings_group.0.hb_page_title_alignment', null, $post_id);
}


$page_title_type_style = "";
// Color background
if ( $page_title_type == 'hb-color-background' ) {
	$page_title_type_style = 'background-color:' . $page_title_background_color;
} else if ( $page_title_type == 'hb-image-background' ) {	
	$page_title_type_style = 'background-image: url(' . $page_title_background_image . ')';
	if ( $page_title_background_parallax ) {
		$page_title_type .= ' parallax';
	}
}

if ( $page_title_animation ) {
	$page_title_animation = 'hb-animate-element ' . $page_title_animation;
} 

if ( $page_subtitle_animation ) {
	$page_subtitle_animation = 'hb-animate-element ' . $page_subtitle_animation;
} 

if ( $page_title_style == 'stroke-title' ){
	$page_title_color = '';
}
?>
<?php if (!is_user_logged_in()):?>
<div style="background-color:#FF0000; color:#FFFFFF; z-index:9999;  width:100%; position:fixed; top:59px; font-weight:bold; line-height:20px; font-family: verdana; font-size:12px; text-align: center;" class="usa-disclaimer">
	<div class="usa-grid">
		<span class="usa-disclaimer-official">
			DRAFT of 2016 Report.  
		</span>
	</div>
</div>
<?php endif; ?>

<!-- START #hb-page-title -->
<div class="<?php echo $page_title_type; echo ' ' . $page_title_height . ' ' . $page_title_color; ?>" id="hb-page-title">
	<div class="hb-image-bg-wrap" style="<?php echo $page_title_type_style; ?>"></div>

	<div class="container clearfix<?php echo ' ' . $page_title_alignment; ?>">
		<!-- START .hb-page-title -->
		<div class="hb-page-title<?php
			if ( $page_title_style ) 
				echo ' ' . $page_title_style;
			if ( $page_title_color )
				echo ' ' . $page_title_color;
			if ( $page_title_alignment )
				echo ' ' . $page_title_alignment;
		?>">
			<h1 class="<?php echo $page_title_animation; ?>"><?php 
				if ( function_exists('is_product_category') && is_product_category() ){
					_e('Product Category', 'hbthemes');
				} else if ( function_exists('is_shop') && is_shop() ) {
					if ( vp_metabox('general_settings.hb_page_title_h1', null, $post_id ) )
						echo vp_metabox('general_settings.hb_page_title_h1', null, $post_id );
					else
						echo get_the_title($post_id);
				} else if ( is_singular('faq') ) {
					_e('Frequently Asked Questions' , 'hbthemes');
				} else if ( is_singular('hb_testimonials') ) {
					_e('Testimonial' , 'hbthemes');
				} else if ( is_search() ) {
					_e('Search Results ','hbthemes');
				} else if ( class_exists('bbPress') && bbp_is_forum_archive() ) {
					_e('Forums ','hbthemes');
				} else if ( is_archive() ) {
					echo hb_options('hb_archives_title');
				} else if ( vp_metabox('general_settings.hb_page_title_h1', null, $post_id) ) {
					echo vp_metabox('general_settings.hb_page_title_h1', null, $post_id);
				} else {
					the_title();
				}
			?>
			</h1>

			<?php if ( ( class_exists('bbPress') && !bbp_is_forum_archive() ) || !class_exists('bbPress') ) { ?>
			<?php if ( vp_metabox('general_settings.hb_page_subtitle') || is_search() || is_archive() ) { ?>
			<br/>
			<?php if ( !$is_shop ) { ?>
				<h2 class="<?php echo $page_subtitle_animation; ?>">
					<?php 
					if ( is_search() ) {
						if ( $wp_query->found_posts == 0 )
						{
							_e('No results found','hbthemes');
						}
						else if ( $wp_query->found_posts == 1)
						{
							echo $wp_query->found_posts;
							_e(' result found for ','hbthemes');
							echo '<em>'.get_search_query().'</em>';
						}
						else
						{
							echo $wp_query->found_posts;
							_e(' results found for ','hbthemes');
							echo '<em>'.get_search_query().'</em>';
						}
					} else if ( is_archive() ) {

						if ( function_exists('is_product_category') && is_product_category() ){
							echo single_cat_title('',false);
						} else if ( function_exists('is_shop') && is_shop() ) {
							if(vp_metabox('general_settings.hb_page_subtitle', null, $post_id)) {
								echo vp_metabox('general_settings.hb_page_subtitle', null, $post_id); 
							}
						} else if ( is_day() ) {
							_e('Daily Archive for ' , 'hbthemes'); 
							echo get_the_time( 'F jS, Y' );
						}
						else if ( is_month() ) {
							_e('Monthly Archive for ','hbthemes'); 
							echo get_the_time('F, Y');
						}
						else if ( is_year() ) {
							_e('Yearly Archive for ','hbthemes');
							echo get_the_time('Y');
						}
						else if ( is_tag() ) {
							_e('Posts tagged &quot;','hbthemes'); 
							echo single_tag_title();
							_e('&quot','hbthemes');
						}
						else if ( is_category() ) {
							_e('Category Archive for &quot;','hbthemes');
							echo single_cat_title();
							_e('&quot','hbthemes');
						}
						else if ( is_author() ) {
							$cur_auth = $wp_query->get_queried_object();
							_e("Entries by ",'hbthemes');
							echo $cur_auth->nickname;
						} 
						else if ( is_tax() ) {
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							_e( 'Archives for: ', 'hbthemes' ); echo $term->name;
						} else if ( is_tax( 'post_format' ) ) {
							if (has_post_format('link'))
								_e("Archive for Link posts","hbthemes");
							if (has_post_format('image'))
								_e("Archive for Image posts","hbthemes");
							if (has_post_format('quote'))
								_e("Archive for Quote posts","hbthemes");
							if (has_post_format('status'))
								_e("Archive for Status posts","hbthemes");
							if (has_post_format('audio'))
								_e("Archive for Audio posts","hbthemes");
							if (has_post_format('video'))
								_e("Archive for Video posts","hbthemes");
							if (get_post_format() == '' )
								_e("Archive for Standard posts","hbthemes");
							if (has_post_format('gallery'))
								_e("Archive for Gallery posts","hbthemes");
						}
	 				} else if(vp_metabox('general_settings.hb_page_subtitle', null, $post_id)) {
						echo vp_metabox('general_settings.hb_page_subtitle', null, $post_id); 
					} ?>
				</h2>
			<?php } else {
				if(vp_metabox('general_settings.hb_page_subtitle', null, $post_id)) {
					echo '<h2 class="' . $page_subtitle_animation .'">' . vp_metabox('general_settings.hb_page_subtitle', null, $post_id) . '</h2>';
				}
			} ?>
			<?php } ?>
			<?php } ?>
		</div>
		<!-- END .hb-page-title -->

		<?php 
			$teamCats = get_the_terms( get_the_ID(), 'team_categories' ); 
			if ( $teamCats && count($teamCats) > 0 ) {
				$firstCat = $teamCats[0]->name;
				$link = "/networks#networkLeaders";
				$label = "« Network Leadership";
				if ( $firstCat == "Board" ) {
					$link = "/board";
					$label = "« The Board";
				}
		?>
			<div class="breadcrumbs-wrapper">
		        <div class="breadcrumbs-inside">
		    		<!-- <a href="http://2016.bbg.gov">Home</a> 
			    	<span class="sep-icon"><i class="icon-angle-right"></i></span>  -->
			    	<span><a href="<?php echo $link; ?>"><?php echo $label; ?></a></span>
		    	</div>
	    	</div>
    	<?php 
    	
			}
		?>

	</div>
</div>
<!-- END #hb-page-title -->
