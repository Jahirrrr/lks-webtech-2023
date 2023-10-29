<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
	<h1 class="entry-title"><?php forme_the_post_link() ?></h1>
	<?php get_template_part( 'entry', 'meta' ) ?>
	<?php
	if ( is_archive() || is_search() )
		get_template_part( 'entry', 'summary' );
	else
		get_template_part( 'entry', 'content' );

	if ( is_single() )
		get_template_part( 'entry-footer', 'single' ); 
	else
		get_template_part( 'entry-footer' ); 
	?>
</article> 