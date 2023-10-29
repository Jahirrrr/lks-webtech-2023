<?php get_header() ?>
<?php if (have_posts()) :
    while (have_posts()) : the_post() ?>
        <section class="single">
            <div class="container">
                <div class="section-title">
                    <?php the_title() ?>
                </div>
                <div class="section-content">
                    <?php the_content() ?>
                </div>
            </div>
        </section>
<?php
        wp_reset_postdata();
    endwhile;
endif ?>
<?php get_footer() ?>