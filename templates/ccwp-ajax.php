<?php
$instance = array();

$instance_fields = array(
	'display',
);

foreach( $instance_fields as $if ){
	
	if ( ! empty( $_POST[ $if ] ) ){
		
		$instance[ $if ] = sanitize_text_field( $_POST[ $if ] );
		
	} // end if
	
} // end foreach

$ccl_article = new CCL_Article_Commodities();

$ccl_query = new CCL_Query_Commodities();


$query_args = $ccl_query->get_query_from_post();

var_dump( $query_args );

/*
var_dump( $query_args );

$query = new WP_Query( $query_args );

if ( $query->have_posts() ){
	
	while ( $query->have_posts() ){
		
		$query->the_post();
		
		the_title();
		
	} // end while
	
} else {
	
	echo 'No results found. Try adjusting your filters.';
	
}// end if*/

echo implode( '' , $ccl_article->get_articles_from_query( $query_args , $instance ) );


/*if ( have_posts() ){
	
	while ( have_posts() ){
		
		the_post();
		
		$article = $ccl_article->get_post_article( $post );
		
		echo $ccl_article->get_article_display( $article );
		
	} // end while
	
}*/

?>

