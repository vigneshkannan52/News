<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('zon_theme_options') ) {
		set_theme_mod( 'zon_theme_options', zon_get_option_defaults_values() );
	}
/********************* ZON RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function zon_responsiveness() {
	$zon_settings = zon_get_theme_options();
	if( $zon_settings['zon_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width" />
	<?php } else { ?>
	<meta name="viewport" content="width=1170" />
	<?php  }
}
add_filter( 'wp_head', 'zon_responsiveness');

/******************************** EXCERPT LENGTH *********************************/
function zon_excerpt_length($zon_excerpt_length) {
	$zon_settings = zon_get_theme_options();
	if( is_admin() ){
		return absint($zon_excerpt_length);
	}

	$zon_excerpt_length = $zon_settings['zon_excerpt_length'];
	return absint($zon_excerpt_length);
}
add_filter('excerpt_length', 'zon_excerpt_length');

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function zon_continue_reading($more) {
	$zon_settings = zon_get_theme_options();
	$zon_tag_text = $zon_settings['zon_tag_text'];
	$link = sprintf(
		'<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),esc_html($zon_tag_text),
		/* translators: %s: Name of current post */
		sprintf( __( '<span class="screen-reader-text"> "%s"</span>', 'zon' ), get_the_title( get_the_ID() ) )
	);
	if( is_admin() ){
		return $more;
	}

	return '&hellip; ';
}
add_filter('excerpt_more', 'zon_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function zon_body_class($zon_class) {
	$zon_settings = zon_get_theme_options();
	$zon_blog_layout = $zon_settings['zon_blog_layout'];
	$zon_site_layout = $zon_settings['zon_design_layout'];
	$zon_header_design_layout = $zon_settings['zon_header_design_layout'];
	$zon_cat_color_design = $zon_settings['zon_cat_color_design'];
	if ($zon_site_layout =='boxed-layout') {
		$zon_class[] = 'boxed-layout';
	}elseif ($zon_site_layout =='small-boxed-layout') {
		$zon_class[] = 'boxed-layout-small';
	}else{
		$zon_class[] = '';
	}
	if((!is_single()) && (!is_page_template('page-templates/contact-template.php'))){
		if ($zon_blog_layout == 'medium_image_display' && !is_page_template('page-templates/zon-template.php')){
			$zon_class[] = "small-image-blog";
		}elseif($zon_blog_layout == 'three_column_image_display' && !is_page_template('page-templates/zon-template.php')){
			$zon_class[] = "three-column-blog";
		}elseif($zon_blog_layout == 'four_column_image_display' && !is_page_template('page-templates/zon-template.php')){
			$zon_class[] = "four-column-blog";
		}elseif($zon_blog_layout == 'two_column_image_display' && !is_page_template('page-templates/zon-template.php')){
			$zon_class[] = "two-column-blog";
		}elseif($zon_blog_layout == 'one_blog_display' && !is_page_template('page-templates/zon-template.php')){
			$zon_class[] = "one-column-blog";
		}else{
			$zon_class[] = "";
		}
	}

	if ( is_singular() && false !== strpos( get_queried_object()->post_content, '<!-- wp:' ) ) {
		$zon_class[] = 'gutenberg';
	}

	if(is_page_template('page-templates/zon-template.php')) {
		$zon_class[] = 'zon-corporate';

		if(!is_active_sidebar( 'zon_template_side_section' )){
			$zon_class[] = 'zon-no-sidebar';
		}
	}

	if($zon_settings['zon_slider_design_layout']=='no-slider') {
		$zon_class[] = 'n-sld';
	}elseif ($zon_settings['zon_slider_design_layout']=='small-slider'){
		$zon_class[] = 'small-sld';
	} else {
		$zon_class[] = '';
	}

	if($zon_header_design_layout == ''){
		$zon_class[] = '';
	}else{
		$zon_class[] = 'top-logo-title';
	}

	if ($zon_cat_color_design == 'round'){
		$zon_class[] = 'cat-color-1';
	} elseif($zon_cat_color_design == 'flat'){
		$zon_class[] = 'cat-color-2';
	}else{
		$zon_class[] = '';
	}
	return $zon_class;
}
add_filter('body_class', 'zon_body_class');

