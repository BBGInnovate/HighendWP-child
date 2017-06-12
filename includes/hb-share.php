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

<div class="share-holder">

	<h4>Share</h4>
	<ul class="bbg__article-share">
		<li>
			<a class="bbg__article-share__link facebook" href="<?php echo $fbUrl; ?>" target="_blank">
				<span class="hb-moon-facebook-2"></span>
			</a>
		</li>
		<li>
			<a class="bbg__article-share__link twitter" href="<?php echo $twitterURL; ?>" target="_blank">
				<span class="hb-moon-twitter-2"></span>
			</a>
		</li>
	</ul>

</div>