<?php if ( is_paged() ) : ?>
	<?php if ( function_exists( 'wp_pagenavi' ) ) : ?>
		<?php wp_pagenavi(); ?>
	<?php else: ?>
		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older articles', 'forme' ), '<span class="meta-nav">&larr;</span>') ) ?></div>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer articles %s', 'forme' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
		</div>
	<?php endif; ?>
<?php endif; ?>