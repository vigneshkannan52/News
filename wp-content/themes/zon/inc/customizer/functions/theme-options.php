<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
$zon_settings = zon_get_theme_options();
/********************** ZON WordPress DEFAULT PANEL ***********************************/
$wp_customize->add_section('header_image', array(
'title' => __('Header Media', 'zon'),
'priority' => 20,
'panel' => 'zon_wordpress_default_panel'
));
$wp_customize->add_section('colors', array(
'title' => __('Colors', 'zon'),
'priority' => 30,
'panel' => 'zon_wordpress_default_panel'
));
$wp_customize->add_section('background_image', array(
'title' => __('Background Image', 'zon'),
'priority' => 40,
'panel' => 'zon_wordpress_default_panel'
));
$wp_customize->add_section('nav', array(
'title' => __('Navigation', 'zon'),
'priority' => 50,
'panel' => 'zon_wordpress_default_panel'
));
$wp_customize->add_section('static_front_page', array(
'title' => __('Static Front Page', 'zon'),
'priority' => 60,
'panel' => 'zon_wordpress_default_panel'
));
$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'zon'),
	'priority' => 10,
	'panel' => 'zon_wordpress_default_panel'
));

$wp_customize->add_section('zon_custom_header', array(
	'title' => __('Zon Options', 'zon'),
	'priority' => 503,
	'panel' => 'zon_options_panel'
));

$wp_customize->add_section( 'live_update', array(
	'title'    => __('Live Update', 'zon'),
	'priority'       => 507,
	'panel' => 'zon_options_panel'
 ));

$wp_customize->add_section( 'search_text', array(
   'title'    => __('Search Text', 'zon'),
   'priority'       => 508,
   'panel' => 'zon_options_panel'
));

$wp_customize->add_section( 'excerpt_tag_setting', array(
   'title'    => __('Excert Text/ Excerpt Length', 'zon'),
   'priority'       => 509,
   'panel' => 'zon_options_panel'
));

$wp_customize->add_section('zon_footer_image', array(
	'title' => __('Footer Background Image', 'zon'),
	'priority' => 510,
	'panel' => 'zon_options_panel'
));

/********************  ZON THEME OPTIONS ******************************************/
$wp_customize->add_setting('zon_theme_options[zon_logo_sitetitle_display]', array(
	'capability' => 'edit_theme_options',
	'default' => $zon_settings['zon_logo_sitetitle_display'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_logo_sitetitle_display]', array(
	'label' => __('Display Logo/ Site title Position', 'zon'),
	'priority' => 101,
	'section' => 'title_tagline',
	'type' => 'select',
	'checked' => 'checked',
		'choices' => array(
		'above_topbar' => __('Above Topbar (Default)','zon'),
		'below_topbar' => __('Below Topbar','zon')
	),
));

$wp_customize->add_setting('zon_theme_options[zon_header_display]', array(
	'capability' => 'edit_theme_options',
	'default' => $zon_settings['zon_header_display'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_header_display]', array(
	'label' => __('Site Logo/ Text Options', 'zon'),
	'priority' => 105,
	'section' => 'title_tagline',
	'type' => 'select',
	'checked' => 'checked',
		'choices' => array(
		'header_text' => __('Display Site Title Only','zon'),
		'header_logo' => __('Display Site Logo Only','zon'),
		'show_both' => __('Show Both','zon'),
		'disable_both' => __('Disable Both','zon'),
	),
));

/********************** Secondary Logo Image ***********************************/
$wp_customize->add_setting( 'zon_theme_options[zon_secondary_logo]',array(
	'default'	=> $zon_settings['zon_secondary_logo'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zon_theme_options[zon_secondary_logo]', array(
	'label' => __('Secondary Logo','zon'),
	'description' => __('Image will be displayed on Side menu','zon'),
	'priority'	=> 110,
	'section' => 'title_tagline',
	)
));

$wp_customize->add_setting( 'zon_theme_options[zon_secondary_logo_link]', array(
	'default'           => $zon_settings['zon_secondary_logo_link'],
	'sanitize_callback' => 'esc_url_raw',
	'type'                  => 'option',
	'capability'            => 'manage_options'
	)
 );
 $wp_customize->add_control( 'zon_theme_options[zon_secondary_logo_link]', array(
	'label' => __('Link','zon'),
	'priority'	=> 115,
	'section' => 'title_tagline',
	'type'     => 'text'
	)
 );

$wp_customize->add_setting( 'zon_theme_options[zon_logo_high_resolution]', array(
	'default' => $zon_settings['zon_logo_high_resolution'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_logo_high_resolution]', array(
	'priority'=>120,
	'label' => __('Main Logo for high resolution screen(Use 2X size image)', 'zon'),
	'section' => 'title_tagline',
	'type' => 'checkbox',
));

$wp_customize->add_setting('zon_theme_options[zon_header_design_layout]', array(
	'default' => $zon_settings['zon_header_design_layout'],
	'sanitize_callback' => 'zon_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('zon_theme_options[zon_header_design_layout]', array(
	'priority' =>125,
	'label' => __('multi Header Design Layout', 'zon'),
	'section' => 'title_tagline',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'' => __('Default','zon'),
		'top-logo-title' => __('Top/center logo & site title','zon'),
	),
));

