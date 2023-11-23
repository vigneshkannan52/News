( function( api ) {

	// Extends our custom "zon" section.
	api.sectionConstructor['zon'] = api.Section.extend( {

		// No zons for this type of section.
		attachZons: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
