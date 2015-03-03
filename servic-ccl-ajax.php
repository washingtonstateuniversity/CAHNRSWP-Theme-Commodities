<?php
/*
 * version: 0.0.1
*/

class CCL_AJAX {
	
	public function get_posts(){
		
		if( have_posts() ) {
			
			
			echo 'posts found';
			
		} // end if
		
	}
	
}

$ccl_ajax = new CCL_AJAX();

$ccl_ajax->get_posts();

if ( have_posts() ){
	
	while ( have_posts() ){
		
		the_title();
		
	}
	
} else {
	echo 'true';
}

?>
<?php var_dump( $_GET );?>