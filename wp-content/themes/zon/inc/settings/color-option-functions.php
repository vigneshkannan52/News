<?php /**
 * Register color schemes for Zon.
 *
 * Can be filtered with {@see 'zon_color_schemes'}.
 *
 * The order of colors in a colors array:
 * @since Zon 1.1
 *
 * @return array An associative array of color scheme options.
 */
function zon_get_color_schemes() {
	return apply_filters( 'zon_color_schemes', array(
		'default_color' => array(
			'label'  => __( '--Default--', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#3153b2',
				'#3153b2',
				'#3153b2',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#111111',
				'#111111',
				'#111111',
			),
		),
		'yellow'  => array(
			'label'  => __( 'Yellow', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#ffae00',
				'#ffae00',
				'#ffae00',
			),
		),
		'pink'    => array(
			'label'  => __( 'Orange', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#ff8c00',
				'#ff8c00',
				'#ff8c00',
			),
		),
		'red'   => array(
			'label'  => __( 'Red', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#d4000e',
				'#d4000e',
				'#d4000e',
			),
		),
		'purple'   => array(
			'label'  => __( 'Purple', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#9651cc',
				'#9651cc',
				'#9651cc',
			),
		),
		'vanburenborwn'    => array(
			'label'  => __( 'Van Buren Brown', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#a57a6b',
				'#a57a6b',
				'#a57a6b',
			),
		),
		'green'    => array(
			'label'  => __( 'Green', 'zon' ),
			'colors' => array(
				'#3153b2',
				'#2dcc70',
				'#2dcc70',
				'#2dcc70',
			),
		),
	) );
}

if ( ! function_exists( 'zon_get_color_scheme' ) ) :
/**
 * Get the current Zon color scheme.
 *
 * @since Zon 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function zon_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );
	$color_schemes       = zon_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default_color']['colors'];
}
endif;

if ( ! function_exists( 'zon_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Zon.
 *
 * @since Zon 1.0
 *
 * @return array Array of color schemes.
 */
