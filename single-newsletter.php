<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    
    	<img src="<?php echo get_stylesheet_directory_uri();?>/images/fruit-matters-banner.jpg" style="width: 100%;display:block;margin-bottom: 2rem;" />
		
        <div id="newsletter">
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php get_template_part('articles/article'); ?>
		
		<?php endwhile; ?>
        </div>
		
	</div><!--/column-->

	<div class="column two">
		
		<?php get_sidebar(); ?>
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>