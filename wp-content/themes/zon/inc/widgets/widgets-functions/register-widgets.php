<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/**************** ZON REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'zon_widgets_init');
function zon_widgets_init() {

	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'zon'),
			'id' => 'zon_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'zon'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Top Header Info', 'zon'),
			'id' => 'zon_header_info',
			'description' => __('Shows widgets on all page.', 'zon'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Header Banner', 'zon'),
			'id' => 'zon_header_banner',
			'description' => __('Shows widgets on header.', 'zon'),
			'before_widget' => '<div class="advertisement-wrap" id="%1$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Side Menu', 'zon'),
			'id' => 'zon_side_menu',
			'description' => __('Shows widgets on all page.', 'zon'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Slider Section', 'zon'),
			'id' => 'slider_section',
			'description' => __('Use any Slider Plugins and drag that slider widgets to this Slider Section.', 'zon'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Zon Template Section', 'zon'),
			'id' => 'zon_template_section',
			'description' => __('Shows widgets only on Zon Template.', 'zon'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Zon Template Sidebar Section', 'zon'),
			'id' => 'zon_template_side_section',
			'description' => __('Shows widgets only on Zon Template Sidebar.', 'zon'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

	register_sidebar(array(
			'name' => __('Iframe Code For Google Maps', 'zon'),
			'id' => 'zon_form_for_contact_page',
			'description' => __('Add Iframe Code using text widgets', 'zon'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'zon'),
			'id' => 'zon_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'zon'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	$zon_settings = zon_get_theme_options();
	for($i =1; $i<= $zon_settings['zon_footer_column_section']; $i++){
	register_sidebar(array(
			'name' => __('Footer Column ', 'zon') . $i,
			'id' => 'zon_footer_'.$i,
			'description' => __('Shows widgets at Footer Column ', 'zon').$i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
	//Register Widget.
	register_widget( 'Zon_tab_Widgets' );
	register_widget( 'Zon_category_box_Widgets' );
	register_widget( 'Zon_category_box_two_column_Widgets' );
}