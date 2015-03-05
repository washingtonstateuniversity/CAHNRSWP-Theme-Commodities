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
			
			var index = jQuery( this ).parent('li').index();
			
			self.articles.eq( index ).show().siblings().hide();
			
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
	
}); // end if

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

/*
 * Old Form
*/

jQuery( document ).ready( function($){
	
	$('body').on( 'click' , '#browse-options a' , function( event ){
		
		event.preventDefault();
		
		var c = $( this );
		
		c.addClass('selected').siblings().removeClass('selected'); 
		
		c.parent().siblings('.browse-section').eq( c.index() ).show().siblings('.browse-section').hide();
		
	});
	
	$('body').on( 'click' , '.browse-section a.submit' , function( event ){
		
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
	
	$('body').on( 'click' , '.browse-section a.more-link' , function( event ){
		
		event.preventDefault();
		
		var form = jQuery( this ).parents("form").first();
	
		var g = jQuery.post( 
			form.attr("action"), 
			form.serializeArray(), 
			function( data ) {
				form.find('.form-results').append( data );
			}
		);
		
	});
	
	$('body').on( 'change' , '.browse-section input, .browse-section select' , function( event ){
		
		event.preventDefault();
		
		//alert( 'fire');
		
	});
	
});

jQuery( document ).ready( function( $ ){
	
	$('body').on( 'click' , '#browse-options a' , function( event ){
		
		event.preventDefault();
		
		var c = $( this );
		
		c.addClass('selected').siblings().removeClass('selected'); 
		
		c.parent().siblings('.dynamic-section').eq( c.index() ).show().siblings('.dynamic-section').hide();
		
	});
	
	$( '#post-browse.dynamic-form' ).on( 'change' , 'input,select' , function(){
		
		$( this ).parents('form').trigger( 'submit' );
		
	});
	
	
	$( '.dynamic-form' ).on( 'submit' , function( event ){
		event.preventDefault();
		
		var form = $( this );
		
		form.find( 'input[name="offset"]' ).val( 0 );
		
		$.post( 
			form.attr("action"), 
			form.serializeArray(), 
			function( data ) {
				var results = form.find('.results-set');
				results.html( data );
				
				if ( ! form.find('.more-results').length ) {
					
					results.after( '<a href="#" class="more-results" >More Results</a>' );
					
				};
			}
		);
	});
	
	$( '.dynamic-form' ).on( 'click' , '.more-results' , function( event ){
		event.preventDefault();
		
		var form = $( this ).parents( '.dynamic-form' );
		
		get_posts_per_page( form );
		
		$.post( 
			form.attr("action"), 
			form.serializeArray(), 
			function( data ) {
				form.find('.results-set').append( data );
			}
		);
	});
	
	function get_posts_per_page( form ){
		
		var ppp = form.find( 'input[name="posts_per_page"]' ).val();
		
		var poffset = form.find( 'input[name="offset"]' ); 
		
		ppp = ( Number( poffset.val() ) + Number( ppp ) );
		
		poffset.val( ppp );
		
	};
	
});



