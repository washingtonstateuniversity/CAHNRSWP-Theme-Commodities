<?php
if ( ! empty( $post_ar['link'] ) ){
	
	
	
}; // end if

?>
<ul class="cwpc-promo<?php if ( ! empty( $post_ar['img'] ) ) echo ' has-image';?> <?php echo $post_ar['post_type'];?>">
	<?php if ( ! empty( $post_ar['img'] ) ): ?>
	<li class="cwpc-image-wrapper">
    	<?php echo $post_ar['img']; ?>
    </li>
    <?php endif;?>
    <li class="cwpc-caption">
    	<?php if ( ! empty( $post_ar['title'] ) ):?>
    	<h4>
        	<?php echo $post_ar['title'];?>
        </h4>
        <?php endif;?>
        <?php if ( ! empty( $post_ar['excerpt'] ) ):?>
    	<span class="cwpc-excerpt">
        	<?php echo $post_ar['excerpt'];?>
        </span>
        <?php endif;?>
    </li>
</ul>