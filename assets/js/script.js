jQuery( document ).on( 'ready', function($){

	jQuery( document ).on( 'click', '.site-navigation-toggle', function(){
		
		$menuToggle = jQuery(this);
		$menuToggleHolder = $menuToggle.parent('.site-navigation-toggle-holder');
		$dropdownMenu = $menuToggleHolder.siblings('.site-navigation-dropdown');
		
		var isDropdownVisible = !$menuToggleHolder.hasClass('elementor-active');
		
		$menuToggle.attr('aria-expanded', isDropdownVisible);
	    $dropdownMenu.attr('aria-hidden', !isDropdownVisible);
	   	$menuToggleHolder.toggleClass('elementor-active', isDropdownVisible);
	   	
	   	// Always close all sub active items.
	   	$dropdownMenu.find('.elementor-active').removeClass('elementor-active');
	});
	
	jQuery( document ).on( 'click', '.site-navigation-dropdown .menu-item-has-children a', function(){
		
		$anchor = jQuery(this);
		$parentLi = $anchor.parent('li');
		
		var isSubmenuVisible = $parentLi.hasClass('elementor-active');
		
		if ( !isSubmenuVisible ){
			
			// Sub menu is closed so open it.
			$parentLi.addClass('elementor-active');
			
			return false;
		}
		
		// Sub menu is open so allow std behaviour - follow link.
	})
});
