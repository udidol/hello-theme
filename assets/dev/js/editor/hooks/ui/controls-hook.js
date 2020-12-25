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
			header_layout: {
				selector: '.site-header',
				callback: ( $element, args ) => {
					$element.toggleClass( 'header-' + args.settings.header_layout );
				},
			},
		};
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
