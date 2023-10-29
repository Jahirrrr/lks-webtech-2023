<?php get_header(); ?>
<section id="content">
	<?php if ( have_posts() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'forme' ), '<span>' . get_search_query()  . '</span>' ); ?></h1>
		<?php get_template_part( 'nav', 'above' ); ?>
		<?php while ( have_posts() ) : the_post() ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; ?>
		<?php get_template_part( 'nav', 'below' ); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'forme' ) ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'forme' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	<?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>