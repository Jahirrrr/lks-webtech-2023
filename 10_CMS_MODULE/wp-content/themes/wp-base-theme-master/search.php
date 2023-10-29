<?php 
get_header();
get_template_part('partials/page-head'); ?>

<?php if ( have_posts() ) { ?>

	<?php while (have_posts()) { ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content', 'search' ); ?>
	<?php } ?>

<?php } else { ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php } ?>

<?php get_footer(); ?>