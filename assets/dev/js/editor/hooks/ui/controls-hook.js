export default class ControlsHook extends $e.modules.hookUI.After {

	getCommand() {
		// Command to listen.
		return 'document/elements/settings';
	}

	getId() {
		// Unique id for the hook.
		return 'hello-elementor-editor-controls-handler';
	}

	/**
	 * Get Hello Theme Controls
	 *
	 * Returns an object in which the keys are control IDs, and the values are the selectors of the elements that need
	 * to be targeted in the apply() method.
	 *
	 * Example return value:
	 *   {
	 *		hello_elementor_show_logo: '.site-header .site-header-logo',
	 *		hello_elementor_show_menu: '.site-header .site-header-menu',
	 *   }
	 */
	getHelloThemeControls() {
		return {
			header_logo_display: {
				selector: '.site-header .custom-logo-link',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			header_menu_display: {
				selector: '.site-header .menu',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			header_title_display: {
				selector: '.site-header .site-title',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			header_tagline_display: {
				selector: '.site-header .site-description',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			header_layout: {
				selector: '.site-header',
				callback: ( $element, args ) => {
					
					var class_prefix = "header-";
					var input_options = args.container.controls.header_layout.options;
					var input_value = args.settings.header_layout;

					this.toggleLayoutClass( $element, class_prefix, input_options, input_value );
				},
			},
			footer_logo_display: {
				selector: '.site-footer .custom-logo-link',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			footer_title_display: {
				selector: '.site-footer .site-title',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			footer_tagline_display: {
				selector: '.site-footer .site-description',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			footer_menu_display: {
				selector: '.site-footer .site-navigation',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			footer_copyright_display: {
				selector: '.site-footer .copyright',
				callback: ( $element, args ) => {
					$element.toggle();
				},
			},
			footer_layout: {
				selector: '.site-footer',
				callback: ( $element, args ) => {
					
					var class_prefix = "footer-";
					var input_options = args.container.controls.footer_layout.options;
					var input_value = args.settings.footer_layout;

					this.toggleLayoutClass( $element, class_prefix, input_options, input_value );
				},
			},
		};
	}

	/**
	 * Toggle layout classes on containers
	 *
	 * This will cleanly set classes onto which ever container we want to target, removing the old classes and adding the new one
	 *
	 */
	toggleLayoutClass( element, class_prefix, input_options, input_value ) {
		
		// Loop through the possible classes and remove the one that's not in use					
		Object.entries(input_options).forEach(
		    ([key, value]) => { element.removeClass( class_prefix + key ) }
		);

		// Append the class which we want to use onto the element
		if( '' != input_value ){
			element.addClass( class_prefix + input_value );
		}

	}

	/**
	 * Set the conditions under which the hook will run.
	 */
	getConditions( args ) {
		const isKit = 'kit' === elementor.documents.getCurrent().config.type,
			changedControls = Object.keys( args.settings ),
			isSingleSetting =  1 === changedControls.length;

		// If the document is not a kit, or there are no changed settings, or there is more than one single changed
		// setting, don't run the hook.
		if ( ! isKit || ! args.settings || ! isSingleSetting ) {
			return false;
		}

		// If the changed control is in the list of theme controls, return true to run the hook.
		// Otherwise, return false so the hook doesn't run.
		return !! Object.keys( this.getHelloThemeControls() ).includes( changedControls[ 0 ] );
	}

	/**
	 * The hook logic.
	 */
	apply( args, result ) {
		const allThemeControls = this.getHelloThemeControls(),
			// Extract the control ID from the passed args
			controlId = Object.keys( args.settings )[ 0 ],
			controlConfig = allThemeControls[ controlId ],
			// Find the element that needs to be targeted by the control.
			$element = elementor.$previewContents.find( controlConfig.selector );

		controlConfig.callback( $element, args );
	}
}
