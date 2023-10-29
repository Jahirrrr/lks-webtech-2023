<?php include("header-blog.php"); ?>

<div id="content">
	<div class="container_16 col_16">

		<div class="grid_11 alpha">
			<article id="content">
			<?php get_template_part( 'nav', 'above-single' ); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php comments_template('', true); ?>
			<?php endwhile; endif; ?>
			<?php get_template_part( 'nav', 'below-single' ); ?>
			</article>
		</div>
		
		<div class="grid_5 omega lateral">
			<?php get_sidebar(); ?>
		</div>	
	</div>	
</div>			
			<?php get_footer(); ?>