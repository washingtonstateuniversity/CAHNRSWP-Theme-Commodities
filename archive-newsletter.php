<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    
    	<img src="<?php echo get_stylesheet_directory_uri();?>/images/fruit-matters-banner.jpg" style="width: 100%;display:block;" />
        
        <h1 style="margin: 0 2rem 1rem; padding: 2rem 0 1rem; border-bottom: 1px solid #555;">Fruit Matters Newsletter</h1>
        
        <div class="newsletter-promo-gallery" style="margin: 0 1rem;">
	
			<?php while ( have_posts() ) : the_post(); ?>
            
            	<?php 
					
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				
				
				?>
            
            	<div class="newsletter-promo" style="width:33.33%; float: left; margin-bottom: 1rem;">
                	
                    <div style="margin: 0 1rem;position: relative; background-image:url(<?php echo $image[0];?>);background-repeat:no-repeat;background-size:cover;background-position: center center;">
                
                		<img src="<?php echo get_stylesheet_directory_uri();?>/images/4x3spacer.gif" style="width: 100%;display:block;" />
                        
                        <div style="position: absolute; bottom: 0; width: 100%; left:0; background-color: #981e33; font-size: 0.9rem; font-weight: bold; color: #fff;">
                        	
                            <div style="margin: 0.5rem 1rem;"><?php echo $post->post_title;?><br><strong><span style="font-size: 1rem"><?php echo get_the_date( 'F, Y', $post->ID );?></span></strong></div>
                        	
                        </div>
                        
                        <a href="<?php echo get_post_permalink();?>" style="display: block;position:absolute; width: 100%; height:100%;top:0;left:0;"></a>
                    
                    </div>
        
                <?php // get_template_part('articles/article'); ?>
                
                </div>
            
            <?php endwhile; ?>
            
            <div style="clear:both"></div> 
        
        </div>
        
	</div><!--/column-->

	<div class="column two"> 
		
		<?php get_sidebar(); ?>
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>