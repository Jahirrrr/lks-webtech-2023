<?php get_header(); ?>
<div id="content">
	<?php the_post(); ?>
	<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'forme' ), "<span class=\"vcard\"><a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a></span>" ) ?></h1>
	<?php $authordesc = $authordata->user_description; if ( !empty($authordesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $authordesc . '</div>' ); ?>
	<?php rewind_posts(); ?>
	<?php get_template_part( 'nav', 'above' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'nav', 'below' ); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>