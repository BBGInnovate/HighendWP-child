<?php

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
			
		</style>

		<!-- Resources -->
		<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
		<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
		
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/threats.js'></script>
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/map-annualreport.js'></script>

		<!-- HTML --> 
		<?php 
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
	));
?>
