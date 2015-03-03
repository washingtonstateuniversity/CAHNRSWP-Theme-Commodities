<?php global $cwp_c_category; $cwp_c_category = get_category( $cat );?>

<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    	
        <article>
	
		<?php get_template_part( 'parts/browse-options' );?>
        
        <?php get_template_part( 'parts/browse-section-featured' );?>
        
        <?php get_template_part( 'parts/browse-section-browse' );?>
        
        </article>
		
	</div><!--/column-->

	<div class="column two">
		
		<?php get_sidebar(); ?> 
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>