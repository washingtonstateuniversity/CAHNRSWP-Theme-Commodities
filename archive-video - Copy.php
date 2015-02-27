<?php 

class CAHNRSWP_Archive_Type {
	
	public $post_type;
	
	public $ccl_article;
	
	public function __construct(){
		
		global $wp_query;
		
		$this->post_type = $wp_query->query['post_type'];
		
		$this->ccl_article = new CCL_Article_Commodities();
		
	}
	
	public function get_featured(){
		
		$instance = array(
			'display' => 'gallery',
			'per_row' => 4,
		);
		
		$featured_args = array(
			'post_type' => $this->post_type,
			'posts_per_page' => 4,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'name',
					'terms'    => 'Featured',
				),
			),
		);
		
		$featured = new WP_Query( $featured_args );
		
		if ( $featured->have_posts() ){
			
			while ( $featured->have_posts() ){
				
				$featured->the_post();
				
				$article = $this->ccl_article->get_post_article( $featured->post );
				
				echo $this->ccl_article->get_article_display( $article , $instance );
				
				
			} // end while
			
			wp_reset_postdata();
			
		} // end if
		
	} // end method get_featured
	
	public function get_recent(){
		
		$instance = array(
			'display' => 'search-result',
		);
		
		$recent_args = array(
			'post_type' => $this->post_type,
			'posts_per_page' => 8,
			'order' => 'ASC',
		);
		
		$recent = new WP_Query( $recent_args );
		
		if ( $recent->have_posts() ){
			
			while ( $recent->have_posts() ){
				
				$recent->the_post();
				
				$article = $this->ccl_article->get_post_article( $recent->post );
				
				echo $this->ccl_article->get_article_display( $article , $instance );
				
				
			} // end while
			
			wp_reset_postdata();
			
		} // end if
		
	} // end method get_featured
	
	public function get_category_archive(){
		
		global $cahnrswp_commodities;
		
		$cats = $cahnrswp_commodities->get_featured_categories();
		
		foreach( $cats as $cat_id ){
			
			$query = new WP_Query( 'posts_per_page=30&post_type=' . $this->post_type . '&cat=' . $cat_id );
			
			if ( $query->have_posts() ){
			
			$html .= '<li><a href="#">' . get_cat_name( $cat_id ) . '</a>';
			
				$html .= '<ul>';
				
				while ( $query->have_posts() ){
					
					$query->the_post();
					
					$html .= '<li><a href="' . get_permalink() . '">';
					
					$html .= $query->post->post_title;
					
					$html .= '</li>';
					
				} // end while
				
				$html .= '</ul>';
			
			$html .= '</li>';
			
			} // end if
		} // end foreach
		
		echo $html;
		
	}
	
	
	
} 

$cahnrswp_archive = new CAHNRSWP_Archive_Type();
;?>
<?php get_header(); ?>

<main class="spine-page-default <?php echo $cahnrswp_archive->post_type;?>" id="post-type-archive"">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    
        <article>
        
            <header id="archive-header">
                <h1><?php echo post_type_archive_title( );?></h1>
                <form class="search-bar" role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div>
                        <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
                        <input class="search-text" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                        <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
                        <input type="hidden" name="post_type" value="video" />
                    </div>
                </form>
            </header>
            <section class="featured-archive <?php echo $cahnrswp_archive->post_type;?>">
            	<h2>Featured <?php echo post_type_archive_title( );?></h2> 
            	<?php $cahnrswp_archive->get_featured();?>
            </section>
            <section class="recent-archive <?php echo $cahnrswp_archive->post_type;?>">
            	<h4>Recently Added <?php echo post_type_archive_title( );?></h4> 
            	<?php $cahnrswp_archive->get_recent();?>
            </section>
            <section class="category-archive <?php echo $cahnrswp_archive->post_type;?>">
            	<h4><?php echo post_type_archive_title( );?> By Category</h4> 
            	<?php $cahnrswp_archive->get_category_archive();?>
            </section>
        </article>
	</div><!--/column-->

	<div class="column two"> 
		
		<?php get_sidebar(); ?>
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>