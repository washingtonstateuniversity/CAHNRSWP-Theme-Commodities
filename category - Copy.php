<?php global $cwp_c_category; $cwp_c_category = get_category( $cat );?>

<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    	
        <article>
	
			<?php get_template_part( 'parts/category-header' ); ?>
        
            <div class="category-sections">
            
				<?php
                $c_section = ( ! empty( $_GET['section'] ) )? $_GET['section'] : 'featured';
                
                switch( $c_section ){
                    
                    case 'az-index':
                        get_template_part( 'parts/category-section' , 'az-index' );
                        break;
                    case 'search':
                        get_template_part( 'parts/category-section', 'search' );
                        break;
                    default:
                        get_template_part( 'parts/category-section' );
                        break;
                    
                }; // end switch
                ?>
            
            </div>
            
            <?php get_template_part( 'parts/category-related' ); ?>
        
        </article>
		
	</div><!--/column-->

	<div class="column two">
		
		<?php get_sidebar(); ?> 
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>