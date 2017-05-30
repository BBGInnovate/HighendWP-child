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

	wp_enqueue_style( 'selector-css', get_template_directory_uri() . '/js/vendor/selection-sharer.css' );
	wp_enqueue_script( 'selector-script', get_stylesheet_directory_uri() . '/js/vendor/selection-sharer.js' );
	
}
add_action( 'wp_enqueue_scripts', 'highend_child_theme_enqueue_styles' );

function fb_appID() {
?><meta property="fb:app_id" content="1288914594517692" /><?php
}
add_action('wp_head', 'fb_appID', 5);

include_once("functions_maps.php");

?>
