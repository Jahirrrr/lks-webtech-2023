<?php include("header-blog.php"); ?>

<div id="content">
	<div class="container_16 col_16">

		<div class="grid_11 alpha">			
			
			<div id="content">
			<?php the_post(); ?>
			<h3 class="page-title"><?php _e( 'Artikel sesuai kategori', 'blankslate' ) ?> <span>"<?php single_cat_title() ?>"</span></h1>
			<?php $categorydesc = category_description(); if ( !empty($categorydesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
			<?php rewind_posts(); ?>
			<?php get_template_part( 'nav', 'above' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; ?>
			<?php get_template_part( 'nav', 'below' ); ?>
			</div>
		</div>

		<div class="grid_5 omega lateral">
			<?php get_sidebar(); ?>
		</div>

	</div>			
</div>			
		
		<?php get_footer(); ?>