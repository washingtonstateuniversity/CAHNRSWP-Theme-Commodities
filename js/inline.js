// JavaScript Document


/*
* articles/article.php
*/
( function( document, window ) {
					
	window.tf_icons = function(){
		
		jQuery( document ).ready( function(){
			
			jQuery( '.section-icon' ).each( function(){
				
				var c = jQuery( this );
				
				var c_class = c.data( 'class' );
				
				var s_cont = jQuery( '.' + c_class ).first();
				
				if( s_cont.length > 0 ){
					
					c.addClass( 'active');
					
					c.on( 'click' , function( event ){
						
						jQuery( 'html' ).animate({ scrollTop: s_cont.offset().top }, 500 , function(){
							
							if ( s_cont.hasClass( 'ccl-article-accordion' ) ){
								
								event.preventDefault();
								
								s_cont.children( '.ccl-title' ).trigger( 'click');
								
							}
							
						});
						
						jQuery( 'body' ).animate({ scrollTop: s_cont.offset().top }, 500 );
						
					});
				}
				
			});
			
		});
		
	}
	
	var tree_fruit_icons = new tf_icons();
	
})( document, window );