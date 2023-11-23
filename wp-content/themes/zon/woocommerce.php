<?php
/**
 * This template to displays woocommerce page
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

get_header();
	$zon_settings = zon_get_theme_options();
	global $zon_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'zon_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	} ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php zon_breadcrumb();
			woocommerce_content(); ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($zon_settings['zon_sidebar_layout_options'] != 'nosidebar') && ($zon_settings['zon_sidebar_layout_options'] != 'fullwidth')){ ?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Side Sidebar','zon');?>">
	<?php }
} 
	if( 'default' == $layout ) { //Settings from customizer
		if(($zon_settings['zon_sidebar_layout_options'] != 'nosidebar') && ($zon_settings['zon_sidebar_layout_options'] != 'fullwidth')): ?>
		<?php dynamic_sidebar( 'zon_woocommerce_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}
?>
</div><!-- end .wrap -->
<?php
get_footer();