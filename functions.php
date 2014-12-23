<?php 

class Init_CAHNRSWP_Commodities {
	
	public function __construct(){
		
		define( 'CAHNRSCOMMODITIESURL' , get_stylesheet_directory_uri() );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'cahnrswp_wp_enqueue_scripts' ), 20 );
		
		add_action( 'widgets_init' , array( $this, 'cahnrswp_widgets_init' ) );
		
	}
	
	public function cahnrswp_wp_enqueue_scripts() {
		
		wp_enqueue_script( 'cycle2', CAHNRSCOMMODITIESURL . '/js/cycle2.js' , array(), '2.1.6', false );
		
	}
	
	public function cahnrswp_widgets_init(){
		
		$front_center = array(
			'name'          => 'Front Page Center',
			'id'            => 'cwp-frontpage-center',
			'description'   => '',
        	'class'         => '',
			'before_widget' => '<div class="widget-wrapper" >',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' );
			
		/*$sidebar = array(
			'name'          => 'Sidebar',
			'id'            => 'cwp-sidebar-widget-area',
			'description'   => '',
        	'class'         => '',
			'before_widget' => '<div class="widget-wrapper" >',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' );*/
			
		register_sidebar( $front_center );
		
		/*register_sidebar( $sidebar );*/
		
	} // end cahnrswp_widgets_init
	
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