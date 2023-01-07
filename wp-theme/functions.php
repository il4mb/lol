<?php

add_theme_support( 'custom-logo' );

function themename_custom_logo_setup() {
	$defaults = array(
		'height'               => 65,
		'width'                => 65,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => false, 
	);
	add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

require_once __DIR__."/core/async.php";