function zon_get_color_scheme_choices() {
	$color_schemes                = zon_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // zon_get_color_scheme_choices

if ( ! function_exists( 'zon_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Zon 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function zon_sanitize_color_scheme( $value ) {
	$color_schemes = zon_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default_color';
	}

	return $value;
}
endif; // zon_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Zon 1.0
 *
 * @see wp_add_inline_style()
 */
function zon_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default_color' );

	// Don't do anything if the default_color color scheme is selected.
	if ( 'default_color' === $color_scheme_option ) {
		return;
	}

	$color_scheme = zon_get_color_scheme();

	$colors = array(
		'zon_site_page_nav_link_title_color'        => get_theme_mod('zon_site_page_nav_link_title_color',$color_scheme[3]),
		'zon_button_color'    => get_theme_mod('zon_button_color',$color_scheme[3]),
		'zon_widget_title_color'    => get_theme_mod('zon_widget_title_color',$color_scheme[3]),
		'zon_popular_tag_color'    => get_theme_mod('zon_popular_tag_color',$color_scheme[3]),
		'zon_feature_news_color'    => get_theme_mod('zon_feature_news_color',$color_scheme[3]),
		'zon_secondary_color'    => get_theme_mod('zon_secondary_color',$color_scheme[3]),
		'zon_bbpress_woocommerce_color'        => get_theme_mod('zon_bbpress_woocommerce_color',$color_scheme[3]),
		'zon_category_slider_widget_color'        => get_theme_mod('zon_category_slider_widget_color',$color_scheme[3]),
		'zon_tab_category_widget_color'        => get_theme_mod('zon_tab_category_widget_color',$color_scheme[3]),
	);

	$color_scheme_css = zon_get_color_scheme_css( $colors );

	wp_add_inline_style( 'zon-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'zon_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Zon 1.0
 */
function zon_customize_control_js() {
	wp_enqueue_script( 'zon-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls' ), '20180501', true );
	wp_localize_script( 'zon-color-scheme-control', 'colorScheme', zon_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'zon_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Zon 1.0
 */
function zon_customize_preview_js() {
	wp_enqueue_script( 'zon-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160824', true );
}

add_action( 'customize_preview_init', 'zon_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Zon 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function zon_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'zon_site_page_nav_link_title_color'        => '#3153b2',
		'zon_button_color'    => '#3153b2',
		'zon_widget_title_color'    => '#3153b2',
		'zon_popular_tag_color'    => '#3153b2',
		'zon_feature_news_color'    => '#3153b2',
		'zon_secondary_color'    => '#3153b2',
		'zon_bbpress_woocommerce_color'        => '#3153b2',
		'zon_category_slider_widget_color'        => '#3153b2',
		'zon_tab_category_widget_color'        => '#3153b2',
		
	) );
	$css = <<<CSS
	/****************************************************************/
						/*.... Color Style ....*/
	/****************************************************************/
	/* Nav, links and hover */

a,
ul li a:hover,
ol li a:hover,
.top-bar .top-bar-menu a:hover,
.top-bar .top-bar-menu a:focus,
.main-navigation li li.menu-item-has-children > a:hover:after, /* Navigation */
.main-navigation li li.page_item_has_children > a:hover:after,
.main-navigation ul li ul li a:hover,
.main-navigation ul li ul li a:focus,
.main-navigation ul li ul li:hover > a,
.main-navigation ul li.current-menu-item ul li a:hover,
.side-menu-wrap .side-nav-wrap a:hover, /* Side Menu */
.side-menu-wrap .side-nav-wrap a:focus,
.side-nav-wrap li.menu-item-object-category[class*="cl-"] a:hover,
.side-nav-wrap li.menu-item-object-category[class*="cl-"] a:focus,
.entry-title a:hover, /* Post */
.entry-title a:focus,
.entry-title a:active,
.entry-meta a:hover,
a.more-link,
.widget ul li a:hover, /* Widgets */
.widget ul li a:focus,
.widget-title a:hover,
.site-info .copyright a:hover, /* Footer */
.site-info .copyright a:focus,
#colophon .widget ul li a:hover,
#colophon .widget ul li a:focus,
#footer-navigation .menu-item:not([class*="cl-"]) a:hover,
#footer-navigation .menu-item:not([class*="cl-"]) a:focus,
#footer-navigation li.menu-item-object-category[class*="cl-"] a:hover,
#footer-navigation li.menu-item-object-category[class*="cl-"] a:focus,
#footer-navigation a:hover,
#footer-navigation a:focus {
	color: {$colors['zon_site_page_nav_link_title_color']};
}

/* Webkit */
::selection {
	background: {$colors['zon_site_page_nav_link_title_color']};
	color: #fff;
}

/* Gecko/Mozilla */
::-moz-selection {
	background: {$colors['zon_site_page_nav_link_title_color']};
	color: #fff;
}

/* Accessibility
================================================== */
.screen-reader-text:hover,
.screen-reader-text:active,
.screen-reader-text:focus {
	background-color: #f1f1f1;
	color: {$colors['zon_site_page_nav_link_title_color']};
}

/* Sticky Header, Default Buttons & Submit
================================================== */
input[type="reset"],/* Forms  */
input[type="button"],
input[type="submit"],
.main-slider .flex-control-nav a.flex-active,
.main-slider .flex-control-nav a:hover,
.go-to-top .icon-bg,
.search-submit,
.btn-default,
.widget_tag_cloud a,
#sticky-header {
	background-color: {$colors['zon_button_color']};
}

/* Widget Title
================================================== */
.widget-title span {
	background-color: {$colors['zon_widget_title_color']};
}

.widget-title span:after {
	background: -webkit-linear-gradient(to right, {$colors['zon_widget_title_color']}, transparent);
	background: linear-gradient(to right, {$colors['zon_widget_title_color']}, transparent);
}

/* Feature News
================================================== */
.feature-news-wrap,
.feature-news-title {
	border-color: {$colors['zon_feature_news_color']};
}

.feature-news-title:after {
	border-top-color: {$colors['zon_feature_news_color']};
}

.feature-news-slider .flex-direction-nav li a {
	background-color: {$colors['zon_feature_news_color']};
	border-color: {$colors['zon_feature_news_color']};
}

/* Popular, Comment & Tag Widget
================================================== */
.tab-menu button:hover,
.tab-menu button.active,
.mb-tag-cloud .mb-tags a {
	background-color: {$colors['zon_popular_tag_color']};
}

/* Secondary color
================================================== */
.widget-title .more-btn,
.home-buttom,
.breaking-news-header,
.news-header-title:after {
	background-color: {$colors['zon_secondary_color']};
}

/* Header and bbpress
================================================== */
#bbpress-forums .bbp-topics a:hover {
	color: {$colors['zon_bbpress_woocommerce_color']};
}

