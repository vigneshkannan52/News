<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/********************* Color Option **********************************************/
	$wp_customize->add_section( 'color_styles', array(
		'title' 						=> __('Color Options','zon'),
		'priority'					=> 10,
		'panel'					=>'colors'
	));

	$wp_customize->add_section( 'category_colors', array(
		'title' 						=> __('Category Color Options','zon'),
		'priority'					=> 20,
		'panel'					=>'colors'
	));

	$wp_customize->add_section( 'colors', array(
		'title' 						=> __('Background Color Options','zon'),
		'priority'					=> 100,
		'panel'					=>'colors'
	));

	$color_scheme = zon_get_color_scheme();
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default_color',
		'sanitize_callback' => 'zon_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Select Color Style', 'zon' ),
		'description'    => __( 'Please select any other color from dropdown to work with custom color. Changing an individual color settings will not work if default color is choosen.', 'zon' ),
		'section'  => 'color_styles',
		'type'     => 'select',
		'choices'  => zon_get_color_scheme_choices(),
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'zon_site_page_nav_link_title_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_site_page_nav_link_title_color', array(
		'description'       => __( 'Nav, links and Hover', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_button_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_button_color', array(
		'description'       => __( 'Sticky Header, Default Buttons & Submit', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_widget_title_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_widget_title_color', array(
		'description'       => __( 'Widget Title', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_popular_tag_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_popular_tag_color', array(
		'description'       => __( 'Popular/Tag/ Comment Widget', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_feature_news_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_feature_news_color', array(
		'description'       => __( 'Feature News', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_secondary_color', array(
		'default'				=> $color_scheme[3],
		'sanitize_callback'	=> 'sanitize_hex_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_secondary_color', array(
		'description'       => __( 'Secondary Color', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_bbpress_woocommerce_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_bbpress_woocommerce_color', array(
		'description'       => __( 'WooCommerce/ bbPress', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_category_slider_widget_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_category_slider_widget_color', array(
		'description'       => __( 'Category Slider Widget', 'zon' ),
		'section'     => 'color_styles',
	) ) );

	$wp_customize->add_setting( 'zon_tab_category_widget_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_tab_category_widget_color', array(
		'description'       => __( 'Tab Category widget', 'zon' ),
		'section'     => 'color_styles',
	) ) );

/********************* Category Color**********************************************/

	$zon_categories = get_terms( 'category' );
	foreach ( $zon_categories as $zon_category_list ) {
		$wp_customize->add_setting( 'zon_category_color_'.esc_html( strtolower( $zon_category_list->name ) ), array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'zon_category_color_'.esc_html( strtolower( $zon_category_list->name ) ), array(
			'priority'=>30,
			'label'       =>  esc_html( $zon_category_list->name ),
			'section'     => 'category_colors',
		) ) );
	}