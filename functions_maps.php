<?php

function ttpmap_func( $atts ) {

	$freeNotFreeObj = array_map('str_getcsv', file(get_stylesheet_directory_uri() . '/data/freeNotFree.csv'));
	if (count($freeNotFreeObj)) {

		//remove the first row from the array because it's headers, not data
		array_shift($freeNotFreeObj);
	}
	$freeNotFreeStr = json_encode(new ArrayValue($freeNotFreeObj), JSON_PRETTY_PRINT);
	
    ob_start();
?>
	<style>
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
	<script src='<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/ammap.js'></script>
	<script src='<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/mapdata-worldLow.js'></script>
	
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/threats.js'></script>
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/map-annualreport.js'></script>

	<!-- HTML --> 
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
<?php

function hotspotmap_func( $atts ) {

    ob_start();
?>
	
	<script type="text/javascript">
		bbgConfig={};
		bbgConfig.MAPBOX_API_KEY = 'pk.eyJ1IjoiYmJnd2ViZGV2IiwiYSI6ImNpcDVvY3VqYjAwbmx1d2tyOXlxdXhxcHkifQ.cD-q14aQKbS6gjG2WO-4nw';
		bbgConfig.template_directory_uri = 'https://www.bbg.gov/wp-content/themes/bbgRedesign/';

		entities={
		    "ocb": {
		        "description": "<p>OCB oversees Radio and Television Mart\u00ed at its headquarters in Miami, Florida. Combined with the online platform, martinoticias.com, the Mart\u00eds are a one-of-a-kind service that brings unbiased, objective information to all Cubans.</p>\n",
		        "fullName": "Office of Cuba Broadcasting",
		        "url": "http://www.martinoticias.com/"
		    },
		    "rfa": {
		        "description": "<p>RFA journalists provide uncensored, fact-based news to citizens of these countries, among the world\u2019s worst media environments. </p>\n",
		        "fullName": "Radio Free Asia",
		        "url": "http://www.rfa.org/"
		    },
		    "mbn": {
		        "description": "<p>MBN is the non-profit news organization that operates Alhurra Television, Radio Sawa and MBN Digital reaching audiences in 22 countries across the Middle East and North Africa. </p>\n",
		        "fullName": "Middle East Broadcasting Networks",
		        "url": "http://www.alhurra.com/"
		    },
		    "rferl": {
		        "description": "<p>RFE/RL reaches 26.9 million people in  26  languages and in 23 countries, including Afghanistan, Iran, Pakistan, Russia, and Ukraine.</p>\n",
		        "fullName": "Radio Free Europe / Radio Liberty",
		        "url": "http://www.rferl.org/"
		    },
		    "voa": {
		        "description": "<p>Voice of America provides trusted and objective news and information in 45 languages to a measured weekly audience of more than 236.6 million people around the world.</p>\n",
		        "fullName": "Voice of America",
		        "url": "http://www.voanews.com"
		    },
		    "bbg": {
		        "description": "The mission of the Broadcasting Board of Governors is to inform, engage, and connect people around the world in support of freedom and democracy.",
		        "fullName": "Broadcasting Board of Governors",
		        "url": "https://www.bbg.gov"
		    }
		};
	</script>

	<style>
		.legendBox {
			width: 15px;
			height: 15px;
			display:inline-table;
			background: #000000;
		}
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
		.u--hide-medium-large {
		  display: inherit;
		}
		@media screen and (min-width: 900px) {
		  .u--hide-medium-large {
		    display: none;
		  }
		}

		.u--show-medium-large {
		  display: none;
		}
		@media screen and (min-width: 900px) {
		  .u--show-medium-large {
		    display: inherit;
		  }
		}
		/*MOVED FROM BELOW TO UPDATE FONTS*/

		button,
		[type="button"] {
		  margin-top: 0.25em;
		  margin-right: 0.25em;
		  margin-bottom: 0.25em;
		  appearance: none;
		  background-color: #0071bc;
		  border: 0;
		  border-radius: 0.15rem;
		  color: #ffffff;
		  cursor: pointer;
		  display: inline-block;
		  font-family: "Lato", "Helvetica", "Arial", sans-serif;
		  font-size: 1rem;
		  font-weight: 700;
		  line-height: 1;
		  outline: none;
		  padding: .5rem 1rem;
		  text-align: center;
		  text-decoration: none;
		  width: 100%;
		  -webkit-font-smoothing: antialiased;
		}
		@media screen and (min-width: 481px) {
		  button,
		  [type="button"] {
		    width: auto;
		  }
		}
		.entity-buttons button { 
			border-top:3px;
			border-left:3px;
			border-right:3px;
			border-bottom:0px;
			border-style: solid;
			margin-right: 0em;
		 	margin-bottom: 0em;
		 	border-radius: 0em;
		}
	</style>
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/ammap.js'></script>
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/mapdata-worldLow.js'></script>
	<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/map-hotspot.js'></script>

	
	<div class="btn-group entity-buttons u--show-medium-large" role="group" aria-label="..." style="clear: none;">
		<button type="button" title="ALL" class=" btn-default all" value="all"><span class="bbg__map__button-text">ALL</span></button><!--
		--><button type="button" title="CHINA" class=" btn-default china" value="china"><span class="bbg__map__button-text">CHINA</span></button><!--
		--><button type="button" title="CUBA" class=" btn-default cuba" value="cuba"><span class="bbg__map__button-text">CUBA</span></button><!--
		--><button type="button" title="IRAN" class=" btn-default iran" value="iran"><span class="bbg__map__button-text">IRAN</span></button><!--
		--><button type="button" title="RUSSIA" class=" btn-default russia" value="russia"><span class="bbg__map__button-text">RUSSIA</span></button><!--
		--><button type="button" title="COUNTERING VIOLENT EXTREMISM" class=" btn-default cve" value="cve"><span class="bbg__map__button-text">COUNTERING VIOLENT EXTREMISM</span></button><!--
		--></div>
	<div align="center" id="mapFilters" class="u--hide-medium-large">
		<BR>
		<select id="hotSpotPicker">
			<option value="all">All</option>
			<option value="china">China</option>
			<option value="cve">CVE</option>
			<option value="cuba">Cuba</option>
			<option value="iran">Iran</option>
			<option value="russia">Russia</option>
		</select>
	</div>


		<div id="chartdiv"></div>
	<!-- <div style="margin-top:1rem;" class="u--show-medium-large"><em>Hover over a country to highlight other countries in its primary hot spot.  Use the buttons at the top to view hot spots one at a time.</em></div><BR> -->

	<div align="left" class="u--hide-medium-large">
		<div align="center" >
			<div class="legendBox china"></div> China 
			<div class="legendBox cuba"></div> Cuba 
			<div class="legendBox iran"></div> Iran 
			<div class="legendBox russia"></div> Russia<BR>
			<div class="legendBox cve"></div> Countering Violent Extremism
		</div>
	</div>




<?php 
		$str = ob_get_clean();
	    return $str;
	}
	add_shortcode( 'hotspotmap', 'hotspotmap_func' ); 
?>

