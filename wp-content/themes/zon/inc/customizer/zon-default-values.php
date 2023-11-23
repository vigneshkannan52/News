<?php
if(!function_exists('zon_get_option_defaults_values')):
	/******************** ZON DEFAULT OPTION VALUES ******************************************/
	function zon_get_option_defaults_values() {
		global $zon_default_values;
		$zon_default_values = array(
			'zon_responsive'	=> 'on',
			'zon_logo_sitetitle_display' => 'above_topbar',
			'zon_update_text' => esc_html__('Live Update','zon'),
			'zon_update_link' => '#',
			'zon_design_layout' => '',
			'zon_sidebar_layout_options' => 'fullwidth',
			'zon_blog_layout' => 'three_column_image_display',
			'zon_search_custom_header' => 0,
			'zon_side_menu'	=> 0,
			'zon_img-upload-footer-image' => '',
			'zon_secondary_logo' => '',
			'zon_secondary_logo_link' =>'#',
			'zon_header_display'=> 'header_text',
			'zon_scroll'	=> 0,
			'zon_tag_text' => esc_html__('View More','zon'),
			'zon_excerpt_length'	=> '25',
			'zon_reset_all' => 0,
			'zon_stick_menu'	=>0,
			'zon_logo_high_resolution'	=> 0,
			'zon_blog_post_image' => 'on',
			'zon_search_text' => esc_html__('Search &hellip;','zon'),
			'zon_blog_content_layout'	=> 'excerptblog_display',
			'zon_header_design_layout'	=> '',
			'zon_entry_meta_single' => 'show',
			'zon_entry_meta_blog' => 'show-meta',
			'zon_post_category' => 0,
			'zon_post_author' => 1,
			'zon_post_date' => 0,
			'zon_post_comments' => 0,
			'zon_footer_column_section'	=>'4',
			'zon_disable_main_menu' => 0,
			'zon_current_date'=>0,
			'zon_disable_cat_color_menu'=>0,
			'zon_disable_homeicon'=>0,
			'zon_open_newtab'=>0,
			'zon_cat_color_design'=>'round',

			/* Slider Settings */
			'zon_slider_content_bg_color' => 'off',
			'zon_slider_type'	=> 'default_slider',
			'zon_slider_design_layout'	=> 'small-slider',
			'zon_slider_link' =>0,
			'zon_enable_slider' => 'frontpage',
			'zon_default_category_slider' => '',
			'zon_small_slider_post_category' => '',
			'zon_slider_number'	=> '5',
			/* Layer Slider */
			'zon_animation_effect' => 'fade',
			'zon_slideshowSpeed' => '5',
			'zon_animationSpeed' => '7',
			'zon_display_page_single_featured_image'=>0,
			/* Front page feature */
			/* Frontpage Feature News */
			'zon_disable_feature_news'	=> 1,
			'zon_total_feature_news'	=> '6',
			'zon_feature_news_title'	=> '',
			'zon_featured_news_category' => '',
			/* Frontpage Breaking News */
			'zon_disable_breaking_news'	=> 0,
			'zon_total_breaking_news'	=> '7',
			'zon_breaking_news_title'	=> esc_html__('Breaking News','zon'),
			'zon_breaking_news_category' => '',
			/*Social Icons */
			'zon_top_social_icons' =>0,
			'zon_side_menu_social_icons' =>0,
			'zon_buttom_social_icons'	=>0,
			);
		return apply_filters( 'zon_get_option_defaults_values', $zon_default_values );
	}
endif;