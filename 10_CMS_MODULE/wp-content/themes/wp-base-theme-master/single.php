<?php get_header(); ?>

<?php while (have_posts()) { ?>
	<?php the_post(); ?>
	<?php get_template_part('template-parts/content', get_post_type()); ?>
<?php } ?>

<?php get_footer(); ?>