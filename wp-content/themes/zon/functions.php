<?php
/**
 * Display all zon functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'zon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zon_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'zon-featured-image', 700, 496, true );
	add_image_size( 'zon-featured-blog', 820, 480, true );
	add_image_size( 'zon-featured-slider', 1920, 1080, true );

	register_nav_menus( array(
		'top-menu' => __( 'Top Menu', 'zon' ),
		'primary' => __( 'Main Menu', 'zon' ),
		'side-nav-menu' => __( 'Side Menu', 'zon' ),
		'footermenu' => __( 'Footer Menu', 'zon' ),
		'social-link'  => __( 'Add Social Icons Only', 'zon' ),
	) );

	/* 
	* Enable support for custom logo. 
	*
	*/ 
	add_theme_support( 'custom-logo', array(
		'flex-width' => true, 
		'flex-height' => true,
	) );

	add_theme_support( 'gutenberg', array(
			'colors' => array(
				'#0c4cba',
			),
		) );
	
	add_theme_support( 'align-wide' );
	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	//Indicate widget sidebars can use selective refresh in the Customizer. 
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css', zon_fonts_url()) );

/**
 * Load WooCommerce compatibility files.
 */
	
require get_template_directory() . '/woocommerce/functions.php';


}
endif; // zon_setup
add_action( 'after_setup_theme', 'zon_setup' );

/***************************************************************************************/
function zon_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'zon_content_width' );

