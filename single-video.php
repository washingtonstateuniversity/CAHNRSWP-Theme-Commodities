<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one video-post-content<?php if( is_active_sidebar( 'video_sidebar' ) ) echo ' has_sidebar'; ?>">
	
			<?php while ( have_posts() ) : the_post(); ?>
        
                <?php get_template_part('articles/article'); ?>
            
            <?php endwhile; 
			
			if( is_active_sidebar( 'video_sidebar' ) ) : 
        
        ?><div class="video-post-sidebar">
        
        	<?php dynamic_sidebar( 'video_sidebar' ); ?>
        
        </div>
		
        <?php endif; ?>
        
	</div><!--/column-->

	<div class="column two"> 
		
		<?php get_sidebar(); ?>
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>