/********************** SCRIPTS FOR DONATE/ UPGRADE BUTTON ******************************/
function zon_customize_scripts() {
	wp_enqueue_style( 'zon_customizer_custom', get_template_directory_uri() . '/inc/css/zon-customizer.css');
}
add_action( 'customize_controls_print_scripts', 'zon_customize_scripts');

/**************************** SOCIAL MENU *********************************************/
function zon_social_links_display() {
		if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
			'link_after'     => '</span>' . zon_get_icons(array( 'icon' => 'tf-link' ) ),
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif; ?>
<?php }
add_action ('zon_social_links', 'zon_social_links_display');

/******************* DISPLAY BREADCRUMBS ******************************/
function zon_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}
/*********************** Breaking News ***********************************/
function zon_breaking_news_display(){
	global $post;
	$zon_settings = zon_get_theme_options();
	$category = $zon_settings['zon_disable_breaking_news'];
	$query = new WP_Query(array(
		'posts_per_page' =>  intval($zon_settings['zon_total_breaking_news']),
		'post_type' => array(
			'post'
		) ,
		'category_name' => esc_attr($zon_settings['zon_breaking_news_category']),
	));
	
	if($query->have_posts() && $category==0){ ?>
		<div class="breaking-news-box">
			<div class="wrap">
				<div class="breaking-news-wrap">
					<?php if( $zon_settings['zon_breaking_news_title']!=''){ ?>
					<div class="breaking-news-header">
						<h2 class="news-header-title"><?php echo esc_html($zon_settings['zon_breaking_news_title']); ?></h2>
					</div>
					<?php } ?>
					<div class="breaking-news-slider">
						<div class="marquee">
							<?php
							while ($query->have_posts()):$query->the_post(); ?>
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) { ?>
									<span class="breaking-news-img">
										<?php the_post_thumbnail(); ?>
									</span>
									<!-- end.breaking-news-img -->
								<?php } ?>
											<h4 class="breaking-news-title" title="<?php the_title_attribute(); ?>">
												<?php the_title(); ?>
											</h4>
											<!-- end.breaking-news-title -->
										</a>				
							<?php	endwhile;
							wp_reset_postdata();
		echo '</div>
			</div> <!-- end .breaking-news-slider -->
					</div>
					<!-- end .breaking-news-wrap -->
				</div>
				<!-- end .wrap -->
			</div>
			<!-- end .breaking-news-box -->';
	}

}

add_action ('zon_breaking_news', 'zon_breaking_news_display');

