<?php 

class Init_CAHNRSWP_Commodities {
	
	public function __construct(){
		
		define( 'CAHNRSCOMMODITIESURL' , get_stylesheet_directory_uri() );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'cahnrswp_wp_enqueue_scripts' ), 20 );
		
	}
	
	public function cahnrswp_wp_enqueue_scripts() {
		
		wp_enqueue_script( 'cycle2', CAHNRSCOMMODITIESURL . '/js/cycle2.js' , array(), '2.1.6', false );
		
	}
	
	/**
	 * @desc Gets the horizontal navigation menu for the site
	*/
	public function get_horizontal_nav_menu(){
		
		if ( has_nav_menu( 'site' ) ) {
			
			wp_nav_menu( 
				array( 
					'theme_location' => 'site',
					'container'      => '',
					'before' => '/', 
					) 
				);
			
		}; // end if
		
	}
	
}

$cahnrswp_commodities = new Init_CAHNRSWP_Commodities();