<?php 

define( 'CAHNRSCOMMODITIESURL' , get_stylesheet_directory_uri() );
		
define( 'CAHNRSCOMMODITIESDIR' , get_stylesheet_directory() );
		
require_once CAHNRSCOMMODITIESDIR . '/classes/class-ccl-query.php';

require_once CAHNRSCOMMODITIESDIR . '/classes/class-ccl-article.php';

require_once CAHNRSCOMMODITIESDIR . '/classes/class-ccl-display.php';

require_once CAHNRSCOMMODITIESDIR . '/classes/cwp-post-public.php';

class Init_CAHNRSWP_Commodities {
	
	public function __construct(){
		
		require_once CAHNRSCOMMODITIESDIR . '/classes/class-cwpc-display.php';
		
		require_once CAHNRSCOMMODITIESDIR . '/classes/class-ccl-image-commodities.php';
		
		add_action( 'wp_enqueue_scripts', array( $this, 'cahnrswp_wp_enqueue_scripts' ), 20 );
		
		add_action( 'widgets_init' , array( $this, 'cahnrswp_widgets_init' ) );
		
		add_filter( 'excerpt_length', array( $this , 'cahnrswp_excerpt_length' ), 999 );
		
		add_filter( 'post_thumbnail_html' , array( $this , 'cwp_post_thumbnail_html' ) , 20 , 5 );
		
		add_filter( 'the_title' , array( $this, 'cwp_filter_title' ) );
		
		add_filter( 'template_include', array( $this , 'cahnrswp_template_include' ), 99 );
		
	} // end __construct
	
	public function cahnrswp_template_include( $template ){
		
		if ( ! empty( $_POST['cwp_ajax'] ) ){
			
			$template = CAHNRSCOMMODITIESDIR . '/templates/cwp-ajax.php';
			
		}
		
		return $template;
		
	}
	
	public function get_featured_categories(){
		
		$cats = array( 635, 574, 16, 17, 18, 19 , 575, 576 );
		
		return $cats;
		
	}
	
	public function cwp_filter_title( $title ){
		
		if ( is_singular( 'page' ) && is_main_query() ) {
			
			//$title .= '!';
			
		}
		
		return $title;
		
	}
		
	// @desc - Shortends default excerpt
	public function cahnrswp_excerpt_length( $lenght ) {
		
		return 25;
		
	} // end method cahnrswp_excerpt_length
	
	// @desc Adds public js and css
	public function cahnrswp_wp_enqueue_scripts() {
		
		wp_enqueue_script( 'cycle2', CAHNRSCOMMODITIESURL . '/js/cycle2.js' , array(), '2.1.6', false );
		
		wp_enqueue_script( 'public_js', CAHNRSCOMMODITIESURL . '/js/public.js' , array(), '0.0.2', false );
		
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
	
	public static function cwp_get_posts( $query, $display = 'promo' ) {
		
		
		$the_query = new WP_Query( $query );
		
		while ( $the_query->have_posts() ) {
			
			$the_query->the_post();
			
			$post_ar = Init_CAHNRSWP_Commodities::cwp_get_display_object( $display , $the_query->post );
			
			Init_CAHNRSWP_Commodities::cwp_get_display( $display , $post_ar );
			
		}; // end while
		
		wp_reset_postdata();
		
	} // end method cwp_get_posts
	
	
	public static function cwp_get_display( $display , $post_ar ) {
		
		switch( $display ){
			case 'promo':
				include CAHNRSCOMMODITIESDIR . '/inc/inc-display-promo.php';
				break;
			
		}; // end switch
		
	} // end method cwp_get_display
	
	
	public static function cwp_get_display_object( $display ,  $c_post ) {
		
		global $post;
		
		$post_ar = array();
		
		$in_loop = false;
		
		if ( isset( $post ) && $c_post->ID == $post->ID && in_the_loop() ) {
			
			$in_loop = true;
			
		} // end if
		
		$post_ar['title'] = apply_filters( 'the_title' , $c_post->post_title );
		
		$post_ar['content'] = apply_filters( 'the_content' , $c_post->post_content );
		
		$post_ar['img'] = get_the_post_thumbnail( $c_post->ID, 'thumbnail' );
		
		$post_ar['post_type'] = $c_post->post_type;
		
		if( $c_post->post_excerpt ) {
			
			$post_ar['excerpt'] = $c_post->post_excerpt;
			
		} else {
			
			$post_ar['excerpt'] = wp_trim_words( $c_post->post_content , 35 );
			
		};// end if
		
		return $post_ar;
		
	} // end method cwp_get_display_object
	
	public function cwp_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ){
		
		if ( $html && ( empty( $size ) || 'thumbnail' == $size ) ){
		
			$img = wp_get_attachment_image_src( $post_thumbnail_id, $size, $icon );
			
			$html = '<img style="width: 100%;" src="' . $img[0] . '" />';
		
		}
		
		return $html;
		
	}
	
	public function get_featured_category_query( $cat_name , $post_type = 'post' , $exclude = array() ){
		
		$query_args = array(
			'post_type' => $post_type,
			'posts_per_page' => 8,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'name',
					'terms'    => array( $cat_name , 'Featured' ),
					'operator' => 'AND',
				),
			),
		);
		
		$query = new WP_Query( $query_args );
		
		return $query;
		
	} // end method get_featured_category_query
	
	public function get_category_archive( $cat_ids = false , $query_string = 'posts_per_page=30' ){
		
		if ( empty( $cat_ids ) ){
			
			$cat_ids = $this->get_featured_categories();
			
		} // end if	
		
		foreach( $cat_ids as $cat_id ){
			
			$query = new WP_Query( $query_string . '&cat=' . $cat_id );
			
			if ( $query->have_posts() ){
			
			$html .= '<li class="ccwp-accordion"><a href="#" class="ccwp-accordion-link">';
			
			$html .= get_cat_name( $cat_id ) . ' (' . $query->found_posts . ')</a>';
			
				$html .= '<ul style="display: none;" class="ccwp-accordion-content">';
				
				while ( $query->have_posts() ){
					
					$query->the_post();
					
					$html .= '<li><a href="' . get_permalink() . '">';
					
					$html .= $query->post->post_title;
					
					
					$html .= '</a></li>';
					
				} // end while
				
				$html .= '</ul>';
			
			$html .= '</li>';
			
			} // end if
		} // end foreach
		
		return $html;
		
	}
	
}

$cahnrswp_commodities = new Init_CAHNRSWP_Commodities();