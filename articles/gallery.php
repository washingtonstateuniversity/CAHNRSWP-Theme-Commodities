<?php

	$post_link = '<a href="' . get_permalink() . '" >';

	$post_link_end = '</a>';
	
	$post_image = get_the_post_thumbnail( $post->ID , 'thumbnail' );

?><div class="ctwp-gallery-item<?php if( ! empty( $post_image ) ) echo ' has-image';?> <?php echo $post->post_type;?>" >
	
    <?php if( ! empty( $post_image ) ) :?>
    
    	<div class="ctwp-image-wrapper">
        
        	<?php echo $post_link . $post_image . $post_link_end;?>
        
        </div>
    
    <?php endif;?>
    
    <h3>
    
    	<?php echo $post_link;?>
		
			<?php the_title();?>
            
        <?php echo $post_link_end;?>
    
    </h3>
    <div class="ctwp-content">
    
    	<?php echo wp_trim_words( get_the_excerpt() , 35 );?>
    
    </div>
</div>