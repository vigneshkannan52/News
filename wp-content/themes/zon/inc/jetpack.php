<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/*********** ZON ADD THEME SUPPORT FOR INFINITE SCROLL **************************/
function zon_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'zon_jetpack_setup' );
