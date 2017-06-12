<?php
/**
 * @package WordPress
 * @subpackage Highend
 */

//the title/headline field, followed by the URL and the author's twitter handle
$twitterText = "";
$twitterText .= html_entity_decode( get_the_title() );
$twitterText .= " by @bbggov";
$twitterText .= " " . get_permalink();

$twitterURL = "//twitter.com/intent/tweet?text=" . rawurlencode( $twitterText );
$fbUrl = "//www.facebook.com/sharer/sharer.php?u=" . urlencode( get_permalink() );
$hideFeaturedImage = FALSE;

?>

<div class="share-holder"><!-- <i class="hb-moon-share-2"></i> -->

	<h4>Share</h4>
	<ul class="bbg__article-share">
		<li>
			<a class="bbg__article-share__link facebook" href="<?php echo $fbUrl; ?>">
				<span class="hb-moon-facebook-2"></span>
			</a>
		</li>
		<li>
			<a class="bbg__article-share__link twitter" href="<?php echo $twitterURL; ?>">
				<span class="hb-moon-twitter-2"></span>
			</a>
		</li>
	</ul>

	<!-- BEGIN .hb-dropdown-box -->
	<!-- <div class="hb-dropdown-box share-dropdown-box">
		<ul class="blog-social-share">

			<?php if ( hb_options('hb_share_facebook') ) { ?>
            <li><a class="facebook-share" onclick="popWindow('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','500','400');" title="Facebook" rel="tooltip" data-placement="right"><i class="hb-moon-facebook"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_twitter') ) { ?>
			<li><a class="twitter-share" onclick="popWindow('http://twitter.com/share?url=<?php the_permalink(); ?>','Twitter','500','258')" title="Twitter" rel="tooltip" data-placement="right"><i class="hb-moon-twitter"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_gplus') ) { ?>
			<li><a class="googleplus-share" onclick="popWindow('http://plus.google.com/share?url=<?php the_permalink(); ?>','GooglePlus','500','400')" title="Google+" rel="tooltip" data-placement="right"><i class="hb-moon-google-plus-2"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_linkedin') ) { ?>
			<li><a class="linkedin-share" onclick="popWindow('http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>','LinkedIn','500','400')" title="LinkedIn" rel="tooltip" data-placement="right"><i class="hb-moon-linkedin"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_pinterest') ) { ?>
			<?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			<li><a class="pinterest-share" onclick="popWindow('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $feat_image[0]; ?>&amp;description=<?php echo get_bloginfo('title') . ' - '; the_title(); ?>','Pinterest','500','400')" title="Pinterest" rel="tooltip" data-placement="right"><i class="hb-moon-pinterest"></i></a></li>
			<?php } ?>

			<?php if ( hb_options('hb_share_tumblr') ) { ?>
			<li><a class="tumblr-share" onclick="popWindow('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>','Tumblr','500','400')" title="Tumblr" rel="tooltip" data-placement="right"><i class="hb-moon-tumblr-2"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_vkontakte') ) { ?>
			<li><a class="vkontakte-share" onclick="popWindow('http://vkontakte.ru/share.php?url=<?php the_permalink(); ?>','VKontakte','500','400')" title="VKontakte" rel="tooltip" data-placement="right"><i class="icon-vk"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_reddit') ) { ?>
			<li><a class="reddit-share" onclick="popWindow('http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>','Reddit','500','400')" title="Reddit" rel="tooltip" data-placement="right"><i class="hb-moon-reddit"></i></a>
			</li>
			<?php } ?>

			<?php if ( hb_options('hb_share_email') ) { ?>
			<li><a class="email-share" href="mailto:?subject=<?php echo get_bloginfo('title') . ' - '; the_title(); ?>&amp;body=<?php the_permalink(); ?>" target="_blank" title="Email" rel="tooltip" data-placement="right"><i class="hb-moon-envelop"></i></a></li>
			<?php } ?>
		</ul>

	</div> -->
	<!-- END .hb-dropdown-box -->

</div>