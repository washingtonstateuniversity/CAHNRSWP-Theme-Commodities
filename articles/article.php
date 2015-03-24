<?php // Just a stub for now ?>
		
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="article-header">
		<h1 class="article-title">
			<?php the_title(); ?> 
            <?php if ( is_singular( 'page' ) && ! is_front_page() ):?>
            	<a href="#" class="apple-section-icon section-icon" data-class="apple-2"></a>
                <a href="#" class="pear-section-icon section-icon" data-class="pear-2"></a>
                <a href="#" class="cherry-section-icon section-icon" data-class="cherry-2"></a>
                <a href="#" class="peach-section-icon section-icon" data-class="stone-fruit-2"></a>
                <script>
				!function(c,t){t.tf_icons=function(){jQuery(c).ready(function(){jQuery(".section-icon").each(function(){var c=jQuery(this),t=c.data("class"),n=jQuery("."+t).first();n.length>0&&(c.addClass("active"),c.on("click",function(c){jQuery("html").animate({scrollTop:n.offset().top},500,function(){n.hasClass("ccl-article-accordion")&&(c.preventDefault(),n.children(".ccl-title").trigger("click"))}),jQuery("body").animate({scrollTop:n.offset().top},500)}))})})};new tf_icons}(document,window);
				</script>
            <?php endif;?>
        </h1>
	</header>
	<?php the_content(); ?>
</article>