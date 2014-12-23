<?php global $cahnrswp_commodities; ?>
<header id="cahnrs-global-header">
	<div id="site-banner">
    	<a class="site-title" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
			<?php bloginfo('name'); ?> <span><?php bloginfo('description'); ?></span>
        </a>
        <form id="site-search" name="site-search" method="get" action="<?php bloginfo('url'); ?>/site-search">
        	<input id="site-search-field" type="text" value="Search" name="term">
        	<input id="site-search-submit" type="submit" value="">
            <script>
			
				jQuery( document ).ready( function( $ ) {
					
					var site_search = $( '#site-search-field' );
					
					site_search.on( 'focus' , function(){
						
						if( 'Search' == site_search.val() ){
							
							site_search.val(''); 
							
						}; // end if
						
					}); // end on focus
					
				}); // end document ready
			</script>
        </form>
    </div>
    <nav id="site-nav-horizontal" class="bread-crumbs">
    	<a href="<?php bloginfo('url'); ?>" class="home" title="<?php bloginfo('name'); ?>">
			Home
        </a>
    	<?php $cahnrswp_commodities->get_horizontal_nav_menu(); ?>
    </nav>
</header>