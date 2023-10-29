<div class="entry-content">
	<?php  if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
	<?php the_content() ?>
	<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'forme' ) . '&after=</div>' ) ?>
</div>