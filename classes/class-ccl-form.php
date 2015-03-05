<?php
/*
 * version: 0.1.4
*/

class CCL_Form_Commodities {
	
	
	public function get_select_field( $name , $current , $args ){
		
		$html = '';
		
		if ( ! empty( $args['values'] ) ){
			
			$html .= '<select name="' . $name . '" >';
			
			foreach( $args['values'] as $input_value => $input_name ){
				
				$html .= '<option value="' . $input_value . '">' . $input_name . '</option>';
				
			} // end foreach
			
			$html .= '</select>';
			
		} // end if
		
		return $html;
		
	} // end metod get_select_field
	
	public function get_hybrid_multi_select( $name , $args ){
		
		$default_args = array(
			'current_value' => null,
			'label' => '',
			'values' => array(),
			'class' => '',
			'style' => '',
			'is_radio' => '',
		);
		
		$args = $this->set_defaults( $args , $default_args );
		
		if ( $args['is_radio'] ) {
			
			$args['is_radio'] = 'is_radio ';
			
			$type = 'radio';
			
		} else {
			
			$name = $name . '[]';
			
		}// end if
		
		$html = '';
		
		if ( ! empty( $args['values'] ) ){
			
			$id = $this->get_id_from_name( $name );
			
			$html .= '<div id="' . $id . '" class="cwp-hybrid-select ' . $args['class'] . '">';
			$html .= '<div class="select-label">' . $args['label'] . '</div>';
			$html .= '<div class="' . $args['is_radio'] . 'select-options">';
				
			foreach( $args['values'] as $input_value => $input_name ){
				
				$sid = 'option_' . rand( 0, 1000000 ) . '_' . $id;
				
				$active = ( $input_value ===  $args['current_value'] ) ? ' active' : '';
				
				$style = ( $active )? ' style="display: none;"' : ''; 
				
				$html .= '<div class="' . $active . '"' . $style . '>';
				
					$html .= '<label for="' . $sid . '">' . $input_name . '</label>';
					
					$html .= '<input id="' . $sid . '" type="checkbox" ';
					
					$html .= 'name="' . $name . '" value="' . $input_value . '" ';
					
					$html .= checked( $args['current_value'] , $input_value , false )  . '/>';
					
        		$html .= '</div>';
					
			} // end foreach

			$html .= '</div>';
			
			$html .= '<script>if( typeof jQuery !== "undefined" ){
        
        var j = jQuery;
        
        j("#' . $id . '").on("click", ".select-options label" , function() { 
           var c = j( this ).parent();
           c.toggleClass("active");
            
           if ( c.parent().hasClass("is_radio") ){
              c.siblings().removeClass("active");
			  c.siblings().children("input").attr("checked", false);
           };
           if ( ! c.hasClass("active") ){
              c.slideUp("fast");
           };
        });
		
		j("#' . $id . ' .select-label").on("mouseenter" , function(){
			var o = j( this ).siblings(".select-options").children();
			o.slideDown("fast");
		});
		
		j("#' . $id . ' .select-label").on("mouseleave" , function(){
			var c = j( this );
			var t = setTimeout( function(){ 
				if ( ! c.siblings(".select-options").hasClass("active") ){ 
					c.siblings(".select-options").children(":not(.active)").slideUp("fast");
				}
			}, 50 );
		});
		
		j("#' . $id . ' .select-options").on("mouseenter" , function(){ j( this ).addClass("active");});
		
		j("#' . $id . ' .select-options").on("mouseleave" , function(){ 
			j( this ).removeClass("active");
			j( this ).children(":not(.active)").slideUp("fast");
		});
        
    };</script>';
			
			$html .= '</div>';
			
		} // end if
		
