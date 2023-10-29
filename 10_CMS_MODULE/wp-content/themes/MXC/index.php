<?php get_header() ?>
<main>
    <div class="banner" style="background-image: url('<?= DIR ?>/assets/Banner/aleks-dorohovich-nJdwUHmaY8A-unsplash.jpg')">
        <div class="overlay">
            <div class="container">
                <div class="text">
                    <h1>MixCreativa - Agency</h1>
                    <p>Perusahaan Agen Jasa Sewa Desainer Terbaik, Memiliki Designer Terbaik Dan Sudah Teruji Kualitasnya!</p>
                    <button class="btn">See more</button>
                </div>
            </div>
        </div>
    </div>

    <section class="aboutus-section">
        <div class="container">
            <div class="section-title">
                <p class="small text-white bold">About Us</p>
                <h2>About Company</h2>
            </div>
            <div class="section-content">
                <div class="aboutus-group">
                            <article class="aboutus">
                                <div class="aboutus-text">
                                    <center><h3>MixCreativa adalah perusahaan agensi jasa sewa designer terbaik, memiliki designer terbaik dan sudah teruji kualitasnya!</h3></center>
                                </div>
                            </article>
                </div>
            </div>
        </div>
    </section>

    <section class="biodata-section">
        <div class="container">
            <div class="section-title">
                <div class="small text-primary bold">Designer Teams</div>
                <h2>Our Designer</h2>
            </div>
            <div class="section-content">
                <div class="card-group">
                    <?php
                    $query = new WP_Query(['post_type' => 'biodata']);
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post()
                    ?>
                            <div class="card">
                                <div class="card-img">
                                    <img src="<?= get_the_post_thumbnail_url() ?>" alt="Image">
                                </div>
                                <div class="card-body">
                                    <div class="card-title" ><a href="<?= get_the_permalink() ?>"><?php the_title() ?></a></div>
                                    <div class="card-content">
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

    <section class="contact-section">
    <div class="container">
        <div class="section-title">
            <div class="small text-primary bold">Contact Us</div>
            <h2>Contact Information</h2>
        </div>
        <div class="section-content">
            <div class="contact-form">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>



</main>
<?php get_footer() ?>