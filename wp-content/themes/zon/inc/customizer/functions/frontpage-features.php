<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

/******************** ZON FRONTPAGE  *********************************************/
/* Frontpage Zon */
$zon_settings = zon_get_theme_options();
$zon_categories_lists = zon_categories_lists();
$wp_customize->add_section( 'zon_breaking_news', array(
	'title' => __('Breaking News','zon'),
	'priority' => 10,
	'panel' =>'zon_frontpage_panel'
));
$wp_customize->add_section( 'zon_frontpage_features', array(
	'title' => __('Feature News','zon'),
	'priority' => 20,
	'panel' =>'zon_frontpage_panel'
));


/* Frontpage Breaking News */

$wp_customize->add_setting( 'zon_theme_options[zon_disable_breaking_news]', array(
	'default' => $zon_settings['zon_disable_breaking_news'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_disable_breaking_news]', array(
	'priority' => 5,
	'label' => __('Disable Breaking News Section', 'zon'),
	'section' => 'zon_breaking_news',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_breaking_news_title]', array(
	'default' => $zon_settings['zon_breaking_news_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'zon_theme_options[zon_breaking_news_title]', array(
	'priority' => 10,
	'label' => __( 'Title', 'zon' ),
	'section' => 'zon_breaking_news',
	'type' => 'text',
	)
);

$wp_customize->add_setting(
	'zon_theme_options[zon_breaking_news_category]', array(
		'default'				=>$zon_settings['zon_breaking_news_category'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'zon_sanitize_category_select',
		'type'				=> 'option'
	)
);
$wp_customize->add_control( 'zon_theme_options[zon_breaking_news_category]',
		array(
			'priority' => 20,
			'label'       => __( 'Breaking News Category', 'zon' ),
			'section'     => 'zon_breaking_news',
			'settings'	  => 'zon_theme_options[zon_breaking_news_category]',
			'type'        => 'select',
			'choices'	=>  $zon_categories_lists 
		)
);


/* Frontpage Feature News */
$wp_customize->add_setting( 'zon_theme_options[zon_disable_feature_news]', array(
	'default' => $zon_settings['zon_disable_feature_news'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_disable_feature_news]', array(
	'priority' => 5,
	'label' => __('Disable Feature News Section', 'zon'),
	'section' => 'zon_frontpage_features',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_feature_news_title]', array(
	'default' => $zon_settings['zon_feature_news_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'zon_theme_options[zon_feature_news_title]', array(
	'priority' => 10,
	'label' => __( 'Title', 'zon' ),
	'section' => 'zon_frontpage_features',
	'type' => 'text',
	)
);

$wp_customize->add_setting(
	'zon_theme_options[zon_featured_news_category]', array(
		'default'				=>$zon_settings['zon_featured_news_category'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'zon_sanitize_category_select',
		'type'				=> 'option'
	)
);
$wp_customize->add_control( 'zon_theme_options[zon_featured_news_category]',
		array(
			'priority' => 20,
			'label'       => __( 'Feature News Category', 'zon' ),
			'section'     => 'zon_frontpage_features',
			'settings'	  => 'zon_theme_options[zon_featured_news_category]',
			'type'        => 'select',
			'choices'	=>  $zon_categories_lists 
		)
);