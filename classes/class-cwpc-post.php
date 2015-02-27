<?php
class CWPC_Post {
	
	public function get_posts( $query, $display = 'promo' ) {
		
		$the_query = new WP_Query( $query );
		
		$display = new CWPC_Display();
		
		while ( $the_query->have_posts() ) {
			
			$the_query->the_post();
			
			$post_ar = Init_CAHNRSWP_Commodities::cwp_get_display_object( $display , $the_query->post );
			
			Init_CAHNRSWP_Commodities::cwp_get_display( $display , $post_ar );
			
		}; // end while
		
		wp_reset_postdata();
		
	} // end method get_posts
	
} // end class CWPC_Post