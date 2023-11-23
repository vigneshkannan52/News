<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
	$zon_settings = zon_get_theme_options();
	global $zon_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'zon_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($zon_settings['zon_sidebar_layout_options'] != 'nosidebar') && ($zon_settings['zon_sidebar_layout_options'] != 'fullwidth')){ ?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Side Sidebar','zon');?>">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Side Sidebar','zon');?>">
  <?php }
	}?>
  <?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($zon_settings['zon_sidebar_layout_options'] != 'nosidebar') && ($zon_settings['zon_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'zon_main_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'zon_main_sidebar' );
			echo '</aside><!-- end #secondary -->';
		}
	}