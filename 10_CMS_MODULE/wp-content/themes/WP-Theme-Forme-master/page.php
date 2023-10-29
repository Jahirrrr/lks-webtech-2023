<?php get_header() ?>
<div id="content">
	<?php the_post() ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
		<h1 class="entry-title"><?php the_title() ?></h1>
		<div class="entry-content">
			<?php  if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
			<?php the_content() ?>
			<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'forme' ) . '&after=</div>' ) ?>
			<?php edit_post_link( __( 'Edit', 'forme' ), '<div class="edit-link">', '</div>' ) ?>
		</div>
	</article>
	<?php comments_template( '', true ) ?>
</div>
<?php get_sidebar() ?>
<?php get_footer() ?>