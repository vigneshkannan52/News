<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/******************** ZON CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'zon_customize_register_wordpress_default' );
function zon_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'zon_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'WordPress Settings', 'zon' ),
		'description' => '',
	) );
}

add_action( 'customize_register', 'zon_customize_register_options');
function zon_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'zon_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options', 'zon' ),
		'description' => '',
	) );
}

add_action( 'customize_register', 'zon_customize_register_featuredcontent' );
function zon_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'zon_featuredcontent_panel', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Slider Options', 'zon' ),
		'description' => '',
	) );
}

add_action( 'customize_register', 'zon_customize_register_frontpage_options');
function zon_customize_register_frontpage_options( $wp_customize ) {
	$wp_customize->add_panel( 'zon_frontpage_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Frontpage', 'zon' ),
		'description' => '',
	) );
}

add_action( 'customize_register', 'zon_customize_register_colors' );
function zon_customize_register_colors( $wp_customize ) {
	$wp_customize->add_panel( 'colors', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Colors Section', 'zon' ),
		'description' => '',
	) );
}