/*********************** zon Category SLIDERS ***********************************/
function zon_category_sliders() {
	global $post;
	$zon_settings = zon_get_theme_options();
	global $excerpt_length;
	$zon_tag_text = $zon_settings['zon_tag_text'];
	$zon_slider_design_layout = $zon_settings['zon_slider_design_layout'];
	$entry_format_meta_blog = $zon_settings['zon_entry_meta_blog'];
	$category = $zon_settings['zon_default_category_slider'];
	$zon_small_slider_post_category = $zon_settings['zon_small_slider_post_category'];
	$query = new WP_Query(array(
				'posts_per_page' =>  intval($zon_settings['zon_slider_number']),
				'post_type' => array(
					'post'
				) ,
				'category_name' => esc_attr($category),
			));

	$small_query = new WP_Query(array(
				'posts_per_page' =>  5,
				'post_type' => array(
					'post'
				) ,
				'category_name' => esc_attr($zon_small_slider_post_category),
			));
	
	if(($query->have_posts() ) ||  ($small_query->have_posts() && !empty($zon_small_slider_post_category) ) ){ ?>
	<div class="main-slider-wrap">
		<div class="main-slider clearfix">
		<?php
		if ($zon_slider_design_layout=='no-slider'){
			echo  '<div class="no-slider">';
		} elseif ($zon_slider_design_layout=='layer-slider'){
			echo  '<div class="layer-slider">';
		} elseif ($zon_slider_design_layout=='small-slider'){
		echo '<div class="small-slider">';
		} else {
			echo  '<div class="multi-slider">';
		}
		echo  '<ul class="slides">';
		while ($query->have_posts()):$query->the_post();
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'zon_slider_image');
			$excerpt = get_the_excerpt();
				echo '<li>';
				if ($image_attributes) {
					echo  '<div class="image-slider" title="'.the_title_attribute('echo=0').'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}else{
					echo  '<div class="image-slider">';
				}
				echo  '<article class="slider-content">';
				if ($image_attributes != '' || $excerpt != '') {
					echo  '<div class="slider-text-content">';

					if($entry_format_meta_blog != 'hide-meta' ){
						echo  '<div class="entry-meta">';
							do_action('zon_post_categories_list_id');
						echo '</div> <!-- end .entry-meta -->';
					}
					
					$remove_link = $zon_settings['zon_slider_link'];
						if($remove_link == 0){

								echo '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title_attribute('echo=0').'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';

						}else{
							echo '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
						}

						if ($excerpt != '') {
							echo '<p class="slider-text">'.wp_strip_all_tags( get_the_excerpt(), true ).'</p><!-- end .slider-text -->';
						}
					if($entry_format_meta_blog != 'hide-meta' ){
						echo  '<div class="entry-meta">';
						echo '<span class="author vcard"><a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" title="'.the_title_attribute('echo=0').'">' .esc_attr(get_the_author()).'</a></span>';
						printf( '<span class="posted-on"><a href="%1$s" title="%2$s">%3$s</a></span>',
											esc_url(get_the_permalink()),
											esc_attr( get_the_time(get_option( 'date_format' )) ),
											esc_html( get_the_time(get_option( 'date_format' )) )
										);

						if ( comments_open()) { ?>
								<span class="comments">
								<?php comments_popup_link( __( 'No Comments', 'zon' ), __( '1 Comment', 'zon' ), __( '% Comments', 'zon' ), '', __( 'Comments Off', 'zon' ) ); ?> </span>
						<?php }
						echo  '</div> <!-- end .entry-meta -->';
					}
					echo  '</div><!-- end .slider-text-content -->';
				}
				echo '</article><!-- end .slider-content --> ';
				echo '</div><!-- end .image-slider -->
				</li>';
			endwhile;
			wp_reset_postdata(); ?>
			</ul><!-- end .slides -->
		</div> <!-- end .layer-slider -->
		<?php if ($zon_settings['zon_slider_design_layout']=='small-slider'){ ?>
		<div class="small-sld-cat">
			<?php
			while ($small_query->have_posts()):$small_query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
					<div class="sld-cat-wrap">
						<?php if( has_post_thumbnail() ){ ?>
							<div class="sld-cat-image">
								<figure class="post-featured-image">
									<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
										<?php the_post_thumbnail('zon-featured-image'); ?>
									</a>
								</figure>
								<!-- end .post-featured-image -->
							</div>
							<!-- end .sld-cat-image -->
							<?php } ?>
							<div class="sld-cat-text">
								<header class="entry-header">		
									<h2 class="entry-title">
										 <a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute('echo=0'); ?>"> <?php the_title();?> </a>
									</h2>
									<!-- end.entry-title -->
									<?php if($entry_format_meta_blog != 'hide-meta' ){
										echo  '<div class="entry-meta">';
										echo '<span class="author vcard"><a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" title="'.the_title_attribute('echo=0').'">' .esc_html(get_the_author()).'</a></span>';
										printf( '<span class="posted-on"><a href="%1$s" title="%2$s">%3$s</a></span>',
															esc_url(get_the_permalink()),
															esc_attr( get_the_time(get_option( 'date_format' )) ),
															esc_html( get_the_time(get_option( 'date_format' )) )
														); ?>

										<?php if ( comments_open()) { ?>
												<span class="comments">
												<?php comments_popup_link( __( 'No Comments', 'zon' ), __( '1 Comment', 'zon' ), __( '% Comments', 'zon' ), '', __( 'Comments Off', 'zon' ) ); ?> </span>
										<?php }
										echo  '</div> <!-- end .entry-meta -->';
									} ?>
								</header>
								<!-- end .entry-header -->
							</div>
							<!-- end .sld-cat-text -->
						</div>
						<!-- end .sld-cat-wrap -->
					</article>
					<!-- end .post -->
			<?php  endwhile;
			wp_reset_postdata(); ?>
		</div> <!-- end .small-sld-cat-->
		<?php } ?>
	</div> <!-- end .main-slider -->
</div><!-- end .main-slider-wrap -->
<?php }
}
/*************************** Getting Cat ID dynamic ****************************************/
function zon_post_categories_list() {
	global $post;
	$zon_post_id = $post->ID;
	$zon_categories_list = get_the_category($zon_post_id); ?>
	<span class="cats-links">
		<?php if( !empty( $zon_categories_list ) ) {
				foreach ( $zon_categories_list as $category_list ) {
					$zon_category_name = $category_list->name;
					$zon_category_id = $category_list->term_id;
					$zon_category_link = get_category_link( $zon_category_id ); ?>
						<a class="cl-<?php echo esc_attr( $zon_category_id ); ?>" href="<?php echo esc_url( $zon_category_link ); ?>"><?php echo esc_html( $zon_category_name ); ?></a>
			<?php  }
			} ?>
	</span><!-- end .cat-links -->
<?php }