		return $html;
		
	} // end method get_hybrid_select
	
	
	
	public function get_id_from_name( $name ){
		
		$name = str_replace( '[]', '' , $name );
		
		$name = str_replace( '][', '_' , $name );
		
		$name = str_replace( '[', '-' , $name );
		
		$name = str_replace( array( '_' , ']' ), '' , $name );
		
		$name .= '_' . rand( 1 , 100000 );
		
		return $name;
		
	} // end merhod get_id_from_name
	
	
	
	public function get_input_field( $name , $current , $args = array() ){
		
		$html = '';
		
		if ( ! isset( $current ) ){
			
			$current = '';
			
		} // end if
		
		$html .= '<input';
		
		$html .= ' name="' . $name . '"';
		
		$html .= ' value="' . $current . '"';
		
		$html .= ' />';
		
		return $html;
		
	} // end metod get_select_field
	
	public function set_defaults( $current , $defaults ){
		
		foreach( $defaults as $key => $value ){
			
			if ( ! array_key_exists( $key , $current ) ){
				
				$current[ $key ] = $value;
				
			} // end if
			
		} // end foreach
		
		return $current;
		
	} // end method set_defaults
	
	public function get_post_types( $exclude = array() ){
		
		$post_types = get_post_types( array( 'exclude_from_search' => false ) , 'objects' ); 
		
		$values = array( 'any' => 'All Content');
		
		foreach( $post_types as $post_type ){
			
			if ( ! in_array( $post_type->name , $exclude ) ){
			
				$values[ $post_type->name ] = $post_type->label;
			
			} // end if
			
		} // end foreach
		
		return $values;
		
	}
	
	public function get_search_form( $default = '', $presets = array() , $is_hidden = false ){
		
		if ( empty( $presets['posts_per_page'] ) ){
			
			$presets['posts_per_page'] = 8;
			
		} // end if
		
		$style = ( $is_hidden )? 'display:none;' : '';
		
		$html = '<form id="post-search" style="' . $style . '" data-results="' . $results_count . '" class="dynamic-form dynamic-section" action="' . get_site_url() . '" >';
		
			$html .= '<fieldset class="hidden-field-set">';
			
				$html .= '<input type="hidden" name="ccwp_ajax" value="true" />';
				
				$html .= '<input type="hidden" name="posts_per_page" value=' . $results_count . ' />';
				
				$html .= '<input type="hidden" name="offset" value=0 />';
			
				foreach ( $presets as $name => $value ){
					
					$html .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
					
				} // end foreach
			
			$html .= '</fieldset>';
			
			$html .= '<fieldset class="form-fields">';
			
				$html .= '<div class="input-wrapper search-bar">';
				
					$html .= '<input type="text" class="search-field" name="s" value="" />';
					
					$html .= '<input type="submit" class="search-submit" value="Search" />';
				
				$html .= '</div>';
			
			$html .= '</fieldset>';
			
			$html .= '<div class="results-set">';
			
				$html .= $default;
			
			$html .= '</div>';
		
		$html .= '</form>';
		
		return $html;
		
	}
	
	public function get_browse_form( $default = '', $form_html = '' ,$presets = array() , $is_hidden = false ){
		
		if ( empty( $presets['posts_per_page'] ) ){
			
			$presets['posts_per_page'] = 8;
			
		} // end if
		
		$style = ( $is_hidden )? 'display:none;' : '';
		
		$html = '<form id="post-browse" style="' . $style . '" data-results="' . $results_count . '" class="dynamic-form dynamic-section" action="' . get_site_url() . '" >';
		
			$html .= '<fieldset class="hidden-field-set">';
			
				$html .= '<input type="hidden" name="ccwp_ajax" value="true" />';
				
				$html .= '<input type="hidden" name="posts_per_page" value=' . $results_count . ' />';
				
				$html .= '<input type="hidden" name="offset" value=0 />';
			
				foreach ( $presets as $name => $value ){
					
					$html .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
					
				} // end foreach
			
			$html .= '</fieldset>';
			
			$html .= '<fieldset class="form-fields">';
			
				$html .= $form_html;
			
			$html .= '</fieldset>';
			
			$html .= '<div class="results-set">';
			
				$html .= $default;
			
			$html .= '</div>';
		
		$html .= '</form>';
		
		return $html;
		
	}
	
}