<?php if ( is_front_page() ):?>
<div id="site-home-section">
	<div class="site-home-column">
    	<h1><?php the_title();?></h1>
        <h2><?php bloginfo( 'description' ); ?> </h2>
        <div class="site-home-widgets">
        	<?php if ( is_active_sidebar( 'cwp-frontpage-center' ) ) {
                dynamic_sidebar( 'cwp-frontpage-center' );
			}; ?>
            <div class="demo-gallery">
            	<img src="<?php echo CAHNRSCOMMODITIESURL ;?>/images/video-center.png" />
            </div>
        </div>
    </div>
</div>
<?php get_template_part( 'inc/inc-treefruit-frontpage-footer' ) ;?>
<?php endif;?>