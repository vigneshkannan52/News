<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
$zon_settings = zon_get_theme_options();

$wp_customize->add_section('zon_layout_options', array(
	'title' => __('Layout Options', 'zon'),
	'priority' => 102,
	'panel' => 'zon_options_panel'
));

$wp_customize->add_setting('zon_theme_options[zon_responsive]', array(
	'default' => $zon_settings['zon_responsive'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_responsive]', array(
	'priority' =>20,
	'label' => __('Responsive Layout', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'on' => __('ON ','zon'),
		'off' => __('OFF','zon'),
	),
));

$wp_customize->add_setting('zon_theme_options[zon_blog_layout]', array(
	'default' => $zon_settings['zon_blog_layout'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_blog_layout]', array(
	'priority' =>30,
	'label' => __('Blog Layout', 'zon'),
	'section'    => 'zon_layout_options',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'one_blog_display' => __('Blog with Large Image','zon'),
		'two_column_image_display' => __('Blog with Two Column','zon'),
		'three_column_image_display' => __('Blog with Three Column/ Default','zon'),
		'four_column_image_display' => __('Blog with Four Column','zon'),
		'medium_image_display' => __('Blog with Small Image','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_entry_meta_single]', array(
	'default' => $zon_settings['zon_entry_meta_single'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_entry_meta_single]', array(
	'priority'=>40,
	'label' => __('Disable Entry Meta from Single Page', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'select',
	'choices' => array(
		'show' => __('Display Entry Format','zon'),
		'hide' => __('Hide Entry Format','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_entry_meta_blog]', array(
	'default' => $zon_settings['zon_entry_meta_blog'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_entry_meta_blog]', array(
	'priority'=>50,
	'label' => __('Disable Entry Meta from Slider/ Blog/ Widgets Page', 'zon'),
	'section' => 'zon_layout_options',
	'type'	=> 'select',
	'choices' => array(
		'show-meta' => __('Display Entry Meta','zon'),
		'hide-meta' => __('Hide Entry Meta','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_post_category]', array(
	'default' => $zon_settings['zon_post_category'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_post_category]', array(
	'priority'=>55,
	'label' => __('Disable Category', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_post_author]', array(
	'default' => $zon_settings['zon_post_author'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_post_author]', array(
	'priority'=>60,
	'label' => __('Disable Author', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_post_date]', array(
	'default' => $zon_settings['zon_post_date'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_post_date]', array(
	'priority'=>65,
	'label' => __('Disable Date', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_post_comments]', array(
	'default' => $zon_settings['zon_post_comments'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_post_comments]', array(
	'priority'=>68,
	'label' => __('Disable Comments', 'zon'),
	'section' => 'zon_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting('zon_theme_options[zon_blog_content_layout]', array(
   'default'        => $zon_settings['zon_blog_content_layout'],
   'sanitize_callback' => 'zon_sanitize_select',
   'type'                  => 'option',
   'capability'            => 'manage_options'
));
$wp_customize->add_control('zon_theme_options[zon_blog_content_layout]', array(
   'priority'  =>75,
   'label'      => __('Blog Content Display', 'zon'),
   'section'    => 'zon_layout_options',
   'type'       => 'select',
   'checked'   => 'checked',
   'choices'    => array(
       'fullcontent_display' => __('Blog Full Content Display','zon'),
       'excerptblog_display' => __(' Excerpt  Display','zon'),
   ),
));

$wp_customize->add_setting('zon_theme_options[zon_design_layout]', array(
	'default'        => $zon_settings['zon_design_layout'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type'                  => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_design_layout]', array(
	'priority'  =>80,
	'label'      => __('Design Layout', 'zon'),
	'section'    => 'zon_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'' => __('Full Width Layout','zon'),
		'boxed-layout' => __('Boxed Layout','zon'),
		'small-boxed-layout' => __('Small Boxed Layout','zon'),
	),
));