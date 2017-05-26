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

				<?php 
					the_content(); 
					
					while( have_rows('timeline_items') ): 
						the_row(); 
						//$imgSrc = "http://2016.bbg.gov/wp-content/themes/HighendWP-child/timeline/cd-icon-picture.svg";
						$thedate = get_sub_field('timeline_date');		
						$title = get_sub_field('timeline_item_title');
						$imgSrc = get_sub_field('timeline_icon');
						$imgSrc = "/wp-content/themes/HighendWP-child/timeline/cd-icon-picture.svg";
						$href = get_sub_field('timeline_link');
						$body = get_sub_field('timeline_html_content');
				?>
					<div class="cd-timeline-block">
						<div class="cd-timeline-img cd-picture">
							<img src="<?php echo $imgSrc; ?>" alt="Picture">
						</div>
						<div class="cd-timeline-content">
							<h2><?php echo $title; ?></h2>
							<?php echo $body; ?>
							<a href="<?php echo $href; ?>" class="cd-read-more">Read more</a>
							<span class="cd-date"><?php echo $thedate; ?></span>
						</div> <!-- cd-timeline-content -->
					</div>
				<?php 
					endwhile;
				?>
			</div>
		</div> <!-- END .row -->
	</div> <!-- END .container -->
</div> <!-- END #main-content -->


<?php endwhile; endif; ?>
<?php get_footer(); ?>