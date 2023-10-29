
<?php
/*
Template Name: Blog
*/
?>

<?php include "header-blog.php"; ?>

<div id="content">
<div class="container_16 col_16">
<div class="grid_11 alpha">
<?php if (have_posts()): ?>
    <br></br>
<h1 class="page-title"><?php printf(
    __("Search Results for: %s", "blankslate"),
    "<span>" . get_search_query() . "</span>"
); ?></h1>
<?php get_template_part("nav", "above"); ?>
<?php while (have_posts()):
    the_post(); ?>
<?php get_template_part("entry"); ?>
<?php
endwhile; ?>
<?php get_template_part("nav", "below"); ?>
<?php else: ?>
<div id="post-0" class="post no-results not-found">
<h2 class="entry-title"><?php _e("Nothing Found", "blankslate"); ?></h2>
<div class="entry-content">
<p><?php _e(
    "Sorry, nothing matched your search. Please try again.",
    "blankslate"
); ?></p>
<?php get_search_form(); ?>
</div>
</div>
</div>
<?php endif; ?>
</div>
</div>
<div class="grid_5 omega lateral">
		<?php get_sidebar(); ?>
		</div>

<?php get_footer(); ?>