$wp_customize->add_setting( 'zon_theme_options[zon_search_custom_header]', array(
	'default' => $zon_settings['zon_search_custom_header'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_search_custom_header]', array(
	'priority'=>20,
	'label' => __('Disable Search Form', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_side_menu]', array(
	'default' => $zon_settings['zon_side_menu'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_side_menu]', array(
	'priority'=>25,
	'label' => __('Disable Side Menu', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_stick_menu]', array(
	'default' => $zon_settings['zon_stick_menu'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_stick_menu]', array(
	'priority'=>30,
	'label' => __('Disable Stick Menu', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_scroll]', array(
	'default' => $zon_settings['zon_scroll'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_scroll]', array(
	'priority'=>40,
	'label' => __('Disable Goto Top', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_top_social_icons]', array(
	'default' => $zon_settings['zon_top_social_icons'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_top_social_icons]', array(
	'priority'=>50,
	'label' => __('Disable Top Social Icons', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_side_menu_social_icons]', array(
	'default' => $zon_settings['zon_side_menu_social_icons'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_side_menu_social_icons]', array(
	'priority'=>60,
	'label' => __('Disable Side Menu Social Icons', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_buttom_social_icons]', array(
	'default' => $zon_settings['zon_buttom_social_icons'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_buttom_social_icons]', array(
	'priority'=>70,
	'label' => __('Disable Bottom Social Icons', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_display_page_single_featured_image]', array(
	'default' => $zon_settings['zon_display_page_single_featured_image'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_display_page_single_featured_image]', array(
	'priority'=>100,
	'label' => __('Disable Page/Single Featured Image', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_disable_main_menu]', array(
	'default' => $zon_settings['zon_disable_main_menu'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_disable_main_menu]', array(
	'priority'=>120,
	'label' => __('Disable Main Menu', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_current_date]', array(
	'default' => $zon_settings['zon_current_date'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_current_date]', array(
	'priority'=>130,
	'label' => __('Disable Header Current Date', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_disable_cat_color_menu]', array(
	'default' => $zon_settings['zon_disable_cat_color_menu'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_disable_cat_color_menu]', array(
	'priority'=>140,
	'label' => __('Disable Main/side/footer Navigation category color', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_disable_homeicon]', array(
	'default' => $zon_settings['zon_disable_homeicon'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_disable_homeicon]', array(
	'priority'=>150,
	'label' => __('Disable Home Icon from Menu', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'zon_theme_options[zon_reset_all]', array(
	'default' => $zon_settings['zon_reset_all'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'zon_reset_alls',
	'transport' => 'postMessage',
));
$wp_customize->add_control( 'zon_theme_options[zon_reset_all]', array(
	'priority'=>160,
	'label' => __('Reset all default settings. (Refresh it to view the effect)', 'zon'),
	'section' => 'zon_custom_header',
	'type' => 'checkbox',
));

/******************** Live Update ******************************************/

$wp_customize->add_setting( 'zon_theme_options[zon_update_text]', array(
	'default'           => $zon_settings['zon_update_text'],
	'sanitize_callback' => 'sanitize_text_field',
	'type'                  => 'option',
	'capability'            => 'manage_options'
	)
 );
 $wp_customize->add_control( 'zon_theme_options[zon_update_text]', array(
	'label' => __('Update Text','zon'),
	'section' => 'live_update',
	'type'     => 'text'
	)
 );

 $wp_customize->add_setting( 'zon_theme_options[zon_update_link]', array(
	'default'           => $zon_settings['zon_update_link'],
	'sanitize_callback' => 'esc_url_raw',
	'type'                  => 'option',
	'capability'            => 'manage_options'
	)
 );
 $wp_customize->add_control( 'zon_theme_options[zon_update_link]', array(
	'label' => __('Update Link','zon'),
	'section' => 'live_update',
	'type'     => 'text'
	)
 );

 $wp_customize->add_setting( 'zon_theme_options[zon_open_newtab]', array(
	'default' => $zon_settings['zon_open_newtab'],
	'sanitize_callback' => 'zon_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'zon_theme_options[zon_open_newtab]', array(
	'label' => __('Open in New Tab', 'zon'),
	'section' => 'live_update',
	'type' => 'checkbox',
));

/********************Search Text ******************************************/

$wp_customize->add_setting( 'zon_theme_options[zon_search_text]', array(
   'default'           => $zon_settings['zon_search_text'],
   'sanitize_callback' => 'sanitize_text_field',
   'type'                  => 'option',
   'capability'            => 'manage_options'
   )
);
$wp_customize->add_control( 'zon_theme_options[zon_search_text]', array(
   'label' => __('Search Text','zon'),
   'section' => 'search_text',
   'type'     => 'text'
   )
);
/********************Excert Text/ Excerpt Length ******************************************/
$wp_customize->add_setting( 'zon_theme_options[zon_tag_text]', array(
   'default'           => $zon_settings['zon_tag_text'],
   'sanitize_callback' => 'sanitize_text_field',
   'type'                  => 'option',
   'capability'            => 'manage_options'
   )
);
$wp_customize->add_control( 'zon_theme_options[zon_tag_text]', array(
   'label' => __('Excerpt Text','zon'),
   'section' => 'excerpt_tag_setting',
   'type'     => 'text'
   )
);
$wp_customize->add_setting( 'zon_theme_options[zon_excerpt_length]', array(
   'default'           => $zon_settings['zon_excerpt_length'],
   'sanitize_callback' => 'zon_numeric_value',
   'type'                  => 'option',
   'capability'            => 'manage_options'
   )
);
$wp_customize->add_control( 'zon_theme_options[zon_excerpt_length]', array(
   'label' => __('Excerpt length','zon'),
   'section' => 'excerpt_tag_setting',
   'type'     => 'text'
   )
);

/********************** Footer Background Image ***********************************/
$wp_customize->add_setting( 'zon_theme_options[zon_img-upload-footer-image]',array(
	'default'	=> $zon_settings['zon_img-upload-footer-image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zon_theme_options[zon_img-upload-footer-image]', array(
	'label' => __('Footer Background Image','zon'),
	'description' => __('Image will be displayed on footer','zon'),
	'priority'	=> 50,
	'section' => 'zon_footer_image',
	)
));