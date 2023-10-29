<?php get_header(); ?>
<article id="content">
	<?php get_template_part( 'nav', 'above-single' ); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>
		<?php comments_template('', true); ?>
	<?php endwhile; endif; ?>
	<?php get_template_part( 'nav', 'below-single' ); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>