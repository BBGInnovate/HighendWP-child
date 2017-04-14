<?php

class ArrayValue implements JsonSerializable {
	//****** HELPER CLASS FOR SERIALIZING PHP TO JSON
	public function __construct(array $array) {
		$this->array = $array;
	}

	public function jsonSerialize() {
		return $this->array;
	}
}

function highend_child_theme_enqueue_styles() {

    $parent_style = 'highend-parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'highend-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'highend_child_theme_enqueue_styles' );

function ttpmap_func( $atts ) {

	$freeNotFreeObj = array_map('str_getcsv', file(get_stylesheet_directory_uri() . '/freeNotFree.csv'));
	if (count($freeNotFreeObj)) {

		//remove the first row from the array because it's headers, not data
		array_shift($freeNotFreeObj);
	}
	$freeNotFreeStr = json_encode(new ArrayValue($freeNotFreeObj), JSON_PRETTY_PRINT);
	
    ob_start();
?>
		<!-- Styles -->
		<style>
			/* start expanding the print styles */
			#chartdiv {
				border: 1px solid #CCC;
				font-size: 11px;
				height: 200px;
				width: 100%;
			}
			@media screen and (min-width: 600px) {
				#chartdiv {
					height: 400px;
				}
			}
			@media screen and (min-width: 900px) {
				#chartdiv {
					height: 500px;
				}
			}
			.amcharts-legend-div {
				position: fixed !important;
				top: 520px !important;
				padding: 10px;
			}

			.amcharts-chart-div > a {
				display: none !important;
			}

			#loading {
				display: none;
				z-index: 9997; 
				position: absolute;
				bottom: 5%;
				left: 5%;
				width: 50px;
				height: 50px;
			}
			.legendBox {
				width: 15px;
				height: 15px;
				display:inline-table;
				background: #000000;
			}
			#main-content {
				padding-top: 0px !important;
			}
		</style>
		<!-- Resources -->
		<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
		<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
		
		<!-- 
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>  
		-->
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/threats.js'></script>
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/map-annualreport.js'></script>

		<!-- HTML --> 
		<?php 
		// <div class="btn-group entity-buttons u--show-medium-large" role="group" aria-label="..." style="clear: none;">
		// 	<button type="button" title="ALL" class=" btn-default all" value="all"><span class="bbg__map__button-text">Free</span></button><!--
		// --><button type="button" title="CHINA" class=" btn-default china" value="china"><span class="bbg__map__button-text">Not Free</span></button><!--
		// --><button type="button" title="CUBA" class=" btn-default cuba" value="cuba"><span class="bbg__map__button-text">Partially Free</span></button><!--
		// --></div>
		?>
		<h2>Threats to Press</h2>
		<div class="bbg__map-area__container " style="postion: relative;">
			<div id="chartdiv"></div>
			<div align="center" >
						<div align="center" >
							<div class="legendBox free"></div> Free 
							<div class="legendBox not-free"></div> Partially Free 
							<div class="legendBox partially-free"></div> Not Free 
						</div>
					</div>
		</div>
<?php 

	echo "<script type='text/javascript'>\n";
	echo "freeNotFree = $freeNotFreeStr";
	echo "</script>";


	$str = ob_get_clean();

    return $str;
}
add_shortcode( 'ttpmap', 'ttpmap_func' ); 
vc_map( array(
   "name" => __("Threats to Press Map"),
   "base" => "ttpmap",
   "category" => __('Content'),
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text"),
         "param_name" => "foo",
         "value" => __("Default params value"),
         "description" => __("Description for foo param.")
      )
   )
) );