add_action( 'zon_post_categories_list_id', 'zon_post_categories_list' );

/*************************** Adding Category to menu ****************************************/
$zon_settings = zon_get_theme_options();
	function zon_category_nav_class( $classes, $item ){
	    if( 'category' == $item->object ){
	        $category = get_category( $item->object_id );

			if(isset($category->term_id)) {

	        	$classes[] = 'cl-' . $category->term_id;
			}
	    }
	    return $classes;
	}
	add_filter( 'nav_menu_css_class', 'zon_category_nav_class', 10, 2 );
	
		/********* Adding Multiple Fonts ********************/

		if ( ! function_exists( 'zon_fonts_url' ) ) :
			function zon_fonts_url() {
				$fonts_url = '';
				$fonts     = array();
				/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */
				if ( 'off' !== _x( 'on', 'Roboto Slab font: on or off', 'zon' ) ) {
					$fonts[] = 'Roboto Slab:wght@400;500';
				}
			
				/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
				if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'zon' ) ) {
					$fonts[] = 'Roboto:wght@400;500;700&display=swap';
				}

				if ( $fonts ) {
					$fonts_url = add_query_arg( array(
						'family' => implode( '&family=', $fonts ),
						'display' => 'swap',
					), 'https://fonts.googleapis.com/css2' );
				}
			
				return esc_url_raw($fonts_url);
			}
			endif;
