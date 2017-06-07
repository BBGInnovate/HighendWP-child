<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
/*
Template Name: Vertical Timeline
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<?php 
$main_content_style = "";
if ( vp_metabox('background_settings.hb_content_background_color') )
	$main_content_style = ' style="background-color: ' . vp_metabox('background_settings.hb_content_background_color') . ';"';
?>
<style>
.facebook-responsive {
    overflow:hidden;
    padding-bottom:68%;
    position:relative;
    height:0;
}

.facebook-responsive iframe {
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}

iframe#superTuesday {

}
.facebook-responsive-aftermath  {
	overflow:hidden;
	padding-bottom:60%;
	position:relative;
	height:0;
}

</style>
	<!-- BEGIN #main-content -->
<div id="main-content"<?php echo $main_content_style; ?>>
	<div class="container">
		<div class="row main-row">
			<div id="page-<?php the_ID(); ?>" <?php post_class('col-12'); ?>>
				<link href='//fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>	
				<link rel="stylesheet" href="/wp-content/themes/HighendWP-child/timeline/style-trimmed.css">
				<script src="/wp-content/themes/HighendWP-child/timeline/modernizr.js"></script>
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
				<script src="/wp-content/themes/HighendWP-child/timeline/main.js"></script> <!-- Resource jQuery -->
				<?php the_content(); ?>
				<section id="cd-timeline" class="cd-container">
				<?php 
					
					
					while( have_rows('timeline_items') ): 
						the_row(); 
						//$imgSrc = "http://2016.bbg.gov/wp-content/themes/HighendWP-child/timeline/cd-icon-picture.svg";
						$thedate = get_sub_field( 'timeline_date' );		
						$title = get_sub_field( 'timeline_item_title' );
						
						$href = get_sub_field( 'timeline_link' );
						$body = get_sub_field( 'timeline_html_content' );
						$side = get_sub_field( 'timeline_item_side' );
						if ( $side == "right" || $side == "left" ) {
							$side .= "-side";
						}
						
						//$imgSrc = "/wp-content/themes/HighendWP-child/timeline/cd-icon-picture.svg";
						$imgSrc = get_stylesheet_directory_uri() . "/timeline/";

						$icon = get_sub_field( 'timeline_icon' ); 
						if ( $icon == "map pin" ) {
							$imgSrc .= "cd-icon-location.svg";
						} else if ( $icon == "camera" ) {
							$imgSrc .= "cd-icon-movie.svg";
						} else if ( $icon == "mountain" ) {
							$imgSrc .= "cd-icon-picture.svg"; 
						}
				?>
					<div class="cd-timeline-block <?php echo $side; ?>">
						<?php if ( $side != "center" ): ?>
						<div class="cd-timeline-img cd-picture">
							<img src="<?php echo $imgSrc; ?>" alt="Picture">
						</div>
						<?php endif; ?>

						<div class="cd-timeline-content <?php echo $side; ?>">
							<h2><?php echo $title; ?></h2>
							<?php echo $body; ?>
							<?php 
								if ( $href != "" ) {
									echo '<a href="' . $href . '" class="cd-read-more">Read more</a>';
								}
							?>
							<?php if ( $side != "center" ): ?>
							<span class="cd-date"><?php echo $thedate; ?></span>
							<?php endif; ?>
						</div> <!-- cd-timeline-content -->
					</div>
				<?php 
					endwhile;
				?>
				</section>
			</div>
		</div> <!-- END .row -->
	</div> <!-- END .container -->
</div> <!-- END #main-content -->


<?php endwhile; endif; ?>
<?php get_footer(); ?>