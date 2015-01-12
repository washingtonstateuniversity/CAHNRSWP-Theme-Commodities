<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    
        <article>
        
        <header id="archive-header">
            <form class="search-bar" role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div>
                    <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
                    <input class="search-text" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
                    <input type="hidden" name="post_type" value="video" />
                </div>
            </form>
        </header>
		<?php
		
			$pi = 0;
			 
			while ( have_posts() && 8 > $pi ) {
				
				the_post(); 
				
				get_template_part('articles/gallery');
				
				$pi++;
        
			}; // end while?>
        </article>
	</div><!--/column-->

	<div class="column two"> 
		
		<?php get_sidebar(); ?>
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>