<?php 

class Init_CAHNRSWP_Commodities {
	
	public function __construct(){
		
		define( 'CAHNRSCOMMODITIESURL' , get_stylesheet_directory_uri() );
		
		define( 'CAHNRSCOMMODITIESDIR' , get_stylesheet_directory() );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'cahnrswp_wp_enqueue_scripts' ), 20 );
		
		add_action( 'widgets_init' , array( $this, 'cahnrswp_widgets_init' ) );
		
		add_filter( 'excerpt_length', array( $this , 'cahnrswp_excerpt_length' ), 999 );
		
	} // end __construct
	
	
	// @desc - Shortends default excerpt
	public function cahnrswp_excerpt_length( $lenght ) {
		
		return 25;
		
	} // end method cahnrswp_excerpt_length
	
	// @desc Adds public js and css
	public function cahnrswp_wp_enqueue_scripts() {
		
		wp_enqueue_script( 'cycle2', CAHNRSCOMMODITIESURL . '/js/cycle2.js' , array(), '2.1.6', false );
		
	} // end cahnrswp_wp_enqueue_scripts
	
	// @desc Registers custom sidebars: cwp-frontpage-center
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
			
		register_sidebar( $front_center );
		
		$video_sidebar = array(
			'name'          => 'Video Sidebar',
			'id'            => 'video_sidebar',
			'description'   => '',
        	'class'         => '',
			'before_widget' => '<div class="widget-wrapper" >',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' );
			
		register_sidebar( $video_sidebar );
		
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
		
	} // end method get_horizontal_nav_menu
}

$cahnrswp_commodities = new Init_CAHNRSWP_Commodities();