<div class="clear"></div>
<?php global $post; if ( 'post' == $post->post_type ) : ?>
<div class="entry-footer">

	<div class="row">

		<div class="grid_7 alpha ">
			<?php 
			if ( is_category() && $catz = blankslate_catz(' ') ) : // ?>
			<span class="cat-links"><?php printf( __( '', 'blankslate' ), $catz ); ?></span>
			<span class="meta-sep">  </span>
			<?php else : ?>
			<span class="cat-links"><span class="entry-footer-prep entry-footer-prep-cat-links">
			</span><?php echo get_the_category_list(' '); ?></span>
			<span class="meta-sep"> </span>
			<?php endif; ?>

			<?php if ( is_tag() && $tag_it = blankslate_tag_it(' ') ) : // ?>
			<span class="tag-links"><?php printf( __( ' ', 'blankslate' ), $tag_it ); ?></span>
			<?php else : ?>
			<?php the_tags( '<span class="tag-links"><span class="entry-footer-prep entry-footer-prep-tag-links">' . '</span>', " ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">  </span>\n" ); ?>
			<?php endif; ?>
		</div>


		<div class="grid_2 partilha">

			<span class="partilhar">Bagikan</span>
		</div>
		<div class="grid_2 omega balao">

			<div class="comments-link"><?php comments_popup_link( __( 'Komentar', 'blankslate' ), __( '1', 'blankslate' ), __( '%', 'blankslate' ) ); ?></div>
		</div>
		
	</div>

	<div class="clear"></div>
	
</div>
<?php endif; ?>