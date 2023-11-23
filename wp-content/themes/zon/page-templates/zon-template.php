<?php
/**
 * Template Name: Zon Template
 *
 * Displays Magazine template.
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
get_header(); ?>
<div class="wrap">
	<?php 	if( is_active_sidebar( 'zon_primary_fullwidth' ) && class_exists('Zon_Plus_Features') ){
		echo '<div class="primary-full-width clearfix">';
			dynamic_sidebar ('zon_primary_fullwidth');
		echo '</div>';
	} ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php 
			if( is_active_sidebar( 'zon_template_section' )){
				dynamic_sidebar( 'zon_template_section' );
			}

		the_content(); ?>
		</main><!-- end #main -->
	</div> <!-- end #primary -->
	
		<?php if( is_active_sidebar( 'zon_template_side_section' )){ ?>
		<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Side Sidebar','zon');?>">
			<?php dynamic_sidebar( 'zon_template_side_section' ); ?>
		</aside> <!-- end #secondary -->
	<?php	}
	if( is_active_sidebar( 'zon_seondary_fullwidth' ) && class_exists('Zon_Plus_Features') ){
		echo '<div class="secondary-full-width clearfix">';
			dynamic_sidebar ('zon_seondary_fullwidth');
		echo '</div>';
	} ?>
	
</div><!-- end .wrap -->


<?php get_footer();