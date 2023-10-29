<?php
/*
Template Name: Blog
*/
?>

<?php include("header-blog.php"); ?>

<div id="content">
	<div class="container_16 col_16">

		<div class="grid_11 alpha">
		<?php get_template_part( 'nav', 'above' ); ?>
		<?php while ( have_posts() ) : the_post() ?>
		<?php get_template_part( 'entry' ); ?>
		<?php comments_template(); ?>
		<?php endwhile; ?>
		<?php get_template_part( 'nav', 'below' ); ?>
		</div>

		<div class="grid_5 omega lateral">
		<?php get_sidebar(); ?>
		</div>
	</div>
</div>


<?php get_footer(); ?>