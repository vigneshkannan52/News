<?php

/* Photograph Plus */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	function photograph_import_files() {
  return array(
  	array(
	      'import_file_name'             => 'Photograph Free',
	      'categories'                   => array( 'Photograph Free'),
	      'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/photograph/photograph.wordpress.xml',
	      'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/photograph/photograph-widgets.wie',
	      'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/photograph/photograph-export.dat',
	      'import_notice'                => __( 'Recommended Plugins: Jetpack, Instagram Feed and Contact Form 7 Plugins  to look exactly as in our demo. <br> <br> Thanks for being part of us. If you really like our theme, Please help us <a href="https://wordpress.org/support/theme/photograph/reviews/" target="_blank" rel="nofollow">rating</a> our theme. Jetpack Plugins is to display Gallery as shown in demo. You need to activate Carousel and Tiled Galleries to display exactly as in our demo site.
	      	', 'theme-freesia-demo-import' ),
	      'import_preview_image_url'   	 => 'https://themefreesia.com/wp-content/uploads/2018/04/screenshot.jpg',
	      'preview_url'                  => 'https://demo.themefreesia.com/photograph/',
	    ),
  	array(
      'import_file_name'             => 'Wedding Photots Free',
      'categories'                   => array( 'Wedding Photots Free'),
      'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/wedding-photos/wedding-photos.wordpress.xml',
      'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/wedding-photos/wedding-photos-widgets.wie',
      'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/wedding-photos/wedding-photos-export.dat',
      'import_notice'                => __( 'Recommended Plugins: Jetpack and Contact Form 7 Plugins  to look exactly as in our demo. <br> <br> Thanks for being part of us. If you really like our theme, Please help us <a href="https://wordpress.org/support/theme/wedding-photos/reviews/" target="_blank" rel="nofollow">rating</a> our theme. Jetpack Plugins is to display Gallery as shown in demo. You need to activate Carousel and Tiled Galleries to display exactly as in our demo site.
      	', 'theme-freesia-demo-import' ),
      'import_preview_image_url'     => 'https://themefreesia.com/wp-content/uploads/2018/12/screenshot.jpg',
      'preview_url'                  => 'https://demo.themefreesia.com/wedding-photos/',
    ),
  	array(
      'import_file_name'             => 'Webart Free',
      'categories'                   => array( 'Webart Free'),
      'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/webart/webart.wordpress.xml',
      'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/webart/webart-widgets.wie',
      'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ).'../files/dummy/webart/webart-export.dat',
      'import_notice'                => __( 'Recommended Plugins: Jetpack, Instagram Feed and Contact Form 7 Plugins  to look exactly as in our demo. <br> <br> Thanks for being part of us. If you really like our theme, Please help us <a href="https://wordpress.org/support/theme/webart/reviews/" target="_blank" rel="nofollow">rating</a> our theme. Jetpack Plugins is to display Gallery as shown in demo. You need to activate Carousel and Tiled Galleries to display exactly as in our demo site.
      	', 'theme-freesia-demo-import' ),
      'import_preview_image_url'     => 'https://themefreesia.com/wp-content/uploads/2018/06/screenshot.jpg',
      'preview_url'                  => 'https://demo.themefreesia.com/webart/',
    ),

    array(
      'import_file_name'             => 'Photograph Plus',
      'categories'                   => array( 'Photograph Plus'),
      'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ).'dummy/photograph/photograph.wordpress.xml',
      'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ).'dummy/photograph/photograph-widgets.wie',
      'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ).'dummy/photograph/photograph-export.dat',
      'import_notice'                => __( 'Recommended Plugins: Jetpack, Instagram Feed and Contact Form 7 Plugins  to look exactly as in our demo. <br> <br> Thanks for being part of us. If you really like our theme, Please help us <a href="https://wordpress.org/support/theme/photograph/reviews/" target="_blank" rel="nofollow">rating</a> our theme. Jetpack Plugins is to display Gallery as shown in demo. You need to activate Carousel and Tiled Galleries to display exactly as in our demo site.
      	', 'theme-freesia-demo-import' ),
      'import_preview_image_url'     => 'https://themefreesia.com/wp-content/uploads/2018/07/screenshot.jpg',
      'preview_url'                  => 'https://demo.themefreesia.com/photograph-plus/',
    ),
  ); 
}
add_filter( 'ocdi/import_files', 'photograph_import_files' );

function photograph_after_import_setup($selected_import) {
	if ( 'Wedding Photots Free' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);

	} else {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$side_menu = get_term_by( 'name', 'Side menu', 'nav_menu' );
		$social_link = get_term_by( 'name', 'Add Social Icons Only', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
				'side-nav-menu' => $side_menu->term_id,
				'social-link' => $social_link->term_id,
			)
		);

	}
		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'ocdi/after_import', 'photograph_after_import_setup' );