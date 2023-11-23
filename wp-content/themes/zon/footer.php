<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

$zon_settings = zon_get_theme_options(); ?>
</div><!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-bg <?php if($zon_settings['zon_img-upload-footer-image'] !=''){ ?>fbg-active" style="background-image:url('<?php echo esc_url($zon_settings['zon_img-upload-footer-image']); ?>');" <?php } ?>>
	<div class="footer-bg-color"></div>
		<?php
		$footer_column = $zon_settings['zon_footer_column_section'];
			if( is_active_sidebar( 'zon_footer_1' ) || is_active_sidebar( 'zon_footer_2' ) || is_active_sidebar( 'zon_footer_3' ) || is_active_sidebar( 'zon_footer_4' )) { ?>
			<div class="widget-wrap">
				<div class="wrap">
					<div class="widget-area">
					<?php
						if($footer_column == '1' || $footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
						echo '<div class="column-'.absint($footer_column).'">';
							if ( is_active_sidebar( 'zon_footer_1' ) ) :
								dynamic_sidebar( 'zon_footer_1' );
							endif;
						echo '</div><!-- end .column'.absint($footer_column). '  -->';
						}
						if($footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
						echo '<div class="column-'.absint($footer_column).'">';
							if ( is_active_sidebar( 'zon_footer_2' ) ) :
								dynamic_sidebar( 'zon_footer_2' );
							endif;
						echo '</div><!--end .column'.absint($footer_column).'  -->';
						}
						if($footer_column == '3' || $footer_column == '4'){
						echo '<div class="column-'.absint($footer_column).'">';
							if ( is_active_sidebar( 'zon_footer_3' ) ) :
								dynamic_sidebar( 'zon_footer_3' );
							endif;
						echo '</div><!--end .column'.absint($footer_column).'  -->';
						}
						if($footer_column == '4'){
						echo '<div class="column-'.absint($footer_column).'">';
							if ( is_active_sidebar( 'zon_footer_4' ) ) :
								dynamic_sidebar( 'zon_footer_4' );
							endif;
						echo '</div><!--end .column'.absint($footer_column).  '-->';
						}
						?>
					</div> <!-- end .widget-area -->
				</div><!-- end .wrap -->
			</div> <!-- end .widget-wrap -->
			<?php } ?>
			<div class="site-info">
				<div class="wrap">
					<?php
					do_action('zon_footer_menu');
					?>
					<div class="copyright-wrap clearfix">
						<?php 
						if($zon_settings['zon_buttom_social_icons'] == 0):
							do_action('zon_social_links');
						endif;
						
						
						if ( is_active_sidebar( 'zon_footer_options' ) ) :
							dynamic_sidebar( 'zon_footer_options' );
						else:
							echo '<div class="copyright">'; ?>
							<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
											<?php esc_html_e('Designed by:','zon'); ?> <a title="<?php echo esc_attr__( 'Theme Freesia', 'zon' ); ?>" target="_blank" href="<?php echo esc_url( 'https://themefreesia.com' ); ?>"><?php esc_html_e('Theme Freesia','zon');?></a> |
											<?php date_i18n(__('Y','zon')) ; ?> <a title="<?php echo esc_attr__( 'WordPress', 'zon' );?>" target="_blank" href="<?php echo esc_url( __('https://wordpress.org','zon')  );?>"><?php esc_html_e('WordPress','zon'); ?></a>  | <?php echo '&copy; ' . esc_html__('Copyright All right reserved ','zon'); ?>
										</div>
						<?php endif; ?>
					</div> <!-- end .copyright-wrap -->
					<div style="clear:both;"></div>
				</div> <!-- end .wrap -->
			</div> <!-- end .site-info -->
			<?php
				$disable_scroll = $zon_settings['zon_scroll'];
				if($disable_scroll == 0):?>
					<button class="go-to-top" type="button">
						<span class="icon-bg"></span>
						<span class="back-to-top-text"><?php esc_html_e('Top','zon'); ?></span>
						<i class="fa fa-angle-up back-to-top-icon"></i>
					</button>
			<?php endif; ?>
			<div class="page-overlay"></div>
	</div>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>