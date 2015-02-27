<?php
/*
 * version: 0.0.3
*/

class CCL_Query_Commodities {
	
	/*public function get_article_from_rest( $url , $args = array() ){
		
		$article = false;
		
		$response = wp_remote_get( $url . '?rest-ext=true' );
			
		if ( ! is_wp_error( $response  ) ){ 
				
			 $body = wp_remote_retrieve_body( $response );
			 
			 $wp_rest_item = json_decode( $body , true );
			 
			 if ( $wp_rest_item ){
				 
				$article = $this->get_rest_article( $wp_rest_item );
				 
			 } // end if
			
		} // end if
		
		return $article;
		
	}*/
	
	
	public function get_local_query( $instance ){
		
		$query = array();
		
		if ( isset( $instance['post_type'] ) ) {
			
			$query['post_type'] = $instance['post_type'];
			
		}
		
		if ( ! empty( $instance['s'] ) ){
			
			$query['s'] = $instance['s'];
			
		} // end if
		
		if ( isset( $instance['post__in'] ) ) {
			
			/*$query['post_in'][] = $instance['p'];*/
			$query['post__in'][] = $instance['post__in'];
			
			$query['order_by'][] = 'post__in';
			
		}
		
		if ( isset( $instance['tax_query'] ) && isset( $instance['tax_terms'] ) && $instance['tax_terms'] ){
			
			$query['tax_query'] = array(
				array(
					'taxonomy' => $instance['tax_query'],
					'field'    => 'name',
					'terms'    => explode( ',' , $instance['tax_terms'] ),
					),
			);
				
		}
		
		if ( isset( $instance['posts_per_page'] ) ) {
			
			if ( 'all' == $instance['posts_per_page'] ) $instance['posts_per_page'] = -1;
			
			$query['posts_per_page'] = $instance['posts_per_page'];
			
		} 
		
		return $query;
		
	} // end method get_local_query 
	
	
	
	public function get_rest_article( $wp_rest_item ){
		
		$article = array();
		
		$article['type'] = ( ! empty( $wp_rest_item['type'] ) )? $wp_rest_item['type'] : '';
				
		$article['title'] = ( ! empty( $wp_rest_item['title'] ) )? $wp_rest_item['title'] : '';
			
		$article['content'] = ( ! empty( $wp_rest_item['content'] ) )? $wp_rest_item['content'] : '';
			
		$article['excerpt'] = ( ! empty( $wp_rest_item['excerpt'] ) )? $wp_rest_item['excerpt'] : '';
		
		$article['link'] = ( ! empty( $wp_rest_item['link'] ) )? $wp_rest_item['link'] : '';
		
		$article['author'] = ( ! empty( $wp_rest_item['author']['name'] ) )? $wp_rest_item['author']['name'] : '';
		
		$article['date'] = ( ! empty( $wp_rest_item['date'] ) )? $wp_rest_item['date'] : '';
		
		if ( ! empty( $wp_rest_item['featured_image']['attachment_meta']['sizes']['thumbnail']['url'] ) ) {
			
			$article['img'] = '<img src=" '
			 			. $wp_rest_item['featured_image']['attachment_meta']['sizes']['thumbnail']['url']
						. '" />';
						
			$article['img'] = apply_filters( 'post_thumbnail_html' , $article['img'] , false, false, 'thumbnail', array() );
			
		} // end if
		
		return $article;
		
	}
	
}