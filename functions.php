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
				display:inline-block;
				background: #000000;
			}
			#main-content {
				padding-top: 0px !important;
			}
			#slider-section, #rev_slider_2_1_wrapper {
				background: #062843 !important; 
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<h2>Threats to Press</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non lacus velit. Proin porta ultricies ex non vulputate. Aenean maximus convallis varius. Invidual threats are mapped below with the <i class="fa fa-map-pin" aria-hidden="true"></i> icon and you may <a style="text-decoration: underline;" href="https://www.bbg.gov/2016-threats-archive/" target="_blank">view a full list</a> on the bbg.gov site.</p>
		<div class="bbg__map-area__container " style="postion: relative;">
			<div id="chartdiv"></div>
			<div align="center" >
						<div align="center" >
							<div class="legendBox free"></div> Free 
							<div class="legendBox partially-free"></div> Partially Free 
							<div class="legendBox not-free"></div> Not Free 
							&nbsp;&nbsp;<span style="white-space: nowrap;"><i class="fa fa-map-pin" aria-hidden="true"></i> Incident</span>
						</div>
					</div>
		</div>
<?php 

	echo "<script type='text/javascript'>\n";
	echo "freeNotFree = $freeNotFreeStr";
	echo "</script>";
?>
	<style>
		div[id^='circleTooltip_'] {
			padding: 20px;
			border: 1px solid #EBEBEB;
			position: relative;
			color:#FFF;
		}
		#circleTooltip_voa {
			background: #538EBD;
		}
		#circleTooltip_rfa {
			background: #2D655E;
		}
		#circleTooltip_mbn {
			background: #7E3536;
		}
		#circleTooltip_ocb {
			background: #92AECF;
		}
		#circleTooltip_rferl {
			background: #887639;
		}
		.vc_chart-legend li {
			list-style-type: none !important;
		}
	</style>

	<script type="text/javascript">
		
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
			jQuery("path[class$='_circle'],g[class$='_circle']").css('cursor','pointer'); 			
			jQuery("path[class$='_circle'],g[class$='_circle']").hover( 
				function(e) {
					var entity = jQuery(this).attr('class').split("_").shift();
					toggleCircleDiv(entity,'in');
				},
				function(e) {
					toggleCircleDiv('','out');
				}
			);
			jQuery('#circleTooltip').hide() //.addClass('hb-testimonial');

			//there is an issue with the Visual Composer line chart that happens on the hoempage
			function fakeWindowResize(){
				jQuery(window).resize();
			}
			setTimeout(fakeWindowResize, 2000); 

			jQuery(document).on('pumBeforeOpen', '.pum', function () {
				var $iframe = jQuery('iframe', jQuery(this));
					if ("undefined" === typeof window.popSrc) {
						window.popSrc = $iframe.prop('src');
					}
			 		$iframe.prop('src', '').prop('src', window.popSrc + '?autoplay=1');
			}).on('pumBeforeClose', function () {
					var $iframe = jQuery('iframe', jQuery(this));
					$iframe.prop('src', '').prop('src', window.popSrc);
				});
				
		});

	</script>
 
<?php 

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

/*

<style>
	section#ceoBackgroundVideo {
		background: url(https://www.bbg.gov/wp-content/media/2011/11/4.1-1024x683.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
</style>
*/

?>
