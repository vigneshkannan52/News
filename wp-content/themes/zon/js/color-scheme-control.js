/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'zon-color-scheme' ),
		colorSchemeKeys = [
		'zon_site_page_nav_link_title_color',
		'zon_button_color',
		'zon_widget_title_color',
		'zon_popular_tag_color',
		'zon_feature_news_color',
		'zon_secondary_color',
		'zon_bbpress_woocommerce_color',
		'zon_category_slider_widget_color',
		'zon_tab_category_widget_color',
		],
		colorSettings = [
		'zon_site_page_nav_link_title_color',
		'zon_button_color',
		'zon_widget_title_color',
		'zon_popular_tag_color',
		'zon_feature_news_color',
		'zon_secondary_color',
		'zon_bbpress_woocommerce_color',
		'zon_category_slider_widget_color',
		'zon_tab_category_widget_color',
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {

					api( 'zon_site_page_nav_link_title_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_site_page_nav_link_title_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_button_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_button_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_widget_title_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_widget_title_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_popular_tag_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_popular_tag_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_feature_news_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_feature_news_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_secondary_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_secondary_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_bbpress_woocommerce_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_bbpress_woocommerce_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_category_slider_widget_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_category_slider_widget_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'zon_tab_category_widget_color' ).set( colorScheme[value].colors[3] );
					api.control( 'zon_tab_category_widget_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});
		// Add additional colors.
		colors.zon_site_page_nav_link_title_color = Color( colors.zon_site_page_nav_link_title_color ).toCSS();
		colors.zon_button_color = Color( colors.zon_button_color ).toCSS();
		colors.zon_widget_title_color = Color( colors.zon_widget_title_color ).toCSS();
		colors.zon_popular_tag_color = Color( colors.zon_popular_tag_color ).toCSS();
		colors.zon_feature_news_color = Color( colors.zon_feature_news_color ).toCSS();
		colors.zon_secondary_color = Color( colors.zon_secondary_color ).toCSS();
		colors.zon_bbpress_woocommerce_color = Color( colors.zon_bbpress_woocommerce_color ).toCSS();
		colors.zon_category_slider_widget_color = Color( colors.zon_category_slider_widget_color ).toCSS();
		colors.zon_tab_category_widget_color = Color( colors.zon_tab_category_widget_color ).toCSS();
		css = cssTemplate( colors );

		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
