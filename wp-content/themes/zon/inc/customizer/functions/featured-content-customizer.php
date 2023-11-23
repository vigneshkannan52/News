<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

/******************** ZON SLIDER SETTINGS ******************************************/
$zon_settings = zon_get_theme_options();
$zon_categories_lists = zon_categories_lists();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider Settings', 'zon' ),
	'priority' => 140,
	'panel' => 'zon_featuredcontent_panel'
));

$wp_customize->add_section( 'small_slider_posts', array(
	'title' => __( 'Select Category Posts for Right Side Area', 'zon' ),
	'priority' => 145,
	'panel' => 'zon_featuredcontent_panel'
));

$wp_customize->add_section( 'slider_category_content', array(
	'title' => __( 'Select Category Slider', 'zon' ),
	'priority' => 150,
	'panel' => 'zon_featuredcontent_panel'
));

$wp_customize->add_setting( 'zon_theme_options[zon_slider_design_layout]', array(
	'default' => $zon_settings['zon_slider_design_layout'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_slider_design_layout]', array(
	'priority'=>10,
	'label' => __('Slider Design Layout', 'zon'),
	'description' => __('Layer/Single option only for Boxed layout. Minumum Size:- 768x532px', 'zon'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'no-slider' => __('No Slider/ Only post','zon'),
		'layer-slider' => __('Layer/ Single Slider','zon'),
		'multi-slider' => __('Multi/ Four slider','zon'),
		'small-slider' => __('Default/ Small Slider','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_enable_slider]', array(
	'default' => $zon_settings['zon_enable_slider'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_enable_slider]', array(
	'priority'=>20,
	'label' => __('Enable Slider', 'zon'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'frontpage' => __('Front Page','zon'),
		'enitresite' => __('Entire Site','zon'),
		'disable' => __('Disable Slider','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_animation_effect]', array(
	'default' => $zon_settings['zon_animation_effect'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_animation_effect]', array(
	'priority'=>60,
	'label' => __('Animation Effect', 'zon'),
	'description' => __('This feature will not work on Multi Slider','zon'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'slide' => __('Slide','zon'),
		'fade' => __('Fade','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_slideshowSpeed]', array(
	'default' => $zon_settings['zon_slideshowSpeed'],
	'sanitize_callback' => 'zon_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_slideshowSpeed]', array(
	'priority'=>70,
	'label' => __('Set the speed of the slideshow cycling', 'zon'),
	'section' => 'featured_content',
	'type' => 'text',
));

$wp_customize->add_setting( 'zon_theme_options[zon_animationSpeed]', array(
	'default' => $zon_settings['zon_animationSpeed'],
	'sanitize_callback' => 'zon_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_animationSpeed]', array(
	'priority'=>80,
	'label' => __(' Set the speed of animations', 'zon'),
	'description' => __('This feature will not work on Animation Effect set to fade','zon'),
	'section' => 'featured_content',
	'type' => 'text',
));


/* Slider Category Section */

$wp_customize->add_setting('zon_theme_options[zon_slider_content_bg_color]', array(
	'default' =>$zon_settings['zon_slider_content_bg_color'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('zon_theme_options[zon_slider_content_bg_color]', array(
	'priority' =>8,
	'label' => __('Slider Content With background color', 'zon'),
	'description'=> __('For Layer Slider only','zon'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'on' => __('Show Background Color','zon'),
	'off' => __('Hide Background Color','zon'),
	),
));

/* Select your category to display Slider */

$wp_customize->add_setting( 'zon_theme_options[zon_default_category_slider]', array(
		'default'				=>$zon_settings['zon_default_category_slider'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'zon_sanitize_category_select',
		'type'				=> 'option'
	));
$wp_customize->add_control(
	
	'zon_theme_options[zon_default_category_slider]',
		array(
			'priority' 				=> 10,
			'label'					=> __('Select Category Slider ( By default it will display all post )','zon'),
			'description'					=> __('By default it will display all post','zon'),
			'section'				=> 'slider_category_content',
			'settings'				=> 'zon_theme_options[zon_default_category_slider]',
			'type'					=>'select',
			'choices'	=>  $zon_categories_lists 
	)
);


/* Select your category to display posts in slider section */
$wp_customize->add_setting( 'zon_theme_options[zon_small_slider_post_category]', array(
		'default'				=>$zon_settings['zon_small_slider_post_category'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'zon_sanitize_category_select',
		'type'				=> 'option'
	));
$wp_customize->add_control('zon_theme_options[zon_small_slider_post_category]',
		array(
			'priority' 				=> 10,
			'label'					=> __('Display 5 Posts in Small Slider','zon'),
			'description'					=> __('Selecting this category will only be displayed in Small Slider which is selected from Slider Design Layout','zon'),
			'section'				=> 'small_slider_posts',
			'settings'				=> 'zon_theme_options[zon_small_slider_post_category]',
			'type'					=>'select',
			'choices'	=>  $zon_categories_lists 
		)
);

	