<?php if ( is_front_page() ):?>
<div id="site-home-section">
	<div class="site-home-column">
    	<h1><?php the_title();?></h1>
        <div class="site-home-widgets">
        	<?php if ( is_active_sidebar( 'cwp-frontpage-center' ) ) {
                dynamic_sidebar( 'cwp-frontpage-center' );
			}; ?>
        </div>
    </div>
</div>
<?php get_template_part( 'inc/inc-treefruit-frontpage-footer' ) ;?>
<?php elseif( is_singular() ):?>
<?php 
global $post;

if( is_singular( array( 'page' , 'post' ) ) ){

	$featured_image = new CCL_Image_Commodities();
	
	$feature_atts = array( 'style' => 'height:325px;' , 'class' => 'unbound recto verso' );
	
	echo $featured_image->get_parallax_feature( $post->ID , $feature_atts , true );
	
};

?>
<?php endif;?>