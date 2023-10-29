<?php get_header() ?>
<section class="event-section">
    <div class="container">
        <div class="section-title">
            <div class="small text-primary bold">Our Designer</div>
            <h2>Our Teams</h2>
        </div>
        <div class="section-content">
            <div class="card-group">
                <?php
                $query = new WP_Query(['post_type' => 'biodata', 'category_name' => get_queried_object()->name]);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post()

                ?>
                        <div class="card">
                            <div class="card-img">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="Image">
                            </div>
                            <div class="card-body">
                                <div class="card-title"><?php the_title() ?></div>
                                <div class="card-content">
                                    <?php the_excerpt() ?>
                                </div>
                            </div>
                        </div>
                <?php wp_reset_postdata();
                    endwhile;
                endif ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>