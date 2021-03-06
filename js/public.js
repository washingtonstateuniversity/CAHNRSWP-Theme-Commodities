jQuery( document ).ready( function(){
	
	/*
	 * @desc - Handles submenu feature on archive pages
	*/
		
	function cwp_submenu_init(){
		
		this.submenu = jQuery( '.cwp-submenu-wrapper' ); 
		
		this.content = this.submenu.children('.cwp-submenu-articles');
		
		this.articles = this.content.children('article');
		
		var self = this;
		
		self.submenu.on( 'click', '.cwp-submenu-section a', function( event ){
			
			event.preventDefault();
			
			var par = jQuery( this ).parent();
			
			var index = par.index();
			
			self.articles.eq( index ).show().siblings().hide();
			
			par.addClass( 'active-article' ).siblings('li').removeClass( 'active-article' );
			
		}); // end on click
		
		self.content.on( 'click' , '.more-link' , function( event ){
			
			if ( typeof clb !== 'undefined' ) {
				
				event.preventDefault();
				
				clb.activate_lb( jQuery( this ) );
				
			};
			
		});
		
	}; // end cwp_submenu

	var cwp_submenu = new cwp_submenu_init(); 
	
	/*
	 * @desc - Handles tabs
	*/
	
	function cwpc_tabs_init(){
		
		jQuery( 'body' ).on( 'click' , '.commodities-tabs a' , function( event ){
			
			event.preventDefault();
			
			var par = jQuery( this ).parent();
			
			var wrap = par.parents('.cwp-tab-section');
			
			var cont = wrap.find('.cwp-tab-content');
			
			cont.eq( par.index() ).addClass( 'active-section' ).siblings().removeClass( 'active-section' );
			
			par.addClass( 'active-section' ).siblings().removeClass( 'active-section' );
			
		}); // end on click
		
	}; // end function cwpc_tabs_init
	
	var cwpc_tabs = new cwpc_tabs_init(); 
	
	jQuery( 'body' ).on( 'submit' , '.dynamic-show-more', function( event ){
		
		event.preventDefault();
		
		var form = jQuery( this );
		
		var form_data = form.serializeArray();
		
		form_data.push( { name : 'cwp_ajax' , value : true } );
		
		console.log( form_data );
		
		var g = jQuery.post( 
			form.attr("action"), 
			form_data, 
			function( data ) {
				form.before( data );
				
				var offset_input = form.find( 'input[name="offset"]');
				
				var new_count = parseInt( offset_input.val() ) + parseInt( form.data( 'count') );
				
				offset_input.val( new_count );
				
			}
		);
		
	});
	
}); // end if


jQuery('body').on( 'click' , '.browse-section a.submit' , function( event ){
		
		event.preventDefault();
		
		var form = jQuery( this ).parents("form").first();
	
		var g = jQuery.post( 
			form.attr("action"), 
			form.serializeArray(), 
			function( data ) {
				form.find('.form-results').html( data );
			}
		);
		
	});



/*
 * Accordion List
*/
jQuery(document).ready(function( $ ){
	$( 'body').on('click' , '.ccwp-accordion-link', function( event ){
		event.preventDefault();
		var c = $( this );
		var p = $( this ).parent();
		p.toggleClass( 'active');
		c.siblings('.ccwp-accordion-content').slideToggle('fast');
		p.siblings('.ccwp-accordion').children('.ccwp-accordion-content').slideUp('fast');
		p.siblings('.ccwp-accordion').removeClass('active');
	});
});

/*
 * Demo
*/ 
jQuery(document).ready(function( $ ){
	
	var banner = $( '.content-banner .content-banner-inner');
	
	$( window ).scroll( function(){
		
		var scr = $( window ).scrollTop();
		
		var b_scr = scr * 0.5;
		
		banner.css( 'top', b_scr + 'px' );
		
		
	}); // end window scroll
	
	
}); // end document ready