/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function zon_scripts() {
	// Include the file.
	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
	$zon_settings = zon_get_theme_options();
	$zon_stick_menu = $zon_settings['zon_stick_menu'];
	wp_enqueue_script('zon-main', get_template_directory_uri().'/js/zon-main.js', array('jquery'), false, true);
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'zon-style', get_stylesheet_uri() );

	if( $zon_stick_menu != 1 ):

		wp_enqueue_script('jquery-sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
		wp_enqueue_script('zon-sticky-settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);

	endif;

	// Theme block stylesheet.
	wp_enqueue_style( 'zon-block-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_style('zon-iconstyle', get_template_directory_uri().'/assets/font-icons/css/all.min.css');
	wp_enqueue_script('jquery-marquee', get_template_directory_uri().'/assets/marquee/jquery.marquee.min.js', array('jquery'), false, true);


	wp_enqueue_script('zon-navigation', get_template_directory_uri().'/js/navigation.js', array('jquery'), false, true);
	wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false, true);
	wp_enqueue_script('zon-slider', get_template_directory_uri().'/js/flexslider-setting.js', array('jquery-flexslider'), false, true);
	wp_enqueue_script('zon-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array('jquery'), false, true);

	$zon_animation_effect   = esc_attr($zon_settings['zon_animation_effect']);
	$zon_slideshowSpeed    = absint($zon_settings['zon_slideshowSpeed'])*1000;
	$zon_animationSpeed = absint($zon_settings['zon_animationSpeed'])*100;
	wp_localize_script(
		'zon-slider',
		'zon_slider_value',
		array(
			'zon_animation_effect'   => $zon_animation_effect,
			'zon_slideshowSpeed'    => $zon_slideshowSpeed,
			'zon_animationSpeed' => $zon_animationSpeed,
		)
	);
	wp_enqueue_script( 'zon-slider' );
	if( $zon_settings['zon_responsive'] == 'on' ) {
		wp_enqueue_style('zon-responsive', get_template_directory_uri().'/css/responsive.css');
	}
	
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'zon-google-fonts', wptt_get_webfont_url(zon_fonts_url()), array(), null );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	/* Custom Css */
	$zon_internal_css='';

	if ($zon_settings['zon_logo_high_resolution'] !=0){
		$zon_internal_css .= '/* Logo for high resolution screen(Use 2X size image) */
		.custom-logo-link .custom-logo {
			height: 80px;
			width: auto;
		}

		.top-logo-title .custom-logo-link {
			display: inline-block;
		}

		.top-logo-title .custom-logo {
			height: auto;
			width: 50%;
		}

		.top-logo-title #site-detail {
			display: block;
			text-align: center;
		}

		@media only screen and (max-width: 767px) { 
			.top-logo-title .custom-logo-link .custom-logo {
				width: 60%;
			}
		}

		@media only screen and (max-width: 480px) { 
			.top-logo-title .custom-logo-link .custom-logo {
				width: 80%;
			}
		}';
	}

	if($zon_settings['zon_slider_content_bg_color'] =='on' && $zon_settings['zon_slider_design_layout'] == 'layer-slider'){
		$zon_internal_css .= '/* Slider Content With background color(For Layer Slider only) */
		.layer-slider .slider-content {
			background-color: rgba(0, 0, 0, 0.5);
			padding: 30px;
		}';
	}
	if ($zon_settings['zon_post_category'] !=0){
		$zon_internal_css .= '
			/* Hide Category */
			.entry-meta .cats-links,
			.box-layout-1 .cat-box-primary .cat-box-text .cats-links,
			.widget-cat-box-2 .post:nth-child(2) .cats-links,
			.widget-cat-box-2 .cat-box-two-primary .cats-links,
			.main-slider .no-slider .slides li:first-child .slider-text-content .cats-links {
				display: none;
				visibility: hidden;
			}';
	}
	if ($zon_settings['zon_post_author'] !=1){
		$zon_internal_css .= '
			/* Show Author */
			.entry-meta .author,
		.mb-entry-meta .author {
			float: left;
			display: block;
			visibility: visible;
		}';
	}
	if ($zon_settings['zon_post_date'] !=0){
		$zon_internal_css .= '/* Hide Date */
			.entry-meta .posted-on,
			.mb-entry-meta .posted-on {
				display: none;
				visibility: hidden;
			}';
	}
	if ($zon_settings['zon_post_comments'] !=0){
		$zon_internal_css .= '/* Hide Comments */
			.entry-meta .comments,
			.mb-entry-meta .comments {
				display: none;
				visibility: hidden;
			}';
	}
	if($zon_settings['zon_header_display']=='header_logo'){
		$zon_internal_css .= '
		#site-branding #site-title, #site-branding #site-description{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}';
	}

	wp_add_inline_style( 'zon-style', wp_strip_all_tags($zon_internal_css) );
}
add_action( 'wp_enqueue_scripts', 'zon_scripts' );

/************** Enqueue editor styles for Gutenberg *************************************/

function zon_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'zon-block-editor-style', get_theme_file_uri() . '/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'zon-google-fonts', zon_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'zon_block_editor_styles' );

/**************** Categoy Lists ***********************/

if( !function_exists( 'zon_categories_lists' ) ):
    function zon_categories_lists() {
        $zon_cat_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $zon_categories = get_categories( $zon_cat_args );
        $zon_categories_lists = array();
        $zon_categories_lists = array('' => esc_html__('--Select--','zon'));
        foreach( $zon_categories as $category ) {
            $zon_categories_lists[esc_attr( $category->slug )] = esc_html( $category->name );
        }
        return $zon_categories_lists;
    }
endif;
