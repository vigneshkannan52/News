<?php
/**
 * Displays the searchform
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
?>
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$zon_settings = zon_get_theme_options();
		$zon_search_form = $zon_settings['zon_search_text'];?>
		<label class="screen-reader-text"><?php echo esc_html($zon_search_form);?></label>
		<input type="search" name="s" class="search-field" placeholder="<?php echo esc_attr($zon_search_form); ?>" autocomplete="off" />
		<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form> <!-- end .search-form -->