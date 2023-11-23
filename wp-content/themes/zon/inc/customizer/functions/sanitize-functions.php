<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/********************* ZON CUSTOMIZER SANITIZE FUNCTIONS *******************************/
function zon_checkbox_integer( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function zon_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

function zon_sanitize_category_select($input) {
	
	$input = sanitize_key( $input );
	return ( ( isset( $input ) && true == $input ) ? $input : '' );

}

function zon_numeric_value( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}

function zon_reset_alls( $input ) {
	if ( $input == 1 ) {
		delete_option( 'zon_theme_options');
		$input=0;
		return absint($input);
	} 
	else {
		return '';
	}
}