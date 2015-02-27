<?php
/*
 * CCL_Image
 * version: 0.0.1
*/

class CCL_Image_Commodities {
	
	/*
	 * @desc - Gets parent featured image id
	 * @param int $post_id
	 * @return - Thumbnail ID or false if not set
	*/
	public function get_image_id( $post_id , $lineage = false ){
		
		$id = false;
		
		$temp_id = get_post_thumbnail_id( $post_id );
		
		if ( ! empty( $temp_id ) ){
			
			$id = $temp_id;
		
		} else if ( $lineage ) {
			
			$ancestors = get_post_ancestors( $post_id );
			
			foreach ( $ancestors as $ancestor_id ){
				
				$temp_id = get_post_thumbnail_id( $ancestor_id );
					 	
				if ( ! empty( $temp_id ) ){
					
					$id = $temp_id;
					
					break;
					
				};// end if
				
			}; // end if
			
		}; // end if
		
		return $id;
		
	} // end method get_parent_image_id
	
	
	
	public function get_thumbnail_src_from_id( $id , $size = 'thumbnail' , $icon = false  ){
		
		$url = '';
		
		$image_attributes = wp_get_attachment_image_src( $id , $size ); 
		
		if ( $image_attributes ) {
			
			$url = $image_attributes[0];
			
		}; // end if 
		
		return $url;
		
	} // end method get_thumbnail_src_from_id
	
	public function get_parallax_feature( $post_id , $attrs = array() , $lineage = false ){
		
		$html = '';
		
		$img_id = $this->get_image_id( $post_id , $lineage );
		
		if ( $img_id ){
			
			$html .= $this->get_parallax_feature_html( $img_id , $attrs );
			
		}; // end if
		
		return $html;
		
	} // end method get_parallax_feature
	
	
	public function get_parallax_feature_html( $img_id , $attrs ){
		
		$class = ( ! empty( $attrs['class'] ) ) ? $attrs['class'] : '';
		
		$style = ( ! empty( $attrs['style'] ) ) ? $attrs['style'] : '';
		
		$html = '';
		
		$img_src = $this->get_thumbnail_src_from_id( $img_id , 'large' );
		
		if ( $img_src ) {
			
			$html .= '<div class="parallax-banner-wrapper ' . $class . '" style="overflow:hidden; position: relative;' . $style . '">';
			
				$html .= '<div class="parallax-banner" style="position: absolute; width: 100%; height: 125%; bottom: 0; left: 0; background-image: url(' . $img_src . '); background-position: center center; background-size: cover;">';
				
				$html .= '</div>';
			
			$html .= '</div>';
			
			$html .='<script>jQuery(document).ready(function( $ ){ var banner = $( ".parallax-banner-wrapper .parallax-banner"); $( window ).scroll( function(){ var scr = $( window ).scrollTop(); var b_scr = scr * 0.5; banner.css( "bottom", "-" + b_scr + "px" ); });  }); </script>';
			
		}; // end if
		
		return $html;
		
	} // end method get_parallax_feature_html
	
}