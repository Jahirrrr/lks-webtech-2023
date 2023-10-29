<div class="entry-content">
    <br>
<?php 
if ( has_post_thumbnail() ) {
the_post_thumbnail();
} 
?>
<div class="conteudo grid_11 alpha">
<?php the_content(); ?>
</div>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>') ?>
</div>