.bbp-submit-wrapper button.submit {
	background-color: {$colors['zon_bbpress_woocommerce_color']};
	border: 1px solid {$colors['zon_bbpress_woocommerce_color']};
}

/* Woocommerce
================================================== */
.woocommerce #respond input#submit,
.woocommerce a.button, 
.woocommerce button.button, 
.woocommerce input.button,
.woocommerce #respond input#submit.alt, 
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt,
.woocommerce-demo-store p.demo_store {
	background-color: {$colors['zon_bbpress_woocommerce_color']};
}

.woocommerce .woocommerce-message:before {
	color: {$colors['zon_bbpress_woocommerce_color']};
}

/* Category Slider widget */
.cat-slider .flex-direction-nav li a:hover {
	background-color: {$colors['zon_category_slider_widget_color']};
}

/* Tab Category widget */
.cat-tab-menu li:hover:after,
.cat-tab-menu li.active:after {
	background: -webkit-linear-gradient(to right, transparent, {$colors['zon_tab_category_widget_color']}, transparent);
	background: linear-gradient(to right, transparent, {$colors['zon_tab_category_widget_color']}, transparent);
}
.cat-tab-menu li:hover,
.cat-tab-menu li.active {
	color: {$colors['zon_tab_category_widget_color']} !important;
}


CSS;

	return $css;
}
function zon_color_scheme_css_template() {
	$colors = array(

		// Color Styles
		'zon_site_page_nav_link_title_color'        => '{{ data.zon_site_page_nav_link_title_color }}',
		'zon_button_color'    => '{{ data.zon_button_color }}',
		'zon_widget_title_color'    => '{{ data.zon_widget_title_color }}',
		'zon_popular_tag_color'    => '{{ data.zon_popular_tag_color }}',
		'zon_feature_news_color'    => '{{ data.zon_feature_news_color }}',
		'zon_secondary_color'    => '{{ data.zon_secondary_color }}',
		'zon_bbpress_woocommerce_color'        => '{{ data.zon_bbpress_woocommerce_color }}',
		'zon_category_slider_widget_color'        => '{{ data.zon_category_slider_widget_color }}',
		'zon_tab_category_widget_color'        => '{{ data.zon_tab_category_widget_color }}',
	);
	?>
	<script type="text/html" id="tmpl-zon-color-scheme">
		<?php echo zon_get_color_scheme_css( $colors ); ?>
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'zon_color_scheme_css_template' );

/************** Category Color **************************************/
function zon_category_colors( $zon_category_id){
	$zon_settings = zon_get_theme_options();
	$zon_categories = get_terms( 'category' );
	$zon_category_list = array();
	$output_css='';
	foreach ( $zon_categories as $category_list) {
		 $zon_category_list = get_theme_mod('zon_category_color_'.esc_html( strtolower( $category_list->name ) ) );
		 $zon_cat_id = esc_attr( $category_list->term_id );
		 ?>
		 <?php if( $zon_category_list != '' && $zon_category_list != '#ffffff'){

			 	$output_css .= '.cats-links .cl-'.$zon_cat_id.'{

					color:'.esc_attr($zon_category_list).';'.'

				}
				.cat-color-1 .cats-links .cl-'.$zon_cat_id.':before,
				.cat-color-1 .cats-links .cl-'.$zon_cat_id.':after {
					background: '.esc_attr($zon_category_list).';'.'
				}
				/*For Main menu and Tab Category filter*/
				
				.menu-item-object-category.cl-'.$zon_cat_id. ' a, .widget-tab-cat-box .cat-tab-menu .cl-'.$zon_cat_id. '{
					color:'.esc_attr($zon_category_list).';'.'

				}';
			}
	}

	
		if($zon_settings['zon_disable_cat_color_menu'] ==1){
			$output_css .= '
			/* Disable Main/side/footer Navigation category color:  */

			.main-navigation > ul > li.menu-item-object-category[class*="cl-"] a {
				color: #fff;
			}

			.side-nav-wrap li.menu-item-object-category[class*="cl-"] a {
				color: #222;
			}

			#footer-navigation li.menu-item-object-category[class*="cl-"] a {
				color: #a4a4a4;
			}';
			}
wp_add_inline_style( 'zon-style', $output_css );
}
add_action( 'wp_enqueue_scripts', 'zon_category_colors', 100 );