/***************************************************************************************/
if(!function_exists('zon_get_theme_options')):
	function zon_get_theme_options() {
	    return wp_parse_args(  get_option( 'zon_theme_options', array() ), zon_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/zon-default-values.php';
require get_template_directory() . '/inc/settings/zon-functions.php';
require get_template_directory() . '/inc/settings/zon-common-functions.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/settings/icon-functions.php';

/************************ Zon Sidebar/ Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/box-widget.php';
require get_template_directory() . '/inc/widgets/widgets-functions/box-two-layout-widget.php';
require get_template_directory() . '/inc/widgets/widgets-functions/popular-tags-comments.php';

if (!is_child_theme()){

	require get_template_directory() . '/inc/welcome-notice.php';

}

/************************ Zon Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';

function zon_customize_register( $wp_customize ) {
	if(!class_exists('Zon_Plus_Features')){
		class Zon_Customize_upgrade extends WP_Customize_Control {
			public function render_content() { ?>
				<a title="<?php esc_attr_e( 'Review Us', 'zon' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/zon/' ); ?>" target="_blank" id="about_zon">
				<?php esc_html_e( 'Review Us', 'zon' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/zon/' ); ?>" title="<?php esc_attr_e( 'Theme Instructions', 'zon' ); ?>" target="_blank" id="about_zon">
				<?php esc_html_e( 'Theme Instructions', 'zon' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://tickets.themefreesia.com/' ); ?>" title="<?php esc_attr_e( 'Support Tickets', 'zon' ); ?>" target="_blank" id="about_zon">
				<?php esc_html_e( 'Forum', 'zon' ); ?>
				</a><br/>
			<?php
			}
		}
		$wp_customize->add_section('zon_upgrade_links', array(
			'title'					=> __('Important Links', 'zon'),
			'priority'				=> 1000,
		));
		$wp_customize->add_setting( 'zon_upgrade_links', array(
			'default'				=> false,
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new Zon_Customize_upgrade(
			$wp_customize,
			'zon_upgrade_links',
				array(
					'section'				=> 'zon_upgrade_links',
					'settings'				=> 'zon_upgrade_links',
				)
			)
		);
	}	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'zon_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'zon_customize_partial_blogdescription',
		) );
	}
	
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/color-options.php' ;
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php' ;
}
if(!class_exists('Zon_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}

/* Color Styles */
require get_template_directory() . '/inc/settings/color-option-functions.php';

/** 
* Render the site title for the selective refresh partial. 
* @see zon_customize_register() 
* @return void 
*/ 
function zon_customize_partial_blogname() { 
bloginfo( 'name' ); 
} 

/** 
* Render the site tagline for the selective refresh partial. 
* @see zon_customize_register() 
* @return void 
*/ 
function zon_customize_partial_blogdescription() { 
bloginfo( 'description' ); 
}
add_action( 'customize_register', 'zon_customize_register' );
/******************* Zon Header Display *************************/
function zon_header_display(){
	$zon_settings = zon_get_theme_options();
	$header_display = $zon_settings['zon_header_display'];
$zon_header_display = $zon_settings['zon_header_display'];
if ($zon_header_display == 'header_logo' || $zon_header_display == 'header_text' || $zon_header_display == 'show_both' || is_active_sidebar( 'zon_header_banner' )) {

	echo '<div class="logo-bar"> <div class="wrap"> ';
		if ($header_display == 'header_logo' || $header_display == 'header_text' || $header_display == 'show_both')	{
			echo '<div id="site-branding">';
			if($header_display != 'header_text'){
				zon_the_custom_logo();
			}
			echo '<div id="site-detail">';
				if (is_home() || is_front_page()){ ?>
				<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
				<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
				<?php if(is_home() || is_front_page()){ ?>
				</h1>  <!-- end .site-title -->
				<?php } else { ?> </h2> <!-- end .site-title --> <?php }

				$site_description = get_bloginfo( 'description', 'display' );
				if ($site_description){?>
					<div id="site-description"> <?php bloginfo('description');?> </div> <!-- end #site-description -->
					<?php } ?>	
		<?php echo '</div></div>'; ?> <!-- end  #site-branding -->
		<?php }
			 if( is_active_sidebar( 'zon_header_banner' )){ ?>
				<div class="advertisement-box">
					<?php dynamic_sidebar( 'zon_header_banner' ); ?>
				</div> <!-- end .advertisement-box -->
			<?php }  ?>
		</div><!-- end .wrap -->
	</div><!-- end .logo-bar -->

<?php }
}
/************** Site Branding *************************************/
add_action('zon_site_branding','zon_header_display');

if ( ! function_exists( 'zon_the_custom_logo' ) ) : 
 	/** 
 	 * Displays the optional custom logo. 
 	 * Does nothing if the custom logo is not available. 
 	 */ 
 	function zon_the_custom_logo() { 
		if ( function_exists( 'the_custom_logo' ) ) { 
			the_custom_logo(); 
		}
 	} 
endif;

/************** Site Branding for sticky header and side menu sidebar *************************************/
add_action('zon_new_site_branding','zon_stite_branding_for_stickyheader_sidesidebar');

	function zon_stite_branding_for_stickyheader_sidesidebar(){ 
		$zon_settings = zon_get_theme_options(); ?>
		<div id="site-branding">
			<?php	
			$zon_header_display = $zon_settings['zon_header_display'];
			if ($zon_header_display == 'header_logo' || $zon_header_display == 'show_both') {
				zon_the_custom_logo(); 
			}

			if ($zon_header_display == 'header_text' || $zon_header_display == 'show_both') { ?>
			<div id="site-detail">
				<div id="site-title">
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
				</div>
				<!-- end #site-title -->
				<div id="site-description"><?php bloginfo('description');?></div> <!-- end #site-description -->
			</div>
				<?php } ?>
		</div> <!-- end #site-branding -->
	<?php }

/************** Front Page Features *************************************/
require get_template_directory() . '/inc/front-page/front-page-features.php';

/************** Footer Menu *************************************/
function zon_footer_menu_section(){
	if(has_nav_menu('footermenu')):
		$args = array(
			'theme_location' => 'footermenu',
			'container'      => '',
			'items_wrap'     => '<ul>%3$s</ul>',
		);
		echo '<nav id="footer-navigation" role="navigation" aria-label="' . esc_attr__('Footer Menu','zon').'">';
		wp_nav_menu($args);
		echo '</nav><!-- end #footer-navigation -->';
	endif;
}
add_action( 'zon_footer_menu', 'zon_footer_menu_section' );