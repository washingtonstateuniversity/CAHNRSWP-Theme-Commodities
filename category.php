<?php
class CCWP_Category_Archive {
	
	public $ccl_article;
	
	public $ccl_form;
	
	public $archive_cat;
	
	public function __construct( $cat ){
		
		$this->archive_cat = get_category( $cat );
		
		$this->ccl_article = new CCL_Article_Commodities();
			
		$this->ccl_form = new CCL_Form_Commodities();
		
	}
	
	public function get_default_search_content(){
		
		$featured_cat = get_category_by_slug( 'featured' );
		
		$featured_query = array(
			'category__and'  => array( $this->archive_cat->term_id , $featured_cat->term_id ),
			'posts_per_page' => 6,
			'post_type'      => array( 'webarticle' ),
		);
		
		$instance = array(
			'display'       => 'promo',
			'short_excerpt' => 1,
		);
		
		$html = '<h4>Featured ' . $this->archive_cat->name . ' Articles</h4>';
		
		$html .= implode( '' , $this->ccl_article->get_articles_from_query( $featured_query , $instance ) );
		
		return $html;
		
	} // end method get_default_content
	
	public function get_default_browse_content(){
		
		$featured_query = array(
			'category__and'  => array( $this->archive_cat->term_id ),
			'posts_per_page' => 6,
			'post_type'      => array( 'webarticle' ),
		);
		
		$instance = array(
			'display'       => 'promo',
			'short_excerpt' => 1,
		);
		
		$html = '<h4>Recently Added ' . $this->archive_cat->name . ' Articles</h4>';
		
		$html .= implode( '' , $this->ccl_article->get_articles_from_query( $featured_query , $instance ) );
		
		return $html;
		
	} // end method get_default_content
	
	public function get_browse_form_controls(){
		
		$controls = $this->get_sort_control();
		
		$controls .= $this->get_post_type_select();
		
		return $controls;
		
	} // end method get_browse_form_controls
	
	public function get_sort_control(){
		
		$name = 'orderby';

		$args = array(
			'label'    => 'Sort By:',
			'values'   => array(
				'date'  => 'Date',
				'title' => 'Title', 
				),
			'is_radio' => true,
			'current_value' => 'date',
		);
		
		$sort = $this->ccl_form->get_hybrid_multi_select( $name , $args );
		
		return $sort;
		
	} // end method get_sort_control
	
	public function get_post_type_select(){
		
		$post_types = $this->ccl_form->get_post_types( array( 'vanityurl','attachment','post' ) );
	
		$name = 'post_type';

		$args = array(
			'label'    => 'Content Type',
			'values'   => $post_types,
			'current_value' => 'webarticle',
		);
		
		$post_type = $this->ccl_form->get_hybrid_multi_select( $name , $args );
		
		return $post_type;
		
	} // end method get_post_type_select
	
}
$ccwp_category_archive = new CCWP_Category_Archive( $cat ); ?>


<?php get_header(); ?>

<main class="spine-page-default">

<?php get_template_part('parts/headers'); ?>

<?php get_template_part('parts/featured-images'); ?> 

<section class="row side-right">

	<div class="column one">
    	
        <article>
        
        <h1><?php echo $ccwp_category_archive->archive_cat->name;?> Resources</h1>
        <?php get_template_part( 'parts/browse-options' );?>
        
        <?php 
			
			$default_search = $ccwp_category_archive->get_default_search_content();
			
			$search_args = array( 'category__and[]' => 16 );
			
			echo $ccwp_category_archive->ccl_form->get_search_form( $default_search , $search_args );
			
			$default_browse = $ccwp_category_archive->get_default_browse_content();
			
			$browse_args = array( 'category__and[]' => 16 );
			
			$controls = $ccwp_category_archive->get_browse_form_controls();
			
			echo $ccwp_category_archive->ccl_form->get_browse_form( $default_browse , $controls , $search_args , true );
		
		?>
        
        </article>
		
	</div><!--/column-->

	<div class="column two">
		
		<?php get_sidebar(); ?> 
		
	</div><!--/column two-->

</section>

</main>

<?php get_footer(); ?>