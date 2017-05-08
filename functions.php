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

	if (is_front_page()) {
		wp_enqueue_style( 'home-style',
	        get_stylesheet_directory_uri() . '/home_styles.css'
	    );
	    wp_enqueue_script('home-script', get_stylesheet_directory_uri().'/home_scripts.js');
	}
	
}
add_action( 'wp_enqueue_scripts', 'highend_child_theme_enqueue_styles' );


include_once("functions_maps.php");


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
