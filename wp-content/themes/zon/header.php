<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$zon_settings = zon_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url','version' )); ?>">
<?php endif;
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
	if ( function_exists( 'wp_body_open' ) ) {

		wp_body_open();

	}
	$zon_settings = zon_get_theme_options(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#site-content-contain"><?php esc_html_e('Skip to content','zon');?></a>
	<!-- Masthead ============================================= -->
	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrap">
			<?php the_custom_header_markup(); ?>
			<!-- Top Header============================================= -->
			<div class="top-header">

				<?php 
				if( $zon_settings['zon_logo_sitetitle_display'] == 'above_topbar') {
					do_action('zon_site_branding');
				} ?>
				<!-- Breaking News ============================================= -->
				<?php if(is_front_page()){
					do_action ('zon_breaking_news');
				} ?>

				<!-- Top Bar ============================================= -->
				<?php if(is_active_sidebar( 'zon_header_info' ) || has_nav_menu( 'top-menu' ) || $zon_settings['zon_current_date'] ==0): ?>
					<div class="top-bar">
						<div class="wrap">
							<?php
							if( $zon_settings['zon_current_date'] ==0) { ?>
								<div class="top-bar-date">
									<span><?php echo date_i18n(__('l, F d, Y','zon')); ?></span>
								</div>
							<?php }

						 	if( is_active_sidebar( 'zon_header_info' )){
								dynamic_sidebar( 'zon_header_info' );
							}

							if(has_nav_menu ('top-menu')){ ?>
							<nav class="top-bar-menu" role="navigation" aria-label="<?php esc_attr_e('Topbar Menu','zon');?>">
								<button class="top-menu-toggle" type="button">			
									<i class="fas fa-bars"></i>
							  	</button>
								<?php
									wp_nav_menu( array(
										'container' 	=> '',
										'theme_location' => 'top-menu',
										'depth'          => 3,
										'items_wrap'      => '<ul class="top-menu">%3$s</ul>',
									) );
								?>
							</nav> <!-- end .top-bar-menu -->
							<?php }
							if( $zon_settings['zon_update_text'] != '') { ?>
							<div class="live-update">
								<a href="<?php echo esc_url($zon_settings['zon_update_link']); ?>"<?php if ($zon_settings['zon_open_newtab']==1){ ?> target="_blank"<?php } ?>><span><i class="fab fa-youtube"></i></span><span><?php echo esc_html($zon_settings['zon_update_text']); ?></span></a>
							</div>
							<!-- end .live-update -->
							<?php }
							 if($zon_settings['zon_top_social_icons'] == 0):
								echo '<div class="header-social-block">';
									do_action('zon_social_links');
								echo '</div>'.'<!-- end .header-social-block -->';
							endif;  ?>

						</div> <!-- end .wrap -->
					</div> <!-- end .top-bar -->
				<?php endif; 

				if( $zon_settings['zon_logo_sitetitle_display'] == 'below_topbar') {
					do_action('zon_site_branding');
				} ?>
				<!-- Main Header============================================= -->
				<div id="sticky-header" class="clearfix">
					<div class="wrap">
						<div class="main-header clearfix">

							<!-- Main Nav ============================================= -->
							<?php do_action ('zon_new_site_branding');
							if($zon_settings['zon_disable_main_menu']==0){ 
								if($zon_settings['zon_disable_homeicon']==0){ ?>
								<div class="home-buttom">
									<a href="<?php echo esc_url(home_url('/'));?>"><i class="fas fa-home"></i></a>
								</div>
								<?php } ?>
								<nav id="site-navigation" class="main-navigation clearfix" role="navigation" aria-label="<?php esc_attr_e('Main Menu','zon');?>">
								<?php if (has_nav_menu('primary')) {
									$args = array(
									'theme_location' => 'primary',
									'container'      => '',
									'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
									); ?>
								
									<button class="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
										<span class="line-bar"></span>
									</button><!-- end .menu-toggle -->
									<?php wp_nav_menu($args);//extract the content from apperance-> nav menu
									} else {// extract the content from page menu only ?>
									<button class="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
										<span class="line-bar"></span>
									</button><!-- end .menu-toggle -->
									<?php	wp_page_menu(array('menu_class' => 'menu', 'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>'));
									} ?>
								</nav> <!-- end #site-navigation -->
							<?php }

							$search_form = $zon_settings['zon_search_custom_header'];
							if (1 != $search_form) { ?>
							<div class="search-navigation">
								<button class="search-toggle" type="button"></button>
								<div id="header-search-box" class="header-search-nav">
									<div class="search-box">
										<?php get_search_form();?>
										<button type="button" class="header-search-x"><i class="fas fa-times"></i></button>
									</div> 
								</div>
							</div>
								<!-- end .search-navigation -->
							<?php }

							$zon_side_menu = $zon_settings['zon_side_menu'];
							if(1 != $zon_side_menu){ 
								if (has_nav_menu('side-nav-menu') || (has_nav_menu( 'social-link' ) && $zon_settings['zon_side_menu_social_icons'] == 0 ) || is_active_sidebar( 'zon_side_menu' )):?>
									<button class="show-menu-toggle" type="button">			
										<span class="sn-text"><?php esc_html_e('Menu Button','zon'); ?></span>
										<span class="bars"></span>
								  	</button>
						  	<?php endif;
						  	} ?>

						</div><!-- end .main-header -->
					</div> <!-- end .wrap -->
				</div><!-- end #sticky-header -->
			
				<?php if(1 != $zon_side_menu){
					if (has_nav_menu('side-nav-menu') || (has_nav_menu( 'social-link' ) && $zon_settings['zon_side_menu_social_icons'] == 0 ) || is_active_sidebar( 'zon_side_menu' ) || ($zon_settings['zon_secondary_logo'] !='') ): ?>
						<aside class="side-menu-wrap" role="complementary" aria-label="<?php esc_attr_e('Side Sidebar','zon');?>">
							
							<button class="hide-menu-toggle" type="button">		
								<span class="bars"></span>
							</button>
							<div class="side-menu">
								<?php if ($zon_settings['zon_secondary_logo'] !=''){ ?>
									<div class="secondary-logo">
										<a class="secondary-logo-link" href="<?php echo esc_url($zon_settings['zon_secondary_logo_link']); ?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>"><img src="<?php echo esc_url ($zon_settings['zon_secondary_logo']);?>" /></a>
									</div><!-- end .secondary-logo -->
								<?php } ?>

								<?php

								if (has_nav_menu('side-nav-menu')) { 
									$args = array(
										'theme_location' => 'side-nav-menu',
										'container'      => '',
										'items_wrap'     => '<ul class="side-menu-list">%3$s</ul>',
										); ?>
								<nav class="side-nav-wrap" role="navigation" aria-label="<?php esc_attr_e('Sidebar Menu','zon');?>">
									<?php wp_nav_menu($args); ?>
								</nav><!-- end .side-nav-wrap -->
								<?php }
								if($zon_settings['zon_side_menu_social_icons'] == 0):
									do_action('zon_social_links');
								endif;

								if( is_active_sidebar( 'zon_side_menu' )) {
									echo '<div class="side-widget-tray">';
										dynamic_sidebar( 'zon_side_menu' );
									echo '</div> <!-- end .side-widget-tray -->';
								} ?>
							</div><!-- end .side-menu -->
						</aside><!-- end .side-menu-wrap -->
					<?php endif;
				} ?>
			</div><!-- end .top-header -->
	</div><!-- end .header-wrap -->
	<!-- Main Slider ============================================= -->
	<?php
		$zon_enable_slider = $zon_settings['zon_enable_slider'];
		if ($zon_enable_slider=='frontpage'|| $zon_enable_slider=='enitresite'){
				if(is_front_page() && ($zon_enable_slider=='frontpage') ) {

				if(is_active_sidebar( 'slider_section' )){

					dynamic_sidebar( 'slider_section' );
				} else {
					if($zon_settings['zon_slider_type'] == 'default_slider') {
						zon_category_sliders();
					} else {

						if(class_exists('Zon_Plus_Features')):
							do_action('zon_image_sliders');
						endif;
					}
				}
			}
			if($zon_enable_slider=='enitresite'){

				if(is_active_sidebar( 'slider_section' )){

					dynamic_sidebar( 'slider_section' );
				} else {
					if($zon_settings['zon_slider_type'] == 'default_slider') {
							zon_category_sliders();
					} else {
						if(class_exists('Zon_Plus_Features')):
							do_action('zon_image_sliders');
						endif;
					}
				}	
			}
		} ?>
</header> <!-- end #masthead -->
<!-- Main Page Start ============================================= -->
<div id="site-content-contain" class="site-content-contain">
	<div id="content" class="site-content">
	<?php
	if(is_front_page()){

		do_action('zon_display_front_page_feature_news');

	}  ?>
	