function videointro_func( $atts ) {
    $bgSource = "https://bbgredesign.voanews.com/wp-content/themes/bbgRedesign/tools/1280_1.jpg"; 
    $popupSrc = "https://www.youtube.com/embed/0Uy-IDrIe7w?enablejsapi=1&origin=https://www.bbgannual.com";
    //https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=https://bbgredesign.voanews.com
    //https://www.youtube.com/watch?v=0Uy-IDrIe7w
    //https://player.vimeo.com/video/171645924?api=1&player_id=videoplayer&color=000000

    //$bgVidSource = "https://bbgredesign.voanews.com/wp-content/themes/bbgRedesign/tools/ar.mov";
    $bgVidSource = "https://bbgredesign.voanews.com/wp-content/themes/bbgRedesign/tools/ar_reducedSize.mp4";

   ob_start();

?>
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script type="text/javascript">
		function toggleVideo(state) { 
			// if state == 'hide', hide. Else: show video
			var div = document.getElementById("popup-video");
			div.style.display = state == 'hide' ? 'none' : 'block';
			var iframe = div.getElementsByTagName("iframe")[0].contentWindow;
			func = state == 'hide' ? 'pauseVideo' : 'playVideo';
			iframe.postMessage('{"event":"command","func":"' + func + '","args":""}','*');
		}
	</script>


	<style>
		#introvideorow .wpb_column {
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		#introvideorow {
			margin-bottom:0px;
		}
		body {
			margin:0px;
		}
		.header {
			height: 780px;
			position: relative;
			text-align: center;
		} 
		@media screen and (max-width: 767px) {
		    .header  {
		        height: 572px;
		    }
		}
		.background-video-outer {
			content: ' ';
			display: block;
			position: absolute;
			width: 100%;
			height: 100%;
			left: 0px;
			top: 0px;
			/*background: #FF0000;*/
			z-index: 5;
		}
		.background-video-inner {
			width: 100%;
		    height: 100%;
		    position: relative;
		}
		.background-video-source  {
			z-index: 2;
			width: 100%;
			height: 100%;
			left: 0px;
			top: 0px;
			overflow: hidden;
			position: absolute
		}
		.background-video-overlay {
			background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAQAAAAziH6sAAAADklEQVQYV2NgmMmgvQMAA3gBfXW5VPgAAAAASUVORK5CYII=);
			width: 100%;
			height: 100%;
			left: 0px;
			top: 0px;
			overflow: hidden;
			position: absolute;
			z-index: 3
		}
		.background-video-source video {
		    height: 100%;
		    width: auto
		}
		@media screen and (min-width: 1380px) {
		    .background-video-source video {
		        height: auto;
		        width: 100%
		    } 
		}

		.block {
			position: relative;
			width:100%;
		}

		.block .content {
			margin: 0px auto;
			max-width: 952px;
			padding-right: 80px;
			padding-left: 80px;
			*zoom: 1
		}
		.block .content h2 {
			color:#FFF;
		}
		.block .content:after {
			content: "";
			display: table;
			clear: both
		}
		.header .block {
			padding-top: 120px;
			height: 100%;
			z-index: 15;
			color:#FFF !important;
		}		
		.header button.play {
			width: 40px;
			height: 40px;
			margin: 0px auto;
			text-align: center;
			text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.65);
			cursor:pointer;
		}
		#popup-video {
		    height: 100%;
		    width: 100%;
		    position: absolute;
		    top: 0px;
		    left: 0px;
		    z-index: 25;
		    background: rgba(45, 45, 45, 0.9);
		    filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
		    display: none;
		}
		.header .popup-video a.close.close-video {
		    width: 86px;
		    height: 86px;
		    margin: 6px auto 0px auto;
		    color:#FFF;
		}
		.popup-video-holder {
			position: relative;
padding-bottom: 56.25%;
padding-top: 30px; height: 0; overflow: hidden;
		}
		.popup-video-holder iframe,
.popup-video-holder object,
.popup-video-holder embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}

	</style>

</head>
<body>

	 <div class="header">
	 	<div class="background-video-outer">
	 		<div class="background-video-inner">
	 			<div class="background-video-overlay"></div>
	 			<div class="background-video-source">
	 				<video width=1280 height=720 autoplay loop muted poster="<?php echo $bgSource; ?>" id=main_video>
						<source src="<?php echo $bgVidSource; ?>" type="video/mp4">
						<img src="<?php echo $bgSource; ?>" alt="" class=video-fallback /> 
					</video>
				</div>
			</div>
		</div>
		<div class=block>
			<div class=content>
				<h2>Serving Freedom<br>and Democracy</h2>
				<i id="btnPlay" class="fa fa-play fa-2x" style="cursor:pointer"></i>
				<!--<p>Broadcasting Board of Governors<BR>2016 Annual Report</p> -->
				<!-- <div class=advance><button></button></div> -->
			</div>
		</div>
		<div class=popup-video id="popup-video">
			<div class=block>
				<div class=content>
					<div class=popup-video-holder> <iframe id=videoplayer src="<?php echo $popupSrc; ?>" width=793 height=470 frameborder=0 web></iframe> </div>
					<a href="#" class="close close-video"><span>Close</span></a> 
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="more">
		<p>More Content</p>
	</div> -->


	<script type="text/javascript">
		
		window.circleRoll = function(entity) {
			alert(entity + " clicked!!!");
		}
		function toggleCircleDiv(entity, direction) {
			if (direction == "out") {
				jQuery('#circleTooltip').hide();
			} else {
				jQuery("div[id^='circleTooltip_']").hide();
				jQuery('#circleTooltip_'+entity).show();	
				jQuery('#circleTooltip').show();
			}
		}

		jQuery( document ).ready(function() {
			jQuery('#btnPlay').click(function(e) {
				toggleVideo('');
			});
			jQuery('.close').click(function(e) {
				toggleVideo('hide');
			});

			jQuery("path[id$='_circle'").hover( 
				function(e) {
					var entity = jQuery(this).attr('id').split("_").shift();
					toggleCircleDiv(entity,'in');
				},
				function(e) {
					toggleCircleDiv('','out');
				}
			);

			jQuery('#circleTooltip').hide().addClass('hb-testimonial');
		});

	</script>


<?php 

	$str = ob_get_clean();

    return $str;
}
add_shortcode( 'videointro', 'videointro_func' ); 
vc_map( array(
   "name" => __("Intro Video"),
   "base" => "videointro",
   "category" => __('Content'),
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text"),
         "param_name" => "foo",
         "value" => __("Default params value"),
         "description" => __("Description for foo param.")
      )
   )
) );

?>
