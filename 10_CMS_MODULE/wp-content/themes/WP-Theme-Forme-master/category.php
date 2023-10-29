<?php get_header(); ?>
<section id="content">
	<?php the_post(); ?>
	<h1 class="page-title"><?php _e( 'Category Archives:', 'forme' ) ?> <span><?php single_cat_title() ?></span></h1>
	<?php
	$categorydesc = category_description();
	if ( ! empty( $categorydesc ) )
		echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' );
	?>
	<?php rewind_posts(); ?>
	<?php get_template_part( 'nav', 'above' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>