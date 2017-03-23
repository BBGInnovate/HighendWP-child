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
		</style>
		<!-- Resources -->
		<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
		<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
		
		<!-- 
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>  
		-->
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/map-annualreport.js'></script>

		<!-- HTML --> 
		<div class="btn-group entity-buttons u--show-medium-large" role="group" aria-label="..." style="clear: none;">
			<button type="button" title="ALL" class=" btn-default all" value="all"><span class="bbg__map__button-text">Free</span></button><!--
		--><button type="button" title="CHINA" class=" btn-default china" value="china"><span class="bbg__map__button-text">Not Free</span></button><!--
		--><button type="button" title="CUBA" class=" btn-default cuba" value="cuba"><span class="bbg__map__button-text">Partially Free</span></button><!--
		--></div>

		<div class="bbg__map-area__container " style="postion: relative;">
			<div id="chartdiv"></div>